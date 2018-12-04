<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function record_insert($tbl_name,$data_array)
	{
		$insert_id=$this->db->insert($tbl_name,$data_array);
		//echo $insert_id;die;
		if($insert_id)
		{
			return $insert_id;
		}
		return false;
	}
        
	public function record_count($tbl_name,$where1=null)
	{		
		if($where1!=null)
		{
			$this->db->where($where1);
		}
		
		$count=$this->db->get($tbl_name)->num_rows();
		
		if($count)
		{
			return $count;
		} 
		return false;	
		
	}

    public function getseriesName($series_id){
          return  $series_name = $this->db->get_where('series', array('series_id' => $series_id))->row()->series_title;        
        //$this->get_test_application($application_id);
        }
    public function trainer_neworder_cnt(){   
        $vendorid = $this->session->userdata('log_trainer_id');
        $this->db->select('orders.*,order_product.trainer_id');
        $this->db->join('order_product','order_product.order_id = orders.order_id');
        $this->db->group_by('order_id'); 
        $this->db->where('order_status<',5);
        $this->db->where('order_product.trainer_id',$vendorid);
    
         return $this->db->get('orders')->num_rows();
    
    }
     public function trainer_product_cnt(){  
        $vendorid = $this->session->userdata('log_trainer_id');
         $this->db->where('trainer_id',$vendorid);
         return $this->db->get('products')->num_rows();
     }


        public function getCategoryName($category_id){
          return  $category_name = $this->db->get_where('category', array('category_id' => $category_id))->row()->category_name;        
        //$this->get_test_application($application_id);
        }
        
