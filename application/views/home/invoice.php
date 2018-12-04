<style type="text/css">
    .table > tbody > tr > th
    {
        padding: 12px !important;
    }
    p {
    margin-bottom: -5px;
}
/*@media print {
  // body {
   //ble-layout:fixed;
   padding-top:2.5cm;
   padding-bottom:2.5cm;
   //height:auto;
   line-height: 70%;
    }
}*/
</style>
<?php 

$invoice_info = $this->db->get_where('orders', array('order_id' => $param2))->result_array();
// echo "<pre>";print_r($invoice_info);die;
 foreach ($invoice_info as $row) {
?>
<!-- Modal with invoice -->
  
    <div class="panel-body no-padding-bottom">
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
                            <p class="invoive"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="#"><?php echo $row['email'];?></a></p>
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
                                            <td><span><img width="40px"  src="<?php echo base_url().'assets/uploads/products/'.$img_path;?>" onError="this.src ='<?php echo base_url().'assets/no_image.jpg';?>'"></span></td>
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
                                           

                                            
                                    </div>              
                                    
<!--                                                            <div class="text-right">
                                                                    <button onClick="PrintElem('invoice_print')" type="button" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print invoice</button>
                                                            </div>-->
                                                  
                                                    </div>
                                                </td>
                                            </tr>
                                    
                                </table>
                                           

                                            
                                    </div>
                            </div>
                        

<!--                                    <h6>Other information</h6>
                                    <p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>-->
                          


    <!-- /modal with invoice -->
 <?php } ?>
<script type="text/javascript">
// function PrintElem(el){
//    
//    var restorepage = document.body.innerHTML;
//    var printcontent = document.getElementById(el).innerHTML;
//    document.body.innerHTML = printcontent;
//        
//    window.print();
//        
//    document.body.innerHTML = restorepage;
//        window.location.reload();
//      // return true;
//}

 function PrintElem(el){
    
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
        
	window.print();
        
	document.body.innerHTML = restorepage;
        window.location.reload();
      // return true;
}
</script>  
</script> 