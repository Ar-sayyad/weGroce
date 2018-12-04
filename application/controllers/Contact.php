<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
public function __construct()  
	{
		parent::__construct();
                $this->load->model('tadmin_model');
                $this->load->model('admin_model');
                $this->load->library('session');
                $this->load->model('user');
                $this->load->library('facebook');
                $this->load->library('google');
                $this->load->library('upload');
                date_default_timezone_set("Asia/Kolkata");
                $this->load->library('form_validation');
                $this->load->helper(array('form','url','file')); 
	}
	public function index()
	{              
            $data['page_title'] = 'Contact Us';
            $data['data_title'] = '';
            $this->load->view('home/contact',$data);
	}
        public function submit()
        {
        $this->form_validation->set_rules('name_contact', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lastname_contact', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('email_contact', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone_contact', 'Mobile', 'required|numeric');
        $this->form_validation->set_rules('message_contact', 'Message', 'required');
        if ($this->form_validation->run() == FALSE)
            {
                    echo validation_errors();
            }
            else
             {
                    echo $this->tadmin_model->save_contact_info();;
            } 
        }
       
        
}
