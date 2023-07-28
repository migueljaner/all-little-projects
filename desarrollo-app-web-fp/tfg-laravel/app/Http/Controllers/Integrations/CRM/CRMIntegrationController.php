<?php

namespace App\Http\Controllers\Integrations\CRM;

// Libs
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

// Controllers
use App\Http\Controllers\Integrations\CRM\CRMVtigerIntegrationController as Vtiger;

class CRMIntegrationController extends Controller
{

    // Variables
    private $CRM;
    
    // Public functions
    public function __construct()
    {
        $this->CRM = new Vtiger();
    }

    // Connect/Login to API CRM client.
    public function connect()
    {
        return $this->CRM->connect();
    }

    // Disconnect/Logout to API CRM client.
    public function disconnect()
    {
        return $this->CRM->disconnect();
    }

    // Insert data contacto in CRM client.
    public function setContact($clientele)
    {
        return $this->CRM->setContact($clientele);
    }

}
