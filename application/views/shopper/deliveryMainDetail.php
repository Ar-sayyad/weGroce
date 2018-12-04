<style>
    .modal-footer{
        display: none !important;
    }
    .btn
    {
      border-bottom: 0px;
    }
</style> 
<div id="logmsg">
    <span type="button" class="btn" id="closeerr" style="margin-top: -20px;margin-right: -27px;float:right;font-size:0px">
        <i class="fa fa-times-circle" style="color:RED;font-size: 24px;"></i>
    </span>
    <p id="logmsgp"></p>
</div>
 <div id="logsuccess">
   <span type="button" class="btn" id="closesuc" style="margin-top: -20px;margin-right: -18px;float:right;font-size:22px">
        <i class="fa fa-times-circle" style="color:green"></i>
    </span>
    <p id="logsuc"></p>
</div>
<div class="top-cart-area login-page" style="padding-left: 30px;padding-right: 30px;">
                    <div class="login-area padding-bottom">                       
                        <div class="row"> 
                          <div class="col-md-12 col-sm-12">
                            <div class="login-area-form login">
                              <div class="form-title">
                                  <a><h2>Fill Order Delivery Details</h2></a>
                              </div>
                              <div class="form-fields">
                                  <input type="hidden" id="order_id" value="<?php echo $param1;?>"/>
                                  
                                  <input type="hidden" id="contact" value="<?php echo $param2;?>"/>
                                  <div class="form-group">                                    
                                      <input type="text" name="dname" class="form-control" id="dname"  required placeholder="Enter Driver Name">
                                  </div>                                   
                                 <div class="form-group">
                                     <input type="text" name="mobile" class="form-control" id="mobile" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" required placeholder="Driver Mobile Number">
                                  </div>
                                    <div class="form-group">
                                        <input type="text" name="vehicle_no" class="form-control" id="vehicle_no"  maxlength="10" autocomplete="off" required placeholder="Vehicle Number">
                                  </div>
                                  <div class="form-action clearfix"> 
                                      <button class="btn btn-primary" id="deliveryOut" style="height:48px;float: right;font-size: larger;width: 40% !important"><i class="icon-pencil7"></i> Update Status</button>
                                  </div>                               
                              </div>
                            </div>
                          </div>                       
                        </div>
                    </div>
                </div>
<script>
 
    $('#vehicle_no').keydown(function(event){  
     
            if(event.keyCode==13){
               $('#deliveryOut').trigger('click');
            }
        });
        
    $('#deliveryOut').click(function(){
   
        $drivername= $("#dname").val();
        $mobile = $("#mobile").val();
        $vehicle_no = $("#vehicle_no").val();
        $order_id = $("#order_id").val();
        $contact = $("#contact").val();
        //alert($order_id);
        //alert($contact);
        
         $('.prod_filtering').fadeIn(); 
         
         $.post("<?php echo base_url();?>Trainerdashboard/checkOrderStatus", {drivername:$drivername, mobile:$mobile, vehicle_no:$vehicle_no }, function(data){

            if(data==1){
              ///alert("here");
                                    
                       $.post("<?php echo base_url();?>Trainerdashboard/changeOrderStatus", { drivername:$drivername, mobile:$mobile, vehicle_no:$vehicle_no, order_id: $order_id, order_status:4,contact:$contact}, function(data){

                                        if(data==1){
                                             window.location.reload();                                          
                                            }else
                                                {
                                                        alert(data);
                                                }
                                        }).fail(function() {
                                        alert( "Posting failed." );
                                    });
                }else
                    {
                      alert("there");
                      $('.prod_filtering').fadeOut();
                      $("#logmsg").show();
                      $("#logmsgp").html(data);
                    }
            }).fail(function() {
            alert( "Posting failed." );
        });
            
             
       });
      
       $("#closeerr").click(function(){
             //alert("hello");
            $('#logmsg').hide();
        });

</script>