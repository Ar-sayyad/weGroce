  <?php 
  $category=$this->db->get('category')->result(); 
$language=$this->db->get('language')->result(); 
$min=$this->db->get('price_range')->result();
$single_info = $this->db->get_where('products', array('product_id' => $param2))->result_array();
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
                                        <h4>Edit  Products</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Trainerdashboard/products/editProducts/<?php echo $row['product_id'];?>" method="post" enctype="multipart/form-data">   
                                    <div class="row">
                                        <div class="col-md-4">                                             
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
                                        <div class="col-md-4"> 
                                            <div class="form-group"> 
                                                <label for="exampleInputEmail1">Product Title</label> 
                                                <span style="color:red">*</span>
                                                <input type="text" class="form-control"  value="<?php echo $row['product_title'];?>" required name="product_name" placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Language<span style="color:red;">*</span></label>  
                                                    <select name="language_id"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Language--</option>
                                                        <?php                       
                                                        foreach($language as $each)
                                                        { ?>
                                                        <option value="<?php echo $each->language_id;?>" name="<?php echo $each->language_id;?>" <?php if($each->language_id==$row['language_id']){echo 'selected';} ?>><?php echo $each->language_name;?></option>  
                                                       <?php }
                                                        ?> 
                                                        </select>
                                             </div>
                                          </div>
                                            
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Price Range<span style="color:red;">*</span></label>  
                                                    <select name="price_range_id"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Price Range--</option>
                                                        <?php                       
                                                        foreach($min as $each)
                                                        { ?>
                                                        <option value="<?php echo $each->price_range_id;?>" name="<?php echo $each->price_range_id;?>" <?php if($each->price_range_id==$row['price_range_id']){echo 'selected';} ?>><?php echo $each->price_range;?></option> 
                                                        <?php }
                                                        ?> 
                                                        </select>
                                             </div>
                                          </div>
                                        <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Price</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="price" value="<?php echo $row['price'];?>"  placeholder="Price">
                                           </div>
                                         </div>  
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Product Type<span style="color:red;">*</span></label>  
                                                    <select name="product_type"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="">--Select Product Type--</option>
                                                        <option value="1" <?php if($row['product_type']==1)echo 'selected'; ?>>Product</option>
                                                        <option value="2" <?php if($row['product_type']==2)echo 'selected'; ?>>Video</option>
                                                        <option value="3" <?php if($row['product_type']==3)echo 'selected'; ?>>Audio</option>
                                                        <option value="4" <?php if($row['product_type']==4)echo 'selected'; ?>>Other</option>
                                                        </select>
                                             </div>
                                          </div>
                                         <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Suitable for<span style="color:red;">*</span></label>  
                                                    <select name="suitable_for"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="">--Select Suitable Type--</option>
                                                        <option value="1" <?php if($row['suitable_for']==1)echo 'selected'; ?>>Industry</option>
                                                        <option value="2" <?php if($row['suitable_for']==2)echo 'selected'; ?>>Person</option>
                                                        <option value="3" <?php if($row['suitable_for']==3)echo 'selected'; ?>>Other</option>
                                                        </select>
                                             </div>
                                          </div>                                        
                                                  
                                         <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Expected Delivery Days</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="delivery_time" value="<?php echo $row['delivery_time'];?>"  placeholder="Expected Delivery Days">
                                           </div>
                                         </div> 
                                        
                                         <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Sample</label> <span style="color:red"></span>
                                                <input type="text" class="form-control"  name="sample" value="<?php echo $row['sample'];?>"  placeholder="Sample">
                                           </div>
                                         </div>

                                          <div class="col-md-4"> 
                                            <div class="form-group"> 
                                              <img id="product_imgess" style="border:1px solid #ccc"  src="<?php echo base_url().'assets/uploads/products/'.$row['product_img'];?>"  width="250px" height="150px">                          
                                                 <label>Product Image<span style="color:red">*</span></label> 
                                                <input type="file" name="productsimg" value="" required="" class="form-control border-none input-flat bg-ash" placeholder="Products Image">
                                            </div> 
                                         </div>  
                                       
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label>Punchline</label> <span style="color:red"></span>
                                                <textarea class="form-control" name="punchline"  placeholder="Punchline"><?php echo $row['punchline'];?></textarea>                                            
                                            </div>  
                                        </div>
                                         
                                         <div class="col-md-4"> 
                                             <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" placeholder="Enter description"  name="description"><?php echo $row['description'];?></textarea>
                                              </div>
                                         </div>
                                                                                  
                                        <!--<div class="col-md-4"> 
                                            <div class="form-group">                           
                                                 <label>Upload Product Image<span style="color:red">*</span></label> 
                                                <input type="file" name="productsimg" value="" required="" class="form-control border-none input-flat bg-ash" placeholder="Products Image">
                                            </div> 
                                         </div>-->


                                        </div>                                      
                                                              
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-pencil-alt"></i> Update</button>
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
