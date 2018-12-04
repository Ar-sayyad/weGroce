<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {
    public function __construct()  
	{
		parent::__construct();
                $this->load->library('session');
                $this->load->helper(array('form','url','file')); 
	}
	public function index()
	{
          $opts = array(
              'http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);            
            $question_info = file_get_contents($this->api_url.'api/web/questions/all/0/9', false, $context);          
            $data['question_info'] = json_decode($question_info,true);
            $data['page_title'] = 'Questions & Answers';
            $data['data_title'] = '';
            $this->load->view('home/questions',$data);
	}
      




        
}
