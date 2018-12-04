<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tadmin_model extends CI_Model {
	
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->library('email');
        $this->load->helper('file');
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    
    /*****login funtionality start********/
    
	function validate_login_info($email,$password){	
		
		 // Checking login credential for admin
		$password = strrev(sha1(md5($password)));
                $admin = $this->db->get_where('admin', array('email' => $email,'password' => $password));
		//$trainer = $this->db->get_where('trainer', array('email' => $email,'password' => $password));		
		if($admin->num_rows() > 0) {
                        $row = $admin->row();
                        $this->session->set_userdata('admin_login', '1');
                        $this->session->set_userdata('log_admin_id', $row->id);
                        $this->session->set_userdata('log_email_id', $row->email);
                        $this->session->set_userdata('log_admin_name', $row->fname." ".$row->lname);
                        $this->session->set_userdata('log_image', $row->image);
                        $this->session->set_userdata('log_address', $row->address);
                        $this->session->set_userdata('log_type', 'admin');
                        echo '1';
                }/*elseif($trainer->num_rows() > 0) {
                        $row = $trainer->row();
                        $this->session->set_userdata('trainer_login', '1');
                        $this->session->set_userdata('log_admin_id', $row->trainer_id);
                        $this->session->set_userdata('login_email_id', $row->email);
                        $this->session->set_userdata('log_admin_name', $row->fname." ".$row->lname);
                        $this->session->set_userdata('log_image', $row->image);
                        $this->session->set_userdata('log_address', $row->address);
                        $this->session->set_userdata('login_type', 'trainer');
                        echo '1';
                }*/else{
			echo 'Invalid Login Details.';
		}		
	}
        
        /********FOR USER LOGIN*********/
        
        function validate_User_login_info($email,$password){
		
		$password = strrev(sha1(md5($password)));
                //$admin = $this->db->get_where('admin', array('email' => $email,'password' => $password));
		$user = $this->db->get_where('users', array('email' => $email,'password' => $password));		
		
                if($user->num_rows() > 0) {
                        $row = $user->row();
                        $this->session->set_userdata('user_login', '1');
                        $this->session->set_userdata('login_user_id', $row->id);
                        $this->session->set_userdata('login_email_id', $row->email);
                        $this->session->set_userdata('name', $row->fname." ".$row->lname);
                        $this->session->set_userdata('profile_img', base_url().$row->picture);
                        $this->session->set_userdata('login_type', 'user');
                        echo '1';
                }else{
			echo 'Invalid Login Details.';
		}
		
	}
	 /*****login funtionality end********/
	
        public function checkOldPassword($oldPassword,$table,$where)
{
  // echo $oldPassword;
  // echo $table;
  // echo $where;die();
	$oldPassword= strrev(sha1(md5($oldPassword)));
	$password = $this->db->get_where('admin' , array('id' => $where))->row()->password;

	if($oldPassword == $password)
        {
          //echo "hi";die();
            return true;
        }
        else
        {
          //echo "bye";die();
            return false;
        }
    
}

 function select_login_user_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('users',array('id' => $user_id))->result_array();
   
    }

    /*** track order***/
         function get_order_item_count($order_id){
                $this->db->from('order_product');
                $this->db->where('order_id', $order_id);
                return $this->db->count_all_results();
            }

        function select_login_user_active_order_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        $this->db->order_by('order_id','desc');
      
        $this->db->where('order_status <','5');
        //$added_by_name = $this->session->userdata('login_type');
        return $this->db->get_where('orders',array('user_id' => $user_id))->result_array();
    }

      function select_login_user_completed_order_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        $this->db->order_by('order_id','desc');
      
         $this->db->where('order_status',5);
        //$added_by_name = $this->session->userdata('login_type');
        return $this->db->get_where('orders',array('user_id' => $user_id))->result_array();
    }

    function select_login_user_cancelled_order_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        $this->db->order_by('order_id','desc');
        $this->db->where('order_status',6);
    //$added_by_name = $this->session->userdata('login_type');
        return $this->db->get_where('orders',array('user_id' => $user_id))->result_array();
    }
    
    function update_likes_info(){
        $this->db->select('user_id,product_id');
        $this->db->where('user_id', $this->session->userdata('login_user_id'));
        $this->db->where('product_id',$this->input->post('product_id'));
        $query =$this->db->get_where('likes')->result();
        if(empty($query)){
          $this->db->set('like_count', 'like_count+1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->update('products');
            
            $data['product_id'] = $this->input->post('product_id');
            $data['user_id'] = $this->session->userdata('login_user_id');
            $data['likes']=1;
            $this->db->insert('likes',$data);

            $this->db->where('product_id', $this->input->post('product_id'));
            echo $this->db->get_where('products')->row()->like_count;
            die();
        }
        $this->db->select('user_id,product_id');
        $this->db->where('user_id',$this->session->userdata('login_user_id'));
        $this->db->where('product_id',$this->input->post('product_id'));
        $this->db->where('likes',0);
        $query1=$this->db->get('likes')->result();        
        
        if($query1)
        {
            $this->db->set('like_count', 'like_count+1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->update('products');            
            
            $this->db->set('likes', '1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->update('likes');
           
            $this->db->where('product_id', $this->input->post('product_id'));
             echo $this->db->get_where('products')->row()->like_count;
              die();
             
        }
         $this->db->select('user_id,product_id');
        $this->db->where('user_id',$this->session->userdata('login_user_id'));
        $this->db->where('product_id',$this->input->post('product_id'));
        $this->db->where('likes',1);
        $query2=$this->db->get('likes')->result(); 
        if($query2)
        {
            $this->db->set('like_count', 'like_count-1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->update('products');

            
            $this->db->set('likes', '0', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->where('user_id', $this->session->userdata('login_user_id'));
            $this->db->update('likes');
           

            $this->db->where('product_id', $this->input->post('product_id'));
            echo $this->db->get_where('products')->row()->like_count;
             die();
              
         }
       
           
       
    }
    
   function update_follow_info(){
        $this->db->select('user_id,product_id');
        $this->db->where('user_id', $this->session->userdata('login_user_id'));
        $this->db->where('product_id',$this->input->post('product_id'));
        $query =$this->db->get_where('follow')->result();
        if(empty($query)){
            
            $this->db->set('follow_count', 'follow_count+1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->update('products');
            
            $data['product_id'] = $this->input->post('product_id');
            $data['user_id'] = $this->session->userdata('login_user_id');
            $data['follow']=1;
            $this->db->insert('follow',$data);

            $this->db->where('product_id', $this->input->post('product_id'));
            echo $this->db->get_where('products')->row()->follow_count;
            die();
        }

        $this->db->select('user_id,product_id');
        $this->db->where('user_id',$this->session->userdata('login_user_id'));
        $this->db->where('product_id',$this->input->post('product_id'));
        $this->db->where('follow',0);
        $query1=$this->db->get('follow')->result();        
        
        if($query1)
        {
            $this->db->set('follow_count', 'follow_count+1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->update('products');            
            
            $this->db->set('follow', '1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->update('follow');
           
            $this->db->where('product_id', $this->input->post('product_id'));
             echo $this->db->get_where('products')->row()->follow_count;
              die();
             
        }
         $this->db->select('user_id,product_id');
        $this->db->where('user_id',$this->session->userdata('login_user_id'));
        $this->db->where('product_id',$this->input->post('product_id'));
        $this->db->where('follow',1);
        $query2=$this->db->get('follow')->result(); 
        if($query2)
        {
            $this->db->set('follow_count', 'follow_count-1', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->update('products');

            
            $this->db->set('follow', '0', FALSE);
            $this->db->where('product_id', $this->input->post('product_id'));
            $this->db->where('user_id', $this->session->userdata('login_user_id'));
            $this->db->update('follow');
           

            $this->db->where('product_id', $this->input->post('product_id'));
            echo $this->db->get_where('products')->row()->follow_count;
             die();
              
         }

    }

    function update_orderStatus_info(){

         $order_id = $this->input->post('order_id');
        
         $username = $this->input->post('username');
         $mob = $this->input->post('contact');
         $stat = $this->input->post('order_status');

         //$order_data = $this->db->get_where('orders',array('order_id' => $order_id))->result_array();//->contact;                
         $data['order_status']  = $this->input->post('order_status');
        
        
        $this->db->where('order_id',$order_id);
        echo $this->db->update('orders',$data);


        $ord_id = $order_id;
         $order_id="#MT00".$order_id;
      if($stat==1){
          $status='Order Placed.';
          
      }
      elseif($stat==2){
          $status='Under Processing. Your Order will Delivering Soon -MT';
          $msg = "Hello $username , Your Order-ID $order_id status updated to $status .";
      
      }
      elseif($stat==3){
          $status='Delivery Assigned';
          $drivername= ucwords($this->input->post('drivername'));
          $con = $this->input->post('mobile');
          $veh = strtoupper($this->input->post('vehicle_no'));
          $vehicle = $veh." -MT";
          
          $dt['order_id'] = $ord_id;
          $dt['driver_name'] = $drivername;
          $dt['mobile'] = $con;
          $dt['vehicle_no'] = $veh;
          $dt['order_type'] = 1;
          $this->db->insert('delivery_details',$dt);
          
          $msg= "Hello $username , Your Order-ID $order_id is out for delivery, be available at shipping Address. By $drivername Mobile-No $con and Vehicle-No $vehicle .";
      }
      elseif($stat==4){
          $status='Out For Delivery. Your Order will Delivering Soon -MT';
          $msg = "Hello $username , Your Order-ID $order_id status updated to $status .";
      }
      elseif($stat==5){
          $status='Delivered Successfully.';
          //$msg = "Hello $username , Your Partial-Order-ID $order_id is delivered Successfully."; 
          $msg = "Hello $username , Your Order-ID $order_id is delivered Successfully.";
      }elseif($stat==6){
          $status='Cancelled.';
          $msg = "Hello $username , Your Order ID: $order_id is Cancelled. - MT";
      }
        //$this->send_message($mob,$msg);
    }

      function order_product_info($order_id){
        $this->db->where('order_id', $order_id);
        return $this->db->get('order_product')->result_array();
    }
    
    function get_img_path($product_id){
         $this->db->where('product_id', $product_id);
        return $this->db->get('products')->row()->product_img;
    }
    

       
       function save_place_order_info(){
             
                /***order table data*****/
                $data['user_id'] =  $this->session->userdata('login_user_id');
                $data['fname'] 	= ucfirst($this->input->post('fname'));
//                $data['lname']  = ucfirst($this->input->post('lname'));
//                $data['email']  = $this->input->post('email');                
//                $data['contact']  = $this->input->post('contact');
//                $data['date'] = date("d M,Y");
//                $data['shipping_address'] = $this->input->post('shipping_address');
//                $data['city']   = ucfirst($this->input->post('city'));
//                $data['pincode']  = $this->input->post('pincode');
//                $data['subtotal']  = $this->input->post('subtotal');
//                $data['shipping_charges'] = $this->input->post('shipping_charges');
//                $data['final_total'] = $this->input->post('final_total');
            
                $data['order_status'] = 1;
                
                /****mail info****/
//                $email = $this->input->post('email');
//                $name = $data['fname']." ".$data['lname'];
//                $contact = $data['contact'];
//                $address = $data['shipping_address'];
//                $city = $data['city'];
//                $pincode = $data['pincode'];
//                $subtotal = $data['subtotal'];
//                $ship_charges = $data['shipping_charges'];
//                $final_total = $data['final_total'];
//                $payment_mode = $data['payment_mode'];
                
                /****end mail info****/
                
                echo $this->db->insert('orders',$data);
                $order_id= $this->db->insert_id();
                if($order_id){
                     foreach ($_SESSION['products'] as $cart) {
                         $dat['order_id'] = $order_id;
                         $dat['product_id'] = $cart['id'];
                         $dat['prod_name'] = $cart['prod_name'];
                         $dat['prod_price'] = $cart['price'];
                         $dat['qty'] = $cart['qty'];
                         $dat['amount'] = $cart['price'] * $cart['qty'];
                         $dat['prod_price'] = $cart['price'];
                         $dat['order_for'] = $cart['ctype'];
                         $dat['trainer_id'] = $cart['trainer_id'];
                         
                         $this->db->insert('order_product',$dat);
                          /***clone data***/
                         //$opc['order_product_id']= $this->db->insert_id();
                         //$opc['order_id'] = $order_id;
                         //$opc['product_id'] = $cart['id'];
                         //$opc['prod_name'] = $cart['prod_name'];
                         //$opc['prod_price'] = $cart['price'];
                         //$opc['qty'] = $cart['qty'];
                         //$opc['amount'] = $cart['price'] * $cart['qty'];
                         
                         //$this->db->insert('order_product_clone',$opc);
                         /***end clone insertion****/
                         
                        }
//                        $title='AQUADEAL SHOP';
//                        $sub = 'Order Placed Successfully.';
//                        $username="info.asbspl@gmail.com";
//                        $body = $this->get_orderBody($email,$name,$contact,$address,$city,$pincode,$subtotal,$ship_charges,$final_total,$payment_mode);
//                        $this->orderMail($email,$username,$title,$sub,$body);
//                        $order_id="#AQ00".$order_id;
//                        $msg="Hello $name , Your Order is Successfully Placed to $title . Order-ID $order_id .";
//                        $this->send_message($contact,$msg);
                        //$this->send_message($contact,$msg);
                  } 
                  $_SESSION['products'] ='';
                /***End order_product table data*****/               
            }
	 
       function update_Myacc_info()
    {		
        $user_id = $this->session->userdata('login_user_id');
        $data['fname'] 		= ucfirst($this->input->post('fname'));
        $data['lname']          = ucfirst($this->input->post('lname'));
        $data['contact']        = $this->input->post('contact');
        
        $this->db->where('id',$user_id);
       echo $this->db->update('users',$data);
	
    }
    
      function update_MyProfacc_info()
    {		
        $user_id = $this->session->userdata('login_user_id');
        $data['gender']    = $this->input->post('gender');
        $data['city']    = ucfirst($this->input->post('city'));
        $data['shipping_address']    = $this->input->post('address');
        $data['pincode']    = $this->input->post('pincode');
        
        $this->db->where('id',$user_id);
       echo $this->db->update('users',$data);
	
    }
    
     function save_uploadProfilePcs_info($image){
        if($_FILES['userfile']['name']!= "")
        {

            $img_name='userfile';
            $img_path='users';

            $image_name=$this->user_profile($img_name,$img_path);


        }   
        else 
        {
            $image_name=$this->input->post('userfile');
        } 
            if($image_name!=NULL)
            {
            $data['picture']=$image_name;
            }
             // echo "<pre>";print_r($data);die;
                $user_id = $this->session->userdata('login_user_id');
                 
               // $data['picture'] = 'assets/uploads/users/'.$image;
                $this->db->where('id',$user_id);
               $this->db->update('users',$data);
              
    }
    
     public function user_profile($img_name,$img_path)
    {   

           
        $filename2      = $_FILES[$img_name]['name']; 
                
        $filename2      = explode(".", $filename2); 
                $new_filename2  = $img_name."_".date('Ymd').time().".".end($filename2);
        $thumb2 = $new_filename2;
        $_FILES['imag']['name']         = $new_filename2;
        $_FILES['imag']['type']         = $_FILES[$img_name]['type'];
        $_FILES['imag']['tmp_name']    = $_FILES[$img_name]['tmp_name'];
        $_FILES['imag']['error'] = $_FILES [$img_name]['error'];
        $_FILES['imag']['size']  = $_FILES [$img_name]['size'];

        $config = array();
        $config['upload_path'] = './assets/uploads/'.$img_path;
        $config['allowed_types'] = '*';
        $config['max_size']      = '0';             
        $config['overwrite']     = FALSE;

        $this->upload->initialize($config);
    
        if($this->upload->do_upload ('imag')){   
        //echo "hi";die;                 
            $imagedata2 = $this -> upload -> data();
            $newimagename2 = $imagedata2["file_name"];
            $newimagename2 = str_replace (" ", "", $newimagename2);
            $this -> load -> library("image_lib");
            $config['image_library'] = 'gd2';
            $config['source_image'] = $imagedata2["full_path"];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = TRUE;
            $config['new_image'] = './assets/uploads/'.$img_path.'/100X100';
            $config['width']  = 180;
            $config['height'] = 200;
            $this -> image_lib -> initialize($config);
            $this -> image_lib -> resize();
        }    
            
        return $new_filename2;  

    }
    
    public function save_contact_info()
    {
        
        $data['name_contact']= ucfirst($this->input->post('name_contact'));
        $data['lastname_contact']= ucfirst($this->input->post('lastname_contact'));
        $data['email_contact'] = $this->input->post('email_contact');
        $data['phone_contact']= $this->input->post('phone_contact');
        $data['message_contact']=$this->input->post('message_contact');
        
         /****mail info****/
          $email = $data['email_contact'];
          $name = $data['name_contact']." ".$data['lastname_contact'];
          $contact = $data['phone_contact'];
          $message = $data['message_contact'];
           /****end mail info****/
          
       $this->db->insert('contact',$data);
       $insert_id= $this->db->insert_id();
                        $title="MY SHOP";
                        $sub = "New Enquiry from mera trainer.";
                        $body = $this->get_Body($email,$contact,$name,$message);
                        $this->sendMail($email,$title,$sub,$body); 
             
      
        // this->db->insert('contact',$data);
                   
                  //  $this->session->set_userdata('register_user_id', $insert_id);
                    if($insert_id){
                        echo 1;
                    }
    }

    
        function get_Body($email,$contact,$name,$message){
               $act=md5($email);
                $key=strrev(sha1($act))."esd15876wq12WEAS1asO4";
        $config=strrev($key);
               
                return $body="<body>
            <div class='row'>
                    <div class='col-sm-4'></div>
                            <div class='col-sm-4 center' style='border: 2px solid #ccc;padding-bottom:10px;background-color: #fff;'>
                                    <div id='nediv' style='float: left;
                                        align-content: center;
                                        width: 100%;
                                        margin-left: 25%;
                                        font-family: tahoma,sans-serif;
                                        margin-top: 1%;'>
                                        <h2>New Enquiry.</h2></div>
                                            <hr style='width:80%;
                                                border: 0;
                                                height: 1px;
                                                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

                                        <div id='mbody' style='width: 80%;
                                        margin-left: 20%;
                                        text-align: justify;
                                        font-family: tahoma,sans-serif;
                                            line-height: 20px;
                                            margin-bottom:3%;'>
                                           
                                         <center style='text-align: left;margin-left: 5%;'>
                                            <b>Hello,</b><br>
                                               Greetings from <a href='".base_url()."'>Mera trainer</a> <br/>
                                                You have received an enquiry, sent from $email with the following details:

                                               Your account details are:<br/>
                                           Name :<b> $name</b><br/>
                                                Mobile No: <b> $contact </b> <br/>
                                                Email is : <b> $email <br/>
                                                Message :<b> $message</b><br/>
                                           </center>
                                          </div>
                                          <hr style='width:80%;
                                                border: 0;
                                                height: 1px;
                                                margin-bottom:3%;
                                                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

                                        <div  id='aclink' style='font-family: tahoma,sans-serif;
                                            line-height: 20px;
                                            font-size:14px;
                                            margin-bottom:3%;
                                            margin-left: 20%;'>
                                            
                                                           </div>
                                         <hr style='width:80%;
                                                border: 0;
                                                height: 1px;
                                                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

                                         <div style='font-family: tahoma,sans-serif;
                                            line-height: 22px;
                                                margin-left: 40%;'>

                                          <h5>MERA TRAINER</h5>


                                        </div>

                            </div>
                    <div class='col-sm-4'></div>
            </div>
                </body>";
           }
    
     function sendMail($email="",$title=" ",$sub="Account Registered Successfully.",$body="") {
    
        
         $config = array();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';

        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");

        $this->email->from($email, $title);
        $this->email->to(' info@meratrainer.com');
        $this->email->subject($sub);
        $this->email->message($body);

        $this->email->send();
        
        
        /*$config = array();
        //$config['useragent'] = 'PHPMailer';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = "info.asbspl@gmail.com";
        $config['smtp_pass'] = "asbsplshop@123";
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->load->library('email');

        $this->email->initialize($config);
        $this->email->from('aquadealindia@gmail.com', $title);
        $this->email->to($email);
        $this->email->subject($sub);
        $this->email->message($body);

        $this->email->send();*/ 
    
    }
  
	
}
