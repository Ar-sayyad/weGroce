<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
    <style>
        .owl-controls{
           display: none; 
        }
    </style>
 <body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1">  
  <!-- Header -->
  <?php include 'header.php';?>
  
  <?php include 'page_linking.php';?>
   
  <!-- Content -->
  <div id="content"> 
    
    <!-- Products -->
    <section class="featur-tabs padding-top-0 padding-bottom-30">
      <div class="container">
          <?php foreach($category_info as $row){ ?>
        <h5 class="padding-top-10 padding-bottom-10 catheading"> 
            <?php echo strtoupper($row->category_name);?>
        </h5>
        <!-- Tab panes -->
        <div class="tab-content row">
            
                <?php  $where =array('category_id'=>$row->category_id);
                            $this->db->limit(4);
                            $products = $this->admin_model->record_list('products',$where);
                           if($products)
                            {
                            foreach($products as $prod){ ?>
      <div class="col-xl-3 col-lg-3 col-md-3"> 
              <div class="product">
                <article>
                      <a href="<?php echo base_url();?>product/products/<?php echo $prod->product_code;?>/<?php echo $prod->product_url;?>">
                        <img class="img-responsive" src="<?php echo base_url();?>assets/uploads/products/<?php echo $prod->product_img;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>assets/no_image.jpg';"  alt="<?php echo $prod->product_title;?>">
                    </a><!-- Content --> 
                  <span class="tag"><?php echo strtoupper($row->category_name);?></span> 
                  <a href="<?php echo base_url();?>product/products/<?php echo $prod->product_code;?>/<?php echo $prod->product_url;?>" class="tittle">
                      <?php echo $prod->product_title;?>
                  </a> 
                  <!-- Reviews -->
                  <BR>
<!--                 <p class="rev">
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
                </div>   
              <?php }
                     }?>
                    
        </div>
          <?php } ?>
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