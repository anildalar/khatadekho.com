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

class BusinessController extends CI_Controller
{
    public $businessM;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library("Aauth");
        $this->load->library('form_validation');
        $this->load->library('session');  
        if($this->session->userdata('is_logged_in') != true){
            redirect('/su/', 'refresh');
            exit;
        }
        $this->load->model('superadmin/BusinessModel'); 

        $this->businessM = new BusinessModel;
    }
    
    public function index(){
        $data['data'] = $this->businessM->BusinessList();
        //echo "hello bussiness";
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Business';
        
        $this->load->view('superadmin/includes/header', $head);
        $this->load->view('superadmin/business',$data);
        $this->load->view('superadmin/includes/footer');
    }

    public function create()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Create Business';
        
        $this->load->view('superadmin/includes/header', $head);
        $this->load->view('superadmin/add-business');
        $this->load->view('superadmin/includes/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('business_name', 'Business Name', 'required');
        $this->form_validation->set_rules('owner_mobno', 'Owner Mobile', 'required');
        $this->form_validation->set_rules('owner_name', 'Owner Name', 'required');
        $this->form_validation->set_rules('owner_email', 'Owner Email', 'required|valid_email');
        $this->form_validation->set_rules('business_addr', 'Business Address', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url('su/business/create'));
        }else{
           $this->businessM->add_business();
           redirect(base_url('su/business/'));
        }
    }

    public function edit($id)
    {
        $business = $this->businessM->find_Business($id);

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Edit Business';
        $status = '1';

        $this->load->view('superadmin/includes/header',$head);
        $this->load->view('superadmin/edit-business',array('business'=>$business),$status);
        $this->load->view('superadmin/includes/footer');
    }

    public function update($id)
    {
        //dd($id);

        $this->form_validation->set_rules('business_name', 'Business Name', 'required');
        $this->form_validation->set_rules('owner_mobno', 'Owner Mobile', 'required');
        $this->form_validation->set_rules('owner_name', 'Owner Name', 'required');
        $this->form_validation->set_rules('owner_email', 'Owner Email', 'required|valid_email');
        $this->form_validation->set_rules('business_addr', 'Business Address', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url('su/business/edit/'.$id));
        }else{ 
          $this->businessM->update_business($id);
          redirect(base_url('su/business/'));
        }
    }

}