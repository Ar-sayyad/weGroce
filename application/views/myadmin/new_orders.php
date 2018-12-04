
<?php include 'header-top.php';?>

<body>

    <!-- # sidebar -->
    <?php include 'sidebar.php';?>
    <!-- /# sidebar -->


    <!-- # header -->
    <?php include 'header.php';?>
    <!-- /# header -->
<style>
 .modal-content{
       overflow: : hidden;
    }
</style> 
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
               <!---page title-->
                <?php include 'page-title.php';?>
                <!---/page-title--->
                <!-- /# row -->
                <section id="main-content">
                    <!---system messages---->                    
                    <?php include 'system_msgs.php';?>
                    <!---/system messages---->
                    
                    <div class="row">
                        <div class="col-lg-12">
<!--                            <div class="addbtn">
                                <button data-toggle="modal" onclick="showAjaxModal('<?php echo base_url();?>Admin/popup/myadmin/addProduct');" class="btn btn-danger" >Add Product</button>
                             </div>-->
                             <div class="card alert">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Name</th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th style="text-align: left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                               <?php $sr=1;
                                                    foreach ($order_info as $row){
                                                       ?> 
                                                <tr>
                                                    <td><?php echo $sr;?></td>
                                                    <td>   <a data-toggle='tooltip' data-placement='auto' title="Main Order Invoice" style="cursor:pointer" onclick="showInvoice('<?php echo base_url();?>Admin/orderpopup/Admin/invoice/<?php echo $row['order_id'];?>');"><?php echo "<b>#MT00".$row['order_id']."</b>";?></a> By <?php echo $row['fname']." ".$row['lname'];?>
                                                     <br>
                                                     <h6 style="font-size: 13px">Total Order: <b><?php echo $this->admin_model->get_order_item_count($row['order_id']); ?></b> Items</h6>

                                                    </td>
                                                    <td><h6 style="font-size: 13px"> <?php echo $row['contact'];?></h6></td>
                                                    <td><h6 style="font-size: 13px"><?php echo $row['email'];?></h6></td>
                                                    <td><i class=" icon-rupee"></i><?php echo $this->admin_model->get_order_item_total($row['order_id']); ?></td>
                                                    <td>
                                                    <ul>                                                                
                             <li class="stat"><?php if($row['order_status']==1){echo"<p data-toggle='tooltip' data-placement='auto' title='Order Just Placed...' style='color:green;font-size: 12px;margin-bottom: 0px;min-height: 0px;'><b><i class='fa fa-check-circle'></i> Order Placed</b></p>";}elseif($row['order_status']>=1 && $row['order_status']!=6){echo"<p data-toggle='tooltip' data-placement='auto' title='Order Placed Successfully' style='color:green;font-size: 12px;'><i class='fa fa-envelopecheck'></i> Order Placed</p>";}else{echo"<p style='color:#ccc'>Order Placed</p>";} ?></li>

                              <li class="stat"><?php if($row['order_status']==2){echo"<p data-toggle='tooltip' data-placement='auto' title='Order In Processing Now...' style='color:green;font-size: 12px;margin-bottom: 0px;min-height: 0px;'><b><i class='fa fa-check-circle'></i> Processing</b></p>";}elseif($row['order_status']>=2 && $row['order_status']!=6){echo"<p data-toggle='tooltip' data-placement='auto' title='Order Processed Successfully' style='color:green;font-size: 12px;margin-bottom: 0px;'><i class='fa fa-check'></i> Processing</p>";}else{echo"<p data-toggle='tooltip' data-placement='auto' title='Waiting for Process...' style='color:#ccc;font-size: 12px;margin-bottom: 0px;min-height: 0px;'>Processing</p>";}  ?></li>

                             <li class="stat"><?php if($row['order_status']==3){echo"<p data-toggle='tooltip' data-placement='auto' title='Order Just Assigned Delivery...' style='color:green;font-size: 12px;margin-bottom: 0px;min-height: 0px;'><b><i class='fa fa-check-circle'></i> Delivery Assigned</b></p>";}elseif($row['order_status']>=3 && $row['order_status']!=6){echo"<p data-toggle='tooltip' data-placement='auto' title='Delivery Assigned Successfully' style='color:green;font-size: 12px;margin-bottom: 0px;'><i class='fa fa-check'></i> Delivery Assigned</p>";}else{echo"<p data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery Assign...' style='color:#ccc;font-size: 12px;margin-bottom: 0px;min-height: 0px;'>Delivery Assigned</p>";}  ?></li>

                              <li class="stat"><?php if($row['order_status']==4){echo"<p data-toggle='tooltip' data-placement='auto' title='Order Just Out for Delivery...' style='color:green;font-size: 12px;margin-bottom: 0px;min-height: 0px;'><b><i class='fa fa-check-circle'></i> Out for Delivery</b></p>";}elseif($row['order_status']>=4 && $row['order_status']!=6){echo"<p data-toggle='tooltip' data-placement='auto' title='Order Out for Delivery' style='color:green;font-size: 12px;margin-bottom: 0px;'><i class='fa fa-check'></i> Out for Delivery</p>";}else{echo"<p data-toggle='tooltip' data-placement='auto' title='Waiting for Out for Delivery...' style='color:#ccc;font-size: 12px;margin-bottom: 0px;min-height: 0px;'>Out for Delivery</p>";}  ?></li>

                              <li class="stat"><?php if($row['order_status']==5){echo"<p data-toggle='tooltip' data-placement='auto' title='Order Delivered...' style='color:green;font-size: 12px;margin-bottom: 0px;min-height: 0px;'><b><i class='fa fa-check-circle'></i> Delivered</b></p>";}elseif($row['order_status']>=5 && $row['order_status']!=6){echo"<p  data-toggle='tooltip' data-placement='auto' title='Order Delivered Successfully' style='color:green;font-size: 12px;margin-bottom: 0px;'><i class='fa fa-check'></i> Delivered</p>";}else{echo"<p data-toggle='tooltip' data-placement='auto' title='Waiting for Delivery...' style='color:#ccc;font-size: 12px;margin-bottom: 0px;min-height: 0px;'>Delivered</p>";}  ?></li>
                          </ul>
   
    
                                                    </td>
                                                    <td style="text-align: left">
                                                        <a style="cursor:pointer" onclick="showOrderModal('<?php echo base_url();?>Admin/popup/myadmin/vendor_invoice/<?php echo $row['order_id'];?>');" class="table-link">
                                                        <span  class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-eye ti-eyes fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>
                                                      
<!--                                                        <a  href="<?php //echo base_url(); ?>Admin/newOrders/delete/<?php echo $row['order_id'];?>" class="table-link danger">
                                                        <span class="fa-stack" onclick="return checkDelete();">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-close ti-clos fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>-->
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
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    <!-- /# row -->
                    <!--FOOTER CONTENTS--->
                     <?php include 'footer-contents.php';?>
                    <!---/FOOTER CONTENTS-->
                </section>
            </div>
        </div>
    </div>



     <!-- # footer -->
    <?php include 'footer.php';?>
    <!-- /# footer -->
    <script>
       $(document).ready(function() {
           function hidetab(){    
            $('#mssg').hide();
          }
            setTimeout(hidetab,4000);
       });
    </script>

</body>


</html>