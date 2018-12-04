<?php 

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
                                        <h4>Add Series</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Trainerdashboard/series/addSeries" method="post" enctype="multipart/form-data">   
                                    <div class="row">
                                                                                
                                        <div class="col-md-4"> 
                                            <div class="form-group"> 
                                                <label>Title</label> 
                                                <span style="color:red">*</span>
                                                <input type="text" class="form-control" id="series_title" required name="series_title" placeholder="Enter Title">
                                            </div>                                          
                                        </div>                                        
                                      <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Language<span style="color:red;">*</span></label>  
                                                    <select name="language_id"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Language--</option>
                                                        <?php                       
                                                        foreach($language as $each)
                                                        { 
                                                        echo "<option value='".$each->language_id."' name='".$each->language_id."' >".$each->language_name."</option>";  
                                                        }
                                                        ?> 
                                                        </select>
                                             </div>
                                          </div>                                     
                                        
                                          
                                        
                                        
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label> Select Type <span style="color:red;">*</span></label>  
                                                <select name="video_type"  class="chosen-select form-control" required=""> 
                                                        <option value="" disabled="" selected="">--Select Type--</option>
                                                        <option value="1">Free</option>
                                                        <option value="2">Paid</option>
                                                   </select>
                                             </div>
                                          </div> 
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Duration<span style="color:red;">*</span></label>  
                                                <input type="text" class="form-control" required="" name="duration"  placeholder="Duration(Min/Hours/etc)">
                                             </div>
                                          </div>
                                         <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Suitable for<span style="color:red;">*</span></label>  
                                                    <select name="suitable_for"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Suitable Type--</option>
                                                        <option value="1">Industry</option>
                                                        <option value="2">Person</option>
                                                        <option value="3">Other</option>
                                                        </select>
                                             </div>
                                          </div>  
                                       <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Is Special Offer?</label> <span style="color:red">*</span>
                                                <select name="special_offer"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Is Special Offer?--</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                </select>
                                           </div>
                                         </div>

                                         
                                         <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Youtube Link<span style="color:red;"></span></label>  
                                                     <input type="text" class="form-control" name="youtube_link"  placeholder="Youtube Link">
                                             </div>
                                          </div>
                                           <!-- <div class="col-md-4"> 
                                            <div class="form-group">                           
                                                 <label>Upload Video<span style="color:red"></span></label> 
                                                 <input type="file" name="seriesfile" accept="video/*" class="form-control border-none input-flat bg-ash" placeholder="Media file">
                                            </div> 
                                         </div> -->
                                          <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Price Range (<i class="fa fa-inr"></i>)<span style="color:red;">*</span></label>  
                                                    <select name="price_range_id"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Price Range--</option>
                                                        <?php                       
                                                        foreach($min as $each)
                                                        { 
                                                        echo "<option value='".$each->price_range_id."' name='".$each->price_range_id."' >".$each->price_range."</option>";  
                                                        }
                                                        ?> 
                                                  </select>
                                             </div>
                                          </div>

                                         
                                        <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Price(<i class="fa fa-inr"></i>)</label> <span style="color:red"></span>
                                                <input type="text" class="form-control" name="price" value="0"  placeholder="Price">
                                           </div>
                                         </div>  
                                        
                                         
                                        
                                          
                                        

                                         
                                         <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" placeholder="Enter description"  name="series_descriptiom"></textarea>
                                              </div>
                                         </div>
                                              
                                        
                                        
                                        
                                        
                                        

                                        </div>                                                              
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-save"></i> Add Series</button>
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
