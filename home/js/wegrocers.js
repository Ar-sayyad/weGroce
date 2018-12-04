$(window).on("load",function(){
 //  alert($('#base').val());  
    var base_url = $('#base').val();
     
          $('.cartMenu').load(base_url+'Cart/demoCart'); 
            $('.shopcarttable').load(base_url+'Cart/cartTable');
             $('.carttotal').load(base_url+'Cart/cartTotal');
         
        });

 $('.cart-plus').click(function(){
  
      var base_url = $('#base').val();
// alert(base_url);
      $id = $(this).attr('id');

      $amount = $(this).attr('amount');
      $type='add';
  if ($amount != 0) {
       $('.cart_process').fadeIn();
       $('.cart_process').html('Going to Cart...');
         $.post(base_url+"Cart/cartUpdate", { 'id': $id,"amount" : $amount, 'type': 'add' }, function(data){
      
       if(data=='')
      {  
            $('.cartMenu').load(base_url+'Cart/demoCart');
            $('.shopcarttable').load(base_url+'Cart/cartTable');
            $('.carttotal').load(base_url+'Cart/cartTotal'); 
          
            $('.cart_process').html('You can add only till minimum order quantity of each product in cart.');
            $('.cart_process').fadeOut();
                               //$('.cartMenu').html(data);                                                               
     }
                        else{
                           
                                  $('.cartMenu').load(base_url+'Cart/demoCart');
                                  $('.shopcarttable').load(base_url+'Cart/cartTable');
                                  $('.carttotal').load(base_url+'Cart/cartTotal');
                                  // $('.sidebartable').load(base_url+'home/sidebartable');
                                  // $('.sidebartotal').load(base_url+'home/sidebartotal');
                                  //location.reload();
                                 $('.cart_process').html('<i class="fa fa-check"></i> Added to cart.');
                                 $('.cart_process').fadeOut();
                                // $('.cartMenu').html(data);
                                 
                              }
                              
        }).fail(function() {
                alert( "Posting failed." );
            });
      
  }
  else
  {
        $('.cart_process').fadeIn();
     $('.cart_process').html('Invalid Amount.. Unable to add in cart');  
     $('.cartMenu').load(base_url+'Cart/demoCart');
     $('.shopcarttable').load(base_url+'Cart/cartTable');
     $('.carttotal').load(base_url+'Cart/cartTotal');
     setTimeout(function () {
            $('.cart_process').fadeOut();
        }, 3000); 
  }
     
                              
  
     
 });
  

 $('.cart-plus-qty').click(function(){
    $id = $(this).attr('id');
    $qty = $('#prd_qty').val();
     var base_url = $('#base').val();
    $type ='update';
// alert($minqty);
// alert($qty);
   if ($qty != 0) 
    {
         $('.cart_process').fadeIn();
         //$('.cart_process').html('Cart updating...');    
//    $id = $(this).attr('id');
    $.post(base_url+'Cart/cartUpdate', {'type': 'update', 'id': $id , 'qty': $qty }, function (data) {
         // alert(data);
        if (data == '') {
            $('.cartMenu').load(base_url+'Cart/demoCart');
            $('.shopcarttable').load(base_url+'Cart/cartTable');
            $('.carttotal').load(base_url+'Cart/cartTotal');
          
             $('.cart_process').html('<i class="fa fa-cross"></i> Something Went Wrong..!');
             $('.cart_process').fadeOut();  
        } else{
                $('.cartMenu').load(base_url+'Cart/demoCart');
                $('.shopcarttable').load(base_url+'Cart/cartTable');
                $('.carttotal').load(base_url+'Cart/cartTotal');
              
               $('.cart_process').html('<i class="fa fa-check-circle-o"></i> Cart Updated...');
             $('.cart_process').fadeOut();           
        }
            if (data > 0) {
                $('.checkoutbtn').removeClass('hide');
            } else {
                $('.checkoutbtn').addClass('hide');
            }
        
        setTimeout(function () {
            $('.cart_process').fadeOut();
        }, 3000);
    });
    }else
    {
          $('.cart_process').fadeIn();
     $('.cart_process').html('Invalid Qty.. Unable to Process');  
     $('.cartMenu').load(base_url+'Cart/demoCart');
     $('.shopcarttable').load(base_url+'Cart/cartTable');
     $('.carttotal').load(base_url+'Cart/cartTotal');
     setTimeout(function () {
            $('.cart_process').fadeOut();
        }, 3000); 
        
    }
     
    //$('.cart_process').fadeOut();
    
});
function updateQty(btn) {
     var base_url = $('#base').val();

  
    $id = $(btn).attr('data-value');
   
    $qtyy = $(btn).val();
  
    $qty=parseInt($qtyy);
   
    $type ='update';
// alert($minqty);
// alert();
   if ($qty >= 0) 
    {
         $('.cart_process').fadeIn();
         $('.cart_process').html('Cart updating...');    
//    $id = $(this).attr('id');
    $.post(base_url+'Cart/cartUpdate', {'type': 'update', 'id': $id , 'qty': $qty }, function (data) {
         // alert(data);
        if (data == '') {
            $('.cartMenu').load(base_url+'Cart/demoCart');
            $('.shopcarttable').load(base_url+'Cart/cartTable');
            $('.carttotal').load(base_url+'Cart/cartTotal');
          
             $('.cart_process').html('<i class="fa fa-cross"></i> Something Went Wrong..!');
             $('.cart_process').fadeOut();  
        } else{
                $('.cartMenu').load(base_url+'Cart/demoCart');
                $('.shopcarttable').load(base_url+'Cart/cartTable');
                $('.carttotal').load(base_url+'Cart/cartTotal');
              
               $('.cart_process').html('<i class="fa fa-check-circle-o"></i> Cart Updated...');
             $('.cart_process').fadeOut();           
        }
            if (data > 0) {
                $('.checkoutbtn').removeClass('hide');
            } else {
                $('.checkoutbtn').addClass('hide');
            }
        
        setTimeout(function () {
            $('.cart_process').fadeOut();
        }, 3000);
    });
    }else
    {
          $('.cart_process').fadeIn();
     $('.cart_process').html('Invalid Qty.. Unable to Process');  
     $('.cartMenu').load(base_url+'Cart/demoCart');
     $('.shopcarttable').load(base_url+'Cart/cartTable');
     $('.carttotal').load(base_url+'Cart/cartTotal');
     setTimeout(function () {
            $('.cart_process').fadeOut();
        }, 3000); 
        
    }
     
    $('.cart_process').fadeOut();
}

 
  


