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
<!--    <?php  $cnt = count($trainers_info['data']);
if($cnt > 12){?>
<div class="col-md-12">
    <center><button class="btn" id="loadMore" onclick="loadMore(12);">Load More</button></center>
</div>
<?php } ?>-->