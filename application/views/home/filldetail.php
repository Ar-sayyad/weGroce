<!doctype html>
<html class="no-js" lang="en">    
<?php include 'header-top.php';?>
   <style type="text/css">
     .table {
    width: 100%;
    margin-left: 10px;
    max-width: 98%;
    margin-bottom: -4px;
  }
   </style>
 <body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1">  
  <!-- Header -->
  <?php include 'header.php';?>
  <div class="col-md-2 col-xs-4 prod_filter" style="display: none;text-align: center;top:30%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 1.8;">
        <img width="80%" src="<?php echo base_url();?>home/images/img/loadings.gif">
</div>
  
  <?php include 'page_linking.php';?>
  
  <!-- Content -->
 <div id="content"> 
     <!-- Products -->
     <section class="padding-top-10 padding-bottom-60">
      <div class="container" >
        <div class="row">
          
          <!-- Shop Side Bar -->
         <div class="col-md-12"> 
           <div class="col-md-8">   
        <!-- Tab panes -->
          <?php  if ($this->session->userdata('user_login') == 1){
       
            if($this->session->userdata('name')!="")
            {
            $login_user_info = $this->tadmin_model->select_login_user_info();
            ?>
           <div class="shop-side-bar-terms"> 
               
                                <div id="profmsg">
                                    <span class="" id="closeerr" style="cursor: pointer;margin-top: -17px;margin-right: -15px;float:right;">
                                        <i class="fa fa-times-circle" style="color:RED;font-size:25px"></i>
                                    </span>
                                    <p id="profmsgp"></p>
                                </div>
                                <div id="profsuccess">

                                    <p id="profsuc"></p>
                                </div>
            
             
               
             <div class="panel panel-default checkout-step-01">
               <div class="panel-heading">
               <a data-toggle="collapse"  data-parent="#accordion" href="#collapseOne">
                                                              
               <h6 class="pheading">Your Details</h6>
                                
               </a>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" style="padding:15px 20px;">
     <div class="panel-body">

         <form  method="post" action="<?php echo base_url();?>Cart/submit" >    
             <!-- panel-body  -->
              
                    <div class="step">
 
                            <div class="row">   
                                <div class="col-md-6 col-sm-12">
                                       
                                            <div class="form-group">
                                              <label>First Name <sup>*</sup></label>
                                              <input type="text" name="fname" id="fname" value="<?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['fname'])){ echo $row['fname'];}else {} endforeach; }else{}?>"  class="form-control" placeholder="First Name [Required]" readonly>
                                            </div>
                                            <div class="form-group">
                                              <label>Mobile No<sup>*</sup></label>
                                              <input type="text" name="contact" id="contact"  class="form-control" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" placeholder="Mobile Number [Required]" value="<?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['contact'])){ echo $row['contact'];}else {} endforeach; }else{}?>" readonly>
                                            </div>

                                             <div class="form-group">
                                              <label>Shipping<sup>*</sup></label>
                                              <textarea name="shipping_address" id="shipping_address"  class="form-control" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" placeholder="Mobile Number [Required]" readonly><?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['shipping_address'])){ echo $row['shipping_address'];}else {} endforeach; }else{}?></textarea>
                                            </div>
                                               <div class="form-group">
                                              <label>Pincode<sup>*</sup></label>
                                              <input type="text" name="pincode" id="pincode"  class="form-control" pattern="[0-9]{10,10}" maxlength="10" autocomplete="off" placeholder="Mobile Number [Required]" value="<?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['pincode'])){ echo $row['pincode'];}else {} endforeach; }else{}?>" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                              <label>Last Name <sup>*</sup></label>
                                              <input type="text" name="lname" id="lname"   class="form-control" placeholder="Last Name [Required]" value="<?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['lname'])){ echo $row['lname'];}else {} endforeach; }else{}?>" readonly>
                                            </div>
                                            <div class="form-group">
                                              <label>Email<sup>*</sup></label>
                                              <input type="text" name="email" id="email" readonly=""  class="form-control" placeholder="Email [Required]" value="<?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['email'])){ echo $row['email'];}else {} endforeach; }else{}?>" readonly>
                                            </div>
                                            <div class="form-group">
                                              <label>City<sup>*</sup></label>
                                              <input type="text" name="city" id="city" readonly=""  class="form-control" placeholder="city [Required]" value="<?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['city'])){ echo $row['city'];}else {} endforeach; }else{}?>" readonly>
                                            </div>                                           
                                          </div>  

                            </div>
                       </div>
                       
              <?php 	}
                else
                {
                       ?>
                <div class="step">
              <p style="padding-left: 12px;">Profile Not Filled? 
<a style="cursor:pointer; color:blue; " data-toggle="modal" data-target="#modal_ajax" onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/home/profile/');" class="">Click here to fill your Profile</a></p>
               </div>
                <?php
               }
                ?>
              </div>
                    <!-- panel-body  -->

            </div>
                                                       

                
            </div>

              <div class="panel panel-default checkout-step-02">
               <div class="panel-heading">
               <a data-toggle="collapse"  data-parent="#accordion" href="#collapseTwo">
                                                              
                 <h6 class="pheading">Cart Details</h6>
                                
               </a>
               </div>
               <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                  <div class="step">
                                <div class="row">   
                                    <table class="table-bordered order-table table table-stripped" style="border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;">
                                    <thead>
                                      
                     <tr>
                                         <th> Image </th>
                                        <th> Name </th>
                                        <th> Price </th>
                                        <th> QTY </th>
                                        <th> Subtotal </th>
                                     </tr>
                                      <tbody>
                                       <?php $total = 0;
                                        if (isset($_SESSION['products']) && $_SESSION['products'] != '') {
                                          foreach ($_SESSION['products'] as $cart) {
                                          $amt = $cart['amount'] * $cart['qty'];
                                          $total = $total + $amt;
                                     ?>
                                      <tr>
                                           <td><img style="width:40px;height:40px;" src="<?php echo base_url().'assets/uploads/products/'.$cart['image'];?>" alt="<?php echo $cart['prod_name'];?>" onError="this.src = '<?php echo base_url().'assets/no_image.jpg';?>'"></td>
                                        <td> <?php echo $cart['prod_name'];?> </td>
                                        <td><i class="fa fa-inr"></i><?php echo $cart['amount'];?></td>
                                          <td><?php echo $cart['qty'];?></td>
                                            <td> <i class="fa fa-inr"></i><?php echo $amt;?></td>
                                       </tr>
                                       <?php }
                                  } 
                                 ?>
                                       <tr class="grand-total-row"  style="border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;">
                                          <td colspan="4" style="text-align: right !important;font-weight: 600">
                                            <p class="total-text" style="margin-bottom: 11px;"> Subtotal: </p>
                                          <p class="total-text" style="margin-bottom: 11px;"> Shipping Charges: </p>
                                          <p class="total-text grand-total" style="margin-bottom: 11px;"> Grand Total: </p>
                                        </td>
                                    <td style="text-align: left;font-weight: 600;font-size: 15px">
                                        <input type="hidden" id="subtotal" name="subtotal" value="<?php echo $total;?>"/>
                                        <p class="total-text highlighted-text" style="margin-bottom: 11px;"> <i class="fa fa-inr"></i><?php echo $total;?> </p>
                                        <input type="hidden" id="shipping_charges" name="shipping_charges" value="0"/>
                                      <p class="total-text highlighted-text" style="margin-bottom: 11px;"> <i class="fa fa-inr"></i>0 </p>
                                      <input type="hidden" id="final_total" name="final_total" value="1"/>
                                      <p class="total-text grand-total highlighted-text" style="margin-bottom: 11px;"> <i class="fa fa-inr"></i><?php echo $total;?> </p>
                                    </td>
                                  </tr>
                                      
                                      </tbody>
                     
                                    </thead>
                                    </table>
                               
                                        

                                                
                                </div>
                                    
                                        
                

                                </div>  
                        </div>
                                                          
                  </div>
             </div>

              <div class="panel panel-default checkout-step-03">
               <div class="panel-heading">
               <a data-toggle="collapse"  data-parent="#accordion" href="#collapseThree">
                                                              
                <h6 class="pheading">Payment Information</h6>
                                
               </a>
               </div>
       <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body" style="padding: 26px;">
                  <div class="step">
            

              <h5>Checkout with PayuMoney</h5>
            
              <p>
                <img src="<?php echo base_url();?>home/images/img/download.jpg" alt="Image">
              </p>
            </div>
            <div id="policy">
              <h5>Cancellation policy</h5>
