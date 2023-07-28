<?php

namespace App\Http\Controllers;

// Libs
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator;
use DateTime;

// Controller
use App\Http\Controllers\ViewController as View;
use App\Http\Controllers\Integrations\CRM\CRMIntegrationController as CRMIntegration;

// Models
use App\Clientele as Clientele;
use App\Establishment as Establishment;
use App\ClienteleDevice as ClienteleDevice;
use App\ClienteleVisitEstablishment as ClienteleVisitEstablishment;
use App\RelationshipClienteleDevice as RelationshipClienteleDevice;
use App\RelationshipClienteleEstablishment as RelationshipClienteleEstablishment;

class CaptivePortalController extends Controller{
    // Variables
    private $request;
    
    // Public functions
    public function __construct(Request $request){
        $this->request = $request;
    }
    public function index($guid, $isDemo = false){
        if(strlen($guid) == 36){

            $validator = $this->validatorHotspotsParameters($isDemo);

            if (!$validator->passes() && !$isDemo){
                //return redirect()->route('index');
                Log::error(['code' => '0', 'msg' => 'The required parameters of the hotspots have not been obtained. Error: '.$validator->errors()]);
            }

            $establishment = Establishment::where('guid', '=', $guid)->first();

            if($establishment){

                $parameters = [
                    'cp-mac' => array_get($this->request, 'mac'),
                    'cp-ip' => array_get($this->request, 'ip'),
                    'guid' => $guid,
                    'cp-link-login' => array_get($this->request, 'link-login'),
                    'cp-link-orig' => array_get($this->request, 'link-orig'),
                    'cp-error' => array_get($this->request, 'error'),
                    'cp-chap-id' => array_get($this->request, 'chap-id'),
                    'cp-chap-challenge' => array_get($this->request, 'chap-challenge'),
                    'cp-link-login-only' => array_get($this->request, 'link-login-only'),
                    'cp-link-orig-esc' => array_get($this->request, 'link-orig-esc'),
                    'cp-mac-esc' => array_get($this->request, 'mac-esc'),
                    'cp-popup' => array_get($this->request, 'popup'),
                    'cp-login' => array_get($this->request, 'link-login-only').'?dst="'.route('index').'/'.$guid.'/success"',
                    'cp-guid' => $guid,
                    'cp-demo' => $isDemo ? true : false,
                    'cp-isRegistered' => false,
                    'lang' => array_get($this->request, 'lang')
                ];
                
                $this->request->session()->put($parameters);

                $clienteleDevice = ClienteleDevice::where('mac', '=', array_get($this->request, 'mac'))->first();

                if($clienteleDevice && !$isDemo){
                    return $this->bypassLogin($clienteleDevice, $establishment);
                }

				// Request::server('HTTP_ACCEPT_LANGUAGE')
                $view = new View('public.captive-portal.index', ['guid' => $guid]);
                return $view -> draw();

            }
        }
        return "The establishment you are trying to access does not exist.";
    }

    public function registerClientele(){ 
        
        $validator = $this->validatorDataClientele();
        
        
        if (!$validator->passes()){
            return json_encode(['success' => 'error', 'msg' => $validator->errors()], JSON_UNESCAPED_UNICODE);
        }

        $establishment = Establishment::where('guid', '=', $this->request->session()->get('cp-guid'))->first();

        if(!$establishment){
            return response(json_encode(['success' => 'error', 'msg' => "The establishment you are trying to access does not exist."], JSON_UNESCAPED_UNICODE))
            ->header('Content-Type', 'application/json');
        }

        if($this->request->session()->get('cp-demo', FALSE)){
            return response(json_encode(['success' => 'ok', 'msg' => '', 'parameters' => $this->getParametersSession()], JSON_UNESCAPED_UNICODE))
            ->header('Content-Type', 'application/json');
        }

        $clientele = $this->saveDataClientele();
        $device = $this->saveDataDevice($clientele);
        
        // guardamos en el CRM
        $this->saveDataClienteleInCRM($clientele->getAttributes(), $this->request->session()->get('cp-guid'));


        if($this->createRelationClienteleDevice($clientele, $device) &&
            $this->createRelationClienteleEstablishment($clientele, $establishment)){

            if($this->trackVisitClientele($clientele, $establishment)){
                return response(json_encode(['success' => 'ok', 'msg' => '', 'parameters' => $this->getParametersSession()], JSON_UNESCAPED_UNICODE))
                ->header('Content-Type', 'application/json');
            }
            
            return response(json_encode(['success' => 'ok', 'msg' => '', 'parameters' => $this->getParametersSession()], JSON_UNESCAPED_UNICODE))
            ->header('Content-Type', 'application/json');
        }

        return response(json_encode(['success' => 'error', 'msg' => "Error registration clientele in establishment."], JSON_UNESCAPED_UNICODE))
        ->header('Content-Type', 'application/json');
    }
    public function successLogin($guid){ 
        if($this->request->session()->get('cp-isRegistered', FALSE)){

            $this->request->session()->forget('cp-isRegistered');
            $this->request->session()->forget('cp-demo');

            $view = new View('public.captive-portal.success');

            return $view->draw();

        }
        if($this->request->session()->get('cp-demo', FALSE)){
            return redirect(route('captive_portal_demo').'/'.$guid);
        }
        return redirect('/captive-portal/'.$guid);
    }

