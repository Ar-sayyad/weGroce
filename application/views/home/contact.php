<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
    <style>
        .owl-controls{
           display: none; 
        }
    </style>
 <body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1">  
  <!-- Header -->
  <?php include 'header.php';?>
  
  <?php include 'page_linking.php';?>
   
  <!-- Content -->
  <div id="content">
      <section  class="contact-sec padding-top-10 padding-bottom-40">
      <div class="container">   
      <div class="col-md-12">
          <div class="col-md-6">
               <!-- MAP -->
        <section id="lessons" class="map-block margin-bottom-40" style="padding:20px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15131.997463287295!2d73.81222417894175!3d18.52893079846458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf99fc569a3f%3A0xb75e5c3d69ec82ed!2sGokhalenagar%2C+Pune%2C+Maharashtra!5e0!3m2!1sen!2sin!4v1519295010989" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
<!--          <div class="map-wrapper" id="map-canvas" data-lat="21.1533201" data-lng="72.7985074" data-zoom="13" data-style="1"></div>
          <div class="markers-wrapper addresses-block"> <a class="marker" data-rel="map-canvas" data-lat="21.1533201" data-lng="72.7985074" data-string="Smart Tech"></a> </div>-->
        </section>
        
          </div>
           <div class="col-md-6">                 
       
        <!-- Conatct -->
         <section id="lessons">
             <div class="contact" style="padding:30px;">
          <div class="contact-form"> 
            <!-- FORM  -->           
              <div class="row">
              <div class="col-md-2 col-xs-4 likedstatus" style="display: none;text-align: center;top:50%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 0.8;background-color: #bd2441;">
</div>
                <div class="col-md-12"> 
                  
                  <!-- Payment information -->
                  <div class="heading">
                    <h2>Do You have a Question for Us ?</h2>
                  </div>
                  <ul class="row">
                    <li class="col-sm-6">
                      <label>First Name
                        <input type="text" class="form-control" name="name_contact" id="name_contact" placeholder="First Name">
                      </label>
                    </li>
                    <li class="col-sm-6">
                      <label>Last Name
                        <input type="text" class="form-control" name="lastname_contact" id="lastname_contact" placeholder="Last Name">
                      </label>
                    </li>
                    <li class="col-sm-6">
                      <label>Email
                        <input type="text" class="form-control" name="email_contact" id="email_contact" placeholder="Email">
                      </label>
                    </li>
                    <li class="col-sm-6">
                      <label>Contact
                        <input type="text" class="form-control" name="phone_contact" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" id="phone_contact" placeholder="Contact">
                      </label>
                    </li>
                    <li class="col-sm-12">
                      <label>Message
                        <textarea class="form-control" name="message_contact" id="message_contact" rows="6" placeholder="Message"></textarea>
                      </label>
                    </li>
                    <li class="col-sm-12 no-margin">
                      <button type="submit" value="submit" class="btn" id="submit_contact" >Send Message</button>
                    </li>
                  </ul>
                </div>
                
            
              </div>           
          </div>
        </div>
         </section>
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
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
<script src="<?php echo base_url();?>home/js/vendors/map.js"></script>
<script>
$("#submit_contact").click(function(){
   
    $name_contact = $("#name_contact").val();
    $lastname_contact = $("#lastname_contact").val();
    $email_contact = $("#email_contact").val();
    $phone_contact = $("#phone_contact").val();
    $message_contact = $("#message_contact").val();
     $.post("<?php echo base_url();?>Contact/submit", { name_contact: $name_contact, lastname_contact: $lastname_contact, email_contact: $email_contact, phone_contact: $phone_contact, message_contact :$message_contact }, function(data){
      if(data==1)
          {
                $('.likedstatus').fadeIn();
                $('.likedstatus').html('Enquiry submitted..!');
                $('.likedstatus').fadeOut(3000);
              $('#name_contact').val("");
              $('#lastname_contact').val("");
              $('#email_contact').val("");
              $('#phone_contact').val("");
              $('#message_contact').val("");
              
          }
          else
          {
            $('.likedstatus').fadeIn();
            $('.likedstatus').html('Something Went Wrong..! Try again Later');
            $('.likedstatus').fadeOut(3000);
              
          }
          
      }).fail(function() {
                alert( "Posting failed." );
            });
});
</script>

</body>
</html>