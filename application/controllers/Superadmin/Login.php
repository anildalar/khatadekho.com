<?php
/**
 * Geo POS -  Accounting,  Invoicing  and CRM Application
 * Copyright (c) Rajesh Dukiya. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@ultimatekode.com
 *  Website: https://www.ultimatekode.com
 *
 *  ************************************************************************
 *  * This software is furnished under a license and may be used and copied
 *  * only  in  accordance  with  the  terms  of such  license and with the
 *  * inclusion of the above copyright notice.
 *  * If you Purchased from Codecanyon, Please read the full License from
 *  * here- http://codecanyon.net/licenses/standard/
 * ***********************************************************************
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library("Aauth");
        $this->load->library('form_validation');
        $this->load->model('superadmin/login_model');
        $this->load->library('session');  
    }
    
    public function signIn(){

        if($this->session->userdata('is_logged_in') == true){
            redirect('su/dashboard/','refresh');
        } 
        $this->load->view('superadmin/header');
        $this->load->view('superadmin/login',);
        $this->load->view('superadmin/footer');
    }

    public function checklogin(){

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if($this->form_validation->run() == true){
            $email    = $this->input->post('email');
            $password = md5($this->input->post('password'));

            //dd($password);
            $result = $this->login_model->login_user($email,$password);

            if(!empty($result)){
                $this->session->set_flashdata('success','logged in ');

                $this->session->set_userdata('is_logged_in',true);
                $this->session->set_userdata('email',$result[0]['email']);
                $this->session->set_userdata('username',$result[0]['username']);
                $this->session->set_userdata('id',$result[0]['id']); 

                //get session data
                //$data = $this->session->userdata('username');

                redirect('su/dashboard/','refresh');
                
            }else{
                $this->session->set_flashdata('error','No Such Account Exist');
                redirect('/su','refresh');
            }
        }else{
            $this->session->set_flashdata('error','Invalid Username Or password');
            redirect('/su','refresh');
        }
        
    }

    public function logout()
    {
        $this->session->unset_userdata('user_loggedin'); 
        $this->session->unset_userdata('id'); 
        $this->session->sess_destroy(); 

        redirect('/su/', 'refresh');

    }
}