<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
   
 <body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1">  
  <!-- Header -->
  <?php include 'header.php';?>
  <div class="col-md-2 col-xs-4 prod_filter" style="display: none;text-align: center;top:30%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 1.8;">
        <img width="80%" src="<?php echo base_url();?>home/images/img/loadings.gif">
</div>
  
  <?php include 'page_linking.php';?>

  
  <!-- Content -->
 <div id="content"> 
     <!-- Products -->
     <section class="padding-top-10 padding-bottom-60">
      <div class="container">
        <div class="row category-filter">
          
          <!-- Shop Side Bar -->
             <div class="col-md-3 side-filter">
                 <div class="shop-side-bar">               
                <div class="trainer-info" style="text-align:center">
                    <?php foreach ($user_info as $row){ ?>     
                        <figure>
                            <img width="200px" height="200px" src="<?php echo base_url()?>assets/uploads/users/<?php echo $row['picture']; ?>" class="rounded-circle my_prof_img" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/trainer.png';" alt="No Image">
                        </figure>
                    <h6 style="text-transform:capitalize;"><?php echo $row['fname'];?> <?php echo $row['lname'];?></h6>
               <span style=" text-align: center;" class="tagg pheading" title="Designation"><i class="fa fa-phone"></i> <?php echo $row['contact'];?></span>

        </div>
                 </div>
             </div>
          <div class="col-md-9"> 
             
        <!-- Tab panes -->
       
           <div class="shop-side-bar-terms">                
                                <div id="profmsg">
                                    <span class="" id="closeerr" style="cursor: pointer;margin-top: -17px;margin-right: -15px;float:right;">
                                        <i class="fa fa-times-circle" style="color:RED;font-size:25px"></i>
                                    </span>
                                    <p id="profmsgp"></p>
                                </div>
                                <div id="profsuccess">

                                    <p id="profsuc"></p>
                                </div>
             <div class="panel panel-default checkout-step-01">
               <div class="panel-heading">
               <a data-toggle="collapse"  data-parent="#accordion" href="#collapseOne">
                                                              
               <h6 class="pheading">Account</h6>
                                
               </a>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in">

                    <!-- panel-body  -->
                <div class="panel-body">
                    <div class="step">
                            <div class="row">   
                                <div class="col-md-6 col-sm-12">
                                       
                                            <div class="form-group">
                                              <label>First Name <sup>*</sup></label>
                                              <input type="text" name="fname" id="fname" value="<?php echo $row['fname'];?>" class="form-control" placeholder="First Name [Required]" required>
                                            </div>
                                            <div class="form-group">
                                              <label>Mobile No<sup>*</sup></label>
                                              <input type="text" name="contact" id="contact" value="<?php echo $row['contact'];?>" class="form-control" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" placeholder="Mobile Number [Required]" readonly="">
                                            </div>
                                              <div class="form-group">
              <!--                                <div class="continue-btn clearfix">
                                                  <button class="btn btn-primary" style="float: left"><i class="fa fa-pencil"></i> Edit</button>
                                              </div>-->
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                              <label>Last Name <sup>*</sup></label>
                                              <input type="text" name="lname" id="lname" value="<?php echo $row['lname'];?>"  class="form-control" placeholder="Last Name [Required]" required>
                                            </div>
                                            <div class="form-group">
                                              <label>Email<sup>*</sup></label>
                                              <input type="text" name="email" id="email" readonly="" value="<?php echo $row['email'];?>" class="form-control" placeholder="Email [Required]" required>
                                            </div>


                                            <!-- <div class="form-group">
                                              <div class="continue-btn clearfix">
                                                  <button class="btn" style="float: right;" data-toggle="tooltip" data-placement="auto" title="Update My Account" id="myacc_update" style="float: right; cursor:pointer;"><i class="fa fa-save"></i> Update</button>
                                              </div>
                                            </div> -->
                                             <div class="form-group">
                                              <div class="continue-btn clearfix">
                                                  <button class="btn" style="float: right;" data-toggle="tooltip" data-placement="auto" title="Update My Account" id="myacc_update" style="float: right; cursor:pointer;"><i class="fa fa-save"></i> Update</button>
                                              </div>
                                            </div>
                                          </div>
                                
                                    
            

                            </div>  
                    </div>
                    </div>
                    <!-- panel-body  -->

            </div>
                                                       

                
            </div>

              <div class="panel panel-default checkout-step-02">
               <div class="panel-heading">
               <a data-toggle="collapse"  data-parent="#accordion" href="#collapseTwo">
                                                              
                                       <h6 class="pheading">Profile</h6>
                                
               </a>
               </div>
               <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                  <div class="step">
                                <div class="row">   
                                  <div class="col-md-6 col-sm-12">
                                          <form action="<?php echo base_url();?>Account/uploadProfilePcs/update" method="post" enctype="multipart/form-data">
                                               <div class="form-group">
                                                 <label>Profile Picture<sup>*</sup></label>  
                                              
                                                 <span><img class="prof_img" src="<?php echo base_url()?>assets/uploads/users/<?php echo $row['picture']; ?> "  onError="this.src = '<?php echo base_url();?>home/images/img/trainer.png'"  height="100px" width="100px" alt="No Image Found.!"></span>
                                                </div>    
                                                 
                                                 
                                        
                                       </div>
                               
                                        <div class="col-md-6 col-sm-12">
                                               <div class="form-group">                                                                           
                                                           <label>Upload Image:<span style="color:red">*</span></label>
                                                           <input class="form-control" type="file" id="productimage"  name="userfile" required="required" />

                                               </div>
                                              <div class="form-group">
                                                       <div class="continue-btn clearfix">
                                                           <button type="submit" class="btn"  style="margin-left: 235px;" data-toggle="tooltip" data-placement="auto" title="Upload Profile Image" id=""><i class="fa fa-upload"></i> Upload</button>
                                                       </div>
                                              </div>
                                                 </form>
                                          </div>

                                                
                                </div>
                                    
                                        
                

                                </div>  
                        </div>
                                                          
                  </div>
             </div>

              <div class="panel panel-default checkout-step-03">
               <div class="panel-heading">
               <a data-toggle="collapse"  data-parent="#accordion" href="#collapseThree">
                                                              
                                        <h6 class="pheading">My Settings</h6>
                                
               </a>
               </div>
                <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                  <div class="step">
                                <div class="row">   
                                    <div class="col-md-6 col-sm-12">
                                            
                           <div class="form-group">
                             <label>Gender<sup>*</sup></label>                             
<input type="radio" style="width: 25px;cursor: pointer" name="gender" id="gender" value="male" required="" <?php if($row['gender']=='male'){?> checked="checked" <?php }else {}?> placeholder="Gender"> Male
<input type="radio" style="width: 25px;cursor: pointer" name="gender" id="gender" value="female" required="" <?php if($row['gender']=='female'){?> checked="checked" <?php }else {}?>  placeholder="Gender"> Female
                                                                   
                            </div>
                            <div class="form-group">
                             <label>Shipping Address <sup>*</sup></label>
                             <textarea name="address" id="address" rows="3" class="form-control" placeholder="Shipping Address [Required]" required><?php echo $row['shipping_address'];?></textarea>
                           </div> 
                                                  <div class="form-group">
                  <!--                                <div class="continue-btn clearfix">
                                                      <button class="btn btn-primary" style="float: left"><i class="fa fa-pencil"></i> Edit</button>
                                                  </div>-->
                                                </div>
                                              </div>
                                <div class="col-md-6 col-sm-12">
                          <div class="form-group">
                             <label>City <sup>*</sup></label>
                             <input type="text" name="city" id="city" value="<?php echo $row['city'];?>"   class="form-control" placeholder="City Name [Required]" required>
                           </div>
                           <div class="form-group">
                                <label>Pincode<sup>*</sup></label>
                                <input type="text" name="pincode" id="pincode" value="<?php echo $row['pincode'];?>"  class="form-control" pattern="[0-9]{6,6}" maxlength="6" autocomplete="off" placeholder="Pincode [Required]" required>
                           </div>
                               <div class="form-group">
                                                  <div class="continue-btn clearfix">
                                                     <button class="btn" style="float: right;" data-toggle="tooltip" data-placement="auto" title="Update Profile Data" id="myprofacc_update" style="float: right;cursor:pointer;"><i class="fa fa-save"></i> Update</button>
                                                   </div>
                                                </div>
                                </div>


                                                
                                              </div>
                                    
                                        
                

                                </div>  
                        </div>
                                                          
                  </div>
             </div>
            </div>
       </div> 
          <!-- Products -->
     
         <?php } ?>
      
            </div>
             </section>
          </div>
           </div>
        </div>

        </div>
      </div>
    </section>
 
       
  </div>
  <!-- End Content --> 
  </div>
  <!-- Footer -->
  
  <?php include 'footer.php';?>
  
  <!-- GO TO TOP  --> 
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a> 
  <!-- GO TO TOP End --> 
 <?php include 'footer-bottom.php';?>
 <script type="text/javascript">
    
