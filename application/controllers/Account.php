<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();

class Account extends CI_Controller {

     public function __construct()  
    {
        parent::__construct();
                $this->load->model('tadmin_model');
                $this->load->model('admin_model');
                $this->load->library('session');
                $this->load->library('upload');
                date_default_timezone_set("Asia/Kolkata");
                $this->load->library('form_validation');
                $this->load->helper(array('form','url','file')); 
    }
    
    	public function index()
    	{
           
    	   $data['user_info'] = $this->tadmin_model->select_login_user_info();          
           $data['page_title'] = 'My Account';
           $data['data_title'] = '';
           $this->load->view('home/my_account',$data);
    	}
        
         public function updateMyaccInfo(){
             if ($this->session->userdata('user_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
            }           
                $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
                $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('contact', 'Mobile Number', 'required|numeric|regex_match[/^[0-9]{10}$/]'); 
               
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                    }
                    else
                     {
                            echo $this->tadmin_model->update_Myacc_info();;
                    }    
            
        }
        
         public function updateProfileAccInfo(){
             if ($this->session->userdata('user_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
            }            
                $this->form_validation->set_rules('city', 'City Name', 'required|alpha');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('pincode', 'Pincode ', 'required|numeric|regex_match[/^[0-9]{6}$/]'); 
               
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                    }
                    else
                     {
                            echo $this->tadmin_model->update_MyProfacc_info();;
                    }    
            
        }
        
         public function uploadProfilePcs($task = "",$image="")
        {
             if ($this->session->userdata('user_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
            } 

             if ($task == "update") {
                
                $this->tadmin_model->save_uploadProfilePcs_info($image);
                $this->session->set_userdata('profile_img', base_url().'assets/uploads/users/'.$image);
                  $this->session->set_flashdata('msg', 'Profile Picture Uploaded Successfully.'); 
                   redirect(base_url() .'account');
            }
        }
}