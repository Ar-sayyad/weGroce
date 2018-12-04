<?php $admin_info = $this->db->get_where('tbl_admin', array('admin_id' => $param2))->result_array();
 foreach ($admin_info as $row) {

?>
<!-- Styles -->
   <section id="main-content">
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Change Profile Image</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Adminity/profile/updateImage/<?php echo $row['admin_id'];?>" method="post" enctype="multipart/form-data">   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <label>Current Image <span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                        <div class="user-photo m-b-20">
                                                            <img class="img-responsive" style="width: 250px;" src="<?php echo base_url();?>assets/uploads/profile/<?php echo $row['profile_pic'];?>" alt="Admin Image Not Set" />
                                                            <input type="hidden" name="old_admin_profile" value="<?php echo $row['profile_pic'];?>"/>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class="col-md-4">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Upload New Image<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-8">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <input type="file" name="userfile" value="" required="" class="form-control border-none input-flat bg-ash" placeholder="Profile Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                                          
                                                                       
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-pencil-alt"></i> Update Profile Image</button>
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
