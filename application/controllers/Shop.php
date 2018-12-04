<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {   
      
      
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
                $this->load->dbutil();
                $this->load->helper(array('form','url','file'));
               
	}
   function backup_db() {
     $date = date('d-m-Y-h-m-s-a');
    $prefs = array(
            'tables'      => array('products','category'),  // Array of tables to backup.
            'ignore'      => array(),           // List of tables to omit from the backup
            'format'      => 'txt',             // gzip, zip, txt
            'filename'    => '$date',    // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
            'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
            'newline'     => "\n"               // Newline character used in backup file
          );
    $backup = $this->dbutil->backup($prefs);
    write_file('assets/uploads/db_backup/'.$date.'.sql', $backup); 
}


public function index()
	{
            $this->db->limit(3);
            $data['category_info']= $this->admin_model->record_list('category');
            $this->load->view('home/index',$data);
	}
        public function home()
	{
		$this->load->view('shop/index3');
	}
        
         public function popup($account_type = '', $page_name = '',$param2 = '')
	{
            $page_name               =	$page_name;
            $page_data['param2']		=	$param2;		
            //echo "hello";
            $this->load->view($account_type.'/'.$page_name,$page_data);	
	}
            
               
        public function likeAnswer(){ 
             $answerId = $this->input->post('answerId');
             $token = $this->session->userdata('token');
            $data = array("answerId" => $answerId);                                                                    
            $data_string = json_encode($data);
            $ch = curl_init($this->api_url.'api/v1/answer/likeDislikeAnswer');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'token: '.$token,
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                               

           $ans_info = curl_exec($ch);
           $ans= json_decode($ans_info,true);            
           if($ans['message']=='Answer liked successfully'){
           echo 1;
           }elseif($ans['message']=='Answer disliked successfully'){
               echo 2;
           }else{ echo 3; }
        }
        
        public function followQuestion(){
            $questionId = $this->input->post('questionId');
            $token = $this->session->userdata('token');
            $data = array("questionId" => $questionId);                                                                    
            $data_string = json_encode($data);
            $ch = curl_init($this->api_url.'api/v1/question/followQuestion');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'token: '.$token,
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                            

           $ans_info = curl_exec($ch);
           $ans= json_decode($ans_info,true);
          
           if($ans['message']=='Question followed successfully')
               { echo 1; }elseif($ans['message']=='Question unFollowed successfully'){ echo 2; }else{ echo 3;}
        }
        
        public function rateAnswer(){
            $answerId = $this->input->post('answerId');
            $rate = $this->input->post('rate');
            $token = $this->session->userdata('token');
            $data = array("answerId" => $answerId,"rating"=>$rate);                                                                    
            $data_string = json_encode($data);
            $ch = curl_init($this->api_url.'api/v1/answer/rateAnswer');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'token: '.$token,
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                            

            $ans_info = curl_exec($ch);
           $ans= json_decode($ans_info,true);
           $answer = array($ans['data']);
          //print_r($answer);
          foreach($answer as $ans){
              echo $average = $ans['rating'];
          }
            
        }
        public function shareAnswer(){
            $answerId = $this->input->post('answerId');
            $questionId = $this->input->post('questionId');
            $token = $this->session->userdata('token');
            $data = array("answerId" => $answerId,"questionId"=>$questionId,"linkType"=>1);                                                                    
            $data_string = json_encode($data);
            $ch = curl_init($this->api_url.'api/v1/answer/shareAnswer');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'token: '.$token,
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                            
          $share_info = curl_exec($ch);
          $share= json_decode($share_info,true);
          $sharing = array($share['data']);
          //print_r($answer);
          foreach($sharing as $shr){
              echo $link = $shr['redirectUrl'];
          }
        }
        
        
         public function share(){
            $id = $this->input->post('product_id');
          
            $data = array("product_id" => $id);                                                                    
            $data_string = json_encode($data);
            $ch = curl_init($this->api_url.'api/v1/answer/shareAnswer');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'token: '.$token,
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                            
          $share_info = curl_exec($ch);
          $share= json_decode($share_info,true);
          $sharing = array($share['data']);
          //print_r($answer);
          foreach($sharing as $shr){
              echo $link = $shr['redirectUrl'];
          }
        }


                public function logout() {
            //$this->session->sess_destroy();
            $this->session->set_userdata('userData','');
            $this->session->set_userdata('user_login', '');
            $this->session->set_userdata('login_user_id', '');
            $this->session->set_userdata('login_email_id', '');
            $this->session->set_userdata('name', '');
            $this->session->set_userdata('login_type', '');
            $this->session->set_userdata('profile_img','');
            $this->session->set_userdata('token','');
            $this->session->set_flashdata('logout_notification', 'logged_out');
            redirect(base_url(), 'refresh');
        }
            /***login-logout END***/
        
}
