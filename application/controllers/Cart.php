<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();

class Cart extends CI_Controller {

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
            $data['page_title'] = 'Cart';
            $data['data_title'] = '';
            $this->load->view('home/cart',$data);
    	}

        public function filldetail(){
            
             $data['page_title'] = 'Fill details';
            $data['data_title'] = '';
            $this->load->view('home/filldetail',$data);
        }

 public function filldetail1(){
            
             $data['page_title'] = 'Fill details';
            $data['data_title'] = '';
            $this->load->view('shop/filldetail',$data);
        }

        public function submit(){
                
                $this->load->view('home/submit');
            }

        public function success(){
                
                $this->load->view('home/success');
            }


        public function demoCart(){
             $this->load->view('home/demoCart');
        }

        public function cartUpdate(){

            $this->load->view('home/cart_update');
        }

        public function cartTable(){
       
        $this->load->view('home/cartTable');
      
        }
        public function cartTotal(){
       
        $this->load->view('home/cartTotal');
      
        }

         public function trackorder()
        {
              $data['activeorder_info'] = $this->tadmin_model->select_login_user_active_order_info();
              $data['completed_info'] = $this->tadmin_model->select_login_user_completed_order_info();
              $data['cancelled_info'] = $this->tadmin_model->select_login_user_cancelled_order_info();
              $data['page_title'] = 'Trackorder';
              $data['data_title'] = '';
              $this->load->view('home/trackorder',$data);
        }

         function changeOrderStatus(){
         
            echo $this->tadmin_model->update_orderStatus_info();
             $this->session->set_flashdata('errors', ('Order Status Updated.!'));
        }

        function vendor_order_product_info($order_id){
            
            $this->db->where('order_id', $order_id);
            return $this->db->get('order_product')->result_array();
        }

        function get_img_path($product_id){

            $this->db->where('product_id', $product_id);
            return $this->db->get('tbl_products')->row()->product_image;
        }
        
          
        function placeOrder(){
            if ($this->session->userdata('user_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
            }
                $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
//                $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
//                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
//                $this->form_validation->set_rules('contact', 'Mobile Number ', 'required|numeric|regex_match[/^[0-9]{10}$/]'); 
//                $this->form_validation->set_rules('city', 'City', 'required|alpha');
//                $this->form_validation->set_rules('shipping_address', 'Shipping Address', 'required');
//                $this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric|regex_match[/^[0-9]{6}$/]');
//              
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                    }
                    else
                     {
                            echo $this->tadmin_model->save_place_order_info();;
                    }    
            
            
        }
       

       
        
}
