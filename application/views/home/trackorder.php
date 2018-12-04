<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
   
 <body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1">  
  <!-- Header -->
  <?php include 'header.php';?>
  
  <?php include 'page_linking.php';?>

  <!-- Content -->
 <div id="content"> 
     <!-- Products -->
     <section class="padding-top-10 padding-bottom-60">
      <div class="container">
        <div class="row category-filter">
          
          <!-- Shop Side Bar -->
    <div class="col-lg-12">



        <div class="panel-heading">
              <section id="lessons">
                <div class="product">
                    <div class="indent_title_in">
                  <a data-toggle="collapse" id="acollapseOne" class="" data-parent="#accordion" href="#collapseOne">
                      <h3 class="pheading">Active Orders</h3>
                    </a>
                  </div>

                     <div id="collapseOne" class="panel-collapse collapse in">
                           <div class="panel-body">
                      <table class="table table-responsive table-striped add_bottom_30">
                        <thead>
                          <tr>
                              <th>Order Detail</th>
                                      <th>Shipping Address</th>
                                      <th>Date</th>
                                      <th>Total</th>
                                      <th>Status</th>
                                      <th>Option</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php 
                              $sr=1;
                           foreach ($activeorder_info as $row){
                             $user_id=$row['user_id'];

                             ?> 
                          <tr>
                            <input type="hidden" id="username" value="<?php echo $row['fname']." ".$row['lname'];?>"/>
                            <input type="hidden" id="cont" value="<?php echo $row['contact'];?>"/>
                          <td>
                            <a><?php echo "<b>#MT00".$row['order_id']."</b>";?></a> By <?php echo $row['fname']." ".$row['lname'];?><br>
                                        <a style="font-size: 12px"><i class="fa fa-envelope"></i> : <?php echo $row['email'];?></a><br>
                                        <i class="fa fa-phone"></i>: <?php echo $row['contact'];?><br>

                                        Purchased: <b><?php echo $this->tadmin_model->get_order_item_count($row['order_id']); ?></b> Items
                          </td>
                          <td> <?php echo $row['shipping_address'].",".$row['city']." - ".$row['pincode'];?>
                                              </td>
                                              <td><?php echo $row['date'];?></td>
                                              <td>
                                              <h5><i class="icon-rupee"></i><?php echo $row['final_total'];?></h5></td>

                <td style=" cursor:pointer;" > <ul>                                                                
                      <li class="stat"><?php if($row['order_status']==1){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Placed...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Order Placed</b></h6>";}elseif($row['order_status']>=1 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Placed Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Order Placed</h6>";}else{echo"<h6 style='color:#ccc;font-size: 12px;'>Order Placed</h6>";} ?></li>
                      <li class="stat"><?php if($row['order_status']==2){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order In Processing Now...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Processing</b></h6>";}elseif($row['order_status']>=2 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Processed Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Processing</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Process...' style='color:#ccc;font-size: 12px;'>Processing</h6>";}  ?></li>
                      <li class="stat"><?php if($row['order_status']==3){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Assigned Delivery...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Delivery Assigned</b></h6>";}elseif($row['order_status']>=3 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Delivery Assigned Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Delivery Assigned</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery Assign...' style='color:#ccc;font-size: 12px;'>Delivery Assigned</h6>";}  ?></li>                                                                
                      <li class="stat"><?php if($row['order_status']==4){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Out for Delivery...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Out for Delivery</b></h6>";}elseif($row['order_status']>=4 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Out for Delivery' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Out for Delivery</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Out for Delivery...' style='color:#ccc;font-size: 12px;'>Out for Delivery</h6>";}  ?></li>
                      <li class="stat"><?php if($row['order_status']==5){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Delivered...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Delivered</b></h6>";}elseif($row['order_status']>=5 && $row['order_status']!=6){echo"<h6  data-toggle='tooltip' data-placement='auto' title='Order Delivered Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Delivered</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery...' style='color:#ccc;font-size: 12px;'>Delivered</h6>";}  ?></li>
                      <li class="stat"><?php if($row['order_status']==6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Cancelled...' style='color:red; font-size: 12px;'><b><i class='fa fa-remove'></i> Cancelled</b></h6>";}  ?></li>
                      </ul>

                          </td>
                          <td>
                                <a style="cursor:pointer" data-toggle="modal" data-target="#invoice_ajax" onclick="showInvoice('<?php echo base_url();?>Shop/popup/home/invoice/<?php echo $row['order_id'];?>');" class=""><i class=" icon-eye"></i></a>

                                   </td>
                          </tr>
                       <?php                     
                         $sr++;    

                          }
                              ?>    




                        </tbody>
                      </table>
                           </div>
                  </div>

                   </div>
              </section>
                </div>  

        <div class="panel-heading">
              <section id="lessons">
                        <div class="product">
                            <div class="indent_title_in">
                            <i class="pe-7s-display1"></i>
                         <a data-toggle="collapse" id="acollapseTwo" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                            <h3 class="pheading">Completed Orders</h3>
                        </a>
                          </div>

                          <div id="collapseTwo" class="panel-collapse collapse">
                           <div class="panel-body">
                              <table class="table table-responsive table-striped add_bottom_30">
                                <thead>
                                  <tr>
                                      <th>Order Detail</th>
                                              <th>Shipping Address</th>
                                              <th>Date</th>
                                              <th>Total</th>
                                              <th>Status</th>
                                              <th>Option</th>
                                  </tr>
                                </thead>
                                <tbody>
                              <?php 
                                      $sr=1;
                                   foreach ($completed_info as $row){
                                        $user_id=$row['user_id'];

                                     ?> 
                                  <tr>
                                  <td>
                                    <a><?php echo "<b>#MT00".$row['order_id']."</b>";?></a> By <?php echo $row['fname']." ".$row['lname'];?><br>
                                                <a style="font-size: 12px"><i class="fa fa-envelope"></i> : <?php echo $row['email'];?></a><br>
                                                <i class="fa fa-phone"></i> : <?php echo $row['contact'];?><br>

                                                Purchased: <b><?php echo $this->tadmin_model->get_order_item_count($row['order_id']); ?></b> Items
                                  </td>
                                  <td> <?php echo $row['shipping_address'].",".$row['city']." - ".$row['pincode'];?>
                                                      </td>
                                                      <td><?php echo $row['date'];?></td>
                                                      <td>
                                                      <h5><i class="icon-rupee"></i><?php echo $row['final_total'];?></h5></td>

                                  <td> 
                                      <ul>                                                                
                              <li class="stat"><?php if($row['order_status']==1){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Placed...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Order Placed</b></h6>";}elseif($row['order_status']>=1 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Placed Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Order Placed</h6>";}else{echo"<h6 style='color:#ccc;font-size: 12px;'>Order Placed</h6>";} ?></li>
                              <li class="stat"><?php if($row['order_status']==2){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order In Processing Now...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Processing</b></h6>";}elseif($row['order_status']>=2 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Processed Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Processing</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Process...' style='color:#ccc;font-size: 12px;'>Processing</h6>";}  ?></li>
                              <li class="stat"><?php if($row['order_status']==3){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Assigned Delivery...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Delivery Assigned</b></h6>";}elseif($row['order_status']>=3 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Delivery Assigned Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Delivery Assigned</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery Assign...' style='color:#ccc;font-size: 12px;'>Delivery Assigned</h6>";}  ?></li>                                                                
                              <li class="stat"><?php if($row['order_status']==4){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Out for Delivery...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Out for Delivery</b></h6>";}elseif($row['order_status']>=4 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Out for Delivery' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Out for Delivery</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Out for Delivery...' style='color:#ccc;font-size: 12px;'>Out for Delivery</h6>";}  ?></li>
                              <li class="stat"><?php if($row['order_status']==5){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Delivered...' style='color:green; font-size: 12px;'><b><i class='fa fa-check-circle'></i> Delivered</b></h6>";}elseif($row['order_status']>=5 && $row['order_status']!=6){echo"<h6  data-toggle='tooltip' data-placement='auto' title='Order Delivered Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Delivered</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery...' style='color:#ccc;font-size: 12px;'>Delivered</h6>";}  ?></li>
                              <li class="stat"><?php if($row['order_status']==6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Cancelled...' style='color:red; font-size: 12px;'><b><i class='fa fa-remove'></i> Cancelled</b></h6>";}  ?></li>
                              </ul>
                                  </td>
                                  <td>
                                           <a style="cursor:pointer" data-toggle="modal" data-target="#invoice_ajax" onclick="showInvoice('<?php echo base_url();?>Shop/popup/home/invoice/<?php echo $row['order_id'];?>');" class=""><i class=" icon-eye"></i></a>

                                           </td>
                                  </tr>
                               <?php                     
                                 $sr++;    

                                  }
                                      ?>    




                                </tbody>
                              </table>
                          </div>
                          </div>

                          <!--wrapper_indent -->
                        </div>
              </section>    
        </div>

        <div class="panel-heading">
          <section id="lessons">
                <div class="product">
                    <div class="indent_title_in">
                 <a data-toggle="collapse" id="acollapseThree" class="collapsed" data-parent="#accordion" href="#collapseThree">
                    <h3 class="pheading">Cancelled Orders</h3>
                </a>
                  </div>

                   <div id="collapseThree" class="panel-collapse collapse">
                           <div class="panel-body">
                      <table class="table table-responsive table-striped">
                        <thead>
                          <tr>
                              <th>Order Detail</th>
                                      <th>Shipping Address</th>
                                      <th>Date</th>
                                      <th>Total</th>
                                      <th>Status</th>
                                      <th>Option</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php 
                              $sr=1;
                           foreach ($cancelled_info as $row){
                                $user_id=$row['user_id'];

                             ?> 
                          <tr>
                          <td>
                            <a><?php echo "<b>#MT00".$row['order_id']."</b>";?></a> By <?php echo $row['fname']." ".$row['lname'];?><br>
                                        <a style="font-size: 12px"><i class="fa fa-envelope"></i> : <?php echo $row['email'];?></a><br>
                                        <i class="fa fa-phone"></i> : <?php echo $row['contact'];?><br>

                                        Purchased: <b><?php echo $this->tadmin_model->get_order_item_count($row['order_id']); ?></b> Items
                          </td>
                          <td> <?php echo $row['shipping_address'].",".$row['city']." - ".$row['pincode'];?>
                                              </td>
                                              <td><?php echo $row['date'];?></td>
                                              <td>
                                              <h5><i class="icon-rupee"></i><?php echo $row['final_total'];?></h5></td>

                          <td> 
                              <ul>                                                                
                      <li class="stat"><?php if($row['order_status']==1){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Placed...' style='color:green;font-size: 12px;'><b><i class='fa fa-check-circle'></i> Order Placed</b></h6>";}elseif($row['order_status']>=1 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Placed Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Order Placed</h6>";}else{echo"<h6 style='color:#ccc;font-size: 12px;'>Order Placed</h6>";} ?></li>
                      <li class="stat"><?php if($row['order_status']==2){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order In Processing Now...' style='color:green;font-size: 12px;'><b><i class='fa fa-check-circle'></i> Processing</b></h6>";}elseif($row['order_status']>=2 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Processed Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Processing</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Process...' style='color:#ccc;font-size: 12px;'>Processing</h6>";}  ?></li>
                      <li class="stat"><?php if($row['order_status']==3){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Assigned Delivery...' style='color:green;font-size: 12px;'><b><i class='fa fa-check-circle'></i> Delivery Assigned</b></h6>";}elseif($row['order_status']>=3 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Delivery Assigned Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Delivery Assigned</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery Assign...' style='color:#ccc;font-size: 12px;'>Delivery Assigned</h6>";}  ?></li>                                                                
                      <li class="stat"><?php if($row['order_status']==4){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Just Out for Delivery...' style='color:green;font-size: 12px;'><b><i class='fa fa-check-circle'></i> Out for Delivery</b></h6>";}elseif($row['order_status']>=4 && $row['order_status']!=6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Out for Delivery' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Out for Delivery</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Out for Delivery...' style='color:#ccc;font-size: 12px;'>Out for Delivery</h6>";}  ?></li>
                      <li class="stat"><?php if($row['order_status']==5){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Delivered...' style='color:green;font-size: 12px;'><b><i class='fa fa-check-circle'></i> Delivered</b></h6>";}elseif($row['order_status']>=5 && $row['order_status']!=6){echo"<h6  data-toggle='tooltip' data-placement='auto' title='Order Delivered Successfully' style='color:green;font-size: 12px;'><i class='fa fa-check'></i> Delivered</h6>";}else{echo"<h6 data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery...' style='color:#ccc;font-size: 12px;'>Delivered</h6>";}  ?></li>
                      <li class="stat"><?php if($row['order_status']==6){echo"<h6 data-toggle='tooltip' data-placement='auto' title='Order Cancelled...' style='color:red;font-size: 12px;'><b><i class='fa fa-remove'></i> Cancelled</b></h6>";}  ?></li>
                      </ul>
                          </td>
                          <td>
                          <a style="cursor:pointer" data-toggle="modal" data-target="#invoice_ajax" onclick="showInvoice('<?php echo base_url();?>Shop/popup/home/invoice/<?php echo $row['order_id'];?>');" class=""><i class=" icon-eye"></i></a>
                                  <!-- <a data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-placement="auto"   onclick="showInvoice('<?php echo base_url();?>Shop/popup/shop/invoice/<?php echo $row['order_id'];?>');"  title="View Order" style="cursor: pointer;"><i class=" icon-eye"></i></a> -->

                                   </td>
                          </tr>
                       <?php                     
                         $sr++;    

                          }
                              ?>    




                        </tbody>
                      </table>
                  </div>
                   </div>

                  <!--wrapper_indent -->
                </div>
          </section>

        </div>

        
    </div>
          <!-- Products -->    
            </div>
             </section>
          </div>
           </div>
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
 <script type="text/javascript">
    
$("#myaccount_tab").click(function(){
     //alert("hello");
     $("#collapseTwo").addClass('in');
     $("#collapseThree").removeClass('in');
     $("#collapsePass").removeClass('in');
  
     
     $("#myaccount_tab").addClass('active');
     $("#profile_tab").removeClass('active')
     $("#password_tab").removeClass('active');
   
 });
  $("#profile_tab").click(function(){
     //alert("hello");
     $("#collapseTwo").removeClass('in');
     $("#collapseThree").addClass('in');
     $("#collapsePass").removeClass('in');
  
     
     $("#myaccount_tab").removeClass('active');
     $("#profile_tab").addClass('active')
     $("#password_tab").removeClass('active');
    
     
 });
 $("#password_tab").click(function(){
     //alert("hello");
     $("#collapseTwo").removeClass('in');
     $("#collapseThree").removeClass('in');
     $("#collapsePass").addClass('in');     
     
     $("#myaccount_tab").removeClass('active');
     $("#profile_tab").removeClass('active')
     $("#password_tab").addClass('active');    
     
 });

$("#myacc_update").click(function(){
    
       $fname = $("#fname").val();
       $lname = $("#lname").val();
       $contact = $("#contact").val();
       $email = $("#email").val();  
       $('.prod_filtering').fadeIn();
       $.post("<?php echo base_url();?>Account/updateMyaccInfo", { fname: $fname, lname:$lname, contact:$contact, email:$email }, function(data){
             //alert(data);
                if(data==1)
                {    $('.prod_filtering').fadeOut();
                    $("#upsuccess").show().delay(5000).fadeOut('fast');
                         $('#upsuc').html("<h3><span style='color:green;text-transform:capitalize;font-size:15px'><i class='fa fa-check-circle-o'></i></span><span style='color:green;text-transform:capitalize;font-size:15px'> Profile Updated Successfully..!</span></h3>");
                         //window.location.reload();//="<?php echo base_url();?>";
                        function closediv(){ 
                           $("#upsuccess").hide();
                        }
                        //setTimeout(closediv,5000);
                }
                else{
                    $('.prod_filtering').fadeOut();
                      $("#upregmsg").show();
                      $("#upregmsgp").html(data);  
                      function closediv(){ 
                           $("#upregmsg").hide();
                        }
                        setTimeout(closediv,5000);
                }
    }).fail(function() {
                alert( "Posting failed." );
            });
     
});

$("#myprofacc_update").click(function(){
  alert();
        $gender = $('input[name=gender]:checked').val();
        $city = $("#city").val();
        $address = $("#address").val();
        $pincode = $("#pincode").val(); 
        $('.prod_filtering').fadeIn();
        $.post("<?php echo base_url();?>Account/updateProfileAccInfo", { gender: $gender, city:$city, address:$address, pincode:$pincode }, function(data){
             //alert(data);
              if(data==1)
                {    
                    $('.prod_filtering').fadeOut();
                    $("#logsuccess").show();
                         $('#logsuc').html("<h3><span style='color:green;text-transform:capitalize;font-size:15px'><i class='fa fa-check-circle-o'></i></span><span style='color:green;text-transform:capitalize;font-size:15px'> Profile Details Updated Successfully..!</span></h3>");
                         //window.location.reload();//="<?php echo base_url();?>";
                        function closediv(){ 
                           $("#logsuccess").hide();
                        }
                        setTimeout(closediv,5000);
                }
                else{
                    $('.prod_filtering').fadeOut();
                      $("#logmsg").show();
                      $("#regmsgp").html(data);  
                      function closediv(){ 
                           $("#logmsg").hide();
                        }
                        setTimeout(closediv,5000);
                }
  }).fail(function() {
                alert( "Posting failed." );
            });
      $("#closeerr").click(function(){
            $('#logmsg').hide();
        });
         $("#closesuc").click(function(){
            $('#logsuccess').hide();
        });
});

$("#pass_update").click(function(){
    $password = $("#password").val();
    $confirm = $("#confirm").val();
    $('.prod_filtering').fadeIn();
    $.post("<?php echo base_url();?>Account/updatePasswordInfo", { password: $password, confirm:$confirm }, function(data){
             //alert(data);
              if(data==1)
                {   
                    $('.prod_filtering').fadeOut();
                    $("#logsuccess").show();
                         $('#logsuc').html("<h4><span style='color:green;text-transform:capitalize;font-size:15px'><i class='fa fa-check-circle-o'></i></span><span style='color:green;text-transform:capitalize;font-size:13px'> Password Updated Successfully..!</span></h4><img width='20' src='<?php echo base_url();?>bigshop/assets/images/loading.gif'><br><span style='font-size:11px'>Logout.....</span>");
                         //window.location.reload();//="<?php echo base_url();?>";
                        function closediv(){ 
                           $("#logsuccess").hide();
                           window.location='<?php echo base_url();?>Shop/logout';
                        }
                        setTimeout(closediv,4000);
                }
                else{
                $('.prod_filtering').fadeOut();
                      $("#logmsg").show();
                      $("#regmsgp").html(data);  
                      function closediv(){ 
                           $("#logmsg").hide();
                        }
                        setTimeout(closediv,5000);
                }
  }).fail(function() {
                alert( "Posting failed." );
            });
            $("#closeerr").click(function(){
            $('#logmsg').hide();
        });
         $("#closesuc").click(function(){
            $('#logsuccess').hide();
        });
});
</script>
</body>
</html>