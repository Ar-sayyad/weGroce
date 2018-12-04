
	<div id="login">
		<aside>

                          <div id="regmsg">
                                    <span class="btn" id="closeerr" style="cursor: pointer;margin-top: -28px;margin-right: -34px;float:right;">
                                        <i class="icon-cancel-circled" style="color:RED;font-size:25px"></i>
                                    </span>
                                    <p id="regmsgp"></p>
                                </div>
                                <div id="logsuccess">

                                    <p id="logsuc"></p>
                                </div>
                          <div id="pass-info" class="clearfix"></div>

				<div class="form-group">
					<span class="input">
                                            <input class="input_field" type="email" autocomplete="off" id="loginEmail" name="email">
						<label class="input_label">
						<span class="input__label-content">Email</span>
					</label>
					</span>

					<span class="input">
                                            <input class="input_field" type="password" autocomplete="off" id="loginPassword" name="password">
						<label class="input_label">
						<span class="input__label-content">Password</span>
					</label>
					</span>
					<small><a style="color:blue;cursor:pointer" onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/shop/forgot/');">Forgot password?</a></small>
				</div>
                                <button class="btn_1 rounded full-width add_top_30" id="doLogin">Login to Mera Trainer</button>
				<div class="text-center add_top_10">New to Mera Trainer? <strong><a style="cursor:pointer" onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/shop/register/');">Sign up!</a></strong></div>
			
		</aside>
	</div>
	<!-- /login -->		
	<!-- COMMON SCRIPTS -->	
  <script>
$(document).ready(function(){
    $('#loginPassword').keydown(function(event){    
            if(event.keyCode==13){
               $('#doLogin').trigger('click');
            }
        });
    $('#doLogin').click(function(){
        $email = $("#loginEmail").val();       
        $password = $("#loginPassword").val();  
         $('#logsuc').html("<img width='25' src='<?php echo base_url();?>home/images/img/loadings.gif'>");
         $.post("<?php echo base_url();?>Login/validateLogin", { email: $email, password:$password }, function(data){
             //alert(data);
             	if(data==1)
                {
                         $("#logsuccess").show();
                         $('#logsuc').html("<span style='color:green;text-transform:capitalize;font-size:15px'>Login Success..!</span><br><img width='25' src='<?php echo base_url();?>home/images/img/loadings.gif'><br><span style='font-size:12px'>Redirecting.....</span>");
                         window.location.reload();//="<?php echo base_url();?>";
                        //alert(data);
                }
                else{
                      $("#regmsg").show();
                      $("#regmsgp").html('<h6 style="padding-top:10%;color:red">'+data+'</h6>');      
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