$("#myaccount_tab").click(function(){
     //alert("hello");
     $("#collapseTwo").addClass('in');
     $("#collapseThree").removeClass('in');
     $("#collapsePass").removeClass('in');
  
     
     $("#myaccount_tab").addClass('active');
     $("#profile_tab").removeClass('active')
     $("#password_tab").removeClass('active');
   
 });
  $("#profile_tab").click(function(){
     //alert("hello");
     $("#collapseTwo").removeClass('in');
     $("#collapseThree").addClass('in');
     $("#collapsePass").removeClass('in');
  
     
     $("#myaccount_tab").removeClass('active');
     $("#profile_tab").addClass('active')
     $("#password_tab").removeClass('active');
    
     
 });
 $("#password_tab").click(function(){
     //alert("hello");
     $("#collapseTwo").removeClass('in');
     $("#collapseThree").removeClass('in');
     $("#collapsePass").addClass('in');
     
     
     $("#myaccount_tab").removeClass('active');
     $("#profile_tab").removeClass('active')
     $("#password_tab").addClass('active');
    
     
 });


$("#myacc_update").click(function(){
    
       $fname = $("#fname").val();
       $lname = $("#lname").val();
       $contact = $("#contact").val();
       $email = $("#email").val();  
       $('.prod_filter').fadeIn();
       $.post("<?php echo base_url();?>Account/updateMyaccInfo", { fname: $fname, lname:$lname, contact:$contact, email:$email }, function(data){
             //alert(data);
                if(data==1)
                {    $('.prod_filter').fadeOut();
                    $("#profsuccess").show().delay(5000).fadeOut('fast');
                         $('#profsuc').html("<h3><span style='color:green;text-transform:capitalize;font-size:15px'><i class='fa fa-check-circle-o'></i></span><span style='color:green;text-transform:capitalize;font-size:15px'> Profile Updated Successfully..!</span></h3>");
                         //window.location.reload();//="<?php echo base_url();?>";
                        function closediv(){ 
                           $("#profsuccess").hide();
                        }
                        //setTimeout(closediv,5000);
                }
                else{
                    $('.prod_filter').fadeOut();
                      $("#profmsg").show();
                      $("#profmsgp").html(data);  
                      function closediv(){ 
                           $("#profmsg").hide();
                        }
                        setTimeout(closediv,3000);
                }
    }).fail(function() {
                alert( "Posting failed." );
            });
     
});

