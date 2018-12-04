<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainers extends CI_Controller {
	public function __construct()  
    {
        parent::__construct();
                //$this->load->model('tadmin_model');
                $this->load->database();
                $this->load->model('admin_model');
                $this->load->library('session');
                $this->load->library('upload');
                date_default_timezone_set("Asia/Kolkata");
                $this->load->library('form_validation');
                $this->load->helper(array('form','url','file')); 
    }

	public function index()
	{
                $opts = array(
              'http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/getTrainerList?start=0', false, $context);
            $industries_info = file_get_contents($this->api_url.'api/v1/industry/getIndustries');
            $topics_info = file_get_contents($this->api_url.'api/v1/topic/getTopics');
            $data['trainers_info'] = json_decode($trainer_info,true);
            $data['industries_info'] = json_decode($industries_info,true);
            $data['topics_info'] = json_decode($topics_info,true);
            $data['industry_id'] = $this->input->post('industry_id');
            $data['page_title'] = 'Trainers';
            $data['data_title'] = '';
            $this->load->view('home/trainers',$data);
	}
        public function trainersinfo($id)
	{
                $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/users/profile/'.$id, false, $context);
            $image_info = file_get_contents($this->api_url.'api/web/users/imageGallery/get/'.$id, false, $context);
            $video_info = file_get_contents($this->api_url.'api/web/users/youtubeVideos/get/'.$id, false, $context);
             $trainer = json_decode($trainer_info,true);
             $image = json_decode($image_info,true);
             $video = json_decode($video_info,true);
             $data['trainer'] = array($trainer['data']);
             $data['image_info'] = $image;//array($image['data']);
             $data['video_info'] = $video;//array($video['data']);
             $data['trainer_id'] = $id;
             //$this->db->where('trainer_id',$id); //load products on trainer_id;
             $this->db->limit(8);
            $data['product'] = $this->admin_model->record_list('products');
             $data['page_title'] = '<a href="'.base_url().'Trainers"><b>Trainers</b></a>';
            $data['data_title'] = ' <i class="fa fa-angle-right"></i> '.$trainer['data']['firstName']." ".$trainer['data']['lastName'];
	    $this->load->view('home/trainersdetail',$data);
	}
        
        public function products($id=''){
            $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/users/profile/'.$id, false, $context);
              $trainer = json_decode($trainer_info,true);
             $this->db->limit(12);
             //$this->db->where('trainer_id',$id); //load products on trainer_id;
             $data['code'] = '';
            $data['product'] = $this->admin_model->record_list('products');
            $data['category_info']= $this->admin_model->record_list('category');
            $data['price_range']= $this->admin_model->record_list('price_range');
            $data['page_title'] = '<a href="'.base_url().'Trainers"><b>Trainers</b></a>';
            $data['data_title'] = ' <i class="fa fa-angle-right"></i> <a href="'.base_url().'trainers/trainersinfo/'.$id.'"><b>'.$trainer['data']['firstName']." ".$trainer['data']['lastName'].'</b></a> <i class="fa fa-angle-right"></i> Products';
            $this->load->view('home/trainerProducts',$data);
        }

        public function loadImageGallery(){     
            
            if($this->session->userdata('count')){
            $count = $this->session->userdata('count');
            }else{
                $count = 11;
            }  
            //echo $count;
            $id = $this->input->post('id');
           echo $gallery=  $this->admin_model->loadImageGallery($count,$id);
           
               $count = $count + 10;
           $this->session->set_userdata('count',$count);                     
          
        }
        public function loadTrainers(){
            $id = $this->input->post('id');
          // echo $gallery=  $this->admin_model->loadTrainersList($id);
           
           $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/getTrainerList?start='.$id, false, $context);
           $data['trainers_info'] = json_decode($trainer_info,true);
           $this->load->view('home/loadtrainersList',$data);
        }
        public function filterTrainers(){
            $industryId = $this->input->post('industryId');
            if(!empty($industryId)){
               $industryId[] =  ($industryId);
          
               $data = array("industryIds" => $industryId, "topicIds[]" => "");                                                                    
                $data_string = json_encode($data);                                                                                   

                $ch = curl_init($this->api_url.'api/web/trainers/filter');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',
                    'token: 9f67c0d60108e71da0f7264f1675c124',
                    'Content-Length: ' . strlen($data_string))                                                                       
                );                                                                                                                 

                 $trainer_info = curl_exec($ch);
            }else{
                 $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/getTrainerList?start=0', false, $context);
            }

            $opts = array(
              'http'=>array(
                  'method'=>"POST",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $industries_info = file_get_contents($this->api_url.'api/v1/industry/getIndustries');
            $topics_info = file_get_contents($this->api_url.'api/v1/topic/getTopics');
            $data['trainers_info'] = json_decode($trainer_info,true);
            $data['industries_info'] = json_decode($industries_info,true);
            $data['topics_info'] = json_decode($topics_info,true);
            $data['industry_id'] = ($industryId);
            $this->load->view('shop/trainers',$data);
        }
        public function filterTrainersList(){
             $industryId = $this->input->post('industryId');
             $topicId = $this->input->post('topicId');
            if(!empty($industryId) || !empty($topicId)){          
               $data = array("industryIds" => $industryId, "topicIds" => $topicId);                                                                    
                  $data_string = json_encode($data);                                                                                   
               
                $ch = curl_init($this->api_url.'api/web/trainers/filter');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',
                    'token: 9f67c0d60108e71da0f7264f1675c124',
                    'Content-Length: ' . strlen($data_string))                                                                       
                );                                                                                                                  

                 $trainer_info = curl_exec($ch);
                  }else{
                 $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/getTrainerList?start=0&count=16', false, $context);
            }
                   $data['trainers_info'] = json_decode($trainer_info,true);
                  
                  $this->load->view('home/trainersList',$data);
        }
        
        public function searchTrainers(){
             $search= $this->input->post('search');          
               $data = array("title" => $search, "type" => "1");                                                                    
                $data_string = json_encode($data);                                                                                   

                $ch = curl_init($this->api_url.'api/web/search/getTrainerListBySearch');                                                                      
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
                $train = $trainer['data'];
                  //echo $trainer['designation'];
                 $trainarr            = array();
                foreach (array_slice($train, 0, 10) as $t){                  
                    $new_entry  = array('firstName' => !empty($t['firstName'])?$t['firstName']:'', 'lastName' => !empty($t['lastName'])?$t['lastName']:'', 'id' => $t['id'],'designation' => !empty($t['designation'])?'- ['.$t['designation'].']':'');
                array_push($trainarr, $new_entry);
                }
                echo json_encode($trainarr);
                 //print_r($t);
                 //$data['trainers_info'] = json_decode($trainer_info,true);
            
        }
        
        public function rateTrainer(){
            $userId = $this->input->post('id');
            $rate = $this->input->post('rate');
            $token = $this->session->userdata('token');
            $data = array("userId" => $userId,"rating"=>$rate);                                                                    
            $data_string = json_encode($data);
            $ch = curl_init($this->api_url.'api/v2/users/rateTrainer');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'token: '.$token,
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                            

            $rate_info = curl_exec($ch);
           $ans= json_decode($rate_info,true);
           $answer = array($ans['data']);
          //print_r($answer);
          foreach($answer as $ans){
              echo $average = $ans['rating'];
          }
            
        }
        public function shareTrainer(){
             $trainerId = $this->input->post('trainerId');
            $token = $this->session->userdata('token');
            $data = array("trainerId" => $trainerId,"linkType"=>2);                                                                    
            $data_string = json_encode($data);
            $ch = curl_init($this->api_url.'api/v2/users/shareTrainer');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',
            'token: '.$token,
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                            
          $share_info = curl_exec($ch);
          $share= json_decode($share_info,true);
          $sharing = array($share['data']);
          //print_r($answer);
          foreach($sharing as $shr){
              echo $link = $shr['redirectUrl'];
          }
        }
        
}
