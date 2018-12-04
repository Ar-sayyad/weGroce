<?php 
 $id=$this->session->userdata('log_trainer_id');
                       $opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents('http://api.meratrainer.com/api/web/users/profile/'.$id, false, $context);
            
             $trainer = json_decode($trainer_info,true);
            
             $t = array($trainer['data']);
             //echo "<pre>";print_r($t);die();
            foreach($t as $row){
             ?>
<?php include 'header-top.php';?> 

<body>

    <!-- # sidebar -->
    <?php include 'sidebar.php';?>
    <!-- /# sidebar -->


    <!-- # header -->
    <?php include 'header.php';?> 
    <!-- /# header -->
    
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
               <!---page title-->
                <?php include 'page-title.php';?>
                <!---/page-title--->
                <!-- /# row -->
                <section id="main-content">
                     <!---system messages---->                    
                    <?php include 'system_msgs.php';?>
                    <!---/system messages---->
                   
                   <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="user-profile">
                                        <div class="row">
                                            <!--<div class="col-lg-4">
                                                <div class="user-photo m-b-30">
                                                    <img class="img-responsive" src="#" alt="Admin Image Not Set" />
                                                </div>
                                                <div class="user-work">
                                                    <div class="work-content">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="showAjaxModal('<?php //echo base_url();?>Trainerdashboard/popup/trainer/changeAdminImage');"><i class="ti-image"></i> Change Image</button>
                                                    </div>
                                                </div>
                                                
                                            </div>-->
                                            <div class="col-lg-8">
                                                <div class="user-profile-name">
                                                    <span class="phone-number"><?php echo $row['firstName']." ".$row['lastName'];?></span>
                                                </div>
                                                <div class="user-Location"><i class="ti-location-pin"></i></div>
                                                <div class="user-job-title">Trainers</div>
                                                
                                               <div class="custom-tab user-profile-tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active"><a href="#1" aria-controls="1" role="tabpanel" data-toggle="tab">Profile Setting</a></li>
                                                         <!--<li role="presentation" class=""><a href="#2" aria-controls="1" role="tabpanel" data-toggle="tab">Password Setting</a></li>-->
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="1">
                                                            <div class="contact-information">
                                                                <div class="user-job-title">Contact information</div>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">Phone:</span>
                                                                    <span class="phone-number"><?php echo $row['mobile'];?></span>
                                                                   
                                                                </div> 
                                                                <?php $address = !empty($trainer['data']['address'])?$trainer['data']['address']:'';?>
                                                                 <div class="address-content">
                                                                    <span class="contact-title">Address:</span>
                                                                     <span class="contact-email"><?php echo $address['area'].",".$address['city'].",".$address['zipcode'];?></span>
                                                                    
                                                                    
                                                                </div> 
                                                                <div class="email-content">
                                                                    <span class="contact-title">Email:</span>
                                                                    <span class="mail-address"><?php echo $row['email'];?></span>
                                                                </div>
                                                               
                                                               
                                                            </div>
                                                            
                                                             <button type="button" class="btn btn-primary" data-toggle="modal" onclick="showProfileModal('<?php echo base_url();?>Trainerdashboard/popup/trainer/changeAdminProfile/<?php echo $this->session->userdata('log_trainer_id');?>');"><i class="ti-pencil-alt"></i> Upadate Profile</button>
                                                        </div>
                                                          <div role="tabpanel" class="tab-pane" id="2">
                                                              <form action="<?php echo base_url();?>Trainerdashboard/profile/updateAdminPassword/<?php echo  $this->session->userdata('log_trainer_id');?>" method="post">
                                                            <div class="contact-information">
                                                                <div class="user-job-title">Change Password</div>
                                                                <div class="phone-content">
                                                                    <div class="col-lg-4">
                                                                        <div class="basic-form">
                                                                            <div class="form-group">
                                                                        <span class="contact-title">Current Password:</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                    
                                                                    <div class="col-lg-8">
                                                                        <div class="basic-form">
                                                                            <div class="form-group">
                                                                                <input type="password" name="old_password" id="old_password" required="" class="form-control" placeholder="Current Password"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="phone-content">
                                                                    <div class="col-lg-4">
                                                                        <div class="basic-form">
                                                                            <div class="form-group">
                                                                    <span class="contact-title">New Password:</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <div class="basic-form">
                                                                            <div class="form-group">
                                                                                <input type="password" name="password" id="password" required="" class="form-control" placeholder="New Password"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="phone-content">
                                                                    <div class="col-lg-4">
                                                                        <div class="basic-form">
                                                                            <div class="form-group">
                                                                    <span class="contact-title">Confirm Password:</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <div class="basic-form">
                                                                            <div class="form-group">
                                                                                <input type="password" name="confirm" id="confirm" required="" class="form-control" placeholder="Confirm Password"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary" onclick=""><i class="ti-key"></i> Change Password</button>
                                                            </div>
                                                              </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                
                   
                    <!-- /# row -->
                    <!--FOOTER CONTENTS--->
                     <?php include 'footer-contents.php';?>
                    <!---/FOOTER CONTENTS-->
                </section>
            </div>
        </div>
    </div>

<?php } ?>

     <!-- # footer -->
    <?php include 'footer.php';?>
    <!-- /# footer -->

    <script>
       $(document).ready(function() {
           function hidetab(){    
            $('#mssg').hide();
          }
            setTimeout(hidetab,4000);
       });
    </script>
</body>


</html>