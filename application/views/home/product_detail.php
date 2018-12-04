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
          
          <!-- Products -->
          <div class="col-md-12 sigl-prod">
              <?php foreach($single_prod_info as $prod){ ?>
            <div class="product-detail">
              <div class="product">
                <div class="row"> 
                  <!-- Slider Thumb -->
                  <div class="col-xs-5">
                      <article class="slider-item on-nav" style="height:auto">
                      <div class="thumb-slider">
                        <ul class="slides">
                          <li data-thumb="<?php echo base_url();?>assets/uploads/products/<?php echo $prod->product_img;?>">
                              <img style="height: 400px;" src="<?php echo base_url();?>assets/uploads/products/<?php echo $prod->product_img;?>" alt="<?php echo $p_name;?>" > </li>
                         
                          <!--<?php $multiple_img = $this->admin_model->get_multiple_img($prod->product_id);
                                foreach($multiple_img as $img){ ?>
                            
                                <li class="col-xs-3" data-thumb="<?php echo base_url();?>assets/uploads/products/<?php echo $img['product_img'];?>"> <img src="<?php echo base_url();?>assets/uploads/products/<?php echo $img['product_img'];?>" alt="<?php echo $p_name;?>" > </li>
                         
                          <?php } ?>-->
                         
                         </ul>
                      </div>
                    </article>
                  </div>
                  <!-- Item Content -->
                  <div class="col-xs-7"> <span class="tags"><?php echo $c_name;?></span>
                    <h5><?php echo $p_name;?></h5>
                    <div class="row">
                      <div class="col-sm-6"><span class="price">Price :  <i class="fa fa-inr"></i><?php echo $prod->price;?> </span></div>
                      <div class="col-sm-6">
                        <p>Availability: <span class="in-stock">
                          <?php if($prod->status ==0){ echo 'Out Of Stock'; }elseif($prod->status==1){ echo 'In Stock';}else{ echo 'Pre-Launch';} ?>     
                            </span></p>
                      </div>
                    </div>
                    <!-- List Details -->
                    <ul class="bullet-round-list">
                        <li>Category :<?php echo $c_name;?></li>
                      <!--<li>Sample: <?php echo $prod->sample;?></li>-->
                      <!--<li>Special Offers: <?php if($prod->special_offer=='0'){ echo 'No';}else{ echo 'Yes'; }?></li>-->
                      <li>Exp. Delivery : <?php echo $prod->delivery_time;?> Days</li>
                      <li>Description: <?php echo $prod->description;?></li>
                      <!--<li>Youtube Link: <?php echo $prod->youtube_link;?></li>-->
                    </ul>                  
                    <!-- Quinty -->
                    <div class="quinty">
                        <input type="number" class="form-control" id="prd_qty" min="1" max="10" value="1">
                    </div>
                    <a class="btn cart-plus-qty" id="<?php echo $prod->product_id;?>"><i class="icon-basket-loaded margin-right-5"></i> Add to Cart</a> </div>
                </div>
              </div>
<!--                <hr>-->
              <!-- Details Tab Section-->
<!--              <div class="item-tabs-sec"> 
                
                 Nav tabs 
                <ul class="nav" role="tablist">
                  <li role="presentation" class="active"><a href="#pro-detil"  role="tab" data-toggle="tab">Product Details</a></li>
                  <li role="presentation"><a href="#cus-rev"  role="tab" data-toggle="tab">Customer Reviews</a></li>
                  <li role="presentation"><a href="#ship" role="tab" data-toggle="tab">Shipping & Payment</a></li>
                </ul>
                
                 Tab panes 
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="pro-detil"> 
                     List Details 
                    <ul class="bullet-round-list">
                      <li>Power Smartphone 7s G930F 128GB International version - Silver</li>
                      <li> 2G bands: GSM 850 / 900 / 1800 / 1900 3G bands: HSDPA 850 / 900 / 1900 / 2100 4G bands: LTE 700 / 800 / 850<br>
                        900 / 1800 / 1900 / 2100 / 2600</li>
                      <li> Dimensions: 142.4 x 69.6 x 7.9 mm (5.61 x 2.74 x 0.31 in) Weight 152 g (5.36 oz)</li>
                      <li> IP68 certified - dust proof and water resistant over 1.5 meter and 30 minutes</li>
                      <li> Internal: 128GB, 4 GB RAM </li>
                    </ul>
                    
                  </div>
                    <div role="tabpanel" class="tab-pane fade" id="cus-rev">
                        <ul class="bullet-round-list">
                      <li>Power Smartphone 7s G930F 128GB International version - Silver</li>
                      <li> 2G bands: GSM 850 / 900 / 1800 / 1900 3G bands: HSDPA 850 / 900 / 1900 / 2100 4G bands: LTE 700 / 800 / 850<br>
                        900 / 1800 / 1900 / 2100 / 2600</li>
                      <li> Dimensions: 142.4 x 69.6 x 7.9 mm (5.61 x 2.74 x 0.31 in) Weight 152 g (5.36 oz)</li>
                      <li> IP68 certified - dust proof and water resistant over 1.5 meter and 30 minutes</li>
                      <li> Internal: 128GB, 4 GB RAM </li>
                    </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="ship">
                        <ul class="bullet-round-list">
                      <li>Power Smartphone 7s G930F 128GB International version - Silver</li>
                      <li> 2G bands: GSM 850 / 900 / 1800 / 1900 3G bands: HSDPA 850 / 900 / 1900 / 2100 4G bands: LTE 700 / 800 / 850<br>
                        900 / 1800 / 1900 / 2100 / 2600</li>
                      <li> Dimensions: 142.4 x 69.6 x 7.9 mm (5.61 x 2.74 x 0.31 in) Weight 152 g (5.36 oz)</li>
                      <li> IP68 certified - dust proof and water resistant over 1.5 meter and 30 minutes</li>
                      <li> Internal: 128GB, 4 GB RAM </li>
                    </ul>
                    </div>
                </div>
              </div>-->
            </div>
              <?php } ?>
          
          </div>
        </div>
      </div>
    </section>
    
    <!-- Your Recently Viewed Items -->
    <section class="padding-bottom-60">
      <div class="container"> 
        
        <!-- heading -->
        <div class="heading">
          <h2>Suggested Items</h2>
          <hr>
        </div>
        <!-- Items Slider -->
          <div class="item-slide-5 with-nav  middle-nav"> 
              <!-- Product -->
               <?php foreach($prod_info as $prod){ ?>
              <div class="product">
                <article>
                    <a href="<?php echo base_url();?>product/products/<?php echo $prod->product_code;?>/<?php echo $prod->product_url;?>">
                        <img class="img-responsive" src="<?php echo base_url();?>assets/uploads/products/<?php echo $prod->product_img;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>assets/no_image.jpg';"  alt="<?php echo $prod->product_title;?>">
                    </a>
                  <!-- Content --> 
                  <span class="tag"><?php echo $this->admin_model->getCategoryName($prod->category_id);?></span> 
                  <a href="<?php echo base_url();?>product/products/<?php echo $prod->product_code;?>/<?php echo $prod->product_url;?>" class="tittle"><?php echo $prod->product_title;?></a> 
                  <!-- Reviews -->
                  <br>
<!--                <p class="rev">
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
                </p>-->
                <div class="price"><i class="fa fa-inr"></i><?php echo $prod->price;?> </div>
               <a class="cart-btn cart-plus cart" id="<?php  echo $prod->product_id;?>" amount="<?php echo $prod->price; ?>" title="Add To Cart"><i class="icon-basket-loaded"></i></a> 
                </article>
              </div>
             <?php }?>
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

</body>
</html>