//         public function getTypeName($category_id){
//          return  $category_name = $this->db->get_where('category', array('category_id' => $category_id))->row()->category_name;        
//        //$this->get_test_application($application_id);
//        }
        
        public function getPriceRangeName($price_range_id){
             $price_range = $this->db->get_where('price_range', array('price_range_id' => $price_range_id))->result_array();
            foreach ($price_range as $row){
                return $row['price_range'];
            }
        }
        
	public function getOtp($fuel_mgt_id){
        	echo $otp = $this->db->get_where('otp',array('fuel_mgt_id' => $fuel_mgt_id))->row()->OTP;
        }
        
         public function getMsg($fuel_mgt_id){
        	echo $msg = $this->db->get_where('otp',array('fuel_mgt_id' => $fuel_mgt_id))->row()->msg;
        }
        
        public function getVendorname($vendor_id){
        	echo $vendor_name = $this->db->get_where('tbl_vendor',array('vendor_id' => $vendor_id))->row()->vendor_name;
        }
         public function getSiteName($site_id){
        	return $site_name = $this->db->get_where('sites',array('site_id' => $site_id))->row()->site_name;
        }
    public function get_today_cnt($id)
    {
         $date = date('m/d/Y');
        $this->db->select('fuel_receipt.*, sum(fuel_receipt.filled_cost) as costs,fuel_mgt.fuel_mgt_id');
        // $this->db->select_sum('fuel_mgt.cost');  
        $this->db->join('fuel_mgt',"fuel_mgt.fuel_mgt_id=fuel_receipt.fuel_mgt_id");
        $this->db->where('fuel_receipt.vendor_id',$id);
     $this->db->where('fuel_receipt.date ',date('d/m/Y',strtotime($date)));
           // $this->db->where('fuel_receipt.date <',date('Y/m/d',strtotime($date)));
       /* $this->db->get('fuel_receipt')->row()->costs;
          echo $this->db->last_query();die;*/

                 $cost = $this->db->get('fuel_receipt')->row()->costs;
     		return round($cost);

    }
	public function record_list($tbl_name,$where1=null)
	{
		if($where1!=null)
		{
			$this->db->where($where1);
		}
		
		return $details=$this->db->get($tbl_name)->result();

		
		//return false;			
	}
	public function records_update($tbl_name,$data,$where1)
	{
		$this->db->where($where1);
		$details=$this->db->update($tbl_name,$data);
		//echo "<pre>";print_r($details);die;
		if($details)
		{
			return $details;
		} 
		return false;			
	}
        
        public function delete_record($tbl_name,$where){
                    $this->db->where($where);
		$details= $this->db->delete($tbl_name);
		//echo "<pre>";print_r($details);die;
		if($details)
		{
			return $details;
		} 
		return false;
        }

	public function Sendmail($email,$password)
    {

    
        $supervisor = $this->db->get_where('tbl_supervisor', array('supervisor_email' => $email));
       $vendor = $this->db->get_where('tbl_vendor', array('vendor_email' => $email));
       $subadmin = $this->db->get_where('tbl_subadmin', array('subadmin_email' => $email));
        $username="nikhil@tirupatitravels.com";
        $pass="asbsplshop@123";
        $name="Tirupati Travels";
        $sub="Welcome to Tirupati Travels";
        $host_name="ssl://smtp.googlemail.com"; 
        $port="465";
        $protocol="smtp";
        
        if($supervisor->num_rows() > 0) {
                        $row = $supervisor->row();                      
                        $forgot_user_id = $row->supervisor_id;
                        $forgot_email_id = $row->supervisor_email;
                        $forgot_name = $row->supervisor_name;
                        $forgot_password = $password;
                        $forgot_type = 'Supervisor';
                        $body=$this->getBody($forgot_email_id,$forgot_user_id,$forgot_name,$forgot_password,$forgot_type);
                        $this->activate_mail($forgot_email_id,$username,$pass,$name,$sub,$body,$host_name,$port,$protocol);
                             
                        return 1;
                        
        }
        elseif($vendor->num_rows() > 0) {
                        $row = $vendor->row();                      
                        $forgot_user_id = $row->vendor_id;
                        $forgot_email_id = $row->vendor_email;
                        $forgot_name = $row->vendor_name;
                        $forgot_password = $password;
                        $forgot_type = 'Vendor';
                        $body=$this->getBody($forgot_email_id,$forgot_user_id,$forgot_name,$forgot_password,$forgot_type);
                        $this->activate_mail($forgot_email_id,$username,$pass,$name,$sub,$body,$host_name,$port,$protocol);
                             
                        return 1;
                        
        }
        elseif($subadmin->num_rows() > 0) {
                        $row = $subadmin->row();                      
                        $forgot_user_id = $row->subadmin_id;
                        $forgot_email_id = $row->subadmin_email;
                        $forgot_name = $row->subadmin_name;
                        $forgot_password = $password;
                        $forgot_type = 'Subadmin';
                        $body=$this->getBody($forgot_email_id,$forgot_user_id,$forgot_name,$forgot_password,$forgot_type);
                        $this->activate_mail($forgot_email_id,$username,$pass,$name,$sub,$body,$host_name,$port,$protocol);
                             
                        return 1;
                        
        }

        else{
            return 0;
        }
        
    
        //return $this->db->get_where('company', array('email' => $email))->result_array();
    }

    function getBody($email,$forgot_user_id,$name,$password,$type){
        
        $act=md5($email);
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
                                        <h2>Welcome to Tirupati Travels</h2></div>
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
                                          You are Successfully Registered to Tirupati Travels .<br/>
                                          Use Below Credentials to Login.<br/>
                                            Your Email is : $email <br/>
                                            Your Password  is : $password <br/>
                                              </center>
                                          </div>
                                          <hr style='width:70%;
                                                border: 0;
                                                height: 1px;
                                                margin-bottom:3%;
                                                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

                                       
                                        

                                         <div style='font-family: cursive;
                                            line-height: 22px;
                                                margin-left: 30%;'>

                                          <h5>Team Tirupati Travels</h5>


                                        </div>

                            </div>
                    <div class='col-sm-4'></div>
            </div>
    </body>";
    }


     
    function activate_mail($email,$username,$pass,$name,$sub,$body,$host_name="ssl://smtp.googlemail.com",$port="465",$protocol="smtp") {

         $config = array();
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
                $this->email->send();
    
        // $config = array();
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        // $config['smtp_port'] = '465';
        // //$config['smtp_user'] = "teamautoit@gmail.com";
        // //$config['smtp_pass'] = "P@ssword1!";
        // $config['smtp_user'] = $username;
        // $config['smtp_pass'] = $pass;
        // $config['mailtype'] = 'html';
        // $config['charset'] = 'utf-8';
        // $config['newline'] = "\r\n";
        // $config['wordwrap'] = TRUE;

        // $this->load->library('email');

        // $this->email->initialize($config);
        // $this->email->from($username, $name);
        // $this->email->to($email);
        // $this->email->subject($sub);
        // $this->email->message($body);

        // $this->email->send();    
    
    }


	public function send_message($mob,$msg)
	{
	 $web_url = "http://api.smsbrain.in/1.2/appsms/send.php";
                $url = $web_url.http_build_query(array('username'=> "meratrainer.otp",'password' => "MeraTrainer123",
                    'mob' => '9922031316','msg' => 'hiii','sender' => "MeraTr"));
             //   echo  $url;
             // echo $shortUrl=file_get_contents($url);
	 	$ch = curl_init();					
		if($ch)
		{
            
        curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'GET');
$result = curl_exec($ch);
curl_close($ch);





			
			return true;
		}
		else
		{
			return true;
		}
	}


	public function records_delete($tbl_name,$where1)
	{
		$this->db->where($where1);
		$details=$this->db->delete($tbl_name);
			
		if($details)
		{
			return $details;
		} 
		return false;			
	}

	public function upload_image($img_name,$img_path)
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
        //$config['max_size']      = '0';             
        $config['overwrite']     = FALSE;

        $this->upload->initialize($config);
       
        if($this->upload->do_upload ('imag')){ 
                   
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
        
        /*if($old_img!="")
        {
            $filename='assets/uploads/'.$img_path.'/'.$old_img;
            
            if (file_exists($filename)) 
            {
            unlink('assets/uploads/'.$img_path.'/'.$old_img);
            unlink('assets/uploads/'.$img_path.'/100X100/'.$old_img); 
        }
        }*/
        //echo $new_filename2;die;        
        return $new_filename2;	

	}
        

      public function upload_media($img_name,$img_path)
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
        //$config['max_size']      = '0';             
        $config['overwrite']     = FALSE;

        $this->upload->initialize($config);
       
        if($this->upload->do_upload ('imag')){ 
            
           
                         
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
        
        /*if($old_img!="")
        {
            $filename='assets/uploads/'.$img_path.'/'.$old_img;
            
            if (file_exists($filename)) 
            {
            unlink('assets/uploads/'.$img_path.'/'.$old_img);
            unlink('assets/uploads/'.$img_path.'/100X100/'.$old_img); 
        }
        }*/
        //echo $new_filename2;die;        
        return $new_filename2;  

    }  

    public function upload_series($img_name,$img_path)
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
        //$config['max_size']      = '0';             
        $config['overwrite']     = FALSE;
        
        $this->upload->initialize($config);
       
        if($this->upload->do_upload ('imag')){ 

            
           
                         
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
        
        /*if($old_img!="")
        {
            $filename='assets/uploads/'.$img_path.'/'.$old_img;
            
            if (file_exists($filename)) 
            {
            unlink('assets/uploads/'.$img_path.'/'.$old_img);
            unlink('assets/uploads/'.$img_path.'/100X100/'.$old_img); 
        }
        }*/
        //echo $new_filename2;die;        
        return $new_filename2;  

    }

    public function upload_tutorial($img_name,$img_path)
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
        //$config['max_size']      = '0';             
        $config['overwrite']     = FALSE;
        
        $this->upload->initialize($config);
       
        if($this->upload->do_upload ('imag')){ 

            
           
                         
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
        
        /*if($old_img!="")
        {
            $filename='assets/uploads/'.$img_path.'/'.$old_img;
            
            if (file_exists($filename)) 
            {
            unlink('assets/uploads/'.$img_path.'/'.$old_img);
            unlink('assets/uploads/'.$img_path.'/100X100/'.$old_img); 
        }
        }*/
        //echo $new_filename2;die;        
        return $new_filename2;  

    }
        public function upload_audio($img_name,$img_path)
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
        //$config['max_size']      = '0';             
        $config['overwrite']     = FALSE;

        $this->upload->initialize($config);
      
        if($this->upload->do_upload ('imag')){ 
                         
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
        
        /*if($old_img!="")
		{
			$filename='assets/uploads/'.$img_path.'/'.$old_img;
			
			if (file_exists($filename)) 
			{
		 	unlink('assets/uploads/'.$img_path.'/'.$old_img);
			unlink('assets/uploads/'.$img_path.'/100X100/'.$old_img); 
		}
		}*/
        //echo $new_filename2;die;        
		return $new_filename2;	

	}

     function get_cateby_info($category_id){
        return $category_id = $this->db->get_where('category',array('category_id' => $category_id))->row()->category_id;
    }

    function select_single_product_info($code)///added
    {
       $id = $this->db->get_where('category',array('cat_code' => $code))->row()->category_id;
       return $this->db->get_where('products',array('category_id' => $id))->result();
      // echo $this->db->last_query();die;
       //return $this->select_product_info($product_category_id);
    }

    function select_trainers_info()///added
    {
      
       $this->db->select('trainer.*,category.category_name');
       $this->db->join('category','category.category_id = trainer.category_id');
      $trainer_info= $this->db->get('trainer')->result_array();
       return $trainer_info;
     
    } 

