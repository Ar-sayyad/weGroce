<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
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
		$this->load->view('shop/register');
	}
        public function doRegister(){
                $this->form_validation->set_rules('fname', 'First Name', 'required');
                $this->form_validation->set_rules('lname','Last Name','required');
                $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
                $this->form_validation->set_rules('contact','Contact No','required|numeric');
                if ($this->form_validation->run())
                    {
                        $code = rand(0,999999);
                         $data=array( 	  
                                    'fname'=>ucwords(strtolower($this->input->post('fname'))),
                                    'lname'=>ucwords(strtolower($this->input->post('lname'))),
                                    'contact'=>$this->input->post('contact'),
                                    'email'=>strtolower($this->input->post('email'))
                                    );
                                    $this->admin_model->record_insert('users',$data);
                                    $insert_id= $this->db->insert_id();  
                                    if($insert_id){
                                        $contact = $this->input->post('contact');
                                        $msg = "Use $code as OTP to verify your mobile no. This verification is important for safety of your account and must be done before you proceed.";
                                        $this->send_message($contact,$msg);
                                        $this->session->set_userdata('register_user_id', $insert_id);
                                        $this->session->set_userdata('reg_email',strtolower($this->input->post('email')));
                                        $this->session->set_userdata('reg_contact',$this->input->post('contact'));                                        
                                        $this->session->set_userdata('otp_code',$code);
                                        echo 1;
                                    }
                    }
                else {
                    echo validation_errors();
                }
        }
        
        public function doSendCode(){
              $this->form_validation->set_rules('contact','Contact No','required|numeric|regex_match[/^[0-9]{10}$/]');
               if ($this->form_validation->run())
                    {                         
                    $contact = $this->input->post('contact');          
                    $data = array("phoneNumber" => $contact);                                                                    
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

                        $login_info = curl_exec($ch);
                        $trainer= json_decode($login_info,true);                
                     if($trainer['data']){
                         $this->session->set_userdata('reg_contact',$this->input->post('contact'));
                         $this->session->set_userdata('reg_token',$trainer['data']);
                         echo 1;
                     } 
                 
                   }
                else {
                    echo validation_errors();
                }
        }
        

           public function validateOTP(){
            $this->form_validation->set_rules('otp', 'OTP', 'required');
            if ($this->form_validation->run())
             {
                    $otp = $this->input->post('otp');
                    $contact = $this->session->userdata('reg_contact');
                    $token   = $this->session->userdata('reg_token');
                    $data = array("code" => $otp,"deviceInfo" =>$_SERVER['HTTP_USER_AGENT'],"deviceType" =>1,"mobileToken" =>$token,"phoneNumber" =>$contact);                                                                    
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

                         $login_info = curl_exec($ch);
                         $usr = json_decode($login_info,true);                       
                        if(!empty($usr['data'])){
                             $user = array($usr['data']);
                       foreach ($user as $row){ 
                           $user = $this->checkUser($row['id']);                           
                            if($user>0){
                                $data1 = array("fname" =>$row['firstName'],"lname" =>$row['lastName'],"email" =>$row['email'],"contact"=>$row['mobile'],"deviceToken"=>$row['token'],"userType"=>1);                                                                    
                                $where = array('id' =>$row['id']);
                                $this->admin_model->records_update('users',$data1,$where);
                                $insert=2;
                            }else{
                                 $data1 = array('id' =>$row['id'],"fname" =>$row['firstName'],"lname" =>$row['lastName'],"email" =>$row['email'],"contact"=>$row['mobile'],"deviceToken"=>$row['token'],"userType"=>1);                                                                    
                                 $this->admin_model->record_insert('users',$data1);
                                 $insert = 1;
                            }
                            $this->session->set_userdata('user_login', '1');
                            $this->session->set_userdata('login_user_id', $row['id']);
                            $this->session->set_userdata('login_email_id', !empty($row['email'])?$row['email']:'');
                            $this->session->set_userdata('firstName', !empty($row['firstName'])?$row['firstName']:'');
                            $this->session->set_userdata('lastName', !empty($row['lastName'])?$row['lastName']:'');
                            $this->session->set_userdata('name', !empty($row['firstName'])?$row['firstName']:''." ".!empty($row['lastName'])?$row['lastName']:'');
                            $this->session->set_userdata('mobile', $row['mobile']);
                            $this->session->set_userdata('token',$row['token']);
                            $this->session->set_userdata('profile_img',!empty($row['attachmentUrl'])?$row['attachmentUrl']:'');
                            $this->session->set_userdata('login_type', 'user');
                            
                           echo $insert;
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
        public function checkUser($id){
        return $this->db->get_where('users',array('id' => $id))->num_rows();
        }

        public function validateOTPold(){
            $this->form_validation->set_rules('otp', 'OTP', 'required');
            if ($this->form_validation->run())
             {
                $eotp = $this->session->userdata('otp_code');
                $otp = $this->input->post('otp');
                if($eotp == $otp){
                    echo 1;
                    $this->session->set_userdata('otp_code','');
                }else{
                    echo "Invalid OTP";
                }
             }
             else{
                    echo validation_errors();
                }            
        }
        
        public function doRegProfile(){            
                $this->form_validation->set_rules('firstName', 'First Name', 'required');
                $this->form_validation->set_rules('lastName', 'Last Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('city', 'City', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('pincode', 'Pincode', 'required');
                     if ($this->form_validation->run())
                     {
                          $firstName = ucfirst(strtolower($this->input->post('firstName')));
                          $lastName = ucfirst(strtolower($this->input->post('lastName')));
                          $email = strtolower($this->input->post('email'));
                          $city = $this->input->post('city');
                          $address = $this->input->post('address');
                          $pincode = $this->input->post('pincode');
                    $token   = $this->session->userdata('token');
                    $id   = $this->session->userdata('login_user_id');
                    $mobile = $this->session->userdata('mobile');
                    $data = array("id" => $id,"firstName" =>$firstName,"lastName" =>$lastName,"mobile"=>$mobile,"deviceToken"=>$token,"userType"=>1,"email" =>$email,"address" => array("area"=>$address,"city"=>$city,"zipcode"=>$pincode));                                                                    
                    $data1 = array("fname" =>$firstName,"lname" =>$lastName,"contact"=>$mobile,"deviceToken"=>$token,"userType"=>1,"email" =>$email,"shipping_address"=>$address,"city"=>$city,"pincode"=>$pincode);                                                                    
                    $where = array('id' =>$id);
                    $this->admin_model->records_update('users',$data1,$where);
                    $data_string = json_encode($data);                                                                             
               
                    $ch = curl_init($this->api_url.'api/v2/users/updateProfile');                                                                      
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',
                    'token: '.$token,
                    'Content-Length: ' . strlen($data_string))                                                                       
                );                                                                                                               
                           $user_info = curl_exec($ch);
                         $usr = json_decode($user_info,true);
                         $user = array($usr['data']);
                        // print_r($user);
                          //echo $user_info;
                           if(!empty($user)){
                       foreach ($user as $row){                            
                            $this->session->set_userdata('user_login', '1');
                            $this->session->set_userdata('login_user_id', $row['id']);
                            $this->session->set_userdata('login_email_id', !empty($row['email'])?$row['email']:'');
                            $this->session->set_userdata('name', !empty($row['firstName'])?$row['firstName']:''." ".!empty($row['lastName'])?$row['lastName']:'');
                            $this->session->set_userdata('mobile', $row['mobile']);
                            $this->session->set_userdata('token',$row['token']);
                            $this->session->set_userdata('profile_img',!empty($row['attachmentUrl'])?$row['attachmentUrl']:'');
                            $this->session->set_userdata('login_type', 'user');                          
                           if(!empty($row['email'])){
                            echo 1;
                           }else{
                               echo "Some thing went wrong..!";
                           }
                        }
                           }else{
                                
                               echo "Some thing went wrong..!";
                           }
                         
                     }
                    else 
                     {
                           echo validation_errors();
                     }            
        }
        
        function uploadImage(){
            //echo $_FILES['userfile']['name'];die();
            $token   = $this->session->userdata('token');
             $id   = $this->session->userdata('login_user_id');
            //$file   = $this->input->post('file');
             //echo $file = realpat($_FILES['file']['name'],"r");
            
            //$fileName = $_FILES['userfile']['name'];
            $data = array("Id" =>$id ,"file" => '@C:\Users\om sai\Desktop\trainer.png');
             $data_string = json_encode($data);                                                                             
               
                    $ch = curl_init($this->api_url.'api/v1/uploadAttachment');                                                                      
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',
                    'token: '.$token,
                    'Content-Length: ' . strlen($data_string))                                                                       
                );                                                                                                               
                         echo $user_info = curl_exec($ch);

                
        }


        /**********SMS*********/
        
        public function send_message($mob,$msg)
	{
               $web_url = "http://www.sms123.in/QuickSend.aspx?";
	 	 $url = $web_url.http_build_query(array('username'=> "ASBSPL",'password' => "ASBSPL",
                    'mob' => $mob,'msg' => $msg,'sender' => "ASBSPL"));	
	 	 //echo  $url;
                 //echo $shortUrl=file_get_contents($url);
		$ch = curl_init();
		if($ch)
		{					
			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			$result = curl_exec($ch );		
			curl_close( $ch );
			//return true;
		}
		else
		{
			//return true;
		}
	}
        
        /***********SMS************/
       
        
        /*******GET REGISTRATION MAIL BODY********/ 
           function get_registerBody($email,$mobile){
               $act=md5($email);
               $site_name = "Mera Trainer";
                $key=strrev(sha1($act))."esd15876wq12WEAS1asO4";
		$config=strrev($key);
               
                return $body="<body>
			<div class='row'>
					<div class='col-sm-4'></div>
							<div class='col-sm-4 center' style='border: 2px solid #EC971F;padding-bottom:10px;background-color: rgb(254, 250, 249);'>
									<div id='nediv' style='float: left;
										align-content: center;
										width: 90%;
										margin-left: 20%;

										font-family: cursive;
										margin-top: 1%;'>
										<h2>Account Register Successfully.</h2></div>
											<hr style='width:70%;
												border: 0;
												height: 1px;
												background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

										<div id='mbody' style='width: 70%;
										margin-left: 20%;
										text-align: justify;
										font-family: cursive;
											line-height: 20px;
											margin-bottom:3%;'>
										   
										 <center style='text-align: left;margin-left: 5%;'>
                                                                                 <b>Hello,</b><br>
                                                                                    Greetings from <a href='".base_url()."'>$site_name</a> <br/>
                                                                                    This is a reminder email to verify your $site_name account.<br/>
                                                                                    We've created a new $site_name account for you. <br/>

                                                                                    Your account details are:<br/>
                                                                                    Your Mobile: <b> $mobile </b> <br/>
                                                                                    Your Email is : $email <br/>
                                                                                </center>
										  </div>
										  <hr style='width:70%;
												border: 0;
												height: 1px;
												margin-bottom:3%;
												background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

										<div  id='aclink' style='font-family: cursive;
											line-height: 20px;
											font-size:14px;
											margin-bottom:3%;
											margin-left: 20%;'>
											  Your Account is Registered Successfully To $site_name!!!<br/>
                                                                                        
                                                                                    </div>
										 <hr style='width:50%;
												border: 0;
												height: 1px;
												background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

										 <div style='font-family: cursive;
											line-height: 22px;
												margin-left: 30%;'>

										  <h5>$site_name</h5>


										</div>

							</div>
					<div class='col-sm-4'></div>
			</div>
                </body>";
           }


           /****forgot password start****/
	function getBody($email,$forgot_user_id,$name,$type,$code){
		$act=md5($email);
                $site_name = "Mera Trainer";
                $key=strrev(sha1($act))."esd15876wq12WEAS1asO4";
		$config=strrev($key);
		$passkey = md5($forgot_user_id);
		return $body="<body>
			<div class='row'>
					<div class='col-sm-4'></div>
							<div class='col-sm-4 center' style='border: 2px solid #EC971F;padding-bottom:10px;background-color: rgb(254, 250, 249);'>
									<div id='nediv' style='float: left;
										align-content: center;
										width: 90%;
										margin-left: 20%;

										font-family: cursive;
										margin-top: 1%;'>
										<h2>Reset Password of $site_name</h2></div>
											<hr style='width:70%;
												border: 0;
												height: 1px;
												background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

										<div id='mbody' style='width: 70%;
										margin-left: 20%;
										text-align: justify;
										font-family: cursive;
											line-height: 20px;
											margin-bottom:3%;'>
										   
										  <center style='text-align: left;margin-left: 5%;'>
										  <b>Hello $name,</b><br>
										  We received a request to reset the password associated with this e-mail address.<br/>
										  If you made this request, please follow the instructions below.<br/>
											Your Email is : $email <br/>
											  </center>
										  </div>
										  <hr style='width:70%;
												border: 0;
												height: 1px;
												margin-bottom:3%;
												background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

										<div  id='aclink' style='font-family: cursive;
											line-height: 20px;
											font-size:14px;
											margin-bottom:3%;
											margin-left: 20%;'>
											 Use below Code to reset your password using our secure server:<br/>
											Password Activation Code : <b>$code</b>
										</div>
										 <hr style='width:50%;
												border: 0;
												height: 1px;
												background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

										 <div style='font-family: cursive;
											line-height: 22px;
												margin-left: 30%;'>

										  <h5>$site_name</h5>


										</div>

							</div>
					<div class='col-sm-4'></div>
			</div>
	</body>";
	}
	
        
        
         /*********Forgot Password*****/
        
        function validateForgotPassword(){
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == FALSE)
                {
					
			echo validation_errors();
                }
                else
                {	
                    $email = $this->input->post('email');
                    $findemail = $this->ForgotPassword($email);  
                    if($findemail==1){
                             $this->session->set_userdata('pass_status',1);	
                             echo 1;		 		    
                        }else{
                            echo 'Email Not Registered...!';
                            }
                }
      
	}
        
	function reset_password(){
		$email = $this->input->get('email');
		$id = $this->input->get('id');			
		$table = $this->input->get('type');		
		$data['type']=$table;	
		$data['id'] = $id;
		$data['email'] = $email;
		$this->load->view('showResetPassword',$data);
		
	}
	function saveResetPassword(){
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm', 'Password Confirmation', 'required|matches[password]');
		if ($this->form_validation->run() == FALSE)
                {
					
			echo validation_errors();
                }
                else
                {                       
                            $user_id = $this->session->userdata('forgot_user_id');
                            $password = $this->input->post('password');
                            echo $this->reset_password_info($user_id,$password);
							 
		}
			
	}
        
        /*****forgot password end*****/
        
        
        
	public function ForgotPassword($email)
	{
                $users = $this->db->get_where('users', array('email' => $email));
                $code = rand(0,999999);
                $this->session->set_userdata('pass_code',$code);	
		$username=""; //SMTP MAIL
		$pass=""; //SMTP PASSWORD
		$name="Mera Trainer";
		$sub="Forgot Password Activation";
		$host_name="smtp.gmail.com";
		$port="465";
		$protocol="smtp";
		
		if($users->num_rows() > 0) {
                        $row = $users->row();                      
                        $forgot_user_id = $row->id;
                        $this->session->set_userdata('forgot_user_id',$forgot_user_id);
			$forgot_email_id = $row->email;
                        $forgot_name = $row->fname." ".$row->lname;
                        $mob = $row->contact;
                        $forgot_type = 'users';
                        $body=$this->getBody($forgot_email_id,$forgot_user_id,$forgot_name,$forgot_type,$code);
                        $this->forgot_mail($forgot_email_id,$username,$pass,$name,$sub,$body,$host_name,$port,$protocol);
                        $msg = "Use $code for resetting your password.";
                        $this->send_message($mob,$msg);
                        $data['pass_status']    = 1;
                        $this->db->where('id',$forgot_user_id);
                        $this->db->update('users',$data);      
                        return 1;
						
        }else{
			return 0;
		}
		
	
        //return $this->db->get_where('company', array('email' => $email))->result_array();
	}
        
        
        function forgot_mail($email,$username,$pass,$name,$sub,$body,$host_name="ssl://smtp.googlemail.com",$port="465",$protocol="smtp") {
	 
       /* $config = array();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';

        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");

         $this->email->from($username, $name);
        $this->email->to($email);
        $this->email->subject($sub);
        $this->email->message($body);

        $this->email->send();*/
/*
$this->email->from('', '');
$this->email->to('');
$this->email->send();
 $this->email->initialize($config);*/
 
       

       $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';;
        $config['smtp_user'] = $username;
        $config['smtp_pass'] = $pass;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        //$sender = "";
        //$this->load->library('email');

        $this->email->initialize($config);
        $this->email->from($username, $name);
        $this->email->to($email);
        $this->email->subject($sub);
        $this->email->message($body);

        $this->email->send();	
	
    }
    
	
    
    function registerMail($email="",$title="",$sub="",$body="") {
	
        $config = array();
        $sender = "contact@meratrainer.com";
        //$config['useragent'] = 'PHPMailer';
       /* $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = "";
        $config['smtp_pass'] = "";
       // $config['smtp_user'] = $username;
        //$config['smtp_pass'] = $pass;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
       
        $this->email->initialize($config);
        $this->email->from($sender, $title);
        $this->email->to($email);
        $this->email->subject($sub);
        $this->email->message($body);

        $this->email->send();*/
        
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';  
        $config['smtp_port'] = '465';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from($sender, $title);
        $this->email->to($email);
        $this->email->subject($sub);
        $this->email->message($body);
        $this->email->send();
	
    }
    
	
	function reset_password_info($id,$password){
		
		$data['pass_status']    = 0;
		$data['password']    =  strrev(sha1(md5($password)));		
		$this->db->where('id',$id);
		echo $this->db->update('users',$data);
		$this->session->set_userdata('pass_status','');
                $this->session->set_userdata('pass_code','');
		$this->session->set_userdata('forgot_user_id','');
	}
	
	/****forgot password function end****/
       
        
}
