  <?php 
  $category=$this->db->get('category')->result(); 
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
                                
                                <form action="<?php echo base_url();?>Admin/products/editProducts/<?php echo $row['product_id'];?>" method="post" enctype="multipart/form-data">   
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
                                                <label for="exampleInputEmail1">Product Name</label> 
                                                <span style="color:red">*</span>
                                                <input type="text" class="form-control"  value="<?php echo $row['product_title'];?>" required name="product_name" placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                       
                                            
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label>Price Range<span style="color:red;">*</span></label>  
                                                    <select name="price_range_id"  class="chosen-select form-control" required="" > 
                                                        <option value="" disabled="" selected="">--Select Price Range-- </option>
                                                        <?php                       
                                                        foreach($min as $each)
                                                        { ?>
                                                        <option value="<?php echo $each->price_range_id;?>" name="<?php echo $each->price_range_id;?>" <?php if($each->price_range_id==$row['price_range_id']){echo 'selected';} ?>><?php echo $each->price_range;?></option>
                                                       <?php }
                                                        ?> 
                                                        </select>
                                             </div>
                                          </div>
                                        <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Price</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="price" value="<?php echo $row['price'];?>"  placeholder="Price">
                                           </div>
                                         </div>  
                                        
                                         <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Exp. Delivery Days</label> <span style="color:red">*</span>
                                                <input type="text" class="form-control" required name="delivery_time" value="<?php echo $row['delivery_time'];?>"  placeholder="Expected Delivery Days">
                                           </div>
                                         </div> 
                                         <div class="col-md-6"> 
                                             <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" placeholder="Enter description"  name="description"><?php echo $row['description'];?></textarea>
                                              </div>
                                         </div>
                                         

                                          <div class="col-md-6"> 
                                            <div class="form-group"> 
                                              <img id="product_imgess" style="border:1px solid #ccc"  src="<?php echo base_url().'assets/uploads/products/'.$row['product_img'];?>"  width="100px" height="80px">                          
                                                 <label>Product Image<span style="color:red">*</span></label> 
                                                <input type="file" name="productsimg" value="" required="" class="form-control border-none input-flat bg-ash" placeholder="Products Image">
                                            </div> 
                                         </div>  
                                       
                                         
                                        


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
