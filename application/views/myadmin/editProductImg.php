<?php 
$category=$this->db->get('category')->result(); 
$single_info = $this->db->get_where('products', array('product_id' => $param2))->result_array();
$img_info = $this->db->get_where('product_images', array('product_id' => $param2))->result_array();

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
<!--                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Update Products Image</h4>                                        
                                    </div>
                                </div>-->
                                <form action="<?php echo base_url();?>Admin/products/editProductImg/<?php echo $row['product_id'];?>" method="post" enctype="multipart/form-data">   
                                    <div class="row">                                                                         
                                        <div class="col-md-12">
                                        
                                             <div class="col-md-3"> 
                                                <div class="form-group">                           
                                                     <label>Product Image<span style="color:red"></span></label>                                                     
                                                </div> 
                                            </div> 
                                 
                                          
                                      
                                            <div class="col-md-9">
                                                    <?php 
                                                   if($img_info) 
                                            {                                     
                                                   foreach ($img_info as $img) 
                                                  { // $imgid =  "img".$k;
                                                 
                                                     ?>
                                                <div class="form-group">
                                                     <img id="product_imgess" style="border:1px solid #ccc"  src="<?php echo base_url().'assets/uploads/products/'.$img['product_img'];?>"  width="250px" height="100px">
                                                 <a href="#" onclick="deleteParentElement(<?php echo $img['image_id'];?>)"  > <span class="btn btn-xs btn-info btn-flat admin-btns event_image_delete">
                                                        <span class="fa fa-trash-o gly-del"></span>
                                                        </span>
                                                 </a>
                                                </div>
                                               
                                                     
                                                  
                                                <?php                                     
                                                }
                                              } 
                                              ?> 
                                                
                                            </div>
                                        
                                            
                                         </div>
                                        
                                        <div class="col-md-12"> 
                                            <div class="col-md-3"> 
                                            <div class="form-group">                           
                                                 <label>Upload Image<span style="color:red">*</span></label>                                                 
                                            </div> 
                                            </div>
                                            <div class="col-md-7 field_wrapper_image"> 
                                               
                                            <div class="form-group ">                           
                                                <input type="file" name="product_img[]" required="" class="form-control border-none input-flat bg-ash" placeholder="Products Image">
                                      
                                            </div>                                        
                                         </div>
                                        
                                        </div>                                      
                                                              
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                           
                                            <button type="button" onclick="add_image();" class="btn btn-info btn-lg  border-none sbmt-btn admin-btns">Add Image</button>
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

  <script type="text/javascript"> 

function add_image() {

    var maxField = 7; 

    var x = 1;

     

         $('.field_wrapper_image').append();
          if(x < maxField){ 
              x++; 
              $('.field_wrapper_image').append('<div class="col-md-7"><div class="form-group "><input type="file" name="product_img[]" style="width: 182%;margin-left: -6px;" required="" class="form-control border-none input-flat bg-ash" placeholder="Products Image"></div></div>');   
            }
}

function call_to_methods1(image_id,key)
 {
  //alert(image_id);
    var result=doconfirm();
    
    if(result)
    {
       remove_image(image_id,key);
    }

 }
 
 function deleteParentElement(id)
{
 
    $.post("<?php echo base_url(); ?>admin/delete_product",
        {
             id:id
             
        },
        function(data)
        {
           if(data==1) 
           {
            alert('Recored Deleted Succesfully');
            setTimeout(function(){location.reload();},2000);
           }
        });   

}
  function doconfirm()
{
  //alert("hiii");
    job=confirm("Are you sure to Delete ?");
    if(job!=true)
    {
        return false;
    }
    return true;
}
 

function remove_image(image_id,key)
  {    
      var base_url= "<?php echo base_url();?>";
      var image_idab = $('#image_id_'+image_id).val();
      var image_name = $('#image_name_'+image_id).val();
      
      var imgsrc = $('#img'+key).attr('src');
     // alert(imgsrc);

      $.ajax({
        type: "POST",
        url: base_url+"products/product_image_delete",
        data: {'image_id': image_idab,'imgsrc':imgsrc,image_name:image_name},        
        dataType: "json",
        success: function(data) {
            if(data.result=="success"){  
               $("#image_"+image_id).hide(); 
            } 
        }
      });      
  }
</script>
    <!-- scripit init-->
