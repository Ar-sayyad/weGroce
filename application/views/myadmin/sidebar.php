<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                     <li class="label">Dashboard</li>
                     <?php if($page_title=='Dashboard'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>Admin" class="">
                            <i class="ti-home"></i> Dashboard </a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin"><i class="ti-home"></i>Dashboard</a>
                                </li>
                            </ul>
                       
                    </li>
                    
                     <li class="label">User Data</li>                    
                            
                            <?php if($page_title=='Users'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/Users"><i class="ti-user"></i>Users</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/Users"><i class="ti-user"></i>Users</a>
                                </li>
                            </ul>
                            </li>
                            
                             <?php if($page_title=='Contact Enquiry'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/Contact"><i class="ti-email"></i>Enquiry</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/Contact"><i class="ti-email"></i>Enquiry</a>
                                </li>
                            </ul>
                            </li>
                            
                            
                             <li class="label">Basic Data</li> 
                            <?php if($page_title=='Categories'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/categories"><i class="ti-view-list-alt"></i>Categories</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/categories"><i class="ti-view-list-alt"></i>Categories</a>
                                </li>
                            </ul>
                            </li>
                            
                            <!-- <?php if($page_title=='Language'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/language"><i class="ti-layout-grid2"></i>Language</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/language"><i class="ti-layout-grid2"></i>Language</a>
                                </li>
                            </ul>
                            </li>-->
                            
<!--                             <?php if($page_title=='Price Range'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/price_range"><i class="fa fa-inr"></i>Price Range</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/price_range"><i class="fa fa-inr"></i>Price Range</a>
                                </li>
                            </ul>
                            </li>-->
                            
                              <!--<?php if($page_title=='Type'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/type"><i class="ti-layout-grid2"></i>Type</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/type"><i class="ti-layout-grid2"></i>Type</a>
                                </li>
                            </ul>
                            </li>
                            
                            <?php if($page_title=='Suitable For'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/suitable"><i class="ti-layout-grid2"></i>Suitable For</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/suitable"><i class="ti-layout-grid2"></i>Suitable For</a>
                                </li>
                            </ul>
                            </li>-->
                            
                            
                            
                                
                            <?php if($page_title=='Products'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/products"><i class="ti-layout-grid2"></i>Products</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/products"><i class="ti-layout-grid2"></i>Products</a>
                                </li>
                            </ul>
                            </li>
                            
                                                  
                    <li class="label">Order Data</li>
                   
                        <?php if($page_title=='New Orders'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/newOrders"><i class="ti-shopping-cart"></i>New Orders</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/newOrders"><i class="ti-shopping-cart"></i>New Orders</a>
                                </li>
                            </ul>
                            </li>
                            <?php if($page_title=='Completed Orders'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/completedOrders"><i class="ti-check-box"></i>Completed Orders</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/completedOrders"><i class="ti-check-box"></i>Completed Orders</a>
                                </li>
                            </ul>
                            </li>
                            <?php if($page_title=='Cancelled Orders'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Admin/cancelledOrders"><i class="ti-close"></i>Cancelled Orders</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/cancelledOrders"><i class="ti-close"></i> Cancelled Orders</a>
                                </li>
                            </ul>
                            </li>
                    
               <!-- <li class="label">Reports</li> -->
                    
                     <!-- <?php if($page_title=='Sales Report'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                        <a href="<?php //echo base_url();?>Admin/salesReport" class="">
                            <i class="ti-receipt"></i> Sales Report</a>
                            <ul>
                                <li>
                                    <a href="<?php //echo base_url();?>Admin/salesReport"><i class="ti-receipt"></i> Sales Report</a>
                                </li>
                            </ul>
                            
                    </li> -->
                    
                                       
                     <li class="label">My Profile</li>
                      <?php if($page_title=='Profile Setting'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>Admin/profile" class="">
                            <i class="ti-settings"></i> Profile Setting</a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/profile"><i class="ti-settings"></i> Profile Setting</a>
                                </li>
                            </ul>
                    </li>
                   
                    <li>
                        <a href="<?php echo base_url();?>Admin/logout"><i class="ti-power-off"></i> Logout</a>
                        <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Admin/logout"><i class="ti-power-off"></i> Logout</a>
                                </li>
                            </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>