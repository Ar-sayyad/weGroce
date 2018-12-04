<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
  
<body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1"> 
  <!-- Header -->

  <?php include 'header.php';?>  
  <!-- Slider Section -->
  <section class="slid-sec">
    <div class="">
      <div class="container-fluid">
        <div class="row"> 
          
          <!-- Main Slider  -->
          <div class="col-md-12 no-padding"> 
            
            <!-- Main Slider Start -->
            <div class="tp-container">
                <div class="tp-" style="">
                <img id="bg" src="<?php echo base_url();?>home/images/img/bg.jpg"  alt="slider" data-bgposition="center bottom" data-bgfit="cover" data-bgrepeat="no-repeat"> 
                </div>
            </div>
          </div>          
          <!-- Main Slider  -->

        </div>
      </div>
    </div>
  </section>
  
  <!-- tab Section -->
        <section class="shipping-info">
      <div class="" >
        <ul> 
          <li>
            <div class="media-left"><i class="fa fa-th-large"></i></div>
            <div class="media-body" >
              <h5>50+</h5>
               <h5>Catrgories</h5>
              <span></span></div>
          </li>
          <!-- Support 24/7 -->
          <li>
            <div class="media-left"> <i class="fab fa-product-hunt"></i> </div>
            <div class="media-body" >
              <h5>500+ </h5>
               <h5> Products</h5>
              <span></span></div>
          </li>
           <li>
            <div class="media-left"> <i class="fas fa-shopping-basket"></i> </div>
            <div class="media-body">
              <h5>1 </h5>
               <h5> Just In One Shop</h5>
              <span></span></div>
          </li>
         
        </ul>
      </div>
    </section>
  
  <!-- Content -->
  <div id="content">    
        <!-- Learning Mall Section -->
   
    

     <section class="featur-tabs padding-top-0 padding-bottom-30">
      <div class="container">
          <?php foreach($category_info as $row){ ?>
        
        <!-- Tab panes -->
        <div class="tab-content row">
            <h5 class="padding-top-10 padding-bottom-10 catheading"> 
            <?php echo strtoupper($row->category_name);?>
        </h5>
            
                <?php  $where =array('category_id'=>$row->category_id);
                            $this->db->limit(12);
                            $products = $this->admin_model->record_list('products',$where);
                           if($products)
                            { ?>
                            <div class="item-slide-5 with-nav  middle-nav"> 
              <!-- Product -->
               <?php foreach($products as $prod){ ?>
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
                <a style="color:#040404;margin-left: 20px;" href="javascript: void(0);" 
onclick="window.open('https://www.facebook.com/sharer/sharer.php?mode=friend&s=100&p[title]='+encodeURIComponent('<?php echo $prod->product_title;?>') + '&p[summary]=' + encodeURIComponent('<?php echo $prod->description; ?>') + '&p[url]=' + encodeURIComponent('<?php echo base_url();?>') + '&p[images][0]=' + encodeURIComponent('<?php echo base_url();?>assets/uploads/products/<?php echo $prod->product_img;?>'),'facebook-share-dialog','width=626,height=436');return false;"><i class="fa fa-share-alt"></i></a>
                </p>-->
                <div class="price"><i class="fa fa-inr"></i><?php echo $prod->price;?> </div>
               <a class="cart-btn cart-plus cart" id="<?php  echo $prod->product_id;?>" amount="<?php echo $prod->price; ?>" title="Add To Cart"><i class="icon-basket-loaded"></i></a> 
                </article>
              </div>
             <?php }?>
            </div>
              <?php 
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

<!-- End Page Wrapper --> 

<!-- JavaScripts --> 

 <?php include 'footer-bottom.php';?>

      <script>
            function rateShow(val){
                 //alert(val);
                 $('.rateIt'+val).show();
             }
             function rateHide(val){
                 $('.rateIt'+val).hide(5000);
             }            
             
             $(function(){
                 <?php foreach ($question_info['data'] as $que){ ?>  
                    followQuestion('<?php echo $que['questionId'];?>'); 
                    fQuestion('<?php echo $que['questionId'];?>'); 
                <?php }?>
                });
               function fQuestion(value){
                    followQuestion(value);
                }
             function likeAnswer(value){
                 $likes = parseInt($("#lks"+value).val());
                 $one = 1;
                  $('.lk'+value).html("<img width='10' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                  $.post("<?php echo base_url();?>Shop/likeAnswer", { answerId:value }, function(data){
             //alert(data);
             	if(data==1){
                    $likes = parseInt($likes) + parseInt($one);
                    $('#lks'+value).val($likes);
                     $('.lk'+value).html($likes);                    
                }
                else if(data==2){
                    $likes = parseInt($likes) - parseInt($one);
                    $('#lks'+value).val($likes);
                     $('.lk'+value).html($likes);
                }else if(data==3){
                    $('.likedstatus').fadeIn();
                    $('.likedstatus').html('Check Login..!');
                    $('.likedstatus').fadeOut(3000);
                }
            }).fail(function() {
                alert( "Posting failed." );
            });
                 
             }
             function rateAnswer(value,rate){                
                  $('.ratin'+value).fadeIn();
                  $('.ratin'+value).html("<img width='20' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                 $.post("<?php echo base_url();?>Shop/rateAnswer", { answerId:value,rate:rate }, function(data){
            /// alert(data);
             	if(data){
                     
                      $('.ratin'+value).html('<i class="icon-ok-circled2"></i> You Rated '+data+' Rating.');
                      $('.ratin'+value).fadeOut(5000);
                }
                else{
                    $('.likedstatus').html('Someting went Wrong.!');
                    $('.likedstatus').fadeOut(3000);
                }
//                
            }).fail(function() {
                alert( "Posting failed." );
            });
             }
             function followQuestion(value){
                  $.post("<?php echo base_url();?>Shop/followQuestion", { questionId:value }, function(data){
             //alert(data);
             	if(data==1){
                     $('.que'+value).removeClass('icon-heart-empty');
                      $('.que'+value).addClass('icon-heart');
                }
                else if(data==2){
                    $('.que'+value).removeClass('icon-heart');
                      $('.que'+value).addClass('icon-heart-empty');
                }
            }).fail(function() {
                alert( "Posting failed." );
            });
        }
           function shareAnswer(value,ques){
                $('.shr'+value).fadeIn();
                  $('.shr'+value).html("<img width='10' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                $.post("<?php echo base_url();?>Shop/shareAnswer", { answerId:value, questionId:ques }, function(data){            
             	if(data){
                   window.open(data,'GoogleWindow','width=626,height=436');
                    $('.shr'+value).fadeOut();
                   return false;  
                }
                else{
                   
                }
            }).fail(function() {
                alert( "Posting failed." );
            });
            }
        
        
            function share(id){
                $(id).fadeIn();
                  $(id).html("<img width='10' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                $.post("<?php echo base_url();?>Shop/share", { product_id:id}, function(data){            
             	if(data){
                   window.open(data,'GoogleWindow','width=626,height=436');
                    $('.shr'+id).fadeOut();
                   return false;  
                }
                else{
                   
                }
            }).fail(function() {
                alert( "Posting failed." );
            });
            }
        </script>
</body>
</html>