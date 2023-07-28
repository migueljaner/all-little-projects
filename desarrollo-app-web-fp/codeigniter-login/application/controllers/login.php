<?php

    class Login extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->library("session");
            $this->load->model("loginmodel");
        }

        function Index(){
            $this->load->view("login");
            $this->load->view("footer");
        }
        function Login(){
            if($this->input->post()){
                $nombre = $this->input->post("usuario");
                $contraseña = $this->input->post("clave");
                if($this->loginmodel->login($nombre,$contraseña)){
                    header("Location: /Panel");
                }
            }
        }
        function Logout(){
            $this->session->unset_userdata("id");
            header("Location: /Login");
        }
    }

?>