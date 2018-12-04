<!doctype html>
<html class="no-js" lang="en">
    
<?php include 'header-top.php';?>
    <body>
<!-- Page Wrapper -->
<div id="wrap" class="layout-1">  
  <!-- Header -->
  <?php include 'header.php';?>
  
  <?php include 'page_linking.php';?>
 <style type="text/css">
 
   
 </style>
  <!-- Content -->
  <div id="content"> 
     <!-- Products -->
     <section class="padding-top-10 padding-bottom-60">
      <div class="container">
        <div class="row category-filter">
            <!-- Products -->
          <div class="col-md-12"> 
            
            <!-- Items -->
            <span id="loadproducts"></span>
            <div class="item-col-9 loadproducts"> 
              
              <div class="product_about">
                <article>
                    
                  <!-- Content --> 
              
               <h3 class="pheading">
                 When I ask questions & discuss - I begin to understand
               </h3>
                  <br>
                  <!-- Reviews -->
               
                  <p class="about"><strong>MeraTrainer - Everything About Training </strong> is an endeavour to connect learners and training providers with various options and tools.</p>
            <p class="about">Learning is a continuous process, and we proudly ensure it. The first and basic step to learn is ask question. People have questions but don &#8217; t know whom to ask. On the other hand experts and trainers have answers but don &#8217; t know who need it.</p>
            <p class="about">MeraTrainer - Everything About Training is to create an opportunity to ask questions related to your social life, spiritual life, personal life, professional life and financial life. Thousands of experts and trainers are there to reply, express, engage and earn. So, one question has multiple answers / solutions from various experts and trainers. This abundance enable the asker to choose the most suitable one according to the situation.</p>
                                                <p class="about"><em>Keep Learning<br>
                                                 Keep Growing</em></p>
              
          
                  
                </article>
              </div>
            
              

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