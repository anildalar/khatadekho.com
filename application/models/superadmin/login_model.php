<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login_user($email,$password){

        //dd($password);
        //$email,$pass
        $this->db->select('*');
        $this->db->from('geopos_users');
        $this->db->where('email',$email);
        $this->db->where('pass',$password);
        
        if($query=$this->db->get())
        {
            return $query->result_array();
        }
        else{
            return false;
        }
        
        
    }
}