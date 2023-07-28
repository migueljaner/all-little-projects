<?php
class Panel extends CI_Controller{
    private $data;
    function __construct(){
        parent::__construct();
        $this->load->library("session");
        $this->load->model("loginmodel");
    }
    function Index(){
        $this->load->view("panel",$this->data);
        $this->load->view("footer");
    }

}
?>