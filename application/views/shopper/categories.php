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
                            <!-- <div class="addbtn">
                                <button data-toggle="modal" onclick="showAjaxModal('<?php echo base_url();?>Trainerdashboard/popup/trainer/addCategory');" class="btn btn-danger" >Add Category</button>
                             </div> -->
                           <div class="card alert">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center">SR.</th>
                                                   <th style="text-align: center">Image</th>
                                                    <th style="text-align: center">Category</th>
                                                   <!--  <th style="text-align: left">Edit</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sr=1; foreach($category_info as $row){?>
                                                <tr>
                                                    <td style="text-align: center"><?php echo $sr;?></td>
                                                    <td style="text-align: center"><img class="main_img" style="width: 120px;height: 120px;cursor: pointer;border:1px solid #ccc" title="Change Image"  src="<?php echo base_url().'assets/uploads/category/'.$row->category_img; ?>"></td>
                                                    <td style="text-align: center"><?php echo ucwords($row->category_name);?></td>
                                                    
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