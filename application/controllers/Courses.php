<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

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
		
        //$this->load->view('shop/courses');
	}

    // public function courselist(){
        
    //    // $this->load->view('shop/courselist');
    // }

    // public function coursedetail(){
        
    //     //$this->load->view('shop/coursedetail');
    // }
    // public function products($code='',$name='')
    // {
    //    $name = str_replace('-', ' ', $name);
    //    $data['code'] = $code;
     
    //    // $data['id'] = $id;
    //   // $data['category_info'] = $this->admin_model->get_cateby_info($id);
    //    $data['single_cat_prod_info'] = $this->admin_model->select_single_product_info($code);
    //    $this->load->view('shop/products',$data); 
    // }
        
}
