<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainerdashboard extends CI_Controller {
	public function __construct()  
	{
		parent::__construct();
                $this->load->model('tadmin_model');
                $this->load->model('admin_model');
                $this->load->library('session');
                $this->load->library('upload');
                 //$this->load->library('Vimeo');
                date_default_timezone_set("Asia/Kolkata");
                $this->load->library('form_validation');
                $this->load->helper(array('form','url','file'));
                //$this->generateOtp();
		
	}
	public function index()
	{
             
            if($this->session->userdata('trainer_login') == 1){
                
                 $this->session->set_userdata('last_page', current_url());   
                  $data['user_cnt']= $this->admin_model->record_count('users');
                  $data['category_cnt']= $this->admin_model->record_count('category');
                  $data['trainer_neworder_cnt']= $this->admin_model->trainer_neworder_cnt('orders');
                  $data['trainer_product_cnt']= $this->admin_model->trainer_product_cnt('products');
                 
                 $data['page_title'] = 'Dashboard';             
                 $this->load->view('trainer/index',$data);
                
            }elseif ($this->session->userdata('admin_login') == 1) 
            {
                  redirect(base_url().'Admin/Trainer');           
             }
           
	}    
        
        
        public function error(){
            $data['page_title'] = 'Page is Under Development';
            $this->load->view('trainer/404',$data);
        }
        
        
       /**********TRAINERS********/
        
       public function Trainers(){
           if ($this->session->userdata('trainer_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
           }                        
            $opts = array(
              'http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/getTrainerList?start=0&count=50', false, $context);
            $data['trainer_info'] = json_decode($trainer_info,true);
          $data['page_title'] = 'Trainers';
         $this->load->view('trainer/trainers',$data);          
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
            if ($this->session->userdata('trainer_login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(base_url());
               }
            $data['page_title']='System OTP';
            $this->db->order_by("otp_id","desc");
            $data['otp_info']=$this->admin->record_list('otp');
            $this->load->view('trainer/otp_data',$data);
        }

    

        public function send_message($mob,$msg)
	{
               $web_url = "http://api.smsbrain.in/1.2/appsms/send.php";
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
        
        /*************USERS*********/
        
                public function users($task='',$user_id='')
                {
                    if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }                                        
                    if ($task == "delete") {
                        $where =array('id'=>$user_id);
                        $this->admin_model->delete_record('users',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Trainerdashboard/users');
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
                                            redirect(base_url() .'Trainerdashboard/users');		
                            }
                        else {
                            $this->session->set_flashdata('err_msg',validation_errors());
                            redirect(base_url() .'Trainerdashboard/users');
                        }
                    }                    
                        $data['page_title']='Users';
                        //$this->db->where('own_diesel_filler',0);
                        $this->db->order_by("id","desc");
                        $data['user_info']=$this->admin_model->record_list('users');
                        $this->load->view('trainer/users',$data);
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
					redirect(base_url() .'Trainerdashboard/users');		
			}
                    else {
                        $this->session->set_flashdata('err_msg',validation_errors());
                        redirect(base_url() .'Trainerdashboard/users');
                    }
            }
            function changeOrderStatus(){

             $this->admin_model->update_orderStatus_info();
             $this->session->set_flashdata('errors', ('Order Status Updated.!'));
             echo 1;
        }            
            function checkOrderStatus(){

             if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       } 
                $this->form_validation->set_rules('drivername', 'Driver Name', 'required');
                $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric'); 
                $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'required');
                if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                    }
                    else
                     {
                    echo 1;
                     }
        }
            /*********CATEGORIES******/
            
             public function categories($task='',$category_id='')
                {
                    if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
               if ($task == 'addCategory') 
               {
                   $this->form_validation->set_rules('category_name', 'Category Name', 'required|is_unique[category.category_name]');
			 
			 if ($this->form_validation->run())
			{
                             $code = rand(0,999999);                             
                            $data=array( 	  
                                 'category_name'=> ucwords(strtolower($this->input->post('category_name'))),
                                 'cat_code'=> "C".$code,//GENERATE
                                 'cat_url'=> str_replace(' ','-', strtolower($this->input->post('category_name')))//GENERATE
                                 );	


                            $details=$this->admin_model->record_insert('category',$data);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Category Added Successfully.');
                            redirect(base_url() .'Trainerdashboard/categories');                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() .'Trainerdashboard/categories');
                            }  
                 }

                  if ($task == 'editCategory') 
               {

                   $this->form_validation->set_rules('category_name', 'Category Name', 'required');
       
                        if ($this->form_validation->run())
                       {
                          $data=array(     
                                     'category_name'=> ucwords(strtolower($this->input->post('category_name'))),
                                     'cat_url'=> str_replace(' ','-',strtolower($this->input->post('category_name'))),//GENERATE                                     
                                     );          
                            $where=array('category_id' => $category_id); 
                                               
                            $details=$this->admin_model->records_update('category',$data,$where);
                            $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Category Updated Successfully.');
                            redirect(base_url() .'Trainerdashboard/categories'); 
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() .'Trainerdashboard/categories');
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
                        $this->load->view('trainer/categories',$data);
                }
            /*******CATEGORIES******/
              /*********LANGUAGES******/
            
             public function language($task='',$language_id='')
            {
                    if ($this->session->userdata('trainer_login') != 1) {
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
                            redirect(base_url().'Trainerdashboard/language');  
                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/language');
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
                            redirect(base_url().'Trainerdashboard/language'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/language');
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
                        $this->load->view('trainer/language',$data);
                }
            /*******LANGUAGES******/
                
                
            /*********PRICE RANGE******productdetail**/
            
             public function price_range($task='',$price_range_id='')
            {
                    if ($this->session->userdata('trainer_login') != 1) {
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
                            redirect(base_url().'Trainerdashboard/price_range');  
                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/price_range');
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
                            redirect(base_url().'Trainerdashboard/price_range'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/price_range');
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
                
                    if ($this->session->userdata('trainer_login') != 1) {
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
                            redirect(base_url().'Trainerdashboard/type');  
                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/type');
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
                            redirect(base_url().'Trainerdashboard/type'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/type');
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
                
                    if ($this->session->userdata('trainer_login') != 1) {
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
                            redirect(base_url().'Trainerdashboard/suitable');  
                               
                            
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/suitable');
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
                            redirect(base_url().'Trainerdashboard/suitable'); 
                      
                        }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url().'Trainerdashboard/suitable');
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
                        $this->load->view('trainer/suitable',$data);
                }
            /*******SUITABLE FOR******/
            
            /*****PRODUCTS*******/
            
              public function products($task='',$product_id=''){
                if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                if ($task == 'addProducts') 
               {                 
                   $this->form_validation->set_rules('product_name', 'Product Name', 'required');
              
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
                                                'trainer_id'=> $_SESSION['log_trainer_id'],
                                                'language_id'=> $this->input->post('language_id'),
                                                'price_range_id'=> $this->input->post('price_range_id'),
                                                'price'=> $this->input->post('price'),
                                                'product_type'=> $this->input->post('product_type'),
                                                'suitable_for'=> $this->input->post('suitable_for'),
                                                'delivery_time'=> $this->input->post('delivery_time'),
                                                'special_offer'=> $this->input->post('special_offer'),
                                                'status' => $this->input->post('status'),
                                                'sample'=> $this->input->post('sample'),
                                                'punchline'=> $this->input->post('punchline'),
                                                'description'=> $this->input->post('description'),
                                                'product_img'=>$profile,//UPLOAD
                                                'product_code'=> "PR".$code,//GENERATE
                                                'product_url'=> str_replace(' ','-',strtolower($this->input->post('product_name'))),//GENERATE                                                                                         
                                                );          
                                            // echo"<pre>";print_r($data);die;
                                                $details=$this->admin_model->record_insert('products',$data);

                                                $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Products Added Successfully.');
                                                redirect(base_url() .'Trainerdashboard/products');  
                                        }

                                        else {
                                         $this->session->set_flashdata('err_msg',validation_errors());
                                         redirect(base_url() .'Trainerdashboard/products');
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
                                                'trainer_id'=> $_SESSION['log_trainer_id'],
                                                'language_id'=> $this->input->post('language_id'),
                                                'price_range_id'=> $this->input->post('price_range_id'),
                                                'price'=> $this->input->post('price'),
                                                'product_type'=> $this->input->post('product_type'),
                                                'suitable_for'=> $this->input->post('suitable_for'),
                                                'delivery_time'=> $this->input->post('delivery_time'),
                                                'sample'=> $this->input->post('sample'),
                                                'punchline'=> $this->input->post('punchline'),
                                                'description'=> $this->input->post('description'),
                                                 'product_img'=>$profile,//UPLOAD
                                                'product_url'=> str_replace(' ','-',strtolower($this->input->post('product_name')))//GENERATE                                                                                         
                                                );      
                                          
                                                $where=array('product_id' => $product_id);          
                                                $details=$this->admin_model->records_update('products',$data,$where);
                                                $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Products Updated Successfully.');
                                                redirect(base_url() .'Trainerdashboard/products'); 
                                } 
                            }
                            else{
                                  $this->session->set_flashdata('err_msg',validation_errors());
                                  redirect(base_url() .'Trainerdashboard/products');
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
                                        'trainer_id' => $this->session->userdata('log_trainer_id'),
                                        'is_deleted'=>'0',
                                                      );
                                                               
                                        $insert_image=$this->admin_model->record_insert('product_images',$data_img1);
                                         }
                                        } 
                                       }
                                         $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Images Added Successfully.');
                                         redirect(base_url().'Trainerdashboard/products'); 
                    
                        } 
                        if($task=='delete'){
                        $where=array('product_id' => $product_id);   
                        $this->admin_model->delete_record('products',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Trainerdashboard/products');                    
                 }
                 
                        $data['page_title']='Products';
                       
//                        $this->db->where('product_type !=',2);
//                        $this->db->where('product_type !=',3);
                        $this->db->where('trainer_id',$_SESSION['log_trainer_id']);
                        $data['products_info']=$this->admin_model->record_list('products');
                      
                       // echo "<pre>"; print_r($data['products_info']);die;
                        $this->load->view('trainer/products',$data);
            }
            
            
            /******PRODUCTS*****/            
            
            /*****VIDEOS*******/
            
              public function videos($task='',$product_id=''){
                if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
                        if ($task == 'addVideo') 
               {                 
                   $this->form_validation->set_rules('product_name', 'Product Name', 'required');
              
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
                                      // 'category_id'=> $this->input->post('category_id'),
                                       'trainer_id' => $_SESSION['log_trainer_id'],
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

                                       $details=$this->admin_model->record_insert('videos',$data);
                                       $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Products Added Successfully.');
                                       redirect(base_url() .'Trainerdashboard/videos');                              
                       }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() .'Trainerdashboard/videos');
                            }
                }
                 
                         if($task=='delete'){
                        $where=array('media_id' => $product_id);   
                        $this->admin_model->delete_record('videos',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Admin/videos');                    
                 } 
                         
                         
                        $data['page_title']='Videos';
                        $this->db->where_in('product_type',array(2,3));
                        $this->db->where('trainer_id',$_SESSION['log_trainer_id']);
                        $data['products_info']=$this->admin_model->record_list('videos');
                        $this->load->view('trainer/videos',$data);
            }
            
            
            /******VIDEOS*****/
            
           /******SERICES*******/
            public function series($task='',$series_id=''){
                if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
                        if ($task == 'addSeries') 
               {                 
                   $this->form_validation->set_rules('series_title', 'Series Name', 'required|is_unique[series.series_title]');
              
                    if ($this->form_validation->run())
                   {
                    $code = rand(0,999999);             
                       
                       
                       if($_FILES['seriesfile']['name']!= ""){
                       $img_name='seriesfile';
                       $img_path='series';
                      
                       $series=$this->admin_model->upload_series($img_name,$img_path); 
                       }else{
                           $series ='';
                       } 
                       
                      
                         $data=array(                                                   
                                     'series_title'=> ucwords(strtolower($this->input->post('series_title'))),
                                       
                                   'trainer_id' => $_SESSION['log_trainer_id'],
                                   'language_id' => $this->input->post('language_id'),
                                   
                                   'video_type' => $this->input->post('video_type'),
                                   'suitable_for' => $this->input->post('suitable_for'),
                                   'price_range_id' => $this->input->post('price_range_id'),
                                   'price' => $this->input->post('price'),
                                   'duration'=> $this->input->post('duration'),                                       
                                   'special_offer'=> $this->input->post('special_offer'),
                                  'youtube_link' =>$this->input->post('youtube_link'),
                                  
                                   'series_descriptiom'=> $this->input->post('series_descriptiom'),
                                  
                                   'series_path'=>$series,//UPLOAD
                                   
                                   'series_code'=> "SR".$code,//GENERATE
                                   'series_url'=> str_replace(' ','-',strtolower($this->input->post('series_title'))),//GENERATE                                                                                         
                                       );         

                                       $details=$this->admin_model->record_insert('series',$data);
                                       $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Products Added Successfully.');
                                       redirect(base_url() .'Trainerdashboard/series');                              
                       }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() .'Trainerdashboard/series');
                            }
                }
                 
                         if($task=='delete'){
                        $where=array('series_id ' => $series_id );   
                        $this->admin_model->delete_record('series',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Trainerdashboard/series');                    
                 } 
                         
                         
                        $data['page_title']='Series';
                        
                        $this->db->where('trainer_id',$_SESSION['log_trainer_id']);
                        $data['series_info']=$this->admin_model->record_list('series');
                        $this->load->view('trainer/series',$data);
            }
            
            
         /******SERICES*******/


         /******Tutorial*******/
            public function Tutorial($task='',$tutorial_id=''){
                if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                       
                        if ($task == 'addTutorial') 
               {                 
                   $this->form_validation->set_rules('tutorial_title', 'Tutorial Name', 'required|is_unique[tutorial.tutorial_title]');
              
                    if ($this->form_validation->run())
                   {
                    $code = rand(0,999999);             
                       
                       
                       if($_FILES['tutorial_path']['name']!= ""){
                       $img_name='tutorialfile';
                       $img_path='tutorial';
                      
                       $tutorial=$this->Vimeo->upload($img_path); 
                       }else{
                           $tutorial ='';
                       } 
                       
                      
                         $data=array(                                                   
                                     'tutorial_title'=> ucwords(strtolower($this->input->post('tutorial_title'))),
                                   'series_id' => $this->input->post('series_id'),    
                                   'trainer_id' => $_SESSION['log_trainer_id'],
                                   'language_id' => $this->input->post('language_id'),
                                   'video_type' => $this->input->post('video_type'),
                                   'price_range_id' => $this->input->post('price_range_id'),
                                   'price' => $this->input->post('price'),
                                   'duration'=>$this->input->post('duration'),
                                   'tutorial_description'=> $this->input->post('tutorial_description'),
                                 'tutorial_path'=>$tutorial,//UPLOAD
                                   
                                   'tutorial_code'=> "TR".$code,//GENERATE
                                   'tutorial_url'=> str_replace(' ','-',strtolower($this->input->post('tutorial_title'))),//GENERATE                                                                                         
                                       );         

                                       $details=$this->admin_model->record_insert('tutorial',$data);
                                       $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Tutorial Added Successfully.');
                                       redirect(base_url() .'Trainerdashboard/Tutorial');                              
                       }
                        else {
                                $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() .'Trainerdashboard/Tutorial');
                            }
                }
                 
                         if($task=='delete'){
                        $where=array('tutorial_id ' => $tutorial_id );   
                        $this->admin_model->delete_record('tutorial',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Trainerdashboard/Tutorial');                    
                 } 
                         
                         
                        $data['page_title']='Tutorial';
                        
                        $this->db->where('trainer_id',$_SESSION['log_trainer_id']);
                        $data['Tutorial_info']=$this->admin_model->record_list('Tutorial');
                        $this->load->view('trainer/Tutorial',$data);
            }
            
            
         /******Tutorial*******/


