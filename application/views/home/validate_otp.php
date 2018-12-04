 <div class="col-md-2 col-xs-4 prod_filter" style="display: none;text-align: center;top:40%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 1.8;">
        <img width="80px" src="<?php echo base_url();?>home/images/img/loadings.gif">
</div>
<style>  
    .modal-footer,.close{
        display: none !important;
    }
</style>

<div id="login">
		<aside>

                                <div id="regmsg">
                                    <span class="" id="closeerr" style="cursor: pointer;margin-top: -17px;margin-right: -15px;float:right;">
                                        <i class="fa fa-times-circle" style="color:RED;font-size:25px"></i>
                                    </span>
                                    <p id="regmsgp"></p>
                                </div>
                                <div id="logsuccess">

                                    <p id="logsuc"></p>
                                </div>
                        <br>
                         <div class="form-group" style="margin-top: 50px">
				
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label>OTP</label>
                            </div>
                          <div class="col-sm-8">                            
                              <input class="form-control" type="password" name="otp" placeholder="OTP" id="otp" required="">
                           </div>
                            </div>
                          <br><br><br>
                          <div class="col-sm-12 text-center">
                            <button type="submit" class="btn" id="doValidate">Submit</button>
                          </div>
                        </div>
                        </div>
                                
                        
          </aside>
	</div>
<script>
$(document).ready(function(){
    $('#otp').keydown(function(event){    
            if(event.keyCode==13){
               $('#doValidate').trigger('click');
            }
        });
    $('#doValidate').click(function(){
        $otp = $("#otp").val();        
         $('.prod_filter').fadeIn();
         $.post("<?php echo base_url();?>Register/validateOTP", { otp: $otp }, function(data){
             //alert(data);
             	if(data==1){
                    $('.prod_filter').fadeOut();
                     $("#logsuccess").show();
                     $('#logsuc').html("<span style='font-size: 20px;margin-top: 11px;margin: 13px;'><i class='icon-ok-circled2'></i></span><span style='color:green;text-transform:capitalize;font-size:13px'>OTP Validate Successfully..!</span><br><img width='20' src='<?php echo base_url();?>home/images/img/loadings.gif'><br><span style='font-size:13px'>Redirecting.....</span>");
                        //window.location="<?php echo base_url();?>";
                        function profile(){                          
                                
                            showAjaxModal('<?php echo base_url();?>Shop/popup/home/profile');
                        }
                        setTimeout(profile,3000);                                            
                    }else if(data==2){
                         $('.prod_filter').fadeOut();
                         $("#logsuccess").show();
                         $('#logsuc').html("<span style='font-size: 20px;margin-top: 11px;margin: 13px;'><i class='icon-ok-circled2'></i></span><span style='color:green;text-transform:capitalize;font-size:13px'>OTP Validate Successfully..!</span><br><img width='20' src='<?php echo base_url();?>home/images/img/loadings.gif'><br><span style='font-size:13px'>Redirecting.....</span>");
                        //window.location="<?php echo base_url();?>";
                        function profile(){ 
                            window.location="<?php echo base_url();?>";
                        }
                        setTimeout(profile,3000);    
                            
                    }else
			{
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
