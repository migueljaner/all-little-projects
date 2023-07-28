<?php

namespace App\Http\Controllers\Integrations\CRM;

// Libs
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CRMVtigerIntegrationController extends Controller
{

    private $connectionCRM;
    private $sessionName;
    private $userId;
    private $username;
    private $userAccessKey;
    
    public function __construct()
    {
        $this->username = 'dluis';
        $this->userAccessKey = 'W2niWHVU6Wn5m0Tq';
        $this->connectionCRM = new \GuzzleHttp\Client(['base_uri' => 'http://crmportal.dndsys.com']);
    }

    public function connect()
    {

        $request = $this->connectionCRM->request('GET', 'webservice.php', [
            'query' => [
                'operation' => 'getchallenge',
                'username' => $this->username,
            ],
        ]);

        if($request->getStatusCode() == 200){

            $response = json_decode($request->getBody()->getContents());
            $token = $response->result->token;
            $accessKey = md5($token.$this->userAccessKey);

            $request = $this->connectionCRM->request('POST', 'webservice.php', [
                'form_params' => [
                    'operation' => 'login',
                    'username' => $this->username,
                    'accessKey' => $accessKey,
                ],
            ]);

            if($request->getStatusCode() == 200){

                $response = json_decode($request->getBody()->getContents());

                if($response->success){

                    $this->sessionName = $response->result->sessionName;
                    $this->userId = $response->result->userId;

                    return true;

                }

            }

        }

        return false;

    }

    public function disconnect()
    {

        $request = $this->connectionCRM->request('POST', 'webservice.php', [
            'form_params' => [
                'operation' => 'logout',
                'sessionName' => $this->sessionName,
            ],
        ]);

        if($request->getStatusCode() == 200){

            $response = json_decode($request->getBody()->getContents());

            if($response->success){
                return true;
            }

        }

        return false;

    }

    public function setContact($clientele)
    {

        $request = $this->connectionCRM->request('POST', 'webservice.php', [
            'form_params' => [
                'operation' => 'create',
                'sessionName' => $this->sessionName,
                'elementType' => 'Contacts',
                'element' => json_encode([
                    'firstname' => array_get($clientele, 'name', ''), 
                    'lastname' => array_get($clientele, 'surname', ''), 
                    'email' => array_get($clientele, 'email', ''),
                    'birthday' => array_get($clientele, 'birthday', ''),
                    'gender' => array_get($clientele, 'gender.name', ''),
                    'room' => array_get($clientele, 'room', ''),
                    'assigned_user_id' => $this->userId,
                    'source' => 'CAPTIVE-PORTAL',
                ]),
            ],
        ]);

        if($request->getStatusCode() == 200){

            $response = json_decode($request->getBody()->getContents());

            if($response->success){
                return true;
            }

        }

    }
    
}
