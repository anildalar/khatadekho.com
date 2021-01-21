<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class BusinessModel extends CI_Model
{

    public function BusinessList(){

        /*if(!empty($this->input->get("search"))){
          $this->db->like('title', $this->input->get("search"));
          $this->db->or_like('description', $this->input->get("search")); 
        }*/
        $query = $this->db->get("business");
        return $query->result();
    }

    public function add_business()
    {    
        $data = array(
            'business_name' => $this->input->post('business_name'),
            'owner_mobno' => $this->input->post('owner_mobno'),
            'business_website' => $this->input->post('business_website'),
            'owner_name' => $this->input->post('owner_name'),
            'owner_email' => $this->input->post('owner_email'),
            'business_addr' => $this->input->post('business_addr'),
            'status' => $this->input->post('status')
        );
        return $this->db->insert('business', $data);
    }

    public function find_Business($id)
    {
        return $this->db->get_where('business', array('id' => $id))->row();
    }

    public function update_business($id) 
    {
        $data = array(
            'business_name' => $this->input->post('business_name'),
            'owner_mobno' => $this->input->post('owner_mobno'),
            'business_website' => $this->input->post('business_website'),
            'owner_name' => $this->input->post('owner_name'),
            'owner_email' => $this->input->post('owner_email'),
            'business_addr' => $this->input->post('business_addr'),
            'status' => $this->input->post('status')
        );
        if($id==0){
            return $this->db->insert('business',$data);
        }else{
            $this->db->where('id',$id);
            return $this->db->update('business',$data);
        }        
    }
}