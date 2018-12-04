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
          
          
          <!-- Products -->
          <div class="col-md-12"> 
            
            <!-- Items -->
            <span id="loadproducts"></span>
            <div class="item-col-9 loadproducts"> 
              
              <div class="pro_cancellation">
                <article>
                    
                  <!-- Content --> 
              
              <!--  <p class="rev">
                 When I ask questions & discuss - I begin to understand
               </p> -->
                  <!-- Reviews -->
               
                 <p class="cancellation">When you make a purchase as a consumer (i.e. if your purchase is not wholly or mainly for the purpose of your trade, craft, business or profession), you have the following rights of cancellation.</p><br>
                                            <p class="cancellation"><strong>Goods (including CDs, DVDs etc</strong>. In the case of goods, you may cancel your order at any time up to 14 days after delivery of the goods to you. The same right of cancellation applies to any video/audio recordings (or other digital content) supplied on a tangible medium (e.g. on DVD or CD), except that the right to cancel ceases to apply when an audio/video recording or computer software which is sealed when supplied, becomes unsealed after delivery.</p>
                                            <p class="cancellation"><strong>Downloads, not on tangible medium</strong>. In the case of digital content (downloadable content) not supplied on a tangible medium, you may cancel your order at any time up to 14 days after the date of your contract (normally the date of your order). We might not be able to supply such digital content during the cancellation period, or we might need your signed statement to waive the refund right for delivery, depending on different policies in your country.</p>
                                            <p class="cancellation">To exercise your right of cancellation, you must make a clear statement of your wish to cancel. That statement should be communicated (e.g. by letter, email, or telephone) to the Company (using its contact details on the website, or email to: support@meratrainer.com).</p>
                                    <br>
                                            <p class="cancellation">Some products have different policies or requirements associated with them. Online and downloadable products are non-refundable unless specified differently in the applicable product section below.</p>
                                    <br>
                                            <p class ="cancellation">You can return your physical products with a trackable shipping service. If a package doesn't arrive and you don't use a trackable method to return or if you refuse the shipment as a method of return, we may not be able to cover you under the Guarantee.</p>
                                    <br>
                                            <p class ="cancellation">Please ship your returns to All addresses are listed on <a style="color:blue;" href="<?php echo base_url();?>contact">https://www.meratrainer.com/contact</a></p>
                                    <br>
                                    <br>
                                           <h5 class="mb-0">Refund Policy</h5>
                                            <p class="cancellation"><strong>Digital products</strong> -- We do not issue refunds for digital products once the order is confirmed and the product is sent.</p>
                                    <br>
                                            <p class="cancellation">We recommend contacting us for assistance if you experience any issues receiving or downloading our products.</p>
                                    <br>
                                            <p class ="cancellation"><strong>Physical Products</strong> -- Once we receive your item, we will inspect it and notify you that we have received your returned item. We will immediately notify you on the status of your refund after inspecting the item.</p>
                                    <br>
                                            <p class ="cancellation">If your return is approved. We will initiate a refund to your credit card/bank (or original method of payment). You will receive the credit within 7-10 days, depending on your card issuer's policies.</p>
                                    <br>
                                            <p class="cancellation">If you have any questions about our Returns and Refunds Policy, please contact us on <a style="color:blue;" href="mailto:contact@meratrainer.com">contact@meratrainer.com</a></p>
              
          
                  
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