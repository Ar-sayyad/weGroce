<?php 
            $id=$this->session->userdata('log_trainer_id');
                       $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/users/profile/'.$id, false, $context);
             $industries_info = file_get_contents($this->api_url.'api/v1/industry/getIndustries');
            $topics_info = file_get_contents($this->api_url.'api/v1/topic/getTopics');
            $industries_info = json_decode($industries_info,true);
            $indusries=array($industries_info['data']);
            $topics_info = json_decode($topics_info,true);
            $topics=array($topics_info['data']);
            $trainer = json_decode($trainer_info,true);
            $t = array($trainer['data']);
             
            foreach($t as $row){
                //echo "<pre>";print_r($row);die();
             ?>
             <link href="<?php echo base_url();?>mypanel/assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">      
   <section id="main-content">
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Change Profile Info</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Trainerdashboard/updatetrainerProfile" method="post" enctype="multipart/form-data">   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>First Name <span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                
                                                    <input type="text" name="fname" required="" class="form-control"  placeholder="Name" value="<?php echo $row['firstName'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Last Name <span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <input type="text" name="lname" required="" class="form-control"  placeholder="Name" value="<?php echo $row['lastName'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Email <span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <input type="email" name="email" required="" class="form-control"  placeholder="Email Address" value="<?php echo $row['email'];?>">
                                                </div>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Contact No <span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <input type="text" name="mobile" required="" class="form-control" pattern="[0-9]{10,10}" maxlength="10" minlength="10"value="<?php echo $row['mobile'];?>" placeholder="Contact Number"/>
                                                </div>
                                            </div>
                                        </div> 

                                         <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Industries</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                     <select class="form-control" name="industries" id="industries">
                                                     <option value="" >Select Industry </option>
                   <?php  

                   foreach ($indusries as $key => $value) {
                foreach ($value as $industry) {
                     echo "<option ";
                    echo "value='".$industry['id']."'";
                     echo "name='".$industry['id']."'";
                     if($industry['id']== set_value('industries'))
                   {
                     echo " selected ";
                  }
                      echo ">".$industry['name']."</option>";  
                  }
              }
                   ?>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Topics</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                     <select class="form-control" name="topics" id="topics">
                                                     <option value="" >Select Topics </option>
                   <?php  

                   foreach ($topics as $key => $value) {
                foreach ($value as $topic) {
                     echo "<option ";
                    echo "value='".$topic['id']."'";
                     echo "name='".$topic['id']."'";
                     if($topic['id']== set_value('topics'))
                   {
                     echo " selected ";
                  }
                      echo ">".$topic['name']."</option>";  
                  }
              }
                   ?>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $address = !empty($row['address'])?$row['address']:'';
                                    ?>
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>City</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                

                                                     <input type="text" name="city" class="form-control"  placeholder="City"  value="<?php echo !empty($address['city'])?$address['city']:'';?>">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <textarea name="address" class="form-control" placeholder="Address"><?php echo !empty($address['area'])?$address['area']:'';?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Pincode</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                     <input type="text" name="pincode"  pattern="[0-9]{6,6}" maxlength="6" class="form-control"  placeholder="Pincode" value="<?php echo !empty($address['zipcode'])?$address['zipcode']:'';?>">
                                                </div>
                                            </div>
                                        </div> 
                                        
                                        <!--<div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Website</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                     <input type="text" name="website"  class="form-control"  placeholder="Website"/>
                                                </div>
                                            </div>
                                        </div>-->
                                        
                                        <!--<div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Skype ID:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                     <input type="text" name="skype_id"  class="form-control"  placeholder="skype id"/>
                                                </div>
                                            </div>
                                        </div>-->
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-pencil-alt"></i> Update Profile</button>
                                            <button type="button" class="btn btn-primary btn-lg border-none sbmt-btn" data-dismiss="modal"><i class="ti-close"></i> Close</button>
                                        </div>  
                                   </div>
                                </div>                                
                                </form>
                            </div>
                        </div>
                    </div>
              
   </section>
<?php }
?>

<!--    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/moment.latest.min.js"></script>
     scripit init
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/semantic.ui.min.js"></script>
     scripit init
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/prism.min.js"></script>
     scripit init
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
     scripit init
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/pignose.init.js"></script>
     scripit init-->