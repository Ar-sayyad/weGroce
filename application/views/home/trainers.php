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
              <h6>Industries</h6>
              <div class="checkbox checkbox-primary">
                <ul>
                    <?php foreach ($industries_info['data'] as $industry) { ?>                     
                  <li>                   
                        <input id="<?php echo $industry['id'];?>" type="checkbox" name="industryId[]" onChange="filterTrainer()" class="check styled" value="<?php echo $industry['id'];?>" 
                            <?php if(!empty($industry_id)){ foreach ($industry_id as $industryId){if($industryId==$industry['id']) {echo "checked";}}}?>>
                        <label for="<?php echo $industry['id'];?>"> <?php echo $industry['name'];?> </label>                    
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
              <?php if(!empty($trainers_info)){
                            foreach(array_slice($trainers_info['data'],0,16) as $row){                                    
                                    $str = explode('/', $row['attachmentUrl']);
                                    $imgstr = end($str); ?>
              <div class="product">
                <article>
                    <a href="<?php echo base_url();?>trainers/trainersinfo/<?php echo $row['id'];?>">
                        <img class="img-responsive" src="<?php echo $this->api_url;?>attachments/w400/<?php echo $imgstr;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/trainer.png';"  alt="<?php echo $row['firstName']." ".$row['lastName'];?>">
                    </a>
                  <!-- Content --> 
                  <span class="tag" title="<?php echo !empty($row['designation'])?ucwords($row['designation']):'&nbsp;';?>"><?php echo !empty($row['designation'])?ucwords($row['designation']):'&nbsp;';?></span> 
                  <a href="<?php echo base_url();?>trainers/trainersinfo/<?php echo $row['id'];?>" class="tittle"><?php echo $row['firstName']." ".$row['lastName'];?></a> 
                  <!-- Reviews -->
                <p class="rev">
                       <?php $r =round($row['averageRating']);                                                                            
                            for($i=1;$i <= $r;$i++){ ?>                                                                           
                            <i class="fa fa-star"></i>                                                                                    
                            <?php } 
                            for($i=5;$i > $r;$i--){ ?>                                                                           
                           <i class="fa fa-star-o"></i>                                                                                  
                            <?php }
                        ?>
                           <span class="margin-left-40"><i class="fa fa-user-plus" title="Followers"></i> <?php echo !empty($row['totalFollowers'])?$row['totalFollowers']:'0';?></span>
                  <a href="<?php echo base_url();?>trainers/trainersinfo/<?php echo $row['id'];?>" class="view-btn">View Detail</a>
                  </p>
                </article>
              </div>
             <?php }
              }?>
              <!--<?php  $cnt = count($trainers_info['data']);
            if($cnt > 12){?>
            <div class="col-md-12">
                <center><button class="btn" id="loadMore" onclick="loadMore(12);">Load More</button></center>
            </div>
            <?php } ?>-->

            </div>
          </div>
          
          
<!--           <div class="col-md-2">
            <div class="shop-side-bar"> 
          <h6>Topics</h6>
               <div class="checkbox checkbox-primary">
                    <ul>
                        <?php foreach ($topics_info['data'] as $topic) { ?>
                <li>
                    <input id="<?php echo $topic['id'];?>" type="checkbox" name="topicId[]" onChange="filterTrainer()" class="tcheck styled"  value="<?php echo $topic['id'];?>"> 
                <label for="<?php echo $topic['id'];?>"> <?php echo $topic['name'];?> </label> 
                </li>
            <?php } ?>

                    </ul>
               </div>
          </div>
          </div>-->
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
        function filterTrainer(){
              var industry = [];
              var topics = [];
            $.each($(".check:checked"), function(){            
                industry.push($(this).val());
            }); 
            $.each($(".tcheck:checked"), function(){            
                topics.push($(this).val());
            }); 
            //alert(topics);
             $('.prod_filtering').fadeIn();
             $('.loadproducts').css('opacity','0.2');
            $.post("<?php echo base_url();?>Trainers/filterTrainersList", { industryId : industry, topicId : topics  }, function(data){
                //alert(data);
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
         function loadMore(value){
                $('#loadMore').html("<img width='20' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                 $.post("<?php echo base_url();?>Trainers/loadTrainers", { id: value }, function(data){
             //alert(data);
             	if(data){
                    $('.loadproducts').append(data);
                      $('#loadMore').hide();
                }else{
                  <?php   $this->session->set_userdata('count','');?>
                              $('#loadMore').hide();
                }
            })
        }
</script>
</body>
</html>