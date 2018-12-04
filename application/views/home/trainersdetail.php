<!doctype html>
<html class="no-js" lang="en">
  
<?php include 'header-top.php';?>
    <link href="<?php echo base_url();?>shop/css/vendors.css" rel="stylesheet">
   <script src="<?php echo base_url();?>home/js/vendors/jquery/jquery.min.js"></script> 
    <link href="<?php echo base_url();?>shop/css/icon_fonts/css/all_icons.min.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
   <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  
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
          <?php 
			foreach ($trainer as $row) {
                            $str = explode('/', $row['attachmentUrl']);$imgstr = end($str);
                           // $banner = explode('/', $row['banner']);$bannerimg = end($banner);
				?>
          <!-- Shop Side Bar -->
          <div class="col-md-3 side-filter">
            <div class="shop-side-bar">               
                <div class="trainer-info" style="text-align:center">
                        <figure>
                            <img width="200px" src="<?php echo $this->api_url;?>attachments/w400/<?php echo $imgstr;?>" class="rounded-circle" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/trainer.png';" alt="No Image">
                        </figure>
                    <h6 style="text-transform:uppercase;"><?php echo $row['firstName']." ".$row['lastName'];?></h6>
                    <span class="taggg" title="Designation"><?php echo ucwords(!empty($row['designation'])?$row['designation']:'');?></span>                    
                    <?php  if(!empty($row['address'])){ ?>
                    <ul class="taddress" title="Address">
                        <?php  foreach ($row['address'] as $key =>$value){ ?>
                          <?php if($key=='area' && !empty($value)){ ?>
                        <li style="padding: 1px;"> 
                         <?php  echo "$value,"; ?></li>
                          <?php } ?>
                        <?php if($key=='city'&& !empty($value)){ ?>
                        <li style="padding: 1px;"> 
                         <?php  echo "$value,"; ?></li>
                          <?php } ?>
                        <?php if($key=='country'&& !empty($value)){ ?>
                        <li style="padding: 1px;"> 
                         <?php  echo "$value."; ?></li>
                          <?php } }?>
                        </ul> 
                    <?php }?>
                    <span class="followers" title="Followers: <?php  echo !empty($row['totalFollowers'])?$row['totalFollowers']:'0';?>"><i class="fas fa-users"></i> <tag class="flows"><?php  echo !empty($row['totalFollowers'])?$row['totalFollowers']:'0';?></tag></span>
                    <p class="rev" title="Ratings: <?php echo number_format($row['trainerAverageRating'],1);?>" style="color: #f0ad4e;">
                        <span class="rates"><?php echo number_format($row['trainerAverageRating'],1);?></span>
                       <?php  $r =round($row['trainerAverageRating']);                                                                            
                            for($i=1;$i <= $r;$i++){ ?>                                                                           
                            <i class="fas fa-star"></i>                                                                                    
                            <?php } 
                            for($i=5;$i > $r;$i--){ ?>                                                                           
                           <i class="far fa-star"></i>                                                                                  
                            <?php }
                        ?>
                    </p>
                </div>
                        <ul class="detail-menu margin-bottom-10" role="">
                            <a href="#Profile" aria-controls="Profile" role="tab" data-toggle="tab">
                                <li class="trmenu " title="Profile">                                
                                    <i class="fas fa-user"></i> Profile
                               </li>
                            </a>
                             <a href="#Videos" aria-controls="Videos" role="tab" data-toggle="tab">                           
                                <li role="presentation" class="trmenu" title="Videos">
                                    <i class="fas fa-video"></i> Videos                                
                                </li>
                            </a>                            
                            <a href="#Gallery" aria-controls="Gallery" role="tab" data-toggle="tab">
                                <li role="presentation" class="trmenu" title="Gallery">
                                    <i class="fas fa-images"></i> Gallery                               
                                </li>
                            </a>
                             <a href="#Answers" aria-controls="Answers" role="tab" data-toggle="tab">
                                 <li class="trmenu" title="Answers">
                                     <i class="fab fa-autoprefixer"></i> Answers 
                                 </li>
                             </a>
                             <a href="#Products" aria-controls="Products" role="tab" data-toggle="tab">
                                 <li class="trmenu" title="Products">
                                     <i class="fas fa-cart-plus"></i> Products 
                                 </li>
                             </a>
                        </ul>

       
      
            </div>
          </div>        
          
          <!-- Products -->
          <div class="col-md-9">              
        <!-- Tab panes -->
        <div class="tab-content"> 
             <section id="lessons">                                                         
                    <ul class="" style="display: inline-flex;">
                        <li class="scmenu"  title="Followers"><i class="fas fa-user-plus"></i> <?php  echo !empty($row['totalFollowers'])?$row['totalFollowers']:'0';?></li>
                        <li class="scmenu"  title="Likes"><i class="far fa-thumbs-up"></i> <?php  echo !empty($row['totalLikes'])?$row['totalLikes']:'0';?></li>
                        <li class="scmenu"  title="Ratings"><i class="far fa-star"></i> <?php echo number_format($row['trainerAverageRating'],1);?></li>
                        <li class="scmenu"  title="Shares"><i class="fas fa-share-alt"></i> <?php  echo !empty($row['totalShares'])?$row['totalShares']:'0';?></li>
                     </ul>
                 <hr>
                 <h6 class="pheading">Achievements / Bedges</h6>
                         
                    <ul class="rating" style="display: inline-flex;">                        
                                   <?php $medals = !empty($row['medals'])?$row['medals']:'';
                                   if($medals){
                                      $sr=1; foreach ($medals as $medal){ ?>

                        <li style="padding:10px 0px 0px 10px;">
                            <img width="50" title="<?php echo ucwords(!empty($medal['title'])?$medal['title']:'-');?>" src="<?php echo $medal['image'];?>"/>
                                      </li>

                                   <?php $sr++; }                                                                         
                                      }else{
                                          echo " <div class='nohead'>No Medals Available..!</div>";
                                      } ?>
                    </ul>
              </section>
          <!-- TV & Audios -->
          <div role="tabpanel" class="tab-pane active fade in" id="Profile"> 
             <section id="lessons">  
                 <div class="product"> 
              <!-- Product -->
                <h6 class="pheading">Profile</h6>
                  <div class="col-md-12 prof-div">
                  <div class="" style="text-align:left">
                        
                    <h6 style="text-transform:uppercase;"><?php echo $row['firstName']." ".$row['lastName'];?></h6>
                    <span class="tagg" title="Designation"><?php echo ucwords(!empty($row['designation'])?$row['designation']:'');?></span>                    
                    
                    <ul class="" style="display: inline-flex;">
                        <li class="scmenu"  title="Followers"><i class="fas fa-user-plus"></i> <?php  echo !empty($row['totalFollowers'])?$row['totalFollowers']:'0';?></li>
                        <li class="scmenu"  title="Likes"><i class="far fa-thumbs-up"></i> <?php  echo !empty($row['totalLikes'])?$row['totalLikes']:'0';?></li>
                        <li class="scmenu"  title="Ratings"><i class="far fa-star"></i> <?php echo number_format($row['trainerAverageRating'],1);?></li>
                        <li class="scmenu"  title="Shares"><i class="fas fa-share-alt"></i> <?php  echo !empty($row['totalShares'])?$row['totalShares']:'0';?></li>
                        <li class="scmenu"  title="Views"><i class="fas fa-eye"></i> <?php  echo !empty($row['totalViews'])?$row['totalViews']:'0';?></li>
                        <li class="scmenu"  title="Students"><i class="fas fa-graduation-cap"></i> <?php  echo !empty($row['totalPeopleTrained'])?$row['totalPeopleTrained']:'0';?></li>
                        <li class="scmenu"  title="Answers"><i class="fab fa-autoprefixer"></i> <?php  echo !empty($row['totalAnswers'])?$row['totalAnswers']:'0';?></span></li>
                        <li class="scmenu"  title="Experience"><i class="fas fa-plus-circle"></i> <?php  echo !empty($row['totalExperience'])?$row['totalExperience']:'-';?></li>
                     </ul>
                </div>
                      <hr>
                  <h6 class="pheading">Qualification</h6>                  
                  <hr>
                  <div class="qualificat" style="padding: 0px 0px 0px 20px;">
                     <?php $qualifications = !empty($row['qualifications'])?$row['qualifications']:'';
                     if($qualifications){
                        $sr=1; foreach ($qualifications as $qual){ ?>                   
                      <div class="col-md-12 taggg" style="margin-bottom: 15px;">
                                <?php echo $sr;?>.
                      
                            <?php echo ucwords($qual['qualification']);?>
                       </div>                  
                     <?php $sr++; } ?>
                      <hr>
                     <?php }else{
                            echo "<div class='nohead'>No Qualification Available..! </div>";
                        }?>
                    </div>
                  </div>      
              </div>
             </section>
          </div>          
          <!-- Smartphones -->
          <div role="tabpanel" class="tab-pane fade" id="Videos"> 
            <!-- Items -->
              <section id="lessons">
                  <div class="product">  
                    <h6 class="pheading">Videos</h6>
                    <div class="col-md-12 prof-div">
                                     <?php 
                                        if($image_info['data']){;
                                       foreach ($video_info['data'] as $vid) {
                                         $video = explode('/', $vid['videoLink']);
                                         $mvideo = end($video); ?>
                                <div class="col-md-2 vido">
                                    <a href="https://www.youtube.com/watch?v=<?php echo $mvideo;?>" class="video" title="<?php echo ucwords(!empty($vid['title'])?$vid['title']:'');?>">
                                        <i class="vidoicon fas fa-file-video"></i>
                                        <span  class="tagg"><?php echo ucwords(!empty($vid['title'])?$vid['title']:'');?></span>
                                       </a>
                                </div>  
                                       <?php }
                                       }else{
                                            echo "<div class='nohead'>No Video Available..!</div>";
                                        } ?>

                            </div>
                  </div>
              </section>
          </div>
          <!-- Desk & Laptop -->
          <div role="tabpanel" class="tab-pane fade" id="Gallery"> 
                <section id="lessons">
              <!-- Product -->
              <div class="product">  
                  <h6 class="pheading">Media Gallery</h6>
                    <div class="col-md-12 prof-div magnific-gallery">                                       
                                           <?php 
                                           if($image_info['data']){
                                           foreach (array_slice($image_info['data'],0,10) as $immg) {
                                              $img = explode('/', $immg['imageUrl']);
                                                $mediaimg = end($img);?>
                                                <div class="col-md-2 vido">
                                                        <figure>
                                                            <img class="img-gal"  style="" src="<?php echo $this->api_url;?>attachments/w400/<?php echo $mediaimg;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/noimg.jpg';"  alt="No Gallery">
                                                                <figcaption>
                                                                        <div class="caption-content">
                                                                                <a href="<?php echo $this->api_url;?>attachments/w900/<?php echo $mediaimg;?>" title="<?php echo $immg['caption'];?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/noimg.jpg';" data-effect="mfp-zoom-in">
                                                                                    <i class="zoom-q fas fa-search-plus"></i><!-- <p><?php echo $immg['caption'];?></p>-->
                                                                                </a>
                                                                        </div>
                                                                </figcaption>
                                                        </figure>
                                                </div>
                                           <?php } ?>
                                                <div class="imgload"></div>
                                                 <div class="col-md-12">
                                            <center><button class="btn" id="loadMore" onclick="loadMoreImg('<?php echo $row['id'];?>');">Load More</button></center>
                                                 </div>
                                           <?php }else{
                                                echo "<center><div class='nohead'>No Media Available..!</div></center>";
                                            } ?>
                                        
                    </div>
                </div>            
                </section>
          </div>
       
            <div role="tabpanel" class="tab-pane fade" id="Answers"> 
             <section id="lessons">
              <div class="product">
                 <h6 class="pheading">Answers</h6>
                 <div class="col-md-12 prof-div">                     
                     <!-- /card -->
                    <?php $answers = !empty($row['answers'])?$row['answers']:'';
                    if($answers){
                    $sr=1;
                   foreach($answers as $ans){?>                                                        

                 <div class="col-md-6 ans-div ">
                             <div class="rev-content" style="">
                                 <div class="card-body" style="min-height: 114px;">
                                    <?php if(!empty($ans['answer'])){
                                        $arry = json_decode($ans['answer']);
                                    }else{}
                                        if(!empty($arry)){?>
                                              <?php $i=1; foreach ($arry as $key => $value){                                                                                  
                                                  if($i==1){?> 
                                     <h6 class="ans-head"><?php echo strtoupper($key);?> : <?php echo ucfirst($value);?></h6>                                                                                  
                                                  <?php }else{ ?>
                                             <div class="">										
                                                 <p style="font-size: 12px;"> <?php echo "<b>".ucfirst($key)."</b>";?> :   
                                                     <span><?php  echo $story_desc = substr($value,0,80);  ?></span>
                                                     <?php if(strlen($value)>80){ ?>
                                                     <span id="txt<?php echo $ans['answerId'];?>" style="display:none;">
                                                         <?php  echo $story_desc = substr($value,80);?>
                                                     </span>
                                                     <a style="color:blue;cursor: pointer" id="txtshow<?php echo $ans['answerId'];?>" onclick="txtshow('<?php echo $ans['answerId'];?>');">Read More...</a>
                                                     <a style="color:blue;cursor: pointer;display: none" id="txthide<?php echo $ans['answerId'];?>" onclick="txthide('<?php echo $ans['answerId'];?>');">...Read Less</a>
                                                     <?php } ?>
                                             </div>

                                                 <?php } $i++; 
                                              }
                                                     }?>

                                     <?php $video = !empty($ans['videoId'])?$ans['videoId']:""; 
                                      $video1 = explode('/', $video);
                                       $vid = end($video1);
                                       if($vid){
                                     ?>
                                     <div class="col-md-4 vido">
                                    <a href="https://vimeo.com/<?php echo $vid;?>" class="video" title="<?php echo !empty($ans['videoTitle'])?$ans['videoTitle']:"";?>">
                                        <i class="vidoicon fas fa-file-video"></i>
                                        <span  class="tagg"><?php echo !empty($ans['videoTitle'])?$ans['videoTitle']:"";?></span>
                                       </a>
                                </div> 
                                       <?php }?>
                                      <?php $tmimg = !empty($ans['highThumbnail'])?$ans['highThumbnail']:"";
                                      if($tmimg){ ?>
                                      <div class="col-md-4 vido magnific-gallery">
                                                        <figure>
                                                            <img class="img-gall" src="<?php echo $tmimg;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/noimg.jpg';"  alt="No Gallery">
                                                                <figcaption>
                                                                        <div class="caption-content">
                                                                                <a href="<?php echo $tmimg;?>" title="View Image" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/noimg.jpg';" data-effect="mfp-zoom-in">
                                                                                    <i class="zoom-q fas fa-search-plus"></i><!-- <p><?php echo $immg['caption'];?></p>-->
                                                                                </a>
                                                                        </div>
                                                                </figcaption>
                                                        </figure>
                                                </div>                                     
                                     
                                      <?php } ?>                                 
                                     

                                 </div>
                                 <hr class="ans-hr">
                                 <div class="rating" style="">
                                     <?php $r =round($ans['averageRatings']);                                                                            
                                     for($i=1;$i <= $r;$i++){ ?>                                                                           
                                        <i class="fas fa-star"></i>                                                                                    
                                        <?php } 
                                        for($i=5;$i > $r;$i--){ ?>                                                                           
                                       <i class="far fa-star"></i>                                                                                     
                                     <?php }
                                     ?>
                                     <span class="ans-menu" style="color:#000;margin-left: 30%">
                                         <i style="color:#000;" class="fas fa-eye"></i> <?php echo $ans['totalViews'];?></span>
                                 </div>
                                         <div class="">
                                         <?php  if ($this->session->userdata('user_login') == 1){ ?>
                                             <div class="ans-menu ratin">
                                              
                                            <span onclick="rateAnswer('<?php echo $ans['answerId'];?>',5);"><i class="far fa-star"></i>  </span>
                                             <span onclick="rateAnswer('<?php echo $ans['answerId'];?>',4);"><i class="far fa-star"></i>  </span>
                                             <span onclick="rateAnswer('<?php echo $ans['answerId'];?>',3);"><i class="far fa-star"></i>  </span>
                                             <span onclick="rateAnswer('<?php echo $ans['answerId'];?>',2);"><i class="far fa-star"></i>  </span>
                                             <span onclick="rateAnswer('<?php echo $ans['answerId'];?>',1);"><i class="far fa-star"></i>  </span>
                                              : Rate 
                                            
                                         </div>
                                              <span style="display: none;float: right;color:green;" class="mymsg ratin<?php echo $ans['answerId'];?>"></span>
                                           
                                                  <?php }?>
                                           <ul style="display:inline-flex;width: 100%">                                                                                                                                                                    
                                                  <li class="ans-menu">
                                                         <i class="far fa-thumbs-up" onclick="likeAnswer(this.value);" value="<?php echo $ans['answerId'];?>"></i>
                                                         <span class="lk<?php echo $ans['answerId'];?>"><?php echo $ans['totalLikes'];?></span>
                                                     
                                                     <input type="hidden" id="lks<?php echo $ans['answerId'];?>" value="<?php echo $ans['totalLikes'];?>"/>
                                                 </li>
                                                 <li class="ans-menu"> 
                                                         <i class="fas fa-share-alt" onclick="shareAnswer('<?php echo $ans['answerId'];?>','<?php echo $ans['questionId'];?>');"></i>
                                                                <?php echo $ans['totalShares'];?>
                                                         <span class="shr<?php echo $ans['answerId'];?>"></span>
                                                     
                                                 </li>
                                                 <li class="ans-menu" style="padding-left: 22%;">
                                                      <i class="far fa-clock"></i> <?php echo $ans['updated_at'];?>
                                                 </li>
                                             </ul>                                                                                    
                                         </div>

                                 </div>									
                        							
                 </div>

         <?php $sr++; } 
                    }else{
                        echo "<div class='nohead'>No Answers Available..!</div>";
                    } ?>
                    <!-- /card -->
                 </div>
              </div>
           
             </section>
          </div>
          
          <div role="tabpanel" class="tab-pane fade" id="Products"> 
                <section id="lessons">
              <!-- Product -->
                  <h6 class="pheading">Products</h6>
                  <div class="col-md-12 prof-div" style="background-color: #f7f7f7;padding:0px !important;">
                        
              <!-- Product -->
               <?php foreach($product as $prod){ ?>
              <div class="product col-md-3" style="padding:2px !important;">
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
                <div class="price"><i class="fas fa-rupee-sign"></i><?php echo $prod->price;?> </div>
               <a class="cart-btn cart-plus cart" id="<?php  echo $prod->product_id;?>" amount="<?php echo $prod->price; ?>" title="Add To Cart"><i class="fa fa-cart-plus"></i></a> 
                </article>
              </div>
             <?php }?>
        
                    </div>
                  <center><a class="btn" href="<?php echo base_url();?>Trainers/products/<?php echo $trainer_id;?>">View All</a></center>
             
                </section>
          </div>          
          
        </div>    
    
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
  <script>
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
             function rateTrainer(value,rate){                
                  $('.trnmsg').fadeIn();
                  $('.trnmsg').html("<img width='20' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                 $.post("<?php echo base_url();?>Trainers/rateTrainer", { id:value,rate:rate }, function(data){
             //alert(data);
             	if(data){
                     
                      $('.trnmsg').html('<i class="icon-ok-circled2"></i> You Rated '+data+' Rating.');
                      $('.trnmsg').fadeOut(5000);
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
            function shareTrainer(value){
             $('.shr'+value).fadeIn();
                  $('.shr'+value).html("<img width='10' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                $.post("<?php echo base_url();?>Trainers/shareTrainer", { trainerId:value }, function(data){            
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
        
            function txtshow(value){
                $("#txt"+value).show();
                $("#txtshow"+value).hide();
                $("#txthide"+value).show();
            }
            function txthide(value){
                $("#txt"+value).hide();
                $("#txtshow"+value).show();
                $("#txthide"+value).hide();
            }
        function loadMoreImg(value){
                $('#loadMore').html("<img width='20' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                 $.post("<?php echo base_url();?>Trainers/loadImageGallery", { id: value }, function(data){
             //alert(data);
             	if(data){
                    $('.imgload').append(data);
                      $('#loadMore').html('Load More');
                }else{
                  <?php   $this->session->set_userdata('count','');?>
                              $('#loadMore').hide();
                }
            })
        }
</script>
    <script src="<?php echo base_url();?>shop/js/common_scripts.js"></script>
    <script src="<?php echo base_url();?>shop/js/main.js"></script>
        <!-- SPECIFIC SCRIPTS -->
	
</body>
</html>