<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {


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
	$this->db->limit(10);
        $data['category_info']= $this->db->get('category')->result_array();        
        $this->load->view('shop/courses',$data);
	}

    public function courselist(){
        
        $this->load->view('shop/courselist');
    }

    public function coursedetail(){
        
        $this->load->view('shop/coursedetail');
    }
    public function products($code='',$name='')
    {
       $name = str_replace('-', ' ', $name);
       $data['code'] = $code;
      $data['single_cat_prod_info'] = $this->admin_model->select_single_product_info($code);
       $this->load->view('shop/products',$data); 
    }
    public function filterCategoryProduct(){
        $ids = array();
        $ids = $this->input->post('categoryId'); 
        if($ids){
        $id='';
         foreach($ids as $key =>$value){
             $this->db->or_where('category_id',$value);
         }
           $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('shop/productLoad',$data);
        }else{
            $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('shop/productLoad',$data);
        }
       
    }
        
}
