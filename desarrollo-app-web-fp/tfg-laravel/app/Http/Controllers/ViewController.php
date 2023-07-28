<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ViewController extends Controller
{

    private $dataView = [];
    private $view;
    private $user;
    
    public function __construct(String $view, Array $dataView = [])
    {

        View::exists($view) ? $this->view = $view : exit;

        $this->user = Auth::user();

        $this->dataView['parameters'] = $dataView;

    }

    public function draw()
    {

        return view($this->view, ['data' => $this->dataView]);
        
    }

}
