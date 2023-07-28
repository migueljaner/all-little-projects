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

class CaptivePortalController extends Controller
{

    // Variables
    private $request;

    // Public functions
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {

        $guid="e2b11b93-e26f-4b96-afbd-00e228e8a1c1";

        $establishment = Establishment::where('guid', '=', 'e2b11b93-e26f-4b96-afbd-00e228e8a1c1')->first();

        if($establishment){

            $parameters = [
                'cp-mac' => array_get($this->request, 'mac'),
                'cp-ip' => false,
                'cp-link-login' => false,
                'cp-link-orig' => false,
                'cp-error' => false,
                'cp-chap-id' => false,
                'cp-chap-challenge' => false,
                'cp-link-login-only' => false,
                'cp-link-orig-esc' => false,
                'cp-mac-esc' => false,
                'cp-popup' => false,
                'cp-login' => array_get($this->request, 'link-login-only'),
                'cp-guid' => $guid,
                'cp-demo' => false,
                'cp-isRegistered' => false,
            ];

            $this->request->session()->put($parameters);

            $view = new View('public.captive-portal.index', ['guid' => $guid]);

            return $view->draw();

        }

        return "The establishment you are trying to access does not exist.";

    }

    public function registerClientele()
    {

        $establishment = Establishment::where('guid', '=', $this->request->session()->get('cp-guid'))->first();

        if($this->request->session()->get('cp-demo', FALSE)){
            return response(json_encode(['success' => 'ok', 'msg' => '', 'parameters' => $this->getParametersSession()], JSON_UNESCAPED_UNICODE))
            ->header('Content-Type', 'application/json');
        }

        $clientele = $this->saveDataClientele($establishment);
        $device = $this->saveDataDevice($clientele);

        if($this->createRelationClienteleDevice($clientele, $device) &&
            $this->createRelationClienteleEstablishment($clientele, $establishment)
        ){
            
            return response(json_encode(['success' => 'ok', 'msg' => '', 'parameters' => $this->getParametersSession()], JSON_UNESCAPED_UNICODE))
            ->header('Content-Type', 'application/json');

        }

    }

    public function successLogin()
    {
        
        $view = new View('public.captive-portal.success');

        return $view->draw();
        
    }

    // Private functions
    private function saveDataClientele($establishment)
    {

        $clientele = new Clientele;
        $clientele->name = array_get($this->request, 'names', 'pepe');
        $clientele->surname = array_get($this->request, 'surnames', 'jones');
        $clientele->email = array_get($this->request, 'mail', 'pepe@gmail.com');
        $clientele->gender_id = array_get($this->request, 'genders', '1');
        $clientele->birthdate = array_get($this->request, 'birthdates', '1999-3-25');
        $clientele->nationality = 1;
        $clientele->save();

        $this->saveDataClienteleInCRM($clientele, $establishment);

        return $clientele;

    }

    private function saveDataClienteleInCRM($clientele, $establishment)
    {

        $CRM = new CRMIntegration();
        $CRM->connect();
        $CRM->setContact($clientele);
        $CRM->disconnect();

        return true;
        
    }

    private function saveDataDevice($clientele)
    {

        $clienteleMac = 'B8:81:98:ED:32:04';

        $device = new ClienteleDevice;
        $device->mac = $clienteleMac;
        $device->last_proprietor = $clientele->id;
        $device->save();

        return $device;

    }

    private function createRelationClienteleDevice($clientele, $device)
    {
        
        $rsClienteleDevice = new RelationshipClienteleDevice;
        $rsClienteleDevice->device_id = $device->id;
        $rsClienteleDevice->clientele_id = $clientele->id;
        $rsClienteleDevice->save();

        return true;

    }

    private function createRelationClienteleEstablishment($clientele, $establishment)
    {
        
        $rsClienteleEstablishmet = new RelationshipClienteleEstablishment;
        $rsClienteleEstablishmet->establishment_id = $establishment->id;
        $rsClienteleEstablishmet->clientele_id = $clientele->id;
        $rsClienteleEstablishmet->save();

        return true;

    }

    private function trackVisitClientele($clientele, $establishment)
    {

        $clienteleVisit = new ClienteleVisitEstablishment;
        $clienteleVisit->clientele_id = $clientele->id;
        $clienteleVisit->establishment_id = $establishment->id;
        $clienteleVisit->save();

        return true;

    }

    private function getParametersSession(){

        return $parameters = [
            'mac' => $this->request->session()->get('cp-mac', FALSE),
            'username' => 'test',
            'password' => 'test',
            'ip' => false,
            'link_login' => false,
            'link_orig' => false,
            'error' => false,
            'chap_id' => false,
            'chap_challenge' => false,
            'link_login_only' => false,
            'link_orig_esc' => false,
            'mac_esc' => false,
            'popup' => false,
            'login' => $this->request->session()->get('cp-login', FALSE),
            'demo' => false,
        ];

    }

    // Validators
    private function validatorHotspotsParameters()
    {
        return true;
    }

    private function validatorDataClientele()
    {
        return true;
    }

}
