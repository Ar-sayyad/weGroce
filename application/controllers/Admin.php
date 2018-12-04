<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
                //$this->generateOtp();
		
	}
	public function index()
	{
             if ($this->session->userdata('admin_login') == 1) {
                 $this->session->set_userdata('last_page', current_url());
                 $data['user_cnt']= $this->admin_model->record_count('users');
                 $data['category_cnt']= $this->admin_model->record_count('category');
                 $data['neworder_cnt']= $this->admin_model->record_count('orders');
                 $this->db->where('product_type !=',2);
                 $this->db->where('product_type !=',3);
                 $data['product_cnt']= $this->admin_model->record_count('products');
                 $this->db->where('product_type',2);
                 $data['video_cnt']= $this->admin_model->record_count('products');
                 $this->db->where('product_type',3);
                 $data['audio_cnt']= $this->admin_model->record_count('products');
                
                          
                 $data['page_title'] = 'Dashboard';             
                 $this->load->view('myadmin/index',$data);			
            }
            elseif($this->session->userdata('trainer_login') == 1){
                 redirect(base_url().'Trainerdashboard');
                
            }
           else{
                    $data['page_title'] = 'Login';
                    $this->load->view('myadmin/login',$data);
               }

	}    
        
        
        public function error(){
            $data['page_title'] = 'Page is Under Development';
            $this->load->view('myadmin/404',$data);
        }
        
        
       /**********TRAINERS********/
        
       public function Trainers(){
           if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
           }                        
            $opts = array( 
              'http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/getTrainerList?start=0', false, $context);
            $data['trainer_info'] = json_decode($trainer_info,true);
            
            
          $data['page_title'] = 'Trainers';
         $this->load->view('myadmin/trainers',$data);          
       }    


       /********END TRAINERS********/          
               
        
        /******GENERATE OTP****/
        public function generateOtp(){
            $date = date('Y-m-d');           
            $this->db->order_by('otp_id','desc');
            $this->db->limit(1);
            $otp_data = $this->db->get_where('otp')->result_array();  
            foreach($otp_data as $ot){
                 $otp_id = $ot['otp_id'];
                 $sys_date = $ot['date'];               
            }
             $code = rand(0,999999);
            if ($date != $sys_date) {               
                $data=array('OTP'=>$code,'date'=>date('Y-m-d'));
                $where =array('otp_id'=>$otp_id);
                $details=$this->admin->records_update('otp',$data,$where);
                                       // $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> OTP Generated Successfully.');
                                        //redirect(base_url().'Adminity/generateOtp'); 
                $subadmins = $this->db->get('tbl_subadmin')->result_array();
                foreach($subadmins as $sub){
                 $contact = $sub['subadmin_contact']; 
                 $msg ="Use $code for todays vendor transactions. This is system generated.";
                 $data = $this->send_message($contact,$msg);
                }
           }      
                       
        }
        
        public function systemOTP(){
            if ($this->session->userdata('admin_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(base_url());
               }
            $data['page_title']='System OTP';
            $this->db->order_by("otp_id","desc");
            $data['otp_info']=$this->admin->record_list('otp');
            $this->load->view('myadmin/otp_data',$data);
        }

        function  sendsms(){
           
            $msg = "hello";
            //$sumlist =  '[{"sumlist_id":"1","sum_name":"Sum of KMS","sum":"20"},{"sumlist_id":"2","sum_name":"Sum of Amount","sum":"10"},{"sumlist_id":"3","sum_name":"Sum of D.Charges","sum":"50"},{"sumlist_id":"4","sum_name":"Sum of Fine","sum":"50"},{"sumlist_id":"5","sum_name":"Sum of Dress","sum":"40"},{"sumlist_id":"6","sum_name":"Sum of After ded Amt","sum":"50"},{"sumlist_id":"7","sum_name":"Sum of TDS","sum":"10"},{"sumlist_id":"8","sum_name":"Sum of Diesel","sum":"40"},{"sumlist_id":"9","sum_name":"Sum of Amt due","sum":"50"}]';
            $contact = 9922031316;
             //$msg ='Hello , Name Aasif Sayyad vehicle MH 12 E 0259 seat 6 company month Dec-17 total 90 . summary [{"sumlist_id":"1","sum_name":"Sum of KMS","sum":"10"},{"sumlist_id":"2","sum_name":"Sum of Amount","sum":"10"},{"sumlist_id":"3","sum_name":"Sum of D.Charges","sum":"10"},{"sumlist_id":"4","sum_name":"Sum of Fine","sum":"10"},{"sumlist_id":"5","sum_name":"Sum of Dress","sum":"10"},{"sumlist_id":"6","sum_name":"Sum of After ded Amt","sum":"10"},{"sumlist_id":"7","sum_name":"Sum of TDS","sum":"10"},{"sumlist_id":"8","sum_name":"Sum of Diesel","sum":"10"},{"sumlist_id":"9","sum_name":"Sum of Amt due","sum":"10"}]';
            //$msg ="Hello , Name $name vehicle $vehicle_no seat $seat_type company $site_name month $month total $total . summary $sumlist";
             //$msg ="Hello , This is summation data: Name $name , vehicle $vehicle_no , seat $seat_type , company $site_name , month $month , total $total . summary: $sumlist";
             //$sent = $this->send_message($contact,$msg);
            $data = $this->send_message($contact,$msg);   
            echo $data;
        }
        
        public function sendmysms(){
            $mob =9922031316;
            $msg = "hello aasif";
            echo $this->send_messge($mob,$msg);
        }

        public function send_message($mob,$msg)
	{
               $web_url = "http://api.smsbrain.in/1.2/appsms/send.php?";
                $url = $web_url.http_build_query(array('username'=> "meratrainer.otp",'password' => "MeraTrainer123",
                    'mob' => $mob,'msg' => $msg,'sender' => "MeraTr"));	
                	
	 	 echo  $url;
                 echo $shortUrl=file_get_contents($url);
		$ch = curl_init();
		if($ch)
		{					
			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			$result = curl_exec($ch );
		
			curl_close( $ch );
			return 1;
		}
		else
		{
			return 0;
		}
	}

        /********GENERATE OTP END******/    
        /*************CONTACT ENQUIRY*********/
          public function contact($task='',$user_id='')
         {
               if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       } 
                       
                       
                        $data['page_title']='Contact Enquiry';
                        //$this->db->where('own_diesel_filler',0);
                        $this->db->order_by("conatct_id","desc");
                        $data['contact_enquiry']=$this->admin_model->record_list('contact');
                       
                        $this->load->view('myadmin/contact_enquiry',$data);
          }
          
        
        /*************CONTACT ENQUIRY*********/ 
        /*************USERS*********/
        
                public function users($task='',$user_id='')
                {
                    if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }                                        
                    if ($task == "delete") {
                        $where =array('id'=>$user_id);
                        $this->admin_model->delete_record('users',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Admin/users');
                    }
                    if ($task == "update") {                       
                        $this->form_validation->set_rules('fname', 'First Name', 'required');
                        $this->form_validation->set_rules('lname','Last Name','required');
                        $this->form_validation->set_rules('email','Email','required');
                        $this->form_validation->set_rules('contact','Contact No','required');
                             if ($this->form_validation->run())
                            {
                                 $data=array( 	  
                                            'fname'=>ucwords(strtolower($this->input->post('fname'))),
                                            'lname'=>ucwords(strtolower($this->input->post('lname'))),
                                            'contact'=>$this->input->post('contact'),
                                            'email'=>strtolower($this->input->post('email')),
                                            'shipping_address'=>$this->input->post('address'),
                                            'pincode'=>$this->input->post('pincode'),
                                            'active_status'=>1
                                            );
                                             $where =array('id'=>$user_id);
                                            $details=$this->admin_model->records_update('users',$data,$where);
                                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> User Data Updated Successfully.');
                                            redirect(base_url().'Admin/users');		
                            }
                        else {
                            $this->session->set_flashdata('err_msg',validation_errors());
                            redirect(base_url().'Admin/users'); 
                        }
                    }                    
                        $data['page_title']='Users';
                        //$this->db->where('own_diesel_filler',0);
                        $this->db->order_by("id","desc");
                        $data['user_info']=$this->admin_model->record_list('users');
                        $this->load->view('myadmin/users',$data);
                }                
                 public function addUser(){
                    $this->form_validation->set_rules('fname', 'First Name', 'required');
                    $this->form_validation->set_rules('lname','Last Name','required');
                    $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
                    $this->form_validation->set_rules('contact','Contact No','required');                    
                
			 if ($this->form_validation->run())
			{
                             $data=array( 	  
	        			'fname'=>ucwords(strtolower($this->input->post('fname'))),
                                        'lname'=>ucwords(strtolower($this->input->post('lname'))),
	        			'email'=>$this->input->post('email'),
	        			'contact'=>$this->input->post('contact'),
	        			'active_status'=>1
	        			);
					$details=$this->admin_model->record_insert('users',$data);
					$this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> User Added Successfully.');
					redirect(base_url().'Admin/users');		
			}
                    else {
                        $this->session->set_flashdata('err_msg',validation_errors());
                        redirect(base_url().'Admin/users');
                    }
            }
                        
            
            /*********CATEGORIES******/
            
             public function categories($task='',$category_id='')
                {
                    if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
               if ($task == 'addCategory') 
               {
                   $this->form_validation->set_rules('category_name', 'Category Name', 'required|is_unique[category.category_name]');
			 
			 if ($this->form_validation->run())
			{
                             $code = rand(0,999999); 
                              if($_FILES['categoryimg']['name']!= ""){
                                $img_name='categoryimg';
                                $img_path='category';
                                //$old_img=$this->input->post('old_admin_profile');
                                $profile=$this->admin_model->upload_image($img_name,$img_path); 

                                }
                                if($profile)
                                {
                            $data=array( 	  
                                 'category_name'=> ucwords(strtolower($this->input->post('category_name'))),
                                 'cat_code'=> "C".$code,//GENERATE
                                 'category_img'=>$profile,//UPLOAD
                                 'cat_url'=> str_replace(' ','-', strtolower($this->input->post('category_name')))//GENERATE
                                 );		

                            $details=$this->admin_model->record_insert('category',$data);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Category Added Successfully.');
                            redirect(base_url().'Admin/categories');  
                                }
                                 else {
                                         $this->session->set_flashdata('err_msg',validation_errors());
                                         redirect(base_url().'Admin/categories');
                                     } 
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/categories');
                            }  
                 }

                  if ($task == 'editCategory') 
               {

                   $this->form_validation->set_rules('category_name', 'Category Name', 'required');
       
                        if ($this->form_validation->run())
                       {
                             if($_FILES['categoryimg']['name']!= ""){
                               $img_name='categoryimg';
                               $img_path='category';

                               $profile=$this->admin_model->upload_image($img_name,$img_path);
                             }
                        if($profile)
                        {
                          $data=array(     
                                     'category_name'=> ucwords(strtolower($this->input->post('category_name'))),
                                     'category_img'=>$profile,//UPLOAD
                                     'cat_url'=> str_replace(' ','-',strtolower($this->input->post('category_name'))),//GENERATE                                     
                                     );          
                            $where=array('category_id' => $category_id); 
                                               
                            $details=$this->admin_model->records_update('category',$data,$where);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Category Updated Successfully.');
                            redirect(base_url().'Admin/categories'); 
                       }else
                       {
                            $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/categories');
                       }
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/categories');
                            }  
                 }
                 
                 if($task=='delete'){
                      $where =array('category_id'=>$category_id);
                        $this->admin_model->delete_record('category',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Admin/categories');
                     
                 }
                        $data['page_title']='Categories';
                        //$this->db->order_by("category_id","desc");
                        $data['category_info']=$this->admin_model->record_list('category');
                        $this->load->view('myadmin/categories',$data);
                }
            /*******CATEGORIES******/
            
                
            /*********LANGUAGES******/
            
             public function language($task='',$language_id='')
            {
                    if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
               if ($task == 'addLanguage') 
               {
                   $this->form_validation->set_rules('language_name', 'Language Name', 'required|is_unique[language.language_name]');
			 
			 if ($this->form_validation->run())
			{
                          
                            $data=array( 	  
                                 'language_name'=> ucwords(strtolower($this->input->post('language_name'))),
                              
                                 );		

                            $details=$this->admin_model->record_insert('language',$data);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Language Added Successfully.');
                            redirect(base_url().'Admin/language');  
                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/language');
                            }  
                 }

                  if ($task == 'editLanguage') 
               {

                   $this->form_validation->set_rules('language_name', 'Language Name', 'required');
       
                        if ($this->form_validation->run())
                       {
                          
                          $data=array(     
                                     'language_name'=> ucwords(strtolower($this->input->post('language_name'))),
                                     );          
                            $where=array('language_id' => $language_id); 
                                               
                            $details=$this->admin_model->records_update('language',$data,$where);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Language Updated Successfully.');
                            redirect(base_url().'Admin/language'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/language');
                            }  
                 }
//                 
//                 if($task=='delete'){
//                      $where =array('language_id'=>$category_id);
//                        $this->admin_model->delete_record('language',$where);
//                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
//                        redirect(base_url() .'Admin/language');
//                     
//                 }
                        $data['page_title']='Language';
                        $this->db->order_by("language_id","desc");
                        $data['category_info']=$this->admin_model->record_list('language');
                        $this->load->view('myadmin/language',$data);
                }
            /*******LANGUAGES******/
                
                
            /*********PRICE RANGE******productdetail**/
            
             public function price_range($task='',$price_range_id='')
            {
                    if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
               if ($task == 'addPriceRange') 
               {
                   $this->form_validation->set_rules('price_range', 'Price Range Name', 'required|is_unique[price_range.price_range]');
			 
			 if ($this->form_validation->run())
			{
                          
                            $data=array( 	  
                                 'price_range'=> ucwords(strtolower($this->input->post('price_range'))),
                              
                                 );		

                            $details=$this->admin_model->record_insert('price_range',$data);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Price Range Added Successfully.');
                            redirect(base_url().'Admin/price_range');  
                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/price_range');
                            }  
                 }

                  if ($task == 'editPriceRange') 
               {

                   $this->form_validation->set_rules('price_range', 'Price Range Name', 'required');
       
                        if ($this->form_validation->run())
                       {
                          
                          $data=array(     
                                     'price_range'=> ucwords(strtolower($this->input->post('price_range'))),
                                     );          
                            $where=array('price_range_id' => $price_range_id); 
                                               
                            $details=$this->admin_model->records_update('price_range',$data,$where);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Price Range Updated Successfully.');
                            redirect(base_url().'Admin/price_range'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/price_range');
                            }  
                 }
                 
//                 if($task=='delete'){
//                      $where =array('price_range_id'=>price_range_id);
//                        $this->admin_model->delete_record('price_range',$where);
//                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
//                        redirect(base_url() .'Admin/price_range');
//                     
//                 }
                        $data['page_title']='Price Range';
                        $this->db->order_by("price_range_id","desc");
                        $data['price_range_info']=$this->admin_model->record_list('price_range');
                        $this->load->view('myadmin/price_ranges',$data);
                }
            /*******PRICE RANGE******/
                
                   
            /********TYPE*********/
            
             public function type($task='',$type_id='')
            {
                
                    if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
               if ($task == 'addType') 
               {
                   $this->form_validation->set_rules('type_name', 'type Name', 'required|is_unique[type.type_name]');
			 
			 if ($this->form_validation->run())
			{
                          
                            $data=array( 	  
                                 'type_name'=> ucwords(strtolower($this->input->post('type_name'))),
                              
                                 );		

                            $details=$this->admin_model->record_insert('type',$data);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Type Name Added Successfully.');
                            redirect(base_url().'Admin/type');  
                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/type');
                            }  
                 }

                  if ($task == 'editType') 
               {

                   $this->form_validation->set_rules('type_name', 'Type Name', 'required');
       
                        if ($this->form_validation->run())
                       {
                          
                          $data=array(     
                                     'type_name'=> ucwords(strtolower($this->input->post('type_name'))),
                                     );          
                            $where=array('type_id' => $type_id); 
                                               
                            $details=$this->admin_model->records_update('type',$data,$where);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Type Updated Successfully.');
                            redirect(base_url().'Admin/type'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/type');
                            }  
                 }
                 
//                 if($task=='delete'){
//                      $where =array('price_range_id'=>price_range_id);
//                        $this->admin_model->delete_record('price_range',$where);
//                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
//                        redirect(base_url() .'Admin/price_range');
//                     
//                 }
                        $data['page_title']='Type';
                        $this->db->order_by("type_id","desc");
                        $data['type_info']=$this->admin_model->record_list('type');
                        $this->load->view('myadmin/type',$data);
                }
            /*******TYPE******/
                
            /********SUITABLE FOR*********/
            
             public function suitable($task='',$suitable_id='')
            {
                
                    if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
               if ($task == 'addSuitable') 
               {
                   $this->form_validation->set_rules('suitable_name', 'Suitable Name', 'required|is_unique[suitable_for.suitable_name]');
			 
			 if ($this->form_validation->run())
			{
                          
                            $data=array( 	  
                                 'suitable_name'=> ucwords(strtolower($this->input->post('suitable_name'))),
                              
                                 );		

                            $details=$this->admin_model->record_insert('suitable_for',$data);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Suitable Added Successfully.');
                            redirect(base_url().'Admin/suitable');                              
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/suitable');
                            }  
                 }

                  if ($task == 'editSuitable') 
               {

                   $this->form_validation->set_rules('suitable_name', 'Suitable Name ', 'required');
       
                        if ($this->form_validation->run())
                       {
                          
                          $data=array(     
                                     'suitable_name'=> ucwords(strtolower($this->input->post('suitable_name'))),
                                     );          
                            $where=array('suitable_id' => $suitable_id); 
                                               
                            $details=$this->admin_model->records_update('suitable_for',$data,$where);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Suitable Name Updated Successfully.');
                            redirect(base_url().'Admin/suitable'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/suitable');
                            }  
                 }
                 
//                 if($task=='delete'){
//                      $where =array('price_range_id'=>price_range_id);
//                        $this->admin_model->delete_record('price_range',$where);
//                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
//                        redirect(base_url() .'Admin/price_range');
//                     
//                 }
                        $data['page_title']='Suitable For';
                        $this->db->order_by("suitable_id","desc");
                        $data['type_info']=$this->admin_model->record_list('suitable_for');
                        $this->load->view('myadmin/suitable',$data);
                }
            /*******SUITABLE FOR******/
            
            /*****PRODUCTS*******/
            
              public function products($task='',$product_id=''){
                if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                if ($task == 'addProducts') 
               {                 
                   $this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique[products.product_title]');
              
                    if ($this->form_validation->run())
                   {
                             $code = rand(0,999999);                             

                                if($_FILES['productsimg']['name']!= ""){
                                $img_name='productsimg';
                                $img_path='products';
                                //$old_img=$this->input->post('old_admin_profile');
                                $profile=$this->admin_model->upload_image($img_name,$img_path); 

                                }
                                if($profile)
                                {
                                    $data=array(                                                   
                                                'product_title'=> ucwords(strtolower($this->input->post('product_name'))),
                                                'category_id'=> $this->input->post('category_id'),
                                                'trainer_id'=> 1,//$this->input->post('trainer_id'),
                                                'price_range_id'=> $this->input->post('price_range_id'),
                                                'price'=> $this->input->post('price'),
                                                'delivery_time'=> $this->input->post('delivery_time'),
                                                'status' => $this->input->post('status'),
                                                'description'=> $this->input->post('description'),
                                                'product_img'=>$profile,//UPLOAD
                                                'product_code'=> "PR".$code,//GENERATE
                                                'product_url'=> str_replace(' ','-',strtolower($this->input->post('product_name'))),//GENERATE                                                                                         
                                                );          
                                            // echo"<pre>";print_r($data);die;
                                                $details=$this->admin_model->record_insert('products',$data);

                                                $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Products Added Successfully.');
                                                redirect(base_url().'Admin/products');  
                                        }

                                        else {
                                         $this->session->set_flashdata('err_msg',validation_errors());
                                         redirect(base_url().'Admin/products');
                                     } 
                                }
                         }
                         
                            if ($task == 'editProducts') 
               {                 
                   $this->form_validation->set_rules('product_name', 'Product Name', 'required');
              
                    if ($this->form_validation->run())
                    {           

                                if($_FILES['productsimg']['name']!= ""){
                                $img_name='productsimg';
                                $img_path='products';
                                //$old_img=$this->input->post('old_admin_profile');
                                $profile=$this->admin_model->upload_image($img_name,$img_path); 

                                }
                                if($profile)
                                {
                                 $data=array(                                                   
                                                'product_title'=> ucwords(strtolower($this->input->post('product_name'))),
                                                'category_id'=> $this->input->post('category_id'),
                                                'trainer_id'=> 1,//$this->input->post('trainer_id'),
                                                'language_id'=> $this->input->post('language_id'),
                                                'price_range_id'=> $this->input->post('price_range_id'),
                                                'price'=> $this->input->post('price'),
                                                'delivery_time'=> $this->input->post('delivery_time'),
                                                'description'=> $this->input->post('description'),
                                                 'product_img'=>$profile,//UPLOAD
                                                'product_url'=> str_replace(' ','-',strtolower($this->input->post('product_name')))//GENERATE                                                                                         
                                                );      
                                          
                                                $where=array('product_id' => $product_id);          
                                                $details=$this->admin_model->records_update('products',$data,$where);
                                                $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Products Updated Successfully.');
                                                redirect(base_url().'Admin/products'); 
                                }
                            }
                            else{
                                  $this->session->set_flashdata('err_msg',validation_errors());
                                  redirect(base_url().'Admin/products');
                              } 
                         }
                      
                         if ($task == 'editProductImg') 
                        {    
                              $cpt1 = count ( $_FILES['product_img']['name'] );
                              
                                if($cpt1 > 0){
                                        $img1 = array();                                
                                        for($i = 0; $i < $cpt1; $i++) {
                                        if($_FILES['product_img']['name'][$i] != ""){
                                        $filename1     = $_FILES['product_img']['name'][$i];
                                        $filename1     = explode(".", $filename1);  
                                        $new_filename1 = "pro_".current($filename1).date('Ymd').time(). "." .end($filename1);
                                        $new_filename1 = str_replace (" ", "", $new_filename1);
                                        $thumb1 = explode(".", $new_filename1);
                                        $thumb1 = $thumb1[0] . "". "." . end($thumb1);
                                        $_FILES['imag']['name']  = $new_filename1;
                                        $_FILES['imag']['type']  = $_FILES['product_img']['type'] [$i];
                                        $_FILES['imag']['tmp_name'] = $_FILES['product_img']['tmp_name'] [$i];
                                        $_FILES['imag']['error'] = $_FILES ['product_img']['error'] [$i];
                                        $_FILES['imag']['size']  = $_FILES ['product_img']['size'] [$i];
	                                    $config = array();
	                                    $config['upload_path'] = './assets/uploads/products';
	                                    $config['allowed_types'] = '*';
	                                    $config['max_size']      = '0';                            
	                                    $config['overwrite']     = FALSE;
                                        $this->upload->initialize($config);
                                        if($this->upload->do_upload ('imag')){
                                                $imagedata1 = $this -> upload -> data();
                                                $newimagename1 = $imagedata1["file_name"];
                                                $this -> load -> library("image_lib");
                                                $config['image_library'] = 'gd2';
                                                $config['source_image'] = $imagedata1["full_path"];
                                                $config['create_thumb'] = TRUE;
                                                $config['maintain_ratio'] = TRUE;
                                                $config['new_image'] = './assets/uploads/products/100x100';
                                                $config['width']  = 240;
                                                $config['height'] = 381;
                                                $this -> image_lib -> initialize($config);
                                                $this -> image_lib -> resize();
                                        }                                        
                                                $img1[] = array(
                                                        'product_img' => $new_filename1,

                                                ); 
                                               
                                           }    
                                        }
                                      
                                    }
                                    else
                                    {
                                            $img1[] = array(
                                                            'product_img' => "",
                                                          );
                                    } 
 
                                       
                            if($img1)

					{
						for ($i=0; $i < $cpt1; $i++) 
						{ 
							if($img1[$i]['product_img']!="")
							{
								$data_img1= array(
									'product_id' =>  $product_id,
									'product_img' =>  $img1[$i]['product_img'],
									'trainer_id' => 1,
									'is_deleted'=>'0',
									
								);
                                                               
								$insert_image=$this->admin_model->record_insert('product_images',$data_img1);
							        
                                                               
                                                                
                                                        }
						} 
                                                
                                                
					}
                                         $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Images Added Successfully.');
                                         redirect(base_url().'Admin/products'); 
                    
                        }
                         
                         if($task=='delete'){
                        $where=array('product_id' => $product_id);   
                        $this->admin_model->delete_record('products',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Admin/products');                    
                 } 
                 
                        $data['page_title']='Products';
                       
                        //$this->db->order_by("product_id","desc");
                        $data['products_info']=$this->admin_model->record_list('products');
                        $this->load->view('myadmin/products',$data);
            }
            
            
            	public function post_image_delete() 
	{	
		$where=array(
			'image_id'=>$this->input->post('image_id')
		); 
		$image_name = $this->input->post('image_name');
		$imgsrc = $this->input->post('imgsrc');
	  	$details=$this->admin->records_delete('tbl_project_images',$where);
	    if($details)
	    {	    	 
	    	 $result = array('result' => 'success','message' =>'Image Removed');
	    	 unset($imgsrc);
	    	 /* unset("http://192.168.1.100/shubhchintan/builder/assets/uploads/project/100X100/pro_CostofCompetitiveTennis201612031480766332_thumb.jpg");*/
	    }
	    else
	    {
	    	 $result = array('result' => 'failed','message' =>'Please Try Again');		    
	    }	   
	    echo json_encode($result);		   
	}
            
            /******PRODUCTS*****/            
            
            /*****VIDEOS*******/
            
              public function videos($task='',$product_id=''){
                if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
                        if ($task == 'addVideo') 
               {                 
                   $this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique[products.product_title]');
              
                    if ($this->form_validation->run())
                   {
                    $code = rand(0,999999);             
                        $product_type = $this->input->post('product_type');
                       if($_FILES['productsimg']['name']!= ""){
                       $img_name='productsimg';
                       $img_path='products';
                       //$old_img=$this->input->post('old_admin_profile');
                       $profile=$this->admin_model->upload_image($img_name,$img_path); 
                       }else{
                           $profile='';
                       }
                       if($_FILES['videofile']['name']!= ""){
                       $img_name='videofile';
                       $img_path='videos';
                       //$old_img=$this->input->post('old_admin_profile');
                       $videos=$this->admin_model->upload_media($img_name,$img_path); 
                       }else{
                           $videos ='';
                       } 
                       if($_FILES['audiofile']['name']!= ""){
                       $img_name='audiofile';
                       $img_path='audios';
                       //$old_img=$this->input->post('old_admin_profile');
                       $audios=$this->admin_model->upload_audio($img_name,$img_path); 
                       }else{
                           $audios = '';
                       }
                      
                         $data=array(                                                   
                                       'product_title'=> ucwords(strtolower($this->input->post('product_name'))),                                     
                                       'trainer_id' => 1,//$this->input->post('trainer_id'),
                                       'language_id' => $this->input->post('language_id'),
                                       'product_type' => $this->input->post('product_type'),
                                       'video_type' => $this->input->post('video_type'),
                                       'suitable_for' => $this->input->post('suitable_for'),
                                       'price_range_id' => $this->input->post('price_range_id'),
                                       'price' => $this->input->post('price'),
                                       'youtube_link' => $this->input->post('youtube_link'),
                                       'duration'=> $this->input->post('duration'),                                       
                                       'special_offer'=> $this->input->post('special_offer'),
                                       'product_type'=> $this->input->post('product_type'),                                       
                                       //'punchline'=> $this->input->post('punchline'),
                                       'description'=> $this->input->post('description'),
                                       'product_img'=>$profile,//UPLOAD
                                       'video_path'=>$videos,//UPLOAD
                                       'audio_path'=>$audios,//UPLOAD
                                       'product_code'=> "PR".$code,//GENERATE
                                       'product_url'=> str_replace(' ','-',strtolower($this->input->post('product_name'))),//GENERATE                                                                                         
                                       );         
                                  //  echo "<pre>";print_r($data);die();
                                       $details=$this->admin_model->record_insert('videos',$data);
                                       $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Products Added Successfully.');
                                       redirect(base_url().'Admin/videos');                              
                       }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/videos');
                            }
                }
                 
                         if($task=='delete'){
                        $where=array('media_id' => $product_id);   
                        $this->admin_model->delete_record('videos',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Admin/videos');                    
                 } 
                         
                         
                        $data['page_title']='Videos/Audios';
                        $this->db->where_in('product_type',array(2,3));
                        //$this->db->order_by("product_id","desc");
                        $data['products_info']=$this->admin_model->record_list('videos');
                        $this->load->view('myadmin/videos',$data);
            }
            
            
            /******VIDEOS*****/
            
            /*****AUDIOS*******/
            
              public function audios($task='',$product_id=''){
                if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
                        if ($task == 'addAudio') 
               {                 
                   $this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique[products.product_title]');
              
                    if ($this->form_validation->run())
                   {
                    $code = rand(0,999999);             
                        $product_type = $this->input->post('product_type');
                       if($_FILES['productsimg']['name']!= ""){
                       $img_name='productsimg';
                       $img_path='products';
                       //$old_img=$this->input->post('old_admin_profile');
                       $profile=$this->admin_model->upload_image($img_name,$img_path); 
                       }else{
                           $profile='';
                       }
                      
                       if($_FILES['audiofile']['name']!= ""){
                       $img_name='audiofile';
                       $img_path='audios';
                       //$old_img=$this->input->post('old_admin_profile');
                       $audios=$this->admin_model->upload_audio($img_name,$img_path); 
                       }else{
                           $audios = '';
                       }
                      
                         $data=array(                                                   
                                       'product_title'=> ucwords(strtolower($this->input->post('product_name'))),
                                       'category_id'=> $this->input->post('category_id'),
                                       'trainer_id' => 1,//$this->input->post('trainer_id'),
                                       'language_id' => $this->input->post('language_id'),
                                       'product_type' => $this->input->post('product_type'),
                                       'video_type' => $this->input->post('video_type'),
                                       'suitable_for' => $this->input->post('suitable_for'),
                                       'price_range_id' => $this->input->post('price_range_id'),
                                       'price' => $this->input->post('price'),
                                       'youtube_link' => $this->input->post('youtube_link'),
                                       'duration'=> $this->input->post('duration'),                                       
                                       'special_offer'=> $this->input->post('special_offer'),
                                       'product_type'=> $this->input->post('product_type'),                                       
                                       //'punchline'=> $this->input->post('punchline'),
                                       'description'=> $this->input->post('description'),
                                       'product_img'=>$profile,//UPLOAD
                                     
                                       'audio_path'=>$audios,//UPLOAD
                                       'product_code'=> "PR".$code,//GENERATE
                                       'product_url'=> str_replace(' ','-',strtolower($this->input->post('product_name'))),//GENERATE                                                                                         
                                       );         
                                  //  echo "<pre>";print_r($data);die();
                                       $details=$this->admin_model->record_insert('products',$data);
                                       $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Products Added Successfully.');
                                       redirect(base_url().'Admin/audios');                              
                       }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Admin/audios');
                            }
                }
                 
                         if($task=='delete'){
                        $where=array('product_id' => $product_id);   
                        $this->admin_model->delete_record('products',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Admin/audios');                    
                 } 
                         
                         
                        $data['page_title']='Audios';
                        $this->db->where_in('product_type',array(2,3));
                        //$this->db->order_by("product_id","desc");
                        $data['products_info']=$this->admin_model->record_list('products');
                        $this->load->view('myadmin/audios',$data);
            }
            
            
            /******AUDIOS*****/
      
        
        public function subadmin($task='',$subadmin_id='')
        {
            if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
            if($task == 'addSubadmin'){
                        $this->form_validation->set_rules('subadmin_name', 'Subadmin Name', 'required');
			$this->form_validation->set_rules('subadmin_email','Subadmin Email ID','required|valid_email|is_unique[tbl_subadmin.subadmin_email]');
			$this->form_validation->set_rules('subadmin_contact', 'Contact No', 'required|numeric');
                        $this->form_validation->set_rules('password', 'Password', 'required');
                        $this->form_validation->set_rules('cpass', 'Confirm Password', 'required|matches[password]');
			
			 if ($this->form_validation->run())
			{
                                $data=array( 	  
	        			'subadmin_name'=>ucwords(strtolower($this->input->post('subadmin_name'))),
	        			'subadmin_email'=>strtolower($this->input->post('subadmin_email')),
	        			'address'=>$this->input->post('address'),
	        			'subadmin_contact'=>$this->input->post('subadmin_contact'),
	        			'subadmin_alt_contact'=>$this->input->post('subadmin_alt_contact'),
	        			'password'=>strrev(sha1(md5($this->input->post('password')))),
	        			'is_active'=>1
	        			);
					//echo"<pre>";print_r($data);die;
                                         $email=strtolower($this->input->post('subadmin_email'));
                                         $password=$this->input->post('password');
					$details=$this->admin->record_insert('tbl_subadmin',$data);
					$findemail = $this->admin->Sendmail($email,$password);

					$this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Subadmin Added Successfully.');
					redirect(base_url().'Adminity/subadmin');		
			}else {
                            $this->session->set_flashdata('err_msg',validation_errors());
                             redirect(base_url().'Adminity/subadmin');
                        }
            }
            
             if($task == 'editSubadmin'){
                        $this->form_validation->set_rules('subadmin_name', 'Subadmin Name', 'required');
			 $this->form_validation->set_rules('subadmin_email','Subadmin Email ID','required|valid_email');
                         $this->form_validation->set_rules('subadmin_contact', 'Contact No', 'required|numeric');
			 if ($this->form_validation->run())
			{
                            $data=array(
					'subadmin_name'=>ucwords(strtolower($this->input->post('subadmin_name'))),
	        			'subadmin_email'=>strtolower($this->input->post('subadmin_email')),
	        			'address'=>$this->input->post('address'),
	        			'subadmin_contact'=>$this->input->post('subadmin_contact'),
	        			'subadmin_alt_contact'=>$this->input->post('subadmin_alt_contact'),
	        			'is_active'=>1);
                            
                                        $where =array('subadmin_id'=>$subadmin_id);
					$subadmin=$this->admin->records_update('tbl_subadmin',$data,$where);
					$this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Subadmin Updated Successfully.');
					redirect(base_url().'Adminity/subadmin');		
			}else {
                            $this->session->set_flashdata('err_msg',validation_errors());
                             redirect(base_url().'Adminity/subadmin');
                        }
             }
            
             if($task == 'delete'){
                        $where =array('subadmin_id'=>$subadmin_id);
                        $this->admin->delete_record('tbl_subadmin',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Adminity/subadmin');
             }
            $this->db->order_by("subadmin_id","desc");
            $data['subadmin_info']=$this->admin->record_list('tbl_subadmin');
            $data['page_title']='Subadmin';
            $this->load->view('myadmin/subadmin',$data);
        }
       
        
        
        public function profile($task = '',$admin_id = '')
        {
            if ($this->session->userdata('admin_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
            if($task == 'updateImage'){
                if($_FILES['userfile']['name']!= ""){
                      $img_name='userfile';
                      $img_path='profile';
                      $old_img=$this->input->post('old_admin_profile');
                      $profile=$this->admin_model->upload_image($img_name,$img_path,$old_img);  
                }
                        if($profile)
                        {
                            $data=array('image'=>$profile);                            
                                $where =array('id'=>$admin_id);
                                $subadmin=$this->Admin_model->records_update('id',$data,$where);
                                $this->session->set_userdata('log_image', $profile);
                                $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Profile Image Updated Successfully.');
                                redirect(base_url().'Admin/profile');

                        }
                        else
                        {
                                    $this->session->set_flashdata('err_msg',$this->upload->display_errors());
                                    redirect(base_url() .'Admin/profile');

                        }
            }
            
            if($task == 'updateAdminProfile'){
                        $this->form_validation->set_rules('fname', 'Admin First Name', 'required');
                         $this->form_validation->set_rules('lname', 'Admin Last Name', 'required');
			$this->form_validation->set_rules('email','Admin Email ID','required|valid_email');
			$this->form_validation->set_rules('mobile', 'Contact No', 'required|numeric');
                         if ($this->form_validation->run())
			             {
                            $data=array(
					       'fname'=>ucwords(strtolower($this->input->post('fname'))),
                           'lname'=>ucwords(strtolower($this->input->post('lname'))),
	        			    'email'=>strtolower($this->input->post('email')),
	        			    'mobile'=>$this->input->post('mobile'),
	        			    'address'=>$this->input->post('address'),
                                        'pincode'=>$this->input->post('pincode')
	        			    // 'DOB'=>$this->input->post('DOB'),
                                        // 'gender'=>$this->input->post('gender'),
                                        // 'state'=>$this->input->post('state'),
                                        // 'city'=>$this->input->post('city'),
                                        
                                        //'website'=>$this->input->post('website'),
                                        //'skype_id'=>$this->input->post('skype_id'),
	        			//'is_active'=>1
                                        );
                            
                    $where =array('id'=>$admin_id);
					$subadmin=$this->admin_model->records_update('admin',$data,$where);
					$this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Admin Profile Updated Successfully.');
					redirect(base_url().'Admin/profile');		
			}else {
                            $this->session->set_flashdata('err_msg',validation_errors());
                             redirect(base_url().'Admin/profile');
                        }
            }
            
            if($task =='updateAdminPassword'){
                
                $this->form_validation->set_rules('old_password', 'Old Password', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('confirm', 'Password Confirmation', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE)
                {
                       $this->session->set_flashdata('err_msg', validation_errors());
                        redirect(base_url() . 'Admin/profile');
                }
                else
                {
                    // $where=array(
                    //     'id'=> $this->session->userdata('log_trainer_id')
                    //     );
                    $query = $this->tadmin_model->checkOldPassword($this->input->post('old_password'),'admin',$admin_id);

                            if($query)
                                    {
                                       // echo "hii";die();
                                      $data=array('password'=> strrev(sha1(md5($this->input->post('password')))));
                                            $where =array('id'=>$admin_id);
                                            $subadmin=$this->admin_model->records_update('admin',$data,$where);
                                            $this->session->sess_destroy();
                                            $this->session->set_flashdata('msg_ok', ('Password Updated Successfully'));
                                            redirect(base_url() . 'Admin/profile');
                                    }
                                    else
                                    {
                                        //echo "bye";die();
                                         $this->session->set_flashdata('err_msg', 'Please Enter the correct password');
                                            redirect(base_url() . 'Admin/profile');
                                    }

				 
		}
                
            }
            $admin_id = $this->session->userdata('log_admin_id');
           
            $where =array('id'=> $admin_id );
             //$data['admin_info'] = $this->db->get_where('admin', array('id' => $admin_id))->result_array();
            $data['admin_info']=$this->admin_model->record_list('admin',$where); 
            $data['page_title']='Profile Setting';
            $this->load->view('myadmin/myprofile',$data);
        }
        
        
        public function login()
        {
            if ($this->session->userdata('admin_login') == 1) {
                 $this->session->set_userdata('last_page', current_url());                 
                 redirect(base_url());
			
            }else{
                    $data['page_title'] = 'Login';
                    $this->load->view('myadmin/login',$data);
		}
        }
        
        
        public function logout()
	{
		$this->session->sess_destroy();	
		redirect(base_url());
	}
        
        
        /******POPUP MODEL******/
        public function mypopup($account_type = '', $page_name = '', $param1 = '', $param2 = '', $param3 = '')
  {

    //$account_type               = $this->session->userdata('login_type');
                $page_data['param1']    = $param1;
                $page_data['param2']    = $param2;
    $page_data['param3']    = $param3;    
    //echo "hello";
    $this->load->view($account_type.'/'.$page_name,$page_data);   
  }
        
        public function popup($account_type = '', $page_name = '', $param2 = '')
	{
                //$account_type               =	$this->session->userdata('login_type');
		$page_data['param2']		=	$param2;		
		//echo "hello";
		$this->load->view($account_type.'/'.$page_name,$page_data);		
	}
        
        /*********END POPUP MODEL*********/        
        
        
        //Validating login from ajax request
        function validateLogin() {
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
                            echo $this->tadmin_model->validate_login_info($email,$password);
                    }
                
                            
        }
        
        
       /*********ORDERS INFORMATION *********/       

        public function newOrders($task = "", $order_id = ""){
            if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
            } 
          
//            $this->db->where('order_status',1);    
           $data['order_info'] = $this->admin_model->select_cart_order_info('orders');
           $data['page_title'] = 'New Orders';
           $this->load->view('myadmin/new_orders',$data);
            
        }
        
        public function completedOrders($task = "", $order_id = ""){
            if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
            } 
         
           
           $data['order_info'] = $this->admin_model->select_completed_order_info('orders');
           $data['page_title'] = 'Completed Orders';
           $this->load->view('myadmin/completed_orders',$data);
            
        }
        
        public function cancelledOrders($task = "", $order_id = ""){
            if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
            }
            
        
//           $this->db->where('order_status',6);    
           $data['order_info'] = $this->admin_model->select_cancel_order_info('orders');
           $data['page_title'] = 'Cancelled Orders';
           $this->load->view('myadmin/cancelled_orders',$data);
            
        }
        
        
        
        function changeOrderStatus(){
            echo $this->Admin_model->update_orderStatus_info();
             $this->session->set_flashdata('errors', ('Order Status Updated.!'));
        }
        
        public function delete_product()
    {
        $this->db->select('product_img,image_id');
        $this->db->where('image_id',$this->input->post('id'));
        $imgdata=$this->db->get('product_images')->row_array();
       
        
        if(!empty($imgdata))
        {
             
             $this->db->select('product_img');
             $this->db->where('image_id',$imgdata['image_id']);
             $single_product=$this->db->get('product_images')->row_array();
           

         
        
          if($single_product!="")
          {
             $this->db->where('image_id',$this->input->post('id'));
            $this->db->delete('product_images');
            echo 1;die;

          }

         
        }


      
    }

}
