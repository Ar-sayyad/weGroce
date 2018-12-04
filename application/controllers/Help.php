<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {
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
		$this->load->view('shop/help');
	}
       
        
}
