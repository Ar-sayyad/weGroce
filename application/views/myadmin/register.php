<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mera Trainer |Trainer register</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="<?php echo base_url();?>mypanel/assets/img/logo.png"> 
    <!-- Styles -->
    <link href="<?php echo base_url();?>mypanel/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>mypanel/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>mypanel/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>mypanel/assets/css/lib/unix.css" rel="stylesheet">
    <link href="<?php echo base_url();?>mypanel/assets/css/style.css" rel="stylesheet">
</head>

<body>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">                       
                        <div class="login-form">
                            
                            <center>
                                <span>
                                    <h4><img src="<?php echo base_url();?>mypanel/assets/img/main-logo.png" alt="Tirupati Travels" /></h4>
                                    
                                    <h6><small id="res" class="display-block"></small></h6>
                            </span>
                            </center>
                            <form method="post" action="<?php echo base_url().'Login/trainer_register';?>">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <input type="mobile" id="mobile" class="form-control" placeholder="mobile" name="mobile">
                                </div>
                                
<!--                                <div class="checkbox">
                                   
                                    <label class="pull-right"><a href="#">Forgotten Password?</a></label>

                                </div>-->
                                <input type="submit" id="subbtn" class="btn btn-primary btn-flat m-b-30 m-t-30">
                              
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
<script src="<?php echo base_url();?>mypanel/assets/js/lib/jquery.min.js"></script>
<script type="text/javascript">
            $(document).ready(function() {
                 $('#password').keydown(function(event){    
            if(event.keyCode==13){
               $('#loginbtn').trigger('click');
            }
        });
                $('#loginbtn').click(function(){
                   // alert("hello");
                 $('#res').html("<img width='30' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
               $email = $('#email').val();
               $password = $('#password').val();
               if($email == '' || $password == '')
               {
                   //alert('Please enter all login details.');
                    $('#res').html("<span style='color:red;text-transform:capitalize;font-size:13px'>Enter login details..!</span>");
                   return false;
               }
//               $(this).attr('disabled','disabled');
               $.post('<?php echo base_url();?>Admin/validateLogin',{ email:$email,password:$password},function(data){
                   //alert(data);
                  if(data==1) 
                  {	
                  	  $('#res').html("<h5><span style='color:green;text-transform:capitalize;font-size:13px'>Login Success..!</span><br><img width='30' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'><br><span style='font-size:12px'>Redirecting.....</span></h5>");
                     // window.location="http://wegrocers.com/wegrocers-admin/";
                          window.location="<?php echo base_url();?>Admin";
                  }else{
//                    
                      $('#res').html("<h5><span style='color:red;text-transform:capitalize;font-size:12px'>"+data+"</span></h5>");
                  }
               });
            });
            });
            
        </script>
</body>
</html>