/*****Cources*******/
            
              public function Cources($task='',$course_id=''){
                if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                if ($task == 'addCources') 
               {                 
                   $this->form_validation->set_rules('course_name', 'Cources Name', 'required|is_unique[course.course_name]');
              
                    if ($this->form_validation->run())
                   {
                             $code = rand(0,999999);                             

                               
               $data=array(                                                   
                             'course_name'=> ucwords(strtolower($this->input->post('course_name'))),
                             'category_id'=> $this->input->post('category_id'),
                              'trainer_id'=> $_SESSION['log_trainer_id'],
                              'cources_price'=> $this->input->post('cources_price'),
                              'cources_duration'=> $this->input->post('cources_duration'),
                               'course_description'=> $this->input->post('course_description'),
                               'cources_code'=> "CC".$code,//GENERATE
                               'cources_url'=> str_replace(' ','-',strtolower($this->input->post('course_name')))//GENERATE                                                                                         
                           );          
                                           
                    $details=$this->admin_model->record_insert('course',$data);
                    $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i>Products Added Successfully.');
                     redirect(base_url() .'Trainerdashboard/Cources');  
                                       

                                         
                                }
                }
                         if ($task == 'editCources') 
               {                 
                    $this->form_validation->set_rules('course_name', 'Cources Name', 'required|is_unique[course.course_name]');
              
                    if ($this->form_validation->run())
                    {
                                $data=array(                                                   
                             'course_name'=> ucwords(strtolower($this->input->post('course_name'))),
                             'category_id'=> $this->input->post('category_id'),
                              'trainer_id'=> $_SESSION['log_trainer_id'],
                              'cources_price'=> $this->input->post('cources_price'),
                              'cources_duration'=> $this->input->post('cources_duration'),
                               'course_description'=> $this->input->post('course_description'),
                               'cources_code'=> "CC".$code,//GENERATE
                               'cources_url'=> str_replace(' ','-',strtolower($this->input->post('course_name')))//GENERATE                                                                                         
                           );      
                                          
                           $where=array('course_id' => $course_id);          
                          $details=$this->admin_model->records_update('course',$data,$where);
                          $this->session->set_flashdata('msg_ok','<i class="ti-check-box"></i> Products Added Successfully.');
                           redirect(base_url() .'Trainerdashboard/Cources'); 
                            }
                            else{
                                  $this->session->set_flashdata('err_msg',validation_errors());
                                  redirect(base_url() .'Trainerdashboard/Cources');
                              } 
                         }
                        
                         
                         if($task=='delete'){
                        $where=array('course_id' => $course_id);    
                        $this->admin_model->delete_record('course',$where);
                        $this->session->set_flashdata('msg_ok', ('<i class="ti-check-box"></i> Record Removed Successfully.'));
                        redirect(base_url() .'Trainerdashboard/Cources');                    
                 } 
                 
                        $data['page_title']='Cources';
                       
                       
                         $this->db->where('trainer_id',$_SESSION['log_trainer_id']);
                        $data['cources_info']=$this->admin_model->record_list('course');
                        $this->load->view('trainer/Cources',$data);
            }
            
            
            /******Cources*****/           


        public function newOrders($task = "", $order_id = ""){
             if ($this->session->userdata('trainer_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
            }
            
//            $this->db->where('order_status',1);    
           $data['order_info'] = $this->admin_model->select_trainer_cart_order_info('orders');
           $data['page_title'] = 'New Orders';
           $this->load->view('trainer/new_orders',$data);
            
        }
        
        public function completed($task = "", $order_id = ""){
             if ($this->session->userdata('trainer_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
            }
        
           $this->db->where('order_status',5);    
           $data['order_info'] = $this->admin_model->select_trainer_completed_order_info('orders');
           $data['page_title'] = 'Completed Orders';
           $this->load->view('trainer/completed_orders',$data);
            
        }
        
        public function cancelled($task = "", $order_id = ""){
             if ($this->session->userdata('trainer_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url());
            }
         
           $this->db->where('order_status',6);    
           $data['order_info'] = $this->admin_model->select_trainer_cancel_order_info('orders');
           $data['page_title'] = 'Cancelled Orders';
           $this->load->view('trainer/cancelled_orders',$data);
            
        }

      
        
        public function profile()
        {
            if ($this->session->userdata('trainer_login') != 1) {
                        $this->session->set_userdata('last_page', current_url());
                        redirect(base_url());
                       }
                              
            $data['page_title']='Profile Setting';
            $this->load->view('trainer/myprofile',$data);
        }
        public function updatetrainerProfileimg()
        {
            //echo $_FILES['userfile']['name'];die();
            $id =$this->session->userdata('log_trainer_id');
        
            $file = $_FILES['file']['name'];
           
            $data = array("Id" =>$id ,"file" => $_FILES['file']['name']);             

                $data_string = json_encode($data); 

                $ch = curl_init($this->api_url.'api/v1/uploadAttachment');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                // curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                //     'Content-Type: application/json',
                //     'token: $this->session->userdata("log_trainer_token")',
                //     'Content-Length: ' . strlen($data_string))                                                                       
                // );  
                 //echo $this->session->userdata("log_trainer_token");                                                                                                             

                 $trainer_info = curl_exec($ch);
                 $trainer = json_decode($trainer_info,true);
                
                  
                  //echo "<pre>";print_r($trainer['data']);die();
            foreach($t as $row){
                
                $this->session->set_userdata('log_trainer_attachment', $row['email']);
                redirect(base_url() .'Trainerdashboard/profile');
                                }

        }
         public function updatetrainerProfile(){            
                $this->form_validation->set_rules('fname', 'First Name', 'required');
                $this->form_validation->set_rules('lname', 'Last Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
               
                     if ($this->form_validation->run())
                     {
                          $firstName = $this->input->post('fname');
                          $lastName = $this->input->post('lname');
                          $industryId = $this->input->post('industries');
                          $topicId = $this->input->post('topics');
                          $email = $this->input->post('email');
                          $city = $this->input->post('city');
                          $address = $this->input->post('address');
                          $pincode = $this->input->post('pincode');
                    $token   = $this->session->userdata('log_trainer_token');
                    $id   = $this->session->userdata('log_trainer_id');
                    $mobile = $this->session->userdata('log_trainer_mobile');
                     $data = array("id" =>$id ,"firstName" => $firstName ,"lastName" =>$lastName,"email" =>$email ,"mobile" => $mobile,"userType"=>2,"trainer"=>'{
        "industries": [{
            "industryId": '.$industryId.',
            "isPrimary": true
        }],
        "topics": [{
            "isPrimary": true,
            "topicId": '.$topicId.'
        }]
    }',"address" => array("area"=>$address,"city"=>$city,"zipcode"=>$pincode));
                     // echo "<pre>";print_r($data);                                                                   
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

                           $trainer_info = curl_exec($ch);
                    //echo "<pre>";print_r($trainer_info);die();     
                 $trainer = json_decode($trainer_info,true);
               
                  $t = array($trainer['data']);
                 
                   foreach($t as $row){
               
                $this->session->set_userdata('log_trainer_email', $row['email']);
                
                $this->session->set_userdata('log_trainer_name', $row['firstName']." ".$row['lastName']);
               
                        
                       redirect(base_url() .'Trainerdashboard/profile');
                 }
                         
                         
                     }
                    else 
                     {
                           echo validation_errors();
                     }            
        }
       
        
        public function login()
        {
            if ($this->session->userdata('trainer_login') == 1) {
                 $this->session->set_userdata('last_page', current_url());                 
                 redirect(base_url());
			
            }else{
                    $data['page_title'] = 'Login';
                    $this->load->view('trainer/login',$data);
		}
        }
        
        
        public function logout()
	{
		 $this->session->set_userdata('trainer_login', '');
        $this->session->set_userdata('log_trainer_id', '');
        $this->session->set_userdata('log_trainer_email', '');
        $this->session->set_userdata('log_trainer_mobile', '');
         $this->session->set_userdata('log_trainer_name', '');
        $this->session->set_userdata('log_image', '');
        $this->session->set_userdata('log_address', '');
        $this->session->set_userdata('log_type', '');
            $this->session->set_flashdata('logout_notification', 'logged_out');	
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

}