function removeCartItem(btn){
     var base_url = $('#base').val();
    $id = $(btn).attr('data-value');

            $('.cart_process').fadeIn();
            $('.cart_process').html('Removing Product...');
            $.post(base_url+'Cart/cartUpdate', {'type': 'remove', 'id': $id}, function (data) {               
               $.post(base_url+'Cart/demoCart', {'id': $id}, function (data) {
                  
               //$('.cart_loader').html(data);
                   $('.cartMenu').load(base_url+'Cart/demoCart');
                    $('.shopcarttable').load(base_url+'Cart/cartTable');
                    $('.carttotal').load(base_url+'Cart/cartTotal');
                    $('.cart_process').html('<i class="fa fa-remove"></i> Product Removed From cart');
                      $('.cart_process').fadeOut();
               });
             
               //$('.cartRespons').html('(<i class="fa fa-inr"> ' + data + '</i>)');
               //$('.subtotal').html('SUBTOTAL: <i class="fa fa-inr"> ' + data + '</i>');
               if (data > 0) {
                   $('.checkoutbtn').removeClass('hide');
               } else {
                   $('.checkoutbtn').addClass('hide');
               }
           });
}
    


  function addQty(btn) {
    
 var base_url = $('#base').val();
    $id = $(btn).attr('data-value');
    $qty = $('#' + $id + '_qty').html();
//alert($('#' + $id + '_qty').html());
    $qty++;
    $qtyval = $(btn).attr('qty');
    // alert($qtyval);
    if ($qtyval <= 10) {
        $('#' + $id + '_qty').html($qty);
    }

    $('.cart_process').fadeIn();
    $('.cart_process').html('Cart updating...');   
     $.post(base_url+'home/cartUpdate', {'type': 'add_qty', 'id': $id}, function (data) {
      //alert(data);
        if (data == '') {
            $('.cartMenu').load(base_url+'home/demoCart');
            $('.shopcarttable').load(base_url+'home/cartTable');
             $('.carttotal').load(base_url+'home/cartTotal');
             $('.sidebartable').load(base_url+'home/sidebartable');
             $('.sidebartotal').load(base_url+'home/sidebartotal');
             $('.cart_process').html('<i class="fa fa-cross"></i> You can add only 10 quantity of each product in cart.');
             $('.cart_process').fadeOut();

        }
        else
        {
             $('.cartMenu').load(base_url+'home/demoCart');
                $('.shopcarttable').load(base_url+'home/cartTable');
               $('.carttotal').load(base_url+'home/cartTotal');
               $('.sidebartable').load(base_url+'home/sidebartable');
             $('.sidebartotal').load(base_url+'home/sidebartotal');
               $('.cart_process').html('<i class="fa fa-check"></i>  Added to cart.');
             $('.cart_process').fadeOut();  
        }

         if (data > 0) {
                $('.checkoutbtn').removeClass('hide');
            } else {
                $('.checkoutbtn').addClass('hide');
            }
        
        setTimeout(function () {
            $('.cart_process').fadeOut();
        }, 3000);
    });
     
}   
    
