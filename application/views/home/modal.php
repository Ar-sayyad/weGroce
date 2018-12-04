    <script type="text/javascript">
	function showAjaxModal(url)
	{
            $.post(url, { id: '1' }, function(data){
            
			if(data)
			{
                            jQuery('#modal_ajax .modal-body').html(data);
				//$("#popup").html(data);
			}
                    });
                     jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>home/images/img/loadings.gif" style="height:80px;" /></div>');
//		
//		// LOADING THE AJAX MODAL
                    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
//                
       
	}

    function showModal(url)
    {
            $.post(url, { id: '1' }, function(data){
            
            if(data)
            {
                            jQuery('#modal_ajax_invoice .modal-body_invoice').html(data);
                //$("#popup").html(data);
            }
                    });
                     jQuery('#modal_ajax_invoice .modal-body_invoice').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>home/images/img/loadings.gif" style="height:80px;" /></div>');
//      
//      // LOADING THE AJAX MODAL
                    jQuery('#modal_ajax_invoice').modal('show', {backdrop: 'true'});
//                
       
    }
        
        function showProfileModal(url)
	{
           
		
            $.post(url, { id: '1' }, function(data){
            
			if(data)
			{
                            jQuery('#profile_ajax .modal-body').html(data);
				//$("#popup").html(data);
			}
                    });
                     jQuery('#profile_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>home/images/img/loadings.gif" style="height:80px;" /></div>');
//		
//		// LOADING THE AJAX MODAL
                    jQuery('#profile_ajax').modal('show', {backdrop: 'true'});
//                
       
	}
	function showTestImage(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#image_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>home/images/img/loadings.gif" style="height:80px;" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#image_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#image_ajax .modal-body').html(response);
			}
		});
	}

  function showInvoice(url)
  {
            $.post(url, { id: '1' }, function(data){
            
      if(data)
      {
                            jQuery('#invoice_ajax .modal-body').html(data);
        //$("#popup").html(data);
      }
                    });
                     jQuery('#invoice_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>home/images/img/loadings.gif" style="height:80px;" /></div>');
//    
//    // LOADING THE AJAX MODAL
                    jQuery('#invoice_ajax').modal('show', {backdrop: 'true'});
//                
       
  }

	
	
	</script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax" style="width: 100%;margin-top: 30px">
        <div class="modal-dialog" >
            <div class="modal-content" style="width: 80%;margin-left: 10%;">
                
                <div class="modal-header" style="background: #555555"> 
                     <h4 class="modal-title"><img style="height: auto;width: 150px;" src="<?php echo base_url();?>home/images/logo.png"></h4>
                    
                     <!--<button style="cursor: pointer" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cancel-circled" style="color:RED;font-size:25px"></i></button>-->
                    
                </div>
                
                <div class="modal-body" style="min-height:450px;height: 450px;max-height: auto;verflow: visible;margin-top: 0px;">
                                   
                    
                </div>
                
<!--                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>-->
            </div>
        </div>
    </div>


   <div class="modal fade" id="invoice_ajax" style="width: 100%;margin-top: 30px">
        <div class="modal-dialog" >
            <div class="modal-content" style="width: 122%;margin-left: -8%;">
                
                <div class="modal-header" style="background: #555555"> 
                     <h4 class="modal-title"><img style="height: auto;width: 250px;" src="<?php echo base_url();?>home/images/logo.png"></h4>
                    
                     <!--<button style="cursor: pointer" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cancel-circled" style="color:RED;font-size:25px"></i></button>-->
                    
                </div>
                
                <div class="modal-body" style="min-height:450px;height: auto;max-height: auto;overflow: visible;margin-top: 0px;">
                
                    
                    
                </div>

            </div>
        </div>
    </div>
     
    
    <div class="modal fade" id="profile_ajax" style="">
        <div class="modal-dialog" >
            <div class="modal-content" style="width: 90%;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><img style="height: 50px;width: 200px;" src="<?php echo base_url();?>mypanel/assets/img/logo.png"></h4>
                </div>
                
                <div class="modal-body" style="height:600px; overflow:auto;margin-top: -13px;">
                
                    
                    
                </div>
                
