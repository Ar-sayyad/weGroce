<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
     <link href="<?php echo base_url();?>shop/css/vendors.css" rel="stylesheet">
<link href="<?php echo base_url();?>shop/css/icon_fonts/css/all_icons.min.css" rel="stylesheet">
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
          <div class="col-md-12">             
                   
        <section id="lessons">
        <div id="" class=""> 
            <?php $qs=1; foreach ($question_info['data'] as $que){ ?>  
          <?php $answers = !empty($que['answers'])?$que['answers']:'';
                $sr=1;
                foreach(array_slice($answers,0,1) as $ans){?>
          <!-- Blog Post -->
          <div class="col-md-4" style="margin-bottom:10px">
          <div class="blog-post">
              <article>
               <?php $video = !empty($ans['videoId'])?$ans['videoId']:""; 
                    $video = explode('/', $video);
                     $vid = end($video);
                     if($vid){                 
                  $tmimg = !empty($ans['highThumbnail'])?$ans['highThumbnail']:"";
                    ?>
                   <div class="list_lessons" id="Videos">
                       <ul>
			<li>
                        <a target="_blank" href="https://vimeo.com/<?php echo $vid;?>" class="video"  title="<?php echo ucwords(!empty($que['question'])?$que['question']:'');?>">
                            <img class="img-responsive" src="<?php echo $tmimg;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>assets/no_image.jpg';"  >
                        </a>
                        </li>
                       </ul>
                             <!--<span  class="tagg"><?php echo !empty($ans['videoTitle'])?$ans['videoTitle']:"";?></span>--> 
                    </div>
             
                <?php }?>
               
                  <div class="col-md-12">
                      <span onclick="likeAnswer(this.value);" title="Like" value="<?php echo $ans['answerId'];?>">
                    <i class="fa fa-thumbs-up que<?php echo $ans['questionId'];?>"></i> <?php echo $ans['totalLikes'];?>
                    <input type="hidden" id="lks<?php echo $ans['answerId'];?>" value="<?php echo $ans['totalLikes'];?>"/>
                </span>
                  
                      <span title="Share" onclick="shareAnswer('<?php echo $ans['answerId'];?>','<?php echo $ans['questionId'];?>');">
                    <i class="fa fa-share shr<?php echo $ans['answerId'];?>"></i> <?php echo $ans['totalShares'];?>
                </span>
                  
                      <span title="Views"><i class="fa fa-eye"></i> <?php echo $ans['totalViews'];?></span>
                
                      <span title="Follow" onclick="followQuestion(this.value);" value="<?php echo $ans['questionId'];?>">
                    <i class="fa fa-heart-o que<?php echo $ans['questionId'];?>"></i>
                </span>
                  </div>
                   <div class="col-md-12">
                     <div class="col-md-6"> 
                        <div class="rateds rating<?php echo $ans['answerId'];?>">                   
                             <?php $r =round($ans['averageRatings']);                                                                            
                             for($i=1;$i <= $r;$i++){ ?>                                                                           
                                     <i class="fa fa-star"></i>                                                                                    
                                     <?php } 
                                     for($i=5;$i > $r;$i--){ ?>                                                                           
                                    <i class="fa fa-star-o"></i>                                                                                  
                                     <?php }
                             ?> 
                         </div>
                     </div>
                       <div class="col-md-6">
                           <?php  if ($this->session->userdata('user_login') == 1){ ?>
                       <div class="rated  ratees" style="margin:0px;">
                            <span class="rtt" onclick="rateAnswer('<?php echo $ans['answerId'];?>',5);"><i class="fa fa-star-o"></i></span>
                          <span class="rtt" onclick="rateAnswer('<?php echo $ans['answerId'];?>',4);"><i class="fa fa-star-o"></i></span>
                          <span class="rtt" onclick="rateAnswer('<?php echo $ans['answerId'];?>',3);"><i class="fa fa-star-o"></i></span>
                          <span class="rtt" onclick="rateAnswer('<?php echo $ans['answerId'];?>',2);"><i class="fa fa-star-o"></i></span>
                          <span class="rtt" onclick="rateAnswer('<?php echo $ans['answerId'];?>',1);"><i class="fa fa-star-o"></i></span>
                      </div>
                        <span class="rtt mymsg ratin<?php echo $ans['answerId'];?>"></span>
                         <?php }?>
                       </div>
                   </div>
                
                
                <a href="#." class="tittle"><?php echo ucwords(!empty($que['question'])?$que['question']:'');?></a>
                
               <!--<span><i class="fa fa-bookmark-o"></i> <?php echo $ans['updated_at'];?></span>-->
              <!--<p>Etiam porttitor ante non tellus pulvinar, non vehicula lorem fermentum. Nulla vitae efficitur mi [...] </p>-->
            </article>
          </div>
           </div>
                <?php $sr++; }?>
         <?php $qs++; } ?>
        </div>
        </section>
     
 
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
    <script src="<?php echo base_url();?>shop/js/common_scripts.js"></script>
    <script src="<?php echo base_url();?>shop/js/main.js"></script>
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