<!--              <p class="nomargin">Lorem ipsum dolor sit amet, vix <a href="#0">cu justo blandit deleniti</a>, discere omittantur consectetuer per eu. Percipit repudiare similique ad sed, vix ad decore nullam ornatus.</p>-->
                 <p class="nomargin">You can return your physical products with a trackable shipping service. If a package doesn't arrive and you don't use a trackable method to return or if you refuse the shipment as a method of return, we may not be able to cover you under the Guarantee.</p>
                </div> 
                 </div>
                                                          
         </div>
             </div>
            </div>
          
             <?php 
              }else {?>
                   <div class="panel panel-default checkout-step-03">
               <div class="panel-heading">
            <div class="message">
                <p>Exisitng Customer? 
                 <a style="color: #3f9fff; cursor:pointer;" data-toggle="modal" data-target="#modal_ajax" onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/home/sendVerificationCode/');" class="">Click here to login</a></p>
                
                <p>Register with Us
                 <a style="color: #3f9fff; cursor:pointer;" data-toggle="modal" data-target="#modal_ajax" onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/home/sendVerificationCode/');" class="">Click here to Register</a></p>
                         
            </div>
               </div>
                   </div>
              <?php }?>
                          
             
        </div>
     
           <?php
    //session_start();
    $total = 0;
    if (isset($_SESSION['products']) && $_SESSION['products'] != '') {
    foreach ($_SESSION['products'] as $cart) {
    $amt = $cart['amount'] * $cart['qty'];
    $total = $total + $amt;
    }
    }
    ?>	
           <div class="col-md-4">
               <div class="panel panel-default checkout-step-03">
               <div class="panel-heading">
                 <div class=""> 
                        <div class="total_div" style="font-size: 20px;">
                    <table>
                        <tr>
                            <th>
                                Total : <span style="text-align: right;"><i class="fa fa-rupee"><?php echo $total; ?></i></span>
                            </th>
                        </tr>
                         
                    </table> </div>
                   <hr>
                  <div class="add_bottom_30">All Goods/Products and Digital content pricing will be different and depends on its owner who will put it for sale.</div>
                      <input name="totalCost" class="form-control" id="totalcost" readonly="" value="<?php echo $total?>" placeholder="Total Cost" required="required" type="hidden">
		      <input name="user_id" id="user_id" readonly="" value="<?php if(!empty($login_user_info)){ foreach ($login_user_info as $row): if(!empty($row['id'])){ echo $row['id'];}else {} endforeach; }else{}?>" required="required" type="hidden">
                       <hr>
                <div class="trainer-info" style="text-align:center">
                 <?php if($this->session->userdata('name')!="")
						 	{
			 if (isset($_SESSION['products']) && $_SESSION['products'] != '' && $this->session->userdata('user_login') == 1) {?>   
<!--                     <button type="submit"  class="btn_1 full-width" style="padding: 16px 26px !important;">Checkout-->
                         <button type="submit" class="btn"><i class="icon-right"></i> Checkout</button>
                          <?php }
				 } ?>
                             </form>     
        		 <hr>
		<a href="<?php echo base_url();?>Learningmall" class="btn"><i class="icon-right"></i> Continue Shopping</a>
                 

                </div>
                 </div>
               </div>
               </div>
             </div>

          <!-- Products -->
     
        </div>
      
            </div>
           </div>
             </section>
         
           </div>
        
       
  </div>
  <!-- End Content --> 
 
  <!-- Footer -->
  
  <?php include 'footer.php';?>
  
  <!-- GO TO TOP  --> 
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a> 
  <!-- GO TO TOP End --> 
 <?php include 'footer-bottom.php';?>
<script>  
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
 </script>
</body>
</html>