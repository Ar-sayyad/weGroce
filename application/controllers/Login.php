<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
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
		$this->load->view('shop/login');
	}
        public function validateLogin() {
             $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                    }
                    else
                     {
                            $email= $this->input->post('email');
                            $password = $this->input->post('password');
                            $credential = array('email' => $email, 'password' => $password);
                            echo $this->tadmin_model->validate_User_login_info($email,$password);
                    }
                
                            
        }
         public function Checkvendors($param2){
            $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/users/profile/'.$param2, false, $context);
             $trainer = json_decode($trainer_info,true);
            
             $t = array($trainer['data']); 
            foreach($t as $row){
                 
                
                        $this->session->set_userdata('trainer_login', '1');
                        $this->session->set_userdata('log_trainer_id', $row['id']);
                        $this->session->set_userdata('log_trainer_email', $row['email']);
                        $this->session->set_userdata('log_trainer_mobile', $row['mobile']);
                         $this->session->set_userdata('log_trainer_name', $row['firstName']." ".$row['lastName']);
                        $this->session->set_userdata('log_image', $row['attachmentUrl']);
                        $this->session->set_userdata('log_address', $row['address']);
                        $this->session->set_userdata('log_type', 'trainer');
                       redirect(base_url() .'Trainerdashboard');


}

         }
         public function register(){
          $this->load->view('myadmin/register');
         }


public function trainer_register(){
            $mobile = $this->input->post('mobile');
            //echo $mobile;die();             
          
               $data = array("phoneNumber" => $mobile);          

                $data_string = json_encode($data);
                $ch = curl_init($this->api_url.'api/v1/login/sendVerificationCode');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',
                    'token: 9f67c0d60108e71da0f7264f1675c124',
                    'Content-Length: ' . strlen($data_string))                                                                       
                );  
                $this->session->set_userdata('log_trainer_mobile', $this->input->post('mobile'));                                                                                                                 

                 $trainer_info = curl_exec($ch);
                 $trainer = json_decode($trainer_info,true);
                 $data['register_info']=$trainer;
                 //echo "<pre>";print_r($trainer);die();

                $this->load->view('myadmin/otp',$data);
}

public function otpverify()
{
    $this->form_validation->set_rules('code', 'OTP', 'required');
    if ($this->form_validation->run())
    {
            $code = $this->input->post('code');
            $phoneNumber = $this->input->post('phoneNumber');
            $mobileToken = $this->input->post('mobileToken');
            $data = array("code" => $code ,"deviceInfo" =>$_SERVER['HTTP_USER_AGENT'] ,"deviceType" =>1 ,"mobileToken" =>$mobileToken, "phoneNumber" => $phoneNumber);              

                $data_string = json_encode($data); 

                $ch = curl_init($this->api_url.'api/v1/login/login');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',
                    'token: 9f67c0d60108e71da0f7264f1675c124',
                    'Content-Length: ' . strlen($data_string))                                                                       
                );   
                $trainer_info = curl_exec($ch);
                 $trainer = json_decode($trainer_info,true);
                 if(!empty($trainer['data'])){
                $t = array($trainer['data']); 
                    foreach($t as $row){
                $this->session->set_userdata('trainer_login', '1');
                $this->session->set_userdata('log_trainer_id', $row['id']);
                $this->session->set_userdata('log_trainer_email',!empty($row['email'])?$row['email']:'');
                $this->session->set_userdata('log_trainer_mobile', $row['mobile']);
                $this->session->set_userdata('log_trainer_name',!empty($row['firstName'])?$row['firstName']:''." ".!empty($row['lastName'])?$row['lastName']:'');
                $this->session->set_userdata('log_trainer_token', $row['token']);
                $this->session->set_userdata('log_trainer_profile_img',!empty($row['attachmentUrl'])?$row['attachmentUrl']:'');
                $this->session->set_userdata('log_type', 'trainer');
                if(empty($row['firstName'])&&empty($row['lastName'])&&empty($row['email'])){
                           redirect(base_url() .'Trainerdashboard/profile');
                           }else{
                               redirect(base_url() .'Trainerdashboard');
                           }
                        }
                    }
                    else{
                            echo "Entered OTP Is Wrong..!";
                        }
                      
                 

            }
        
             else{
                    echo validation_errors();
                }
}






        
}