function minusQty(btn)
{
  var base_url = $('#base').val();
    $id = $(btn).attr('data-value');

   
    $qty = $('#' + $id + '_qty').html();
    $qty--;

    
    $qtyval = $(btn).attr('qty');
           $('.cart_process').fadeIn();
           $('.cart_process').html('Cart updating...');
   if ($qtyval == 1) {

            $.post(base_url+'home/cartUpdate', {'type': 'remove', 'id': $id}, function (data) {   
      

               $.post(base_url+'home/demoCart', {'id': $id}, function (data) {                  
               //$('.cart_loader').html(data); 
                
                    $('.shopcarttable').load(base_url+'home/cartTable');
                     $('.carttotal').load(base_url+'home/cartTotal');
                      $('.cartMenu').load(base_url+'home/demoCart');

                      $('.sidebartable').load(base_url+'home/sidebartable');
                      $('.sidebartotal').load(base_url+'home/sidebartotal');
                       $('.cart_process').html('<i class="fa fa-remove"></i> Product Remove From cart');
                        $('.cart_process').fadeOut();
                     
               });
              
              
               if (data > 0) {
                   $('.checkoutbtn').removeClass('hide');
               } else {
                   $('.checkoutbtn').addClass('hide');
               }
          });
          
    }
    else
    {
      $('#' + $id + '_qty').html($qty);
        $.post(base_url+'home/cartUpdate', {'type': 'minus', 'id': $id,}, function (data) {
             //alert(data);
             if (data == '') {
                    $('.shopcarttable').load(base_url+'home/cartTable');
                    $('.carttotal').load(base_url+'home/cartTotal');
                    $('.cartMenu').load(base_url+'home/demoCart');
                    $('.sidebartable').load(base_url+'home/sidebartable');
                    $('.sidebartotal').load(base_url+'home/sidebartotal');
                    $('.cart_process').html('<i class="fa fa-remove"></i> Remove From cart');
                    $('.cart_process').fadeOut();
             }
             else
             {
               $('.shopcarttable').load(base_url+'home/cartTable');
               $('.carttotal').load(base_url+'home/cartTotal');
               $('.cartMenu').load(base_url+'home/demoCart');
               $('.sidebartable').load(base_url+'home/sidebartable');
               $('.sidebartotal').load(base_url+'home/sidebartotal');
               $('.cart_process').html('<i class="fa fa-cross"></i> You can not buy less than minimum order quantity of each product in cart.');
               $('.cart_process').fadeOut();
             }

              if (data > 0) {
                   $('.checkoutbtn').removeClass('hide');
               } else {
                   $('.checkoutbtn').addClass('hide');
               }
      });
    }

      
   
//   
}


