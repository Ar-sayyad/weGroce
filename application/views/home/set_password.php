<?php include 'header-top.php';?>
<style>
    .modal-body{
        height:530px !important;
    }
    .modal-footer,.close{
        display: none !important;
    }
</style>
<body id="login_bg">
    
    <div id="login">
		<aside>
<!--			<figure>
				<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>shop/img/logo.png" width="149" height="42" data-retina="true" alt=""></a>
			</figure>-->
			  <!--<form>-->
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
                              <div class="form-fields">
                                  <input type="hidden" id="act_code" value="<?php echo $this->session->userdata('pass_code');?>"/>
                                  <div class="form-group">                                    
                                      <input type="password" name="code" class="form-control" id="code" autocomplete="off" required placeholder="Enter Activation Code">
                                  </div>                                   
                                 <div class="form-group">
                                      <input type="password" name="regpassword" class="form-control" id="regpassword" autocomplete="off" required placeholder="Password">
                                  </div>
                                    <div class="form-group">
                                        <input type="password" name="regconfirm" class="form-control" id="regconfirm" autocomplete="off" required placeholder="Confirm Password">
                                  </div>
                                                               
                              </div>
                            <button class="btn_1 rounded full-width add_top_30" id="setForgot">Update</button>
				
			<!--</form>-->
			<!--<div class="copy">&copy; 2018 Mera Trainer</div>-->
		</aside>
	</div>
<script>
$(document).ready(function(){
    $('#regconfirm').keydown(function(event){    
            if(event.keyCode==13){
               $('#setForgot').trigger('click');
            }
        });
        
    $('#setForgot').click(function(){
        $act_code= $("#act_code").val();
        $code = $("#code").val();
        $password = $("#regpassword").val();
        $confirm = $("#regconfirm").val();
        if($act_code==$code){
         $('.prod_filtering').fadeIn();         
         $.post("<?php echo base_url();?>Register/saveResetPassword", { password: $password, confirm:$confirm }, function(data){
             	if(data==1)
                {
                    $('.prod_filtering').fadeOut();
                    $("#logsuccess").show();
                    $("#setForgot").attr("disabled", "disabled");
                    $('#logsuc').html("<span style='color:green;text-transform:capitalize;font-size:13px'>Password Updated Successfully...!</span><br><img width='20' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'><br><span style='font-size:10px'>Redirecting.....</span>");
                    //window.location.reload();//="<?php echo base_url();?>";
                   //alert(data);
                   function profile(){                          

                       window.location.reload();
                   }
                   setTimeout(profile,3000); 
                }
                else{
                     $('.prod_filtering').fadeOut();
                     $("#regmsg").show();
                     $("#regmsgp").html(data);      
                }
	}).fail(function() {
                alert( "Posting failed." );
            });
            
             }
             else{
                     $("#logmsg").show();
                      $("#logmsgp").html("<h5 style='margin-top:10px'><span style='color:red;text-transform:capitalize;font-size:15px;'>Activation Code Error...!</span></h5>"); 
             }
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