function select_singletrainer_info($trainer_id)///added
    {
      
       $this->db->select('trainer.*,category.category_name');
       $this->db->join('category','category.category_id = trainer.category_id');
       $this->db->where('trainer_id',$trainer_id);
      $single_trainer_info= $this->db->get('trainer')->result_array();
       return $single_trainer_info;
     
    }

    function select_cources_info($trainer_id)///added
    {
      
       $this->db->select('course.*,category.category_name');
       $this->db->join('category','category.category_id = course.category_id');
       $this->db->where('trainer_id',$trainer_id);
      $cources_info= $this->db->get('course')->result_array();
       return $cources_info;
     
    }
    
    function get_order_item_count($order_id){
        $this->db->from('order_product');
        $this->db->where('order_id', $order_id);
        return $this->db->count_all_results();
    }
    
     function select_cart_order_info()
      {
        //$this->db->select('orders.*,order_product.order_status');
//        $this->db->join('order_product','order_product.order_id = orders.order_id');
        $this->db->group_by('order_id'); 
        $this->db->where('order_status<',5);
        $this->db->order_by('order_id','desc');
        return $this->db->get('orders')->result_array();
      
      }
      
       function select_trainer_cart_order_info()
      {
       $vendorid = $this->session->userdata('log_trainer_id');
       $this->db->select('orders.*,order_product.trainer_id');
       $this->db->join('order_product','order_product.order_id = orders.order_id');
        $this->db->group_by('order_id'); 
        $this->db->where('order_status<',5);
         $this->db->where('order_product.trainer_id',$vendorid);
        $this->db->order_by('order_id','desc');
        return $this->db->get('orders')->result_array();
      
      }
      
      function select_completed_order_info()
     {
        $this->db->group_by('order_id');
        $this->db->where('partially_del_status',0);
    
        $this->db->where('order_status',5);
        $this->db->order_by('order_id','desc');
        return $this->db->get('orders')->result_array();
     }
     
     function select_trainer_completed_order_info()
     {
        $vendorid = $this->session->userdata('log_trainer_id');
       $this->db->select('orders.*,order_product.trainer_id');
       $this->db->join('order_product','order_product.order_id = orders.order_id');
       
        $this->db->group_by('order_id');
        $this->db->where('partially_del_status',0);
    $this->db->where('order_product.trainer_id',$vendorid);
        $this->db->where('order_status',5);
        $this->db->order_by('order_id','desc');
        return $this->db->get('orders')->result_array();
     }
     function select_cancel_order_info()
     {
        $this->db->group_by('order_id');
        $this->db->where('partially_del_status',0);
     
        $this->db->where('order_status',6);
        $this->db->order_by('order_id','desc');
        return $this->db->get('orders')->result_array();
     }
     
     function select_trainer_cancel_order_info()
     {
       $vendorid = $this->session->userdata('log_trainer_id');
       $this->db->select('orders.*,order_product.trainer_id');
       $this->db->join('order_product','order_product.order_id = orders.order_id');
         
        $this->db->group_by('order_id');
        $this->db->where('partially_del_status',0);
     $this->db->where('order_product.trainer_id',$vendorid);
        $this->db->where('order_status',6);
        $this->db->order_by('order_id','desc');
        return $this->db->get('orders')->result_array();
     }
             
    function  get_order_item_total($order_id)
    {
         $this->db->where('order_id', $order_id);        
         $data = $this->db->get('order_product')->result_array();
        $amount=0;
        foreach($data as $row){
            $amount=$amount+$row['amount'];
        }
        return $amount;
          
    }
    
    function OrderStatus($order_id){

        $this->db->where('order_id',$order_id);
//       $this->db->where('vendor_id',0);
       $name=$this->db->get('orders')->row();
       
       return $name;         
               
    }
    
     function update_orderStatus_info(){

         $order_id = $this->input->post('order_id');

         
         $mob = $this->input->post('contact');
         $stat = $this->input->post('order_status');

         //$order_data = $this->db->get_where('orders',array('order_id' => $order_id))->result_array();//->contact;                
         $data['order_status']  = $this->input->post('order_status');
          
        $this->db->where('order_id',$order_id);
        $this->db->update('orders',$data);


        $ord_id = $order_id;
         $order_id="#MT00".$order_id;
      if($stat==1){
          $status='Order Placed.';
          
      }
      elseif($stat==2){
          $status='Under Processing. Your Order will Delivering Soon -MT';
          $msg = "Hello , Your Order-ID $order_id status updated to $status .";
      }elseif($stat==3){
          $status='Delivery Assigned. Your Order will Delivering Soon -MT';
          $msg = "Hello , Your Order-ID $order_id status updated to $status .";
      }
      elseif($stat==4){
          $status='Out for Delivery';
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
          
          $msg= "Hello, Your Order-ID $order_id is out for delivery, be available at shipping Address. By $drivername Mobile-No $con and Vehicle-No $vehicle .";
      }
      elseif($stat==5){
          $status='Delivered Successfully.';
          //$msg = "Hello $username , Your Partial-Order-ID $order_id is delivered Successfully."; 
          $msg = "Hello, Your Order-ID $order_id is delivered Successfully.";
      }elseif($stat==6){
          $status='Cancelled.';
          $msg = "Hello, Your Order ID: $order_id is Cancelled. - MT";
      }
       $this->send_message($mob,$msg);
    }

    function send_mail($email,$name,$address,$city,$pincode,$subtotal,$ship_charges,$final_total)
    {
                        $title='MERA TRAINER';
                        $sub = 'Order Placed Successfully.';
                        $username="info@meratrainer.com";
                        $body = $this->get_orderBody($email,$name,$address,$city,$pincode,$subtotal,$ship_charges,$final_total);
                        $this->orderMail($email,$username,$title,$sub,$body);
    }
    function get_orderBody($email,$name,$address,$city,$pincode,$subtotal,$ship_charges,$final_total)
    {
               $act=md5($email);
                $key=strrev(sha1($act))."esd15876wq12WEAS1asO4";
        $config=strrev($key);
               
                 $body1="<body>                     
                     <link rel='stylesheet' href='".base_url()."assets/bootstrap.min.css'>
            <div class='row'>
                    <div class='col-sm-4'></div>
                            <div class='col-sm-4 center' style='border: 2px solid #c5c5c5;padding-bottom:10px;background-color: #ffffff;'>
                                    <div id='nediv' style='
                                        align-content: center;
                                        width: 100%;
                                        margin-left: 20%;

                                        font-family: Tahoma,sans-serif;
                                        margin-top: 1%;'>
                                        <h2>Order Placed Successfully.</h2></div>
                                            <hr style='width:100%;
                                                border: 0;
                                                height: 1px;
                                                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

                                        <div id='mbody' style='width: 90%;
                                        margin-left: 10%;
                                        text-align: justify;
                                        font-family: tahoma;
                                            line-height: 20px;
                                            margin-bottom:3%;'>
                                           
                                         <center style='text-align: left;margin-left: 15%;'>
                                                                                 <b>Hello, $name,</b><br>
                                                                                    Congratulation from <a href='".base_url()."'>MERA TRAINER</a> <br/>
                                                                                    Your order will be delivered Soon.<br/>
                                                                                    Thank You for shopping with MERA TRAINER.<br/><br/>

                                                                                    Your account details are:<br/>
                                                                                    Your Mobile: <b> $contact </b> <br/>
                                                                                    Your Email is : $email <br/><br/>
                                                                                        
                                                                                    <b>Delivery Details:</b><br>
                                                                                    $name<br>
                                                                                    $address<br>
                                                                                    $city - $pincode.<br/><br/>
                                                                                    </center>
                                                                                    <b>Order Details:</b><br>
                                                                                    <table class='table-bordered order-table table' style='width:80%'>
                              <thead>
                              <tr><td colspan='5'><hr></td></tr>
                                <tr>
                                  <td style='text-align: center'> <b>Product</b> </td>
                                  <td style='text-align: center'> <b>Name</b> </td>
                                  <td style='text-align: center'> <b>Price</b> </td>
                                  <td style='text-align: center'> <b>Quantity</b> </td>
                                  <td style='text-align: center'> <b>Subtotal</b> </td>
                                </tr>
                                <tr><td colspan='5'><hr></td></tr>
                              </thead>
                              <tbody>"; 
                                $body2='';
                                    foreach ($_SESSION['products'] as $cart) {
                                        $amt = $cart['amount'] * $cart['qty'];                                       
                                       
                               $body2.="<tr>
                                    <td style='text-align: center'><img style='width:40px;height:40px;' src='".base_url()."uploads/product/".$cart['image']."' alt='".$cart['prod_name']."'></td>
                                 <td style='font-size:12px;text-align: center'>".$cart['prod_name']."</td>
                                 <td style='text-align: center'>Rs.".$cart['amount']."</td>
                                  <td style='text-align: center'>".$cart['qty']."</td>
                                  <td style='text-align: center'> Rs.".$amt."</td>
                                </tr>";
                                  }
                                
                                $body3="<tr><td colspan='5'><hr></td></tr>
                                    <tr>
                                  <td colspan='4' style='text-align:right;font-family:tahoma'>
                                   <p> Subtotal :  </p>
                                   <p> Shipping Charges :  </p>
                                    <p><b> Final Total : </b> </p></td>
                                  <td><p> Rs.$subtotal</p>
                                    <p class='total-text highlighted-text'> Rs.$ship_charges </p>
                                    <p class='total-text grand-total highlighted-text'><b> Rs.$final_total</b></p></td>
                                </tr>
                              
                              </tbody>
                            </table>
                                                                                </center>
                                          </div>
                                          <hr style='width:100%;
                                                border: 0;
                                                height: 1px;
                                                background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>

                                        <div  id='aclink' style='font-family: tahoma;
                                            line-height: 20px;
                                            font-size:14px;'>
                                              <center>Your Order is Successfully Placed...!!!<br/>
                                                                                          <h5>MERA TRAINER</h5></center>
                                                                                        
                                                                                    </div>
                                        


                                        </div>

                            </div>
                    
            </div>
                </body>";
            return $body1.$body2.$body3;                   
           }
           function orderMail($email,$username,$title,$sub,$body) {
     
                /*$config = array();
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';

                $this->load->library('email');
                $this->email->initialize($config);

                $this->email->set_newline("\r\n");

                 $this->email->from($username, $title);
                $this->email->to($email);
                $this->email->subject($sub);
                $this->email->message($body);
                $this->email->send();*/
                
                    $config = array();
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
                    $config['smtp_port'] = '465';
                    //$config['smtp_user'] = "teamautoit@gmail.com";
                    //$config['smtp_pass'] = "P@ssword1!";
                    $config['smtp_user'] = $username;
                    $config['smtp_pass'] = 'asbsplshop@123';
                    $config['mailtype'] = 'html';
                    $config['charset'] = 'utf-8';
                    $config['newline'] = "\r\n";
                    $config['wordwrap'] = TRUE;
                    //$sender = "contact@asbspl.com";
                    $this->load->library('email');

                    $this->email->initialize($config);
                    $this->email->from($username, $title);
                    $this->email->to($email);
                    $this->email->subject($sub);
                    $this->email->message($body);

                    $this->email->send();
            }


    
    
       function vendor_order_product_info($order_id){
   
       $this->db->where('order_id', $order_id);
       return  $this->db->get('order_product')->result_array();
        // echo $this->db->last_query();die;
    }
    
    function get_img_path($product_id){
         $this->db->where('product_id', $product_id);
        return $this->db->get('products')->row()->product_img;
    }
    
    function select_single_product_detail($name){
         
        return  $this->db->get_where('products',array('product_url' => $name))->result_array();
         
     }
     
     function related_detail($trainer_id,$product_id)
     {   
          $this->db->where('product_id =',$product_id);
        return  $this->db->get_where('products',array('trainer_id' => $trainer_id))->result_array();
         
     }
     
      function get_related_product_info($category_id,$product_id)
    {
        $this->db->limit(5);
        $this->db->where('product_id !=',$product_id);
        return $this->db->get_where('products',array('category_id' => $category_id))->result_array();
    }
     
    function get_cat_name($cat_id){///added
        return $cat_name= $this->db->get_where('category',array('category_id' => $cat_id))->row()->category_name;
        //return $name = str_replace(' ', '-', $category_name);
    }
  
    
     function get_multiple_img($product_id)
    {
                    //$this->db->limit(3);
        return  $this->db->get_where('product_images',array('product_id' => $product_id))->result_array();
        // echo $this->db->last_query();die;
    }

      function select_product_info($category_id)///added
    {
        $this->db->limit(5);
        return $this->db->get_where('products',array('category_id' => $category_id))->result_array();
    } 
     function get_cat_names(){
        return $this->db->get('category')->result_array();    
        //return $name = str_replace(' ', '-', $category_name);
    }
    
     function select_cat_product_info($category_id)
    {
    	 // $this->db->where('tbl_category.is_active',1); 
         $this->db->limit(3);
    	 return $this->db->get_where('products',array('category_id' => $category_id))->result_array();
          //echo $this->db->last_query();die;
    }
	
     function get_likes_count($product_id){
         $this->db->where('product_id', $product_id);
        return $this->db->get('products')->row()->like_count;
    }

    function get_trainer_count()
    {
       
    }
    
    function loadImageGallery($count,$id){
        $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $image_info = file_get_contents('http://api.staging.meratrainer.com/api/web/users/imageGallery/get/'.$id, false, $context);
            $image = json_decode($image_info,true);            
             $image_info = $image; 
              
                        if($image_info['data']){                                          
                         foreach (array_slice($image_info['data'],$count,10) as $immg) {
                             if($immg){
                               
                           $img = explode('/', $immg['imageUrl']);
                             $mediaimg = end($img);?>
                            <div class="col-md-2 vido">
                                    <figure>
                                        <img  style="width: 120px !important;height: 80px !important;" src="http://api.staging.meratrainer.com/attachments/w400/<?php echo $mediaimg;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/noimg.jpg';"  alt="No Gallery">
                                            <figcaption>
                                                    <div class="caption-content">
                                                            <a href="http://api.staging.meratrainer.com/attachments/w400/<?php echo $mediaimg;?>" title="<?php echo $immg['caption'];?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/noimg.jpg';" data-effect="mfp-zoom-in">
                                                                    <i class="pe-7s-albums"></i>
<!--                                                                                                                                                    <p><?php echo $immg['caption'];?></p>-->
                                                            </a>
                                                    </div>
                                            </figcaption>
                                    </figure>
                            </div>
                         <?php }
                         
                             }
                        }  
    }

	
}
?>