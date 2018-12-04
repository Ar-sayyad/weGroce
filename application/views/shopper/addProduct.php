<?php 
$category=$this->db->get('category')->result(); 
$language=$this->db->get('language')->result(); 
$price_range=$this->db->get('price_range')->result();
$types=$this->db->get('type')->result();
$suitable_types=$this->db->get('suitable_for')->result(); 
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
                                        <h4>Add Product</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Trainerdashboard/products/addProducts" method="post" enctype="multipart/form-data">   
                                    <div class="row">
                                        <div class="col-md-4">                                             
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
                                        <div class="col-md-4"> 
                                            <div class="form-group"> 
                                                <label>Product Title</label> 
                                                <span style="color:red">*</span>
                                                <input type="text" class="form-control" id="product_name" required name="product_name" placeholder="Enter Product Name">
                                            </div>                                          
                                        </div>                                        
                                      <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Language<span style="color:red;">*</span></label>  
                                                    <select name="language_id"  class="chosen-select form-control" required="" > 
                                                       <option value="" disabled="" selected="">--Select Language-- </option>
                                                        <?php                       
                                                        foreach($language as $each)
                                                        { 
                                                        echo "<option value='".$each->language_id."' name='".$each->language_id."'>".$each->language_name."</option>";  
                                                        }
                                                        ?> 
                                                        </select>
                                             </div>
                                          </div>
                                        
                                          <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Price Range (<i class="fa fa-inr"></i>)<span style="color:red;">*</span></label>  
                                                    <select name="price_range_id"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Price Range-- </option>
                                                        <?php                       
                                                        foreach($price_range as $each)
                                                        { 
                                                        echo "<option value='".$each->price_range_id."' name='".$each->price_range_id."'>".$each->price_range."</option>";  
                                                        }
                                                        ?> 
                                                        </select>
                                             </div>
                                          </div>
                                        <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Price(<i class="fa fa-inr"></i>)</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="price"  placeholder="Price">
                                           </div>
                                         </div>  
                                        
                                         <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Suitable for<span style="color:red;">*</span></label>  
                                                    <select name="suitable_for"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Suitable Type-- </option>
                                                        <?php                       
                                                        foreach($suitable_types as $each)
                                                        { 
                                                        echo "<option value='".$each->suitable_id."' name='".$each->suitable_id."'>".$each->suitable_name."</option>";  
                                                        }
                                                        ?> 
                                                        </select>
                                             </div>
                                          </div>                                        
                                                  
                                         <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Exp. Delivery Days</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="delivery_time"  placeholder="Expected Delivery Days">
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
                                                <label>Product Status</label> <span style="color:red">*</span>
                                                <select name="status"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Status--</option>
                                                        <option value="1">In Stock</option>
                                                        <option value="2">Pre-Launch</option>
                                                        <option value="0">Out of Stock</option>
                                                </select>
                                           </div>
                                         </div>
                                        
                                         <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Sample</label> <span style="color:red"></span>
                                                <input type="text" class="form-control"  name="sample"  placeholder="Sample">
                                           </div>
                                         </div> 
                                       
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Punchline</label> <span style="color:red"></span>
                                                <textarea class="form-control" name="punchline"  placeholder="Punchline"></textarea>                                            
                                            </div>  
                                        </div>
                                         
                                         <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" placeholder="Enter description"  name="description"></textarea>
                                              </div>
                                         </div>
                                                                                  
                                        <div class="col-md-4"> 
                                            <div class="form-group">                           
                                                 <label>Upload Product Image<span style="color:red">*</span></label> 
                                                <input type="file" name="productsimg" value="" required="" class="form-control border-none input-flat bg-ash" placeholder="Products Image">
                                            </div> 
                                         </div>

                                        </div>                                                              
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <input type="hidden" value="1" name="product_type">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-save"></i> Add Product</button>
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
