
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
                            <div class="addbtn">
                                <button data-toggle="modal" onclick="showAjaxModal('<?php echo base_url();?>Admin/popup/myadmin/addVideo');" class="btn btn-danger" >Add Video/Audio</button>
                             </div>
                             <div class="card alert">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SR.</th>
                                                    <th>Media</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Type</th>
                                                    <th style="text-align: left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $sr=1; foreach($products_info as $row){
                                                    //echo "<pre>";print_r($products_info);die()?>
                                                <tr>
                                                    <td><?php echo $sr;?></td>
                                                     <td>
                                                         <video width="300" height="150" oncontextmenu="return false;" controls controlsList="nodownload">
                                                            <source src="<?php echo base_url().'assets/uploads/videos/'.$row->video_path; ?>" type="video/mp4">
                                                            <source src="<?php echo base_url().'assets/uploads/audios/'.$row->audio_path; ?>" type="audio/mp3">
                                                            Your browser does not support HTML5 video.
                                                          </video>
                                                     </td>
                                                    <td><?php echo ucwords($row->product_title);?></td>
                                                    <td><i class="fa fa-inr"></i><?php echo $row->price;?></td>
                                                    <td><?php if($row->product_type==2)
                                                    { 
                                                        echo "Video";
                                                    }
                                                     else {
                                                         echo "Audio";
                                                     }
                                                     ?></td>
                                                    <td style="text-align: left">
                                                        <a style="cursor:pointer" onclick="showAjaxModal('<?php echo base_url();?>Admin/popup/myadmin/viewVideo/<?php echo $row->media_id;?>');" class="table-link">
                                                        <span  class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-eye ti-eyes fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                       </a>
                                                        
                                                        <!--<a style="cursor:pointer" onclick="showAjaxModal('<?php echo base_url();?>Admin/popup/myadmin/editVideo/<?php echo $row->media_id;?>');" class="table-link">
                                                        <span  class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-pencil-alt ti-pencil-al fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>-->
                                                        
                                                        <a href="<?php echo base_url(); ?>Admin/videos/delete/<?php echo $row->media_id;?>" class="table-link danger">
                                                        <span class="fa-stack" onclick="return checkDelete();">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="ti-close ti-clos fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        </a>
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