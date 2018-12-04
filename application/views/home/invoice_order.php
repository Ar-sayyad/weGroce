<?php //include 'header-top.php';?>
  <div class="col-md-2 col-xs-4 prod_filtering" style="display: none;text-align: center;top:30%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 1.8;">
        <img width="50%" src="<?php echo base_url();?>mypanel/assets/img/loading.gif">
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

           <?php 
$invoice_info = $this->db->get_where('orders', array('order_id' => $param2))->result_array();
// echo "<pre>";print_r($invoice_info);die;
 foreach ($invoice_info as $row) {
?>                    
                                
                    
                    
                           
                               <div class="row"   >
                                        <div class="col-md-12">
                                         <table style="width: 100%">
                    <tr>
                        <td>
                            <p class="invoive"> Office No. 9, 1st Floor, Jai Ganesh Plaza, Porwal Road,</p>
                             <p class="invoive"> Opp. Samrat Sweet, Dhanori Octori (Jakat Naka),</p>
                               <p class="invoive">Lohegaon, Pune - 411047<p>
                        </td>
                        <td style="float: right;margin-top: 4px;">
                            <h6 class="text-uppercase text-semibold"><b>Order No: #MT00<?php echo $row['order_id'];?></b></h5>
                            <h6>Date: <span class="text-semibold"><?php echo $row['date'];?></span></h5>
                        </td>
                    </tr>                                                   
                    
                     <tr>
                        <td><br>
                            <h6><span class="text-muted">Invoice To:</span></h6>
                            <p class="invoive"><?php echo $row['fname']." ".$row['lname'];?></h5>                                                            
                            <p class="invoive"><i class=" icon-phone" aria-hidden="true"></i>&nbsp;<?php echo $row['contact'];?></p>
                            <p class="invoive"><i class="icon-mail-1" aria-hidden="true"></i>&nbsp;<a href="#"><?php echo $row['email'];?></a></p>
                        </td>

                         <td style="float: right;margin-top: 22px;">
                            <h6><span class="text-muted">Order Details:</span></h6>
                            <p class="invoive"><?php echo $row['shipping_address'];?></h5>                                                            
                            <p class="invoive"><?php echo $row['city'];?>- <?php echo $row['pincode'];?></p>
                             <p class="invoive">Total Amount:<i class="icon-rupee"></i><?php echo $row['final_total'];?></p>
                        </td>
                       
                    </tr>
                    
                   
                   
                   
                  
                </table>
                                        </div>
                                </div>   
                            
                  <table class="table table-bordered" style="margin-top:34px;">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Rate</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $order_product_info = $this->tadmin_model->order_product_info($row['order_id']);
                                                foreach ($order_product_info as $row1){
                                                    $img_path = $this->tadmin_model->get_img_path($row1['product_id']);
                                        ?>
                                        <tr>
                                            <td><span><img width="40px"  src="<?php echo base_url().'assets/uploads/products/'.$img_path;?>"></span></td>
                                            <td><?php echo $row1['prod_name'];?></td>
                                          
                                            <td><i class="icon-rupee"></i><?php echo $row1['prod_price'];?></td>
                                            <td><?php echo $row1['qty'];?></td>
                                            <td><span class="text-semibold"><i class="icon-rupee"></i><?php echo $row1['amount'];?></span></td>
                                        </tr>
                                                <?php }?>
                                       
                                    </tbody>
                                </table>
        
                                <div class="row invoice-payment">
                                        <table class="table">
                                            <tr>
                            <td>
                                 <div class="col-sm-12">
                                        
                                        <div class="mb-15 mt-15">
                                                <img  class="display-block" style="width: 150px;" alt="">
                                        </div>

                                        <ul class="list-condensed list-unstyled text-muted">
                                                <li><?php echo $row['fname']." ".$row['lname'];?></li>
                                                <li><?php echo $row['shipping_address'];?></li>
                                                <li><?php echo $row['city'];?> - <?php echo $row['pincode'];?></li>
                                                <li><?php echo $row['contact'];?></li>
                                        </ul>
                                     <br>
                                     <h6><b>Authorized person</b></h6>
                                </div>
                            </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                            <!--<h6>Total due</h6>-->
                                                                    <table class="table">
        <tbody>
                <tr>
                        <th>Subtotal:</th>
                        <td class="text-right"><i class="icon-rupee"></i><?php echo $row['subtotal'];?></td>
                </tr>
                <tr>
                        <th>Shipping Charges: <span class="text-regular"></span></th>
                        <td class="text-right"><i class="icon-rupee"></i><?php echo $row['shipping_charges'];?></td>
                </tr>
                <tr>
                <th>Total:</th>
                <td class="text-right text-primary"><i class="icon-rupee"></i><?php echo $row['final_total'];?></td>
                </tr>
              
                <tr>
                    <th> Order Status:</th>
                    <td class="text-right"><?php if($row['order_status']==1){echo"<b style='color:green'><i class='fa fa-check-circle'></i> Order Placed</b>";}elseif($row['order_status']==2){echo "<b style='color:green'><i class='fa fa-check-circle'></i> Processing</b>";}elseif($row['order_status']==3){echo "<b style='color:green'><i class='fa fa-check-circle'></i> Delivery Assigned</b>";}elseif($row['order_status']==4){echo "<b style='color:green'><i class='fa fa-check-circle'></i>Out For Delivery</b>";}elseif($row['order_status']==5){echo "<b style='color:green'><i class='fa fa-check-circle'></i> Delivered</b>";}elseif($row['order_status']==6){echo "<b style='color:red'><i class='fa fa-remove'></i> Cancelled</b>";}?></td>
                </tr>
                
        </tbody>
                                                                    </table>
                                                           
<!--                                                            <div class="text-right">
                                                                    <button onClick="PrintElem('invoice_print')" type="button" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print invoice</button>
                                                            </div>-->
                                                  
                                                    </div>
                                                </td>
                                            </tr>
                                    
                                </table>              
                          
                                
                            
                              <?php } ?>   
                            
                                
                      
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
                               window.location="<?php echo base_url();?>";
//                               $("#regmsg").show();
//				$("#regmsgp").html(data);
//                                 $('.prod_filtering').fadeOut();
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