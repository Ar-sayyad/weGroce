
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
    <?php $order_status= $this->admin_model->OrderStatus($row['order_id'])->order_status; ?>
      <?php if($row['partially_del_status']==1){ ?>
      <a>Partially Delivery Assigned.</a>
      <?php }else{?>
      <select class="form-control" name="order_status" onchange="addstatus(this.value,<?php echo $row['order_id'];?>,<?php echo $row['contact'];?>);" style="width: 160px" >
          <option value="1"<?php if($order_status==1){echo"selected";}elseif($order_status>=1){echo"disabled";} ?>>Order Placed</option>
          <option value="2"<?php if($order_status==2){echo"selected";}elseif($order_status>=2){echo"disabled";}  ?>>Processing</option>
          <option value="3"<?php if($order_status==3){echo"selected";}elseif($order_status>=3){echo"disabled";}  ?>>Delivery Assigned</option>
          <option value="4"<?php if($order_status==4){echo"selected";}elseif($order_status>=4){echo"disabled";}  ?>>Out for Delivery</option>
          <option value="5"<?php if($order_status==5){echo"selected";}elseif($order_status>=5){echo"disabled";}  ?>>Delivered</option>
          <option value="6"<?php if($order_status==6){echo"selected";}elseif($order_status==5){echo"disabled";}  ?>>Cancelled</option>
          
      </select>
      
     <?php } ?>
   
    
                                                    </td>
                                                    <td style="text-align: left">
                                                        <a style="cursor:pointer" onclick="showOrderModal('<?php echo base_url();?>Admin/popup/trainer/vendor_invoice/<?php echo $row['order_id'];?>');" class="table-link">
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
    <script type="text/javascript">
      function addstatus(sr,id,contact)
      {
        if(sr==4)
        {

             
                      showAjaxModal('<?php echo base_url();?>Trainerdashboard/mypopup/trainer/deliveryMainDetail/'+id+'/'+ contact);
        }
        else
        {
              $.post("<?php echo base_url();?>Trainerdashboard/changeOrderStatus",{ order_id: id, order_status:sr, contact:contact }, function(data){
                 
                     if(data==1){
                       location.reload();                                            
                      }else
                          {
                                  alert(data);
                          }
                  }).fail(function() {
                  alert( "Posting failed." );
              });
          }
      }
    </script>
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