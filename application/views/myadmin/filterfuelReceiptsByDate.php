<?php include 'header-top.php';?>

<body>

    <!-- # sidebar -->
    <?php include 'sidebar.php';?>
    <!-- /# sidebar -->


    <!-- # header -->
    <?php include 'header.php';?>
    <!-- /# header -->
    
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
                                <button class="btn btn-primary" >Add Subadmin</button>
                             </div>-->
                             <div class="card alert">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">                                        
                                        <form action="<?php echo base_url();?>Adminity/filterfuelReceiptByDate" method="post">
                                        <div class="col-md-4">
                                                <div class="basic-form">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                        <input type="text" name="fromdate" required="" class="form-control calendar bg-ash" placeholder="dd/mm/yyyy" id="text-calendar">
                                                        <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <div class="col-md-4">
                                                <div class="basic-form">
                                                    <div class="form-group">
                                                        <label>To</label>
                                                        <input type="text" name="todate" required="" class="form-control calendar bg-ash" placeholder="dd/mm/yyyy" id="text-calendar">
                                                        <span class="ti-calendar form-control-feedback booking-system-feedback m-t-30"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-md-4" style="margin-top: 29px;">
                                                <div class="basic-form">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-info btn-search">Search</button>
                                                    </div>
                                                </div>
                                        </div>
                                            </form>
                                        
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SR.</th>
                                                    <th>Fuel Pump Info.</th>
                                                    <th>Vehicle No.</th>
                                                    <th>Driver Info.</th>
                                                    <th>Supervisor Info.</th>
                                                    <th>Cost(<i class="fa fa-inr"></i>)</th>
                                                    <th>Filled Cost</th>
                                                    <th>Uploaded Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sr=1; foreach($fuel_Receipt_info as $row){?>
                                                <tr>
                                                    <td><?php echo $sr;?></td>
                                                    <td><?php echo $row->vendor_name;?><br>
                                                        <?php echo $row->vendor_contact;?></td>
                                                    <td><?php echo $row->vehicle_no;?></td>
                                                    <td><?php echo $row->driver_name;?><br>
                                                        <?php echo $row->driver_contact;?></td>
                                                    <td><?php echo $row->supervisor_name;?><br>
                                                        <?php echo $row->supervisor_contact;?></td>
                                                    <td><i class="fa fa-inr"></i><?php echo number_format($row->cost,2);?></td>
                                                     <td><i class="fa fa-inr"></i><?php echo number_format($row->filled_cost,2);?></td>
                                                    <td><?php echo $row->createdAt;?></td>
                                                    
                                                </tr>
                                                <?php $sr++; 
                                                 $count= $count+$row->cost;
                                                $fuel_cnt = $fuel_cnt+$row->filled_cost;
                                                }?>    
                                                 <thead>
                                                <tr>
                                                    <th colspan="3">
                                                        Total Entries : <?php echo $sr-1;?>
                                                    </th>
                                                    <th colspan="2" style="">
                                                        Totals:
                                                    </th>
                                                    <th>
                                                        <i class="fa fa-inr"></i><?php echo number_format($count,2);?>
                                                    </th>
                                                      <th>
                                                        <i class="fa fa-inr"></i><?php echo number_format($fuel_cnt,2);?>
                                                    </th>
                                                     <th>
                                                        &nbsp;
                                                    </th>
                                                </tr>
                                                </thead>
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
     <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/calendar-2/pignose.init.js"></script>
    
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