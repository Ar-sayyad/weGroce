  <?php 
  $category=$this->db->get('category')->result(); 
$language=$this->db->get('language')->result(); 
$min=$this->db->get('price_range')->result();
$single_info = $this->db->get_where('course', array('course_id' => $param2))->result_array();
foreach ($single_info as $row) {

?>
<!-- Styles -->
<style type="text/css">
input[type=checkbox]
{
    margin: 15px 0 0;
}
</style>
   <section id="main-content">
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Edit  Cources</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Trainerdashboard/Cources/editCources/<?php echo $row['course_id'];?>" method="post" enctype="multipart/form-data">   
                                     <div class="row">
                                        <div class="col-md-6">                                             
                                            <div class="form-group">
                                                <label class="control-label no-padding-right" for="form-field-1">Category <span style="color:red;">*</span>: 
                                                </label>  
                                                    <select   required name="category_id" id="category" class="chosen-select form-control" onchange="getsubcategory(this.id);">
                                                        <option value="" disabled="" selected="">--Select Category-- </option>
                                                        <?php                       
                                                        foreach($category as $each)
                                                        { ?>
                                                        <option value="<?php echo $each->category_id;?>" name="<?php echo $each->category_id;?>" <?php if($each->category_id==$row['category_id']){echo 'selected';} ?>><?php echo $each->category_name;?></option>
                                                       <?php }
                                                        ?> 
                                                        </select>
                                                </div> 
                                         </div>                                        
                                        <div class="col-md-6"> 
                                            <div class="form-group"> 
                                                <label>Cources Title</label> 
                                                <span style="color:red">*</span>
                                                <input type="text" class="form-control" id="course_name" required name="course_name" placeholder="Enter Cources Name" value="<?php echo $row['course_name'];?>">
                                            </div>                                          
                                        </div>                                        
                                      
                                        <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Duration</label> 
                                                <input type="text" class="form-control"  name="cources_duration"  placeholder="Duration" value="<?php echo $row['cources_duration'];?>">
                                           </div>
                                         </div>   
                                          
                                        

                                         <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" placeholder="Enter description"  name="course_description"><?php echo $row['course_description'];?></textarea>
                                              </div>
                                         </div> 
                                        <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Price(<i class="fa fa-inr"></i>)</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="cources_price"  placeholder="Price" value="<?php echo $row['cources_price'];?>">
                                           </div>
                                         </div> 
                                                                              
                                                  
                                         
                                        
                                        
                                        
                                        
                                        
                                         
                                       
                                        
                                         
                                         
                                                                                  
                                        

                                        </div>                                                              
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-save"></i>UpdateCources</button>
                                            <button type="button" class="btn btn-primary btn-lg border-none sbmt-btn" data-dismiss="modal"><i class="ti-close"></i> Close</button>
                                        </div>  
                                   </div>                                                              
                                </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                  
                    
         
                    
   </section>
<?php }
?>
    <!-- scripit init-->
