<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {


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

	public function products($code='',$name='')
	{
            $name = str_replace('-', ' ', $name);
             $data['code'] = $code;            
             $category_id = $this->db->get_where('products',array('product_code'=>$code))->row()->category_id;  
             $p_name = $this->db->get_where('products',array('product_code'=>$code))->row()->product_title;
             $c_name = $this->admin_model->getCategoryName($category_id);
             $data['p_name'] = $p_name;
             $data['c_name'] = $c_name;
             $where =array('product_code'=>$code);
             $data['single_prod_info'] = $this->admin_model->record_list('products',$where);             
             $this->db->limit(5);
             $where1 =array('category_id'=>$category_id);
             $data['prod_info'] = $this->admin_model->record_list('products',$where1); 
             $data['category_info']= $this->admin_model->record_list('category');
             $data['price_range']= $this->admin_model->record_list('price_range');
             $data['page_title'] = '<a href="'.base_url().'Category/category"><b>'.$c_name.'</b></a>';
             $data['data_title'] = ' <i class="fa fa-angle-right"></i> '.ucwords($p_name);
             $this->load->view('home/product_detail',$data); 
	}
        
        public function likes()
        {
            echo $this->tadmin_model->update_likes_info();
             $this->session->set_flashdata('errors', ('Order Status Updated.!'));
        }

        
        // public function likes()
        // {
        //     $product_id = $this->input->post('product_id');
        //     $user_id = $this->session->userdata('user_id');
        //     $data = array(
        //            "product_id" => $product_id,
        //            "user_id" => $user_id
        //         );                                                                    
        //     $data_string = json_encode($data);
           

        
        //    $ans= json_decode($data_string,true);            
        //    if($ans['likes']=='Product liked successfully'){
        //    echo 1;
        //    }elseif($ans['likes']=='Product disliked successfully'){
        //        echo 2;
        //    }else{ echo 3; }
        // }


         public function follow()
        {
              echo $this->tadmin_model->update_follow_info();
             $this->session->set_flashdata('errors', ('Order Status Updated.!'));
        }
        
        public function searchProducts(){
            $key = $this->input->post('search');
            $this->db->limit(10);
             $this->db->like('product_title',$key);
            $data =  $this->db->get('products')->result_array();
              //$data['products'] = $this->admin_model->record_list('products',$where); 
            // $data= $this->bigshop_model->search_all_product_info();
            echo json_encode($data);
        }
   
        
}
