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
                     jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>mypanel/assets/img/loading.gif" style="height:80px;" /></div>');
//		
//		// LOADING THE AJAX MODAL
                    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
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
                     jQuery('#profile_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>mypanel/assets/img/loading.gif" style="height:80px;" /></div>');
//		
//		// LOADING THE AJAX MODAL
                    jQuery('#profile_ajax').modal('show', {backdrop: 'true'});
//                
       
	}
        
                function showOrderModal(url)
	{
           
		
            $.post(url, { id: '1' }, function(data){
            
			if(data)
			{
                            jQuery('#order_ajax .modal-body').html(data);
				//$("#popup").html(data);
			}
                    });
                     jQuery('#order_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>mypanel/assets/img/loading.gif" style="height:80px;" /></div>');
//		
//		// LOADING THE AJAX MODAL
                    jQuery('#order_ajax').modal('show', {backdrop: 'true'});
//                
       
	}
	function showTestImage(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#image_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>mypanel/assets/img/loading.gif" style="height:80px;" /></div>');
		
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
                     jQuery('#invoice_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>mypanel/assets/img/loading.gif" style="height:80px;" /></div>');
//		
//		// LOADING THE AJAX MODAL
                    jQuery('#invoice_ajax').modal('show', {backdrop: 'true'});
//                
	}
	
	
	</script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax" style="">
        <div class="modal-dialog" >
            <div class="modal-content" style="width: 90%;">
                
                <div class="modal-header">               
                    <button type="button" class="card-close close" data-dismiss="modal" aria-hidden="true" data-dismiss="alert"><i class="ti-close"></i></button>
                    <h4 class="modal-title"><img style="height: 50px;width: 200px;" src="<?php echo base_url();?>mypanel/assets/img/logo.png"></h4>
                </div>
                
                <div class="modal-body" style="min-height:550px; overflow:auto;padding-top: 5px;">
                
                    
                    
                </div>
                
<!--                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>-->
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
	
	 <!-- (Image Modal)-->
    <div class="modal fade" id="image_ajax">
        <div class="modal-dialog image-dialog" >
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b><?php echo "ASBSPL SHOP";?> </b></h4>
                </div>
                
                <div class="modal-body" style="height:500px; overflow:auto;">
                
                    
                    
                </div>
                 <div class="modal-footer"> </div>
               
            </div>
        </div>
    </div>
    
         
     
     <div class="modal fade" id="order_ajax">
        <div class="modal-dialog modal-full" style="width: 64%; margin-right: 16%;">
                <div class="modal-content">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title"><img style="height: 50px;width: 150px;" src="<?php echo base_url();?>mypanel/assets/img/logo.png"></h4>
                    
                           
                        </div>
                    
                    <div class="modal-body" style="padding-top: 0px;">                
                    
                    
                </div>
                   
               </div>
            </div>
    </div>
    <!---------invoice---------->
    <div id="invoice_ajax" class="modal fade">
        <div class="modal-dialog modal-full" style="width: 60%;">
                <div class="modal-content" id="invoice_print">
                        <div class="modal-header">
                            <button type="button" class="close" style="top: 25%;font-size: 20px;" data-dismiss="modal">&times;</button>                             
                                <img src="<?php echo base_url();?>mypanel/assets/img/logo.png" class="modal-title" alt="" style="width: 160px;">
                        </div>
                    
                    <div class="modal-body" style="padding-top: 0px;">                
                    
                    
                </div>
                    <div class="modal-footer">
                        <button onClick="PrintElem('invoice_print')" type="button" class="btn btn-primary btn-labeled"><b><i class="fa fa-print"></i></b> Print</button>
                            <button type="button"  class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
               </div>
            </div>
    </div>

    
    
    <script type="text/javascript">
	function confirm_modal(delete_url , post_refresh_url)
	{
		$('#preloader-delete').html('');
		jQuery('#modal_delete').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute("onClick" , "delete_data('" + delete_url + "' , '" + post_refresh_url + "')" );
		document.getElementById('delete_link').focus();
	}
        
	 function checkDelete()
    {
        var chk=confirm("Are You Sure To Release This !");
        if(chk)
        {
          return true;  
        }
        else{
            return false;
        }
    }
    
     function checkOTP()
    {
        var chk=confirm("Are You Sure To Generate New OTP..!");
        if(chk)
        {
          return true;  
        }
        else{
            return false;
        }
    }
    
	 function checkBlock()
    {
        var chk=confirm("Are You Sure To Update Vehicle Status..?");
        if(chk)
        {
          return true;  
        }
        else{
            return false;
        }
    }
</script>
    
    <!-- (Normal Modal)-->
    