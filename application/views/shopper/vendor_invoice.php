<?php 
$invoice_info = $this->db->get_where('orders', array('order_id' => $param2))->result_array();

 foreach ($invoice_info as $row) {
?>
<!-- Modal with invoice -->
<style>
 .table > tbody > tr > th
    {
        padding: 12px !important;
    }
    </style>
 <div class="row" id="invoice_print" >
    <div class="col-md-12 col-xs-12 col-lg-12">
         
     <div class="modal-body printsection">
    <div class="panel-body no-padding-bottom"  >
                                    <div class="row">
                                   <div class="col-md-12">
                                                  <table style="width: 100%">
                                                      
                                                    <tr>
                                                        <td>
                                                            <h6><span class="text-muted">Invoice To:</span></h6>
                                                            <h5><?php echo $row['fname']." ".$row['lname'];?></h5>
                                                            <h6> <span class="text-semibold"><?php echo $row['shipping_address'];?></span></h6>
                                                            <h6><?php echo $row['city'];?> - <?php echo $row['pincode'];?></h6>
                                                            <h6><?php echo $row['contact'];?></h6>
                                                            <h6><a href="#"><?php echo $row['email'];?></a></h6>
                                                        </td>
                                                        <td style="float: right">
                                                            <h5 class="text-uppercase text-semibold">Invoice #MT00<?php echo $row['order_id'];?></h5>
                                                            <h6> Date: <span class="text-semibold"><?php echo $row['date'];?></span></h6>
                                                            <h5> <span class="text-muted">Payment Details:</span></h5>
                                                            <!--<h5>Total Amount: <span class="text-right text-semibold"><i class="fa fa-inr"></i><?php echo $row['final_total'];?></span></h5>-->
                                                        </td>
                                                       
                                                    </tr>
                                                </table>
                                          
                                            
                                        </div>
                                    </div>
                                      <table class="table table-bordered">
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
                                        <?php $order_product_info = $this->admin_model->vendor_order_product_info($row['order_id']);
                                  
                                                $amt=0;
                                                foreach ($order_product_info as $row1){
                                                     $img_path = $this->admin_model->get_img_path($row1['product_id']);
                                        ?>
                                        <tr>
                                            <td><span>
                                                    <img width="60px"  src="<?php echo base_url().'assets/uploads/products/'.$img_path;?>" onError="this.src = '<?php echo base_url().'assets/no_image.jpg';?>'"></span></td>
                                            <td><?php echo $row1['prod_name'];?></td>
                                            <td><?php echo $row1['prod_price'];?></td>
                                            <td><?php echo $row1['qty'];?></td>
                                            <td><span class="text-semibold"><i class="fa fa-inr"></i><?php echo $row1['amount'];?></span></td>
                                        </tr>
                                                <?php
                                                $amt= $amt+$row1['amount'];
                                                
                                                }?>
                                       
                                    </tbody>
                                </table>
          <div class="row invoice-payment">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                     <div class="col-sm-12">
                                                            <h6>Authorized person</h6>
                                                            <div class="mb-15 mt-15">
<!--                                                                    <img src="<?php echo base_url();?>partnerIT/img/signature.png" class="display-block" style="width: 150px;" alt="">-->
                                                            </div>

                                                            <ul class="list-condensed list-unstyled text-muted">
                                                                    <li><?php echo $row['fname']." ".$row['lname'];?></li>

                                                            </ul>
                                                  
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                            <h6>Total due</h6>
                                                                    <table class="table">
                                                                            <tbody>
                                                                                    <tr>
                                                                                            <th>Subtotal:</th>
                                                                                            <td class="text-right"><i class="fa fa-inr"></i><?php echo $amt;?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <th>Shipping Charges: <span class="text-regular"></span></th>
                                                                                            <td class="text-right"><i class="fa fa-inr"></i><?php echo $row['shipping_charges'];?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <th>Total:</th>
                                                                                            <td class="text-right text-primary"><h5 class="text-semibold"><i class="fa fa-inr"></i><?php echo $amt;?></h5></td>
                                                                                    </tr>
                                                                            </tbody>
                                                                    </table>
                                                           
                                                            <div class="text-right">
                                                           <!--  <a onClick="PrintElem1('print')"  class="btn btn-primary pull-right printbtn">
<i class="fa fa-print fa-lg"></i> Print </a> -->
                                                                    <button onClick="PrintElem('invoice_print')" type="button" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print invoice</button>
                                                            </div>
                                                  
                                                    </div>
                                                </td>
                                            </tr>
                                    
                                </table>
                                           

                                            
                                    </div>
                            </div>
              </div>
              </div>
              </div>              

    <!-- /modal with invoice -->
 <?php } ?>
<script type="text/javascript">
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