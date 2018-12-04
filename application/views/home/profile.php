 <div class="col-md-2 col-xs-4 prod_filter" style="display: none;text-align: center;top:40%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 1.8;">
        <img width="80px" src="<?php echo base_url();?>home/images/img/loadings.gif">
</div>
<style>  
    .modal-footer,.close{
        display: none !important;
    }
    .dvic{
        margin: 8px;
    }
</style>
<body id="login_bg">

<div id="login">
		<aside>

                                <div id="regmsg">
                                    <span class="btn" id="closeerr" style="cursor: pointer;margin-top: -18px;margin-right: -15px;float:right;">
                                        <i class="icon-cancel-circled" style="color:RED;font-size:25px"></i>
                                    </span>
                                    <p id="regmsgp"></p>
                                </div>
                                <div id="logsuccess">

                                    <p id="logsuc"></p>
                                </div>
                    
                        <div class="row">
                            <div class="col-sm-12 dvic">
                                <div class="form-group">
                            <div class="col-sm-4">
                                <label>First Name</label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="firstName" value="<?php echo $this->session->userdata('firstName');?>" placeholder="First Name" id="firstName" required="">
                            </div>
                                </div>
                            </div>
                                <div class="col-sm-12 dvic">
                                <div class="form-group">
                                <div class="col-sm-4">
                                <label>Last Name</label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="lastName" value="<?php echo $this->session->userdata('lastName');?>" placeholder="Last Name" id="lastName" required="">
                            </div>
                                </div>
                                </div>
                                
                            <div class="col-sm-12 dvic">
                                <div class="form-group">
                                <div class="col-sm-4">
                                <label>Email</label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="email" name="email" value="<?php echo $this->session->userdata('login_email_id');?>" placeholder="Email" id="email" required="">
                            </div>
                                </div>
                            </div>
                                
                            <div class="col-sm-12 dvic">
                                <div class="form-group">
                                <div class="col-sm-4">
                                <label>City</label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="regcity" placeholder="City" id="city" required="">
                            </div>
                                </div>
                            </div>
                                
                            <div class="col-sm-12 dvic">
                                <div class="form-group">
                                <div class="col-sm-4">
                                <label>Address</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea name="address" class="form-control" id="address" placeholder="Address" required=""></textarea>
                            </div> 
                                </div>
                            </div>
                                
                            <div class="col-sm-12 dvic">
                                <div class="form-group">
                                <div class="col-sm-4">
                                <label>Pincode</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Pincode" pattern="[0-9]{6,6}" maxlength="6" autocomplete="off" required="">
                            </div>
                                </div>
                            </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn" id="doProfile">Submit</button>
                          </div>
                                                        
                                 </aside>
	</div>
<script>
$(document).ready(function(){
    $('#pincode').keydown(function(event){    
            if(event.keyCode==13){
               $('#doProfile').trigger('click');
            }
        });
    $('#doProfile').click(function(){
       $firstName = $("#firstName").val();
       $lastName = $("#lastName").val();
       $email = $("#email").val();
        //$gender = $('input[name=reggender]:checked').val();
        $city = $("#city").val();
        $address = $("#address").val();
        $pincode = $("#pincode").val(); 
         $('.prod_filter').fadeIn();
         $.post("<?php echo base_url();?>Register/doRegProfile", { firstName: $firstName, lastName:$lastName, email:$email, city:$city, address:$address, pincode:$pincode }, function(data){
             //alert(data);
             	if(data==1){
                    $('.prod_filter').fadeOut();
                     $("#logsuccess").show();
                        $('#logsuc').html("<span style='font-size: 20px;margin-top: 11px;margin: 10px;'><i class='icon-ok-circled2'></i></span><span style='color:green;text-transform:capitalize;font-size:12px'>Profile is Updated Successfully..!</span><br><img width='20' src='<?php echo base_url();?>home/images/img/loadings.gif'><br><span style='font-size:10px'>Redirecting.....</span>");
                        function profile(){                       
                                
                            window.location="<?php echo base_url();?>"; 
                        }
                        setTimeout(profile,3000);
                    }else
			{
                               //window.location="<?php echo base_url();?>";
                               $("#regmsg").show();
				$("#regmsgp").html(data);
                                 $('.prod_filter').fadeOut();
                                //alert(data);
			}
	}).fail(function() {
                alert( "Posting failed." );
            });
       });
       $("#closeerr").click(function(){
            $('#regmsg').hide();
        });           
 });
</script>
</body>
</html>