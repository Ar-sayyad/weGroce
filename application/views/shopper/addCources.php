<?php 
$category=$this->db->get('category')->result(); 
$language=$this->db->get('language')->result(); 
$min=$this->db->get('price_range')->result();
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
                                        <h4>Add Cources</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Trainerdashboard/Cources/addCources" method="post" enctype="multipart/form-data">   
                                    <div class="row">
                                        <div class="col-md-6">                                             
                                            <div class="form-group">
                                                <label class="control-label no-padding-right" for="form-field-1">Category <span style="color:red;">*</span>: 
                                                </label>  
                                                    <select   required name="category_id" id="category" class="chosen-select form-control" onchange="getsubcategory(this.id);">
                                                        <option value="" disabled="" selected="">--Select Category-- </option>
                                                        <?php                       
                                                        foreach($category as $each)
                                                        { 
                                                        echo "<option value='".$each->category_id."' name='".$each->category_id."'>".$each->category_name."</option>";  
                                                        }
                                                        ?> 
                                                        </select>
                                                </div> 
                                         </div>                                        
                                        <div class="col-md-6"> 
                                            <div class="form-group"> 
                                                <label>Cources Title</label> 
                                                <span style="color:red">*</span>
                                                <input type="text" class="form-control" id="course_name" required name="course_name" placeholder="Enter Cources Name">
                                            </div>                                          
                                        </div>                                        
                                      
                                        <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Duration</label> 
                                                <input type="text" class="form-control"  name="cources_duration"  placeholder="Duration">
                                           </div>
                                         </div>   
                                          
                                        

                                         <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" placeholder="Enter description"  name="course_description"></textarea>
                                              </div>
                                         </div> 
                                        <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Price(<i class="fa fa-inr"></i>)</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="cources_price"  placeholder="Price">
                                           </div>
                                         </div> 
                                                                              
                                                  
                                         
                                        
                                        
                                        
                                        
                                        
                                         
                                       
                                        
                                         
                                         
                                                                                  
                                        

                                        </div>                                                              
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-save"></i> Add Cources</button>
                                            <button type="button" class="btn btn-primary btn-lg border-none sbmt-btn" data-dismiss="modal"><i class="ti-close"></i> Close</button>
                                        </div>  
                                   </div>
                                 </form>
                                </div>                          
                             </div>
                        </div>
                    </div>
                  
                    
         
                    
   </section>

    <!-- scripit init-->
