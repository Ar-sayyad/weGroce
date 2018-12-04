<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
   
 <body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1">  
  <!-- Header -->
  <?php include 'header.php';?>
  
  <?php include 'page_linking.php';?>
   
  <!-- Content -->
  <div id="content"> 
     <!-- Products -->
     <section class="padding-top-10 padding-bottom-60">
      <div class="container">
        <div class="row category-filter">
          
          <!-- Shop Side Bar -->
          <div class="col-md-3 side-filter">
            <div class="shop-side-bar"> 
              
              <!-- Categories -->
              <h6>Categories</h6>
              <div class="checkbox checkbox-primary">
                <ul>
                     <?php foreach($category_info as $row){ ?>            
                  <li>
                    <input id="<?php echo $row->cat_code;?>" name="category_id[]" onChange="filterCategoryProduct()" value="<?php echo $row->category_id;?>"  class="check styled" <?php if($code==$row->cat_code){ echo "checked"; } ?> type="checkbox" >
                    <label for="<?php echo $row->cat_code;?>"> <?php echo strtoupper($row->category_name);?> </label>
                  </li>
                     <?php }?>                  
                </ul>
              </div>
              
              <h6>Price(<i class="fa fa-inr"></i>)</h6>
              <div class="checkbox checkbox-primary">
                <ul>
                     <?php foreach($price_range as $prc){ ?>            
                  <li>
                    <input name="price_range_id[]" onChange="filterCategoryProduct()" value="<?php echo $prc->price_range_id;?>" class="pricechk styled" type="checkbox" >
                    <label> <?php echo $prc->price_range;?> </label>
                  </li>
                     <?php }?>                  
                </ul>
              </div>
        
            </div>
          </div>
          
          <!-- Products -->
          <div class="col-md-9"> 
            
            <!-- Items -->
            <span id="loadproducts"></span>
            <div class="item-col-4 loadproducts"> 
               <?php foreach($product as $prod){ ?>
              <div class="product">
                <article>
                    <a href="<?php echo base_url();?>product/products/<?php echo $prod->product_code;?>/<?php echo $prod->product_url;?>">
                        <img class="img-responsive" src="<?php echo base_url();?>assets/uploads/products/<?php echo $prod->product_img;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>assets/no_image.jpg';"  alt="<?php echo $prod->product_title;?>">
                    </a>
                  <!-- Content --> 
                  <span class="tag"><?php echo $this->admin_model->getCategoryName($prod->category_id);?></span> 
                  <a href="<?php echo base_url();?>product/products/<?php echo $prod->product_code;?>/<?php echo $prod->product_url;?>" class="tittle"><?php echo $prod->product_title;?></a> 
                  <!-- Reviews -->
                <p class="rev">
                    <?php  if ($this->session->userdata('user_login') == 1){?>
                    <span onclick="return likes(<?php echo $prod->product_id; ?>)">
                       <i class="fa fa-thumbs-up"></i>
                       <span style="font-size: 14px;" class="lik<?php echo $prod->product_id;?>"><?php echo !empty($prod->like_count)?$prod->like_count:0;?></span>
                   </span>
                   <input type="hidden" id="liks<?php echo $prod->product_id;?>" value="<?php echo  $prod->like_count;?>"/>
                <?php }else{?>
                <span onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/shop/sendVerificationCode/');">
                    <i class="fa fa-thumbs-up"></i>
                    <span style="font-size: 14px;" class="lik<?php echo $prod->product_id;?>"><?php echo !empty($prod->like_count)?$prod->like_count:0;?></span>
                </span>
                <?php }?>
                <a style="color:#040404;margin-left: 20px;" href="javascript: void(0);" onclick="window.open('https://www.facebook.com/sharer/sharer.php?mode=friend&s=100&p[title]='+encodeURIComponent('<?php echo $prod->product_title;?>') + '&p[summary]=' + encodeURIComponent('<?php echo $prod->description; ?>') + '&p[url]=' + encodeURIComponent('<?php echo base_url();?>') + '&p[images][0]=' + encodeURIComponent('<?php echo base_url();?>assets/uploads/products/<?php echo $prod->product_img;?>'),'facebook-share-dialog','width=626,height=436');return false;"><i class="fa fa-share-alt"></i></a>
                </p>
                <div class="price"><i class="fa fa-inr"></i><?php echo $prod->price;?> </div>
                  <a class="cart-btn cart-plus cart" id="<?php  echo $prod->product_id;?>" amount="<?php echo $prod->price; ?>" title="Add To Cart"><i class="icon-basket-loaded"></i></a> 
                </article>
              </div>
             <?php }?>
              

            </div>
          </div>
        </div>
      </div>
    </section>
 
       
  </div>
  <!-- End Content --> 
  </div>
  <!-- Footer -->
  
  <?php include 'footer.php';?>
  
  <!-- GO TO TOP  --> 
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a> 
  <!-- GO TO TOP End --> 
 <?php include 'footer-bottom.php';?>
 <script>           
         function filterCategoryProduct(){
              var category = [];             
            $.each($(".check:checked"), function(){            
                category.push($(this).val());
            });
             var price = [];             
            $.each($(".pricechk:checked"), function(){            
                price.push($(this).val());
            }); 
            //alert(topics);
            $('.prod_filtering').fadeIn();
            $('.loadproducts').css('opacity','0.2');
            $.post("<?php echo base_url();?>Learningmall/filterCategoryProduct", { categoryId : category, priceId : price  }, function(data){
               // alert(data); 
             	if(data){
                     $('.prod_filtering').fadeOut();
                      $('.loadproducts').html(data);
                       $('.loadproducts').css('opacity','1');
                      //alert(data);
                    }else
			{                               
                               $('.prod_filtering').fadeOut(); //alert(data);
			}
	}).fail(function() {
                alert( "Posting failed." );
            });      
            
         }
         function filterPriceProduct(){
              var price = [];             
            $.each($(".pricechk:checked"), function(){            
                price.push($(this).val());
            });             
            //alert(topics);
            $('.prod_filtering').fadeIn();
            $('.loadproducts').css('opacity','0.2');
            $.post("<?php echo base_url();?>Learningmall/filterPriceProduct", { priceId : price  }, function(data){
               // alert(data);
             	if(data){
                     $('.prod_filtering').fadeOut();
                      $('.loadproducts').html(data);
                       $('.loadproducts').css('opacity','1');
                      //alert(data);
                    }else
			{                               
                               $('.prod_filtering').fadeOut(); //alert(data);
			}
	}).fail(function() {
                alert( "Posting failed." );
            });      
            
         } 
</script>
</body>
</html>