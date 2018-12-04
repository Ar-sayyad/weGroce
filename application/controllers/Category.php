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

	public function index($code='')
	{
            $this->db->limit(12);
             $data['code'] = $code;
            $data['product'] = $this->admin_model->record_list('products');
            $data['category_info']= $this->admin_model->record_list('category');
            $data['price_range']= $this->admin_model->record_list('price_range');
            $data['page_title'] = 'Category';
            $data['data_title'] = '';
            $this->load->view('home/category',$data);
	}

    public function category(){        
            $this->db->limit(12);
             $data['code'] = '';
            $data['product'] = $this->admin_model->record_list('products');
            $data['category_info']= $this->admin_model->record_list('category');
            $data['price_range']= $this->admin_model->record_list('price_range');
            $data['page_title'] = 'Category List';
            $data['data_title'] = '';
            $this->load->view('home/category-list',$data);
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
        $pids = array();
        $ids = $this->input->post('categoryId');         
        $pids = $this->input->post('priceId'); 
        if(!empty($ids) && !empty($pids)){
          $this->db->where_in('category_id',$ids);
         $this->db->where_in('price_range_id',$pids);
      
           $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('home/productLoad',$data);
        }
        else if(empty($ids) && !empty($pids)){
            foreach($pids as $key =>$value){
             $this->db->or_where('price_range_id',$value);
         }
           $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('home/productLoad',$data);
        }
        else if(!empty($ids) && empty($pids)){
         foreach($ids as $key =>$value){
             $this->db->or_where('category_id',$value);
         }
           $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('home/productLoad',$data);
        }
        else{
            $this->db->limit(12);
            $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('home/productLoad',$data);
        }
       //echo $this->db->last_query();
       
    }
     public function filterPriceProduct(){
        $ids = array();
        $ids = $this->input->post('priceId'); 
        if($ids){
        $id='';
         foreach($ids as $key =>$value){
             $this->db->or_where('price_range_id',$value);
         }
           $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('home/productLoad',$data);
        }else{
            $this->db->limit(12);
            $data['single_cat_prod_info'] = $this->db->get_where('products')->result();
           $this->load->view('home/productLoad',$data);
        }
       
    }
        
}
