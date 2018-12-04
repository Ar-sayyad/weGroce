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
                                <button data-toggle="modal" onclick="showAjaxModal('<?php echo base_url();?>Adminity/popup/myadmin/addSubadmin');" class="btn btn-primary" >Add Subadmin</button>
                             </div>-->
                           <div class="card alert">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SR.</th>
                                                    <th>OTP</th>
                                                    <th style="text-align: left">Date</th>
<!--                                                    <th style="text-align: left">Actions</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sr=1; foreach($otp_info as $row){?>
                                                <tr>
                                                    <td><?php echo $sr;?></td>
                                                    <td><b><?php echo $row->OTP;?></b></td>
                                                    <td style="text-align: left"><?php echo $row->date;?></td>
<!--                                                    <td style="text-align: left">
                                                        <a style="cursor:pointer" href="<?php echo base_url();?>Adminity/generateOtp/update/<?php echo $row->otp_id;?>" class="table-link">
                                                         <span class="tooltiptext">Generate New OTP</span>
                                                         <span  class="fa-stack" onclick="return checkOTP();">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-reload ti-pencil-al fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>
                                                    </td>-->
                                                </tr>
                                                <?php $sr++; }?>    
                                                
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