<!--                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>-->
            </div>
        </div>
    </div>
	
  <script type="text/javascript">
     function orderCancel(id)
    {
        var chk=confirm("Are You Sure To Cancel This Order..?");
        if(chk)
        {
          //return true;
          $username = $("#username").val();
         
           $contact = $("#cont").val();
           $order_id = id;
           $.post("<?php echo base_url();?>Cart/changeOrderStatus", { order_id: $order_id, order_status:6,username:$username, contact:$contact }, function(data){
                if(data==1){
//                     $("#logsuccess").show();
//                        $('#logsuc').html("<h5><span style='font-size: 20px;margin-top: 11px;margin: 10px;'><i class='fa fa-check-circle-o'></i></span><span style='color:green;text-transform:capitalize;font-size:12px'>Your Profile is Updated Successfully..!</span><br><img width='20' src='<?php echo base_url();?>assets/img/loading.GIF'><br><span style='font-size:10px'>Redirecting.....</span></h5>");
                        window.location="<?php echo base_url();?>cart/trackorder";
                                            
                    }else
            {
//                                $("#regmsg").show();
//              $("#regmsgp").html(data);
                                alert(data);
            }
    }).fail(function() {
                alert( "Posting failed." );
            });
        }
        else{
            return false;
        }
    }
    
    
//  function likes(product_id)
//  {
//      $product_id = product_id;
//      $user_id = $("#user_id").val();
//      $count = $("#like_count").val();
//
//    
//       $.post("<?php echo base_url();?>Product/likes", { product_id: $product_id,user_id:$user_id }, function(data){
//         
//           if(data==1){
//                 $('.preloader').fadeOut();
//              window.location.reload();
//   
//
//                                            
//                    }else
//            {
//                 
////                                $("#regmsg").show();
////              $("#regmsgp").html(data);
//                               $('.prod_filtering').fadeOut();
//            }
//      
//    });
//                
//     
//  }
  
  
      function likes(value){
                 $likes = parseInt($("#liks"+value).val());
                
               //   $user_id = $("#user_id").val();
                 $one = 1;
                  $('.lik'+value).html("<img style='width:10px;height:10px' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                  $.post("<?php echo base_url();?>Product/likes", { product_id:value}, function(data){
           
             	if(data!=""){
                   $('.lik'+value).html(data);                    
                }
                 
                else {
                    $('.likedstatus').fadeIn();
                    $('.likedstatus').html('Check Login..!');
                    $('.likedstatus').fadeOut(3000);
                }
            }).fail(function() {
                alert( "Posting failed." );
            });
                 
             }



  //  function follow(value)
  // {

  //    $follows = parseInt($("#follows"+value).val());
  //     $one = 1;
  //      $('.flw'+value).html("<img width='10' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
  //      $.post("<?php echo base_url();?>Product/follow", { product_id: $product_id,user_id:$user_id }, function(data){
  //         if(data!=""){
  //                  $('.flw'+value).html(data);                    
  //               }
                 
  //               else {
  //                   $('.likedstatus').fadeIn();
  //                   $('.likedstatus').html('Check Login..!');
  //                   $('.likedstatus').fadeOut(3000);
  //               }
         
           
      
  //   }).fail(function() {
  //               alert( "Posting failed." );
  //           });
                
     
  // }

     function follow(value){
                 $follows = parseInt($("#follows"+value).val());
              
               //   $user_id = $("#user_id").val();
                 $one = 1;
                  $('.flw'+value).html("<img width='10' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'>");
                  $.post("<?php echo base_url();?>Product/follow", { product_id:value}, function(data){
         
              if(data!=""){
                   $('.flw'+value).html(data);                    
                }
                 
                else {
                    $('.likedstatus').fadeIn();
                    $('.likedstatus').html('Check Login..!');
                    $('.likedstatus').fadeOut(3000);
                }
            }).fail(function() {
                alert( "Posting failed." );
            });
                 
             }
 </script> 
    
  
    