<?php 
$single_category_info = $this->db->get_where('language', array('language_id' => $param2))->result_array();
foreach ($single_category_info as $row) {
?>
<!-- Styles -->
    <link href="<?php echo base_url();?>mypanel/assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
       <section id="main-content">
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Edit Category</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Trainerdashboard/language/editLanguage/<?php echo $row['language_id'];?>" method="post" enctype="multipart/form-data">   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                    <div class="col-md-4">
                                                        <label>Category Name <span class="required">*</span></label>
                                                    </div>
                                                 <div class="col-md-8">
                                                    <input type="text"  name="language_name" required="" value="<?php echo $row['language_name'];?>" class="form-control border-none input-flat  bg-ash" placeholder="Language Name">
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                                             
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-save"></i> Edit Language</button>
                                            <button type="button" class="btn btn-primary btn-lg border-none sbmt-btn" data-dismiss="modal"><i class="ti-close"></i> Close</button>
                                        </div>  
                                   </div>
                                </div>                                
                                </form>
                            </div>
                        </div>
                    </div>
                  
                    
         
                    
   </section>
<?php } ?>
    <!-- scripit init-->
