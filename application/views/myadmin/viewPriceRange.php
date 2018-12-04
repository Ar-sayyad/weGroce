<?php 
$single_category_info = $this->db->get_where('price_range', array('price_range_id' => $param2))->result_array();
foreach ($single_category_info as $row) {
?>
<!-- Styles -->
    <link href="<?php echo base_url();?>mypanel/assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
       <section id="main-content">
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4> Price Range</h4>                                        
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>Admin/priceRange/editpriceRange/<?php echo $row['price_range_id'];?>" method="post" enctype="multipart/form-data">   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                    <div class="col-md-4">
                                                        <label>Min Price <span class="required">*</span></label>
                                                    </div>
                                                 <div class="col-md-8">
                                                    <input type="text"  name="min_price" required="" value="<?php echo $row['min_price'];?>" class="form-control border-none input-flat  bg-ash" placeholder="Min Price">
                                                 </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                    <div class="col-md-4">
                                                        <label>Max Price <span class="required">*</span></label>
                                                    </div>
                                                 <div class="col-md-8">
                                                    <input type="text"  name="max_price" required="" value="<?php echo $row['max_price'];?>" class="form-control border-none input-flat  bg-ash" placeholder="Max Price">
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    
                                        
                                                              
                                  
                                </div>                                
                                </form>
                            </div>
                        </div>
                    </div>
                  
                    
         
                    
   </section>
<?php }
?>
    <!-- scripit init-->
