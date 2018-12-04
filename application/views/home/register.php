<?php //include 'header-top.php';?>

<body id="login_bg">
	
<!--	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>-->
	<!-- End Preload -->
	
<div id="login">
		<aside style="border-radius:5px;">
<!--			<figure>
				<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>shop/img/logo.png" width="149" height="42" data-retina="true" alt=""></a>
			</figure>-->
			<!--<form autocomplete="off">-->
                                <div id="regmsg">
                                    <span class="btn" id="closeerr" style="cursor: pointer;margin-top: -28px;margin-right: -34px;float:right;">
                                        <i class="icon-cancel-circled" style="color:RED;font-size:25px"></i>
                                    </span>
                                    <p id="regmsgp"></p>
                                </div>
                                <div id="logsuccess">

                                    <p id="logsuc"></p>
                                </div>
                        
				<div class="form-group">
					<span class="input">
                                            <input class="input_field" type="text" name="fname" id="fname" required="">
						<label class="input_label">
						<span class="input__label-content">First Name</span>
					</label>
					</span>

					<span class="input">
                                            <input class="input_field" type="text" name="lname" id="lname" required="">
						<label class="input_label">
						<span class="input__label-content">Last Name</span>
					</label>
					</span>
                                    
                                        <span class="input">
                                            <input class="input_field" type="text" name="contact" id="contact" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" required="">
						<label class="input_label">
						<span class="input__label-content">Contact</span>
					</label>
					</span>

					<span class="input">
                                            <input class="input_field" type="email" name="email" id="email" required="" >
						<label class="input_label">
						<span class="input__label-content">Email</span>
					</label>
					</span>

<!--					<span class="input">
                                            <input class="input_field" type="password" name="password" id="password" required="">
						<label class="input_label">
						<span class="input__label-content">password</span>
					</label>
					</span>

					<span class="input">
                                            <input class="input_field" type="password" name="confirm" id="confirm" required="">
						<label class="input_label">
						<span class="input__label-content">Confirm password</span>
					</label>
					</span>-->
					
					<div id="pass-info" class="clearfix"></div>
				</div>
				<button class="btn_1 rounded full-width add_top_30" id="doReg">Register to Mera Trainer</button>
				<div class="text-center add_top_10">Already have an acccount? <strong><a style="cursor:pointer" onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/shop/login/');">Sign In</a></strong></div>
			<!--</form>-->
            <!--<div class="copy">&copy; 2018 Mera Trainer</div>-->
            
            <br><br><br>
		</aside>
	</div>
	<!-- /login -->
		
	<!-- COMMON SCRIPTS -->
    <script src="<?php echo base_url();?>shop/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url();?>shop/js/common_scripts.js"></script>
    <script src="<?php echo base_url();?>shop/js/main.js"></script>
    <script src="<?php echo base_url();?>shop/assets/validate.js"></script>	
  <script>
$(document).ready(function(){
    $('#confirm').keydown(function(event){    
            if(event.keyCode==13){
               $('#doReg').trigger('click');
            }
        });
    $('#doReg').click(function(){
       $fname = $("#fname").val();
       $lname = $("#lname").val();
       $email = $("#email").val();
       $contact = $("#contact").val();
       //$password = $("#password").val();
       //$confirm = $("#confirm").val();  password:$password, confirm:$confirm
       $('.prod_filtering').fadeIn();
         $.post("<?php echo base_url();?>Register/doRegister", { fname: $fname, lname: $lname, email: $email, contact:$contact }, function(data){
             	if(data==1){
                     $('.prod_filtering').fadeOut();
                        $("#logsuccess").show();
                        $("#doReg").attr("disabled", "disabled");
                        $('#logsuc').html("<span style='font-size: 20px;margin-top: 11px;margin: 13px;'><i class='icon-ok-circled2'></i></span><span style='color:green;text-transform:capitalize;font-size:13px'>Your Registration Successfully Done..!</span><br><img width='20' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'><br><span style='font-size:13px'>Redirecting.....</span>");
                        //window.location="<?php echo base_url();?>";
                        function profile(){                          
                                
                            showAjaxModal('<?php echo base_url();?>Shop/popup/shop/validate_otp');
                        }
                        setTimeout(profile,3000); 
                      
                    }else
			{
                                $('.prod_filtering').fadeOut();
                                $("#regmsg").show();
				$("#regmsgp").html(data);
                                //alert(data);
			}
	}).fail(function() {
                alert( "Posting failed." );
            });
       });
       $("#closeerr").click(function(){
             //alert("hello");
            $('#regmsg').hide();
        });
        $("#closesuc").click(function(){
             //alert("hello");
            $('#logsuccess').hide();
            
        });
 });
</script>
</body>

</html>