    // Private functions
    private function bypassLogin($clienteleDevice = false, $establishment = false){
        if($clienteleDevice && $establishment){
            $clientele = $clienteleDevice->last_proprietor;

            if($this->trackVisitClientele($clientele, $establishment)){

                $parameters = $this->getParametersSession();

                $view = new View('public.captive-portal.bypass', $parameters);

                return $view->draw();   
            }
        }
        Log::error(['code' => '0', 'msg' => "It was not possible to activate the bypass."]);

        return false;
    }
    private function saveDataClientele(){
        $clientele = Clientele::where('name', '=', array_get($this->request, 'name'))
        ->where('surname', '=', array_get($this->request, 'surname'))
        ->first();

        if(!$clientele){
            $clientele = new Clientele;
            $clientele->name = array_get($this->request, 'name');
            $clientele->surname = array_get($this->request, 'surname');
            $clientele->email = array_get($this->request, 'email');
            $clientele->gender_id = array_get($this->request, 'gender');
            $clientele->birthdate = array_get($this->request, 'birthdate');
            $clientele->nationality = 1;
            $clientele->save();
            
            if(!$clientele){
                Log::error(['code' => '0', 'msg' => 'The clientele could not be registered, it is possible that the data has already been registered.']);
                return false;
            }
        }
        return $clientele;
    }
    private function saveDataClienteleInCRM($clientele){
        $CRM = new CRMIntegration();
        $CRM->connect();
        $CRM->setContact($clientele);
        $CRM->disconnect();

        return true;
    }
    private function saveDataDevice($clientele = false){
        if($clientele){
            $clienteleMac = $this->request->session()->get('cp-mac');

            $device = ClienteleDevice::where('mac', '=', $clienteleMac)->first();

            if(!$device){

                $device = new ClienteleDevice;
                $device->mac = $clienteleMac;
                $device->last_proprietor = $clientele->id;
                $device->save();
                if(!$device){
                    Log::error(['code' => '0', 'msg' => "Unable to register the client's device, it is possible that the data has already been registered."]);
                    return false;
                }
            }
            if($device->last_proprietor != $clientele->id){

                $device->last_proprietor = $clientele->id;
                $device->save();
            }
            return $device;
        }
        return false;
    }
    private function createRelationClienteleDevice($clientele = false, $device = false){
        if($clientele && $device){

            $rsClienteleDevice = RelationshipClienteleDevice::where('device_id', '=', $device->id)
            ->where('clientele_id', '=', $clientele->id)
            ->first();

            if(!$rsClienteleDevice){
                $rsClienteleDevice = new RelationshipClienteleDevice;
                $rsClienteleDevice->device_id = $device->id;
                $rsClienteleDevice->clientele_id = $clientele->id;
                $rsClienteleDevice->save();
            }

            if($rsClienteleDevice){
                return true;
            }
        }
        return false;
    }
    private function createRelationClienteleEstablishment($clientele = false, $establishment = false){
        if($clientele && $establishment){
            $rsClienteleEstablishmet = RelationshipClienteleEstablishment::where('establishment_id', '=', $establishment->id)
            ->where('clientele_id', '=', $clientele->id)
            ->first();
            if(!$rsClienteleEstablishmet){

                $rsClienteleEstablishmet = new RelationshipClienteleEstablishment;
                $rsClienteleEstablishmet->establishment_id = $establishment->id;
                $rsClienteleEstablishmet->clientele_id = $clientele->id;
                $rsClienteleEstablishmet->save();
            }

            if($rsClienteleEstablishmet){
                return true;
            }
        }
        return false;
    }
    private function trackVisitClientele($clientele = false, $establishment = false){
        if($clientele && $establishment){
            $clienteleVisit = ClienteleVisitEstablishment::where('establishment_id', '=', $establishment->id)
            ->where('clientele_id', '=', $clientele)
            ->orderBy('id', 'desc')
            ->first();
            if($clienteleVisit){
                $dateRegisterVisit = new DateTime($clienteleVisit->created_at);
                $currentDate = new DateTime('now');
                $interval = $dateRegisterVisit->diff($currentDate);
                $diffDates = $interval->h + ($interval->days*24);

                Log::info($diffDates.' '.$clienteleVisit->id);

                if($diffDates < 1){
                    return true;
                }
            }
            $clienteleVisitClient = Establishment::join('clients','establishments.client_id','clients.id')
                                                ->join('clientele_visit_establishments','establishments.id','clientele_visit_establishments.establishment_id')
                                                ->select('establishments.*')
                                                ->where('clientele_visit_establishments.clientele_id',$clientele)
                                                ->where('establishments.id', $establishment->id)->first();
            $clienteleVisitClient = ClienteleVisitEstablishment::where('establishment_id', '=', $clienteleVisitClient->id)
            ->where('clientele_id', '=', $clientele)
            ->orderBy('id', 'desc')
            ->first();
            if($clienteleVisitClient){
                $dateRegisterVisit = new DateTime($clienteleVisitClient->created_at);
                $currentDate = new DateTime('now');
                $interval = $dateRegisterVisit->diff($currentDate);
                $diffDates = $interval->h + ($interval->days*24);

                Log::info($diffDates.' '.$clienteleVisitClient->id);

                if($diffDates < 1){
                    return true;
                }
            }
                                                
            $clienteleVisit = new ClienteleVisitEstablishment;
            $clienteleVisit->clientele_id = $clientele->id;
            $clienteleVisit->establishment_id = $establishment->id;
            $clienteleVisit->save();
            if($clienteleVisit){
                return true;
            }
        }
        return false;
    }
    private function getParametersSession(){ //Se lo mandamos al micro-tick

        $this->request->session()->put(['cp-isRegistered' => TRUE]);

        return $parameters = [
            'mac' => $this->request->session()->get('cp-mac', FALSE),
            'username' => 'test',
            'password' => 'test',
            'ip' => $this->request->session()->get('cp-ip', FALSE),
            'link_login' => $this->request->session()->get('cp-link-login', FALSE),
            'link_orig' => $this->request->session()->get('cp-link-orig', FALSE),
            'error' => $this->request->session()->get('cp-error', FALSE),
            'chap_id' => $this->request->session()->get('cp-chap-id', FALSE),
            'chap_challenge' => $this->request->session()->get('cp-chap-challenge', FALSE),
            'link_login_only' => $this->request->session()->get('cp-link-login-only', FALSE),
            'link_orig_esc' => $this->request->session()->get('cp-link-orig-esc', FALSE),
            'mac_esc' => $this->request->session()->get('cp-mac-esc', FALSE),
            'popup' => $this->request->session()->get('cp-popup', FALSE),
            'login' => $this->request->session()->get('cp-login', FALSE),
            'demo' => $this->request->session()->get('cp-demo', FALSE),
            'lang' => $this->request->session()->get('lang',FALSE),
        ];

    }
      // Validators
    private function validatorHotspotsParameters(){
        return Validator::make($this->request->all(), [
            'mac' => 'required',
            'ip' => 'required',
            'link-login' => 'required',
            'link-orig' => 'required',
            'error' => 'required',
            'chap-id' => 'required',
            'chap-challenge' => 'required',
            'link-login-only' => 'required',
            'link-orig-esc' => 'required',
            'mac-esc' => 'required',
        ]);
    }
    private function validatorDataClientele($isDemo = false){
        return Validator::make($this->request->all(), [
            'name' => 'required|min:2|max:30|string',
            'surname' => 'required|min:2|max:30|string',
            'email' => 'required|email|min:8|max:150'.$isDemo ? '' : '|kickbox',
            'gender' => 'required|numeric|min:1',
            'birthdate' => 'required|date',
            'acceptConditions' => 'required|in:on',
            //'acceptConditionsMinor' => 'in:on',
        ]);
    }
}
  