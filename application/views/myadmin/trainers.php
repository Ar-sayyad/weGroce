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
                                <button data-toggle="modal" onclick="showAjaxModal('<?php echo base_url();?>Admin/popup/myadmin/addUser');" class="btn btn-primary" >Add User</button>
                             </div>-->
                           <div class="card alert">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SR.</th>
                                                    <!--<th>Image</th>-->
                                                    <th>UserName</th>
                                                    <th>Designation</th>
                                                    <th>Followers</th>
                                                    <th>Rating</th>
                                                    <th style="text-align: left">View</th>
                                                    <th>Login</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                                
                                                        //echo count($trainer_info['data']);
                                                $sr=1; foreach($trainer_info['data'] as $row){?>
                                                <tr>
                                                    <td><?php echo $sr;?></td>
                                                    <!--<td><img src="<?php echo !empty($row['attachmentUrl'])?$row['attachmentUrl']:'';?>" alt="No Image"></td>-->
                                                    <td><?php echo ucwords($row['firstName']." ".$row['lastName']);?></td>
                                                    <td><?php echo !empty($row['designation'])?$row['designation']:'';?></td>
                                                    <td><?php echo $row['totalFollowers'];?></td>
                                                    <td><?php echo number_format($row['averageRating'],2);?></td>
                                                    <td style="text-align: left">
                                                        <a style="cursor:pointer" onclick="showAjaxModal('<?php echo base_url();?>Admin/popup/myadmin/viewTrainer/<?php echo $row['id'];?>');" class="table-link">
                                                        <span  class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-eye ti-eyes fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>
                                                        </td>
                                                        <td>
                                                        <a style="cursor:pointer" href="<?php echo base_url();?>Login/Checkvendors/<?php echo $row['id'];?>" target="_blank" class="table-link">
                                                        <span  class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-sign-in fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>
                                                        </td>
                                                        <!--
                                                        <a style="cursor:pointer" onclick="showAjaxModal('<?php echo base_url();?>Admin/popup/myadmin/editUser/<?php echo $row->id;?>');" class="table-link">
                                                        <span  class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-pencil-alt ti-pencil-al fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>
                                                        
                                                        <a  href="<?php echo base_url(); ?>Admin/users/delete/<?php echo $row->id;?>" class="table-link danger">
                                                        <span class="fa-stack" onclick="return checkDelete();">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-close ti-clos fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>-->
                                                    </td>
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