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
          <div class="col-md-9">             
            <!-- Items -->
             <section id="lessons"> 
                  <div class="product"> 
                      <div class="shopcarttable" >
                           <div class="box_cart">
        <table class="table cart-list">
                <thead>
                    <?php if (isset($_SESSION['products']) && $_SESSION['products'] != '') {?>
                        <tr>
                            <th style="text-align:center">
                                        Item
                                </th>
                                <th style="text-align:center">
                                    Name
                                </th>
                                <th style="text-align:center">
                                        Qty
                                </th>
                                <th style="text-align:center">
                                        Price
                                </th>
                                <th style="text-align:center">
                                        Total
                                </th>
                                <th style="text-align:center">
                                        Actions
                                </th>
                        </tr>
                          <?php } ?>
                </thead>
                <tbody>
                <?php
                    if (isset($_SESSION['products']) && $_SESSION['products'] != '') {
                    $sr=1;
                    foreach ($_SESSION['products'] as $cart)
                    {
                    //   echo "<pre>";print_r($cart);die;
                    $amt = $cart['amount'] * $cart['qty'];                                    

                ?>			
                    <tr>
                                <td style="">
                                    <div class="" style="text-align: center;">
                                            <img class="cart-img" src="<?php echo base_url().'assets/uploads/products/'.$cart['image'];?>" alt="Image" onError="this.src = '<?php echo base_url().'assets/no_image.jpg';?>'">

                                        </div>
                                </td>
                                <td style="text-align:center">
                                      <span class="prd_nm"><?php echo $cart['prod_name'];?></span>
                                </td>
                                <td style="width: 15%;text-align:center">
                                     <input type="number" class="form-control prd_qty" min="1" value="<?php echo $cart['qty'];?>" data-value="<?php echo $cart['id'];?>" onchange="updateQty(this)"/>

                                </td> 
                                <td style="text-align:center">
                                    <strong class="prd_amt"><i class="fa fa-rupee"><?php echo $cart['amount'];?></i></strong>
                                </td>
                                <td style="text-align:center">
                                        <strong class="prd_amt"><i class="fa fa-rupee"><?php echo $amt;?></i></strong>
                                </td>
                                <td class="options" style="text-align:center">
                                        <a data-value="<?php echo $cart['id'];?>" onclick="removeCartItem(this)">
                                            <i class="prd-rem fa fa-trash"></i></a>
                                </td>
                        </tr>
                         <?php
                            $sr++;
                            }
                            }
                            else{ ?>
                            <center class="pheading" style="margin-top:60px;margin-bottom:60px;"> Your Cart is Empty</center>
                           <?php  }
                            ?>
                </tbody>
        </table>

</div>
                      </div>
                  </div>
            </section>
          </div>
          <div class="col-md-3">             
                   <div class="product"> 
              <div class="carttotal">
               <?php
    $total = 0;
    if (isset($_SESSION['products']) && $_SESSION['products'] != '') {
    foreach ($_SESSION['products'] as $cart) {
    $amt = $cart['amount'] * $cart['qty'];
    $total = $total + $amt;
    }
    }
    ?>
   <div class="side-filter">
                <div class="total_div" style="font-size: 20px;">
                    <table>
                        <tr>
                            <th>
                                Total : <i class="fa fa-rupee"><?php echo $total; ?></i>
                            </th>
                        </tr>
                        
                    </table>
                    </div>                
                <hr>
                <div style="text-align: center">
     <?php if (isset($_SESSION['products']) && $_SESSION['products'] != '') {?>
<!--                <a href="<?php echo base_url();?>cart/filldetail" class="btn" >Next</a>                  
                     <hr>-->
    <?php } ?>
                    <a href="<?php echo base_url();?>Category" class="btn"><i class="fa fa-right"></i> Continue</a>
                </div>
    </div>
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