$("#myprofacc_update").click(function(){
  //alert();
        $gender = $('input[name=gender]:checked').val();
        $city = $("#city").val();
        $address = $("#address").val();
        $pincode = $("#pincode").val(); 
        $('.prod_filter').fadeIn();
        $.post("<?php echo base_url();?>Account/updateProfileAccInfo", { gender: $gender, city:$city, address:$address, pincode:$pincode }, function(data){
             //alert(data);
              if(data==1)
                {    
                    $('.prod_filter').fadeOut();
                    $("#profsuccess").show();
                         $('#profsuc').html("<h3><span style='color:green;text-transform:capitalize;font-size:15px'><i class='fa fa-check-circle-o'></i></span><span style='color:green;text-transform:capitalize;font-size:15px'> Profile Details Updated Successfully..!</span></h3>");
                         //window.location.reload();//="<?php echo base_url();?>";
                        function closediv(){ 
                           $("#profsuccess").hide();
                        }
                        setTimeout(closediv,5000);
                }
                else{
                    $('.prod_filter').fadeOut();
                      $("#profmsg").show();
                      $("#profmsgp").html(data);  
                      function closediv(){ 
                           $("#profmsg").hide();
                        }
                        setTimeout(closediv,3000);
                }
  }).fail(function() {
                alert( "Posting failed." );
            });
      $("#closeerr").click(function(){
            $('#profmsg').hide();
        });
         $("#closesuc").click(function(){
            $('#profsuccess').hide();
        });
});

$("#pass_update").click(function(){
    $password = $("#password").val();
    $confirm = $("#confirm").val();
    $('.prod_filter').fadeIn();
    $.post("<?php echo base_url();?>Account/updatePasswordInfo", { password: $password, confirm:$confirm }, function(data){
             //alert(data);
              if(data==1)
                {   
                    $('.prod_filter').fadeOut();
                    $("#profsuccess").show();
                         $('#profsuc').html("<h4><span style='color:green;text-transform:capitalize;font-size:15px'><i class='fa fa-check-circle-o'></i></span><span style='color:green;text-transform:capitalize;font-size:13px'> Password Updated Successfully..!</span></h4><img width='20' src='<?php echo base_url();?>home/images/img/loadings.gif'><br><span style='font-size:11px'>Logout.....</span>");
                         //window.location.reload();//="<?php echo base_url();?>";
                        function closediv(){ 
                           $("#profsuccess").hide();
                           window.location='<?php echo base_url();?>Shop/logout';
                        }
                        setTimeout(closediv,4000);
                }
                else{
                $('.prod_filter').fadeOut();
                      $("#profmsg").show();
                      $("#profmsgp").html(data);  
                      function closediv(){ 
                           $("#profmsg").hide();
                        }
                        setTimeout(closediv,3000);
                }
  }).fail(function() {
                alert( "Posting failed." );
            });
            $("#closeerr").click(function(){
            $('#profmsg').hide();
        });
         $("#closesuc").click(function(){
            $('#profsuccess').hide();
        });
});
</script>
</body>
</html>