<?php
class Loginmodel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library("session");
    }
    function Login($usuario,$contraseña){
        $sql = "SELECT * FROM usuarios WHERE nombre=".$this->db->escape($usuario)." AND contraseña=".$this->db->escape($contraseña)."";
        $query=$this->db->query($sql);
        if($query){
            if($query->num_rows()==1){
                foreach($query->result() as $row){
                    $userdata = array(
                        "id"=>$row->id,
                        "nombre"=>$row->nombre
                    );
                }
                $this->session->set_userdata($userdata);
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}

?>