 <div class="col-md-2 col-xs-4 prod_filter" style="display: none;text-align: center;top:40%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 1.8;">
        <img width="80px" src="<?php echo base_url();?>home/images/img/loadings.gif">
</div>
<div id="login">
		<aside style="border-radius:5px;">

                                <div id="regmsg">
                                    <span class="" id="closeerr" style="cursor: pointer;margin-top: -18px;margin-right: -15px;float:right;">
                                        <i class="fa fa-times-circle" style="color:RED;font-size:25px"></i>
                                    </span>
                                    <p id="regmsgp"></p>
                                </div>
                                <div id="logsuccess">

                                    <p id="logsuc"></p>
                                </div>
                        
                        <div class="form-group" style="margin-top: 50px">
				
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label>Mobile Number</label>
                            </div>
                          <div class="col-sm-8">                            
                              <input type="text" name="contact" id="contact" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" required="" class="form-control" placeholder="Mobile Number">
                           </div>
                            </div>
                          <br><br><br>
                          <div class="col-sm-12 text-center">
                            <button type="submit" class="btn" id="doSend">Submit</button>
                          </div>
                        </div>
                        </div>  
		
                </aside>
</div>
	<!-- /login -->
		
	<!-- COMMON SCRIPTS -->
        <script src="<?php echo base_url();?>shop/js/jquery-2.2.4.min.js"></script>
  <script>
    $('#contact').keydown(function(event){    
            if(event.keyCode==13){
               $('#doSend').trigger('click');
            }
        });
    $('#doSend').click(function(){
       $contact = $("#contact").val();
       $('.prod_filter').fadeIn();
       $.post("<?php echo base_url();?>Register/doSendCode", { contact:$contact }, function(data){
             //alert(data);
             	if(data==1){
                     $('.prod_filter').fadeOut();
                        $("#logsuccess").show();
                        $("#doReg").attr("disabled", "disabled");
                        $('#logsuc').html("<span style='font-size: 20px;margin-top: 11px;margin: 13px;'><i class='icon-ok-circled2'></i></span><span style='color:green;text-transform:capitalize;font-size:13px'>Please verify code send to your mobile...!</span><br><img width='20' src='<?php echo base_url();?>home/images/img/loadings.gif'><br><span style='font-size:13px'>Redirecting.....</span>");
                        //window.location="<?php echo base_url();?>";
                        function profile(){                          
                                
                            showAjaxModal('<?php echo base_url();?>Shop/popup/home/validate_otp');
                        }
                       setTimeout(profile,3000); 
                      
                    }else
			{
                                $('.prod_filter').fadeOut();
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
 
</script>
</body>

</html>