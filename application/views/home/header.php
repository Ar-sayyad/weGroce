
    <header>
    <div class="container">
      <div class="logo">
          <a href="<?php echo base_url();?>">
              <h4 class="logonm" style="color: white;"><img style="width: 50px;" src="<?php echo base_url();?>home/images/img/logo.png" alt="" > WeGrocers</h4>
          </a> 
      </div>
      <div class="search-cate">
        <select class="selectpicker" id="select" onchange="searchData();" name="select">
<!--            <option value="1">Trainers</option>-->
            <option value="2">Products</option>        
        </select>
        <input type="search" autocomplete="off" onkeyup="searchData();" id="search-data" placeholder="Search Your Products Here">
      
      <ul class="result"></ul>
      </div>     
      
      <!-- Cart Part -->
      <ul class="nav navbar-right cart-pop cartMenu">
        <li class="dropdown "> 
            <a href="<?php echo base_url();?>Cart" style="color: #ededed;" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="itm-cont">0</span> <i class="flaticon-shopping-bag"></i>

            </a>

        </li>
      </ul>
    </div>
    
    <!-- Menubar -->
    <nav class="navbar ownmenu" id="navbar">
      <div class="container">
        
        <div class="" id="nav-open-btn">
          <ul class="nav">
              <li class="" style="padding-left:15%;"><a href="<?php echo base_url();?>">Home </a></li>
            <li class=""><a href="<?php echo base_url();?>Category">Fruits </a></li>
             <li class=""><a href="<?php echo base_url();?>Category">Vegetables </a></li>
              <li class=""><a href="<?php echo base_url();?>Category">Food Mart </a></li>
               <!--<li class=""><a href="<?php echo base_url();?>Category">Home & Hygiene </a></li>-->
                <li class=""><a href="<?php echo base_url();?>Category">Beauty Products </a></li>
                 <li class=""><a href="<?php echo base_url();?>Category">Dairy & Beverages </a></li>
                  <li class=""><a href="<?php echo base_url();?>Category">Health </a></li>
            <!--<li class=""><a href="<?php echo base_url();?>Questions">Questions & Answers </a></li>-->
            <!--<li class=""><a href="<?php echo base_url();?>About">About Us </a></li>--> 
            <li class=""><a href="<?php echo base_url();?>Contact">Contact Us </a></li>  
            <!--<li> <a href="<?php echo base_url();?>Login">Login</a></li>-->
            
            <!-- <?php  if ($this->session->userdata('user_login') == 1){ ?>
                       <li><a href="<?php echo base_url();?>cart/trackorder" class="">Trackorder</a></li>
                       
                       <?php  if($this->session->userdata('login_email_id')!=""){   ?>
                            <li><a href="<?php echo base_url();?>account" class="">Profile</a></li>
                        <?php }else{ ?>
                             <li><a style="cursor:pointer" data-toggle="modal" data-target="#modal_ajax" onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/home/profile/');" class="">Profile</a></li>
                       <?php } ?>
                             <li><a href="<?php echo base_url();?>Shop/logout" class="">Logout</a></li>
                    <?php }else{ ?>
                        <li><a style="cursor:pointer" data-toggle="modal" data-target="#modal_ajax"  onclick="showAjaxModal('<?php echo base_url();?>Shop/popup/home/sendVerificationCode/');" class="">Login</a></li>
                    <?php } ?>  -->                           
          </ul>
        </div>
        
      </div>
    </nav>
  </header>

<script>
    function mySearchTab(){
        searchData(); 
    }
    function searchData(){
        $search = $("#search-data").val();
        $select = $("#select").val();
        if($search !='' && $select==2){
        $('.result').addClass('disp');
        $('.result').html("<li class='search-product'><img width='25' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'></li>");
       $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Product/searchProducts",
            data: { search: $search },
            dataType: "json",
            success: function (data) { 
                if (data.length > 0) {                   
                  $('.result').empty();                  
                     $.each(data, function (key,value) {
                         var name= value['product_title'];
                            var id= value['product_id'];
                            var ref_no= value['product_code'];
                            var prod_url= value['product_url'];                        
                         $('.result').append('<a href="<?php echo base_url();?>product/products/'+ref_no+'/'+prod_url+'"><li class="search-product">' + name + '</li></a>');
                     });
                }
                else{
                     $('.result').html('<li class="search-product"> No Product Found..!</li>');                      
                }
            } 
            });
            }else if($search !='' && $select==1){
                $('.result').addClass('disp');
        $('.result').html("<li class='search-product'><img width='25' src='<?php echo base_url();?>mypanel/assets/img/loading.gif'></li>");
       $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>trainers/searchTrainers",
            data: { search: $search },
            dataType: "json",
            success: function (data) { 
               // alert(data);
                if (data.length > 0) {                   
                  $('.result').empty();                  
                     $.each(data, function (key,value) {
                         var name= value['firstName']+' '+value['lastName'];
                         var id= value['id'];
                         var designation= value['designation'];
                            //var prod_url= value['product_url'];                        
                         $('.result').append('<a href="<?php echo base_url();?>trainers/trainersinfo/'+id+'"><li class="search-product">' + name + ' '+designation+'</li></a>');
                     });
                }
                else{
                     $('.result').html('<li class="search-product"> No Trainer Found..!</li>');                      
                }
            } 
            });            
            }else{
             $('.result').empty();
             $('.result').addClass('disp');
             }
       
    }
          

</script> 