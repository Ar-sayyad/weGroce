<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                     <li class="label">Dashboard</li>
                     <?php if($page_title=='Dashboard'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>Trainerdashboard" class="">
                            <i class="ti-home"></i> Dashboard </a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard"><i class="ti-home"></i>Dashboard</a>
                                </li>
                            </ul>
                       
                    </li>
                    
                     <li class="label">User Data</li>                    
                            
                            
                            <?php if($page_title=='Users'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/Users"><i class="ti-user"></i>Users</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/Users"><i class="ti-user"></i>Users</a>
                                </li>
                            </ul>
                            </li>
                            
                             <li class="label">Basic Data</li> 
                            <?php if($page_title=='Categories'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/categories"><i class="ti-view-list-alt"></i>Categories</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/categories"><i class="ti-view-list-alt"></i>Categories</a>
                                </li>
                            </ul>
                            </li> 
                            
                           
                            
                            <?php if($page_title=='Products'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/products"><i class="ti-layout-grid2"></i>Products</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/products"><i class="ti-layout-grid2"></i>Products</a>
                                </li>
                            </ul>
                            </li>
                            <!--<?php if($page_title=='Videos'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/videos"><i class="ti-video-camera"></i>Videos/Audio</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/videos"><i class="ti-video-camera"></i>Videos/Audio</a>
                                </li>
                            </ul>
                            </li>-->

                            <!-- <?php if($page_title=='Series'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/series"><i class="ti-video-camera"></i>Series</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/series"><i class="ti-video-camera"></i>Series</a>
                                </li>
                            </ul>
                            </li> -->
                            
                            <!-- <?php if($page_title=='Tutorial'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/Tutorial"><i class="ti-video-camera"></i>Tutorial</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/Tutorial"><i class="ti-video-camera"></i>Tutorial</a>
                                </li>
                            </ul>
                            </li> -->




                            <!-- <?php if($page_title=='Cources'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/Cources"><i class="ti-video-camera"></i>Cources</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/Cources"><i class="ti-video-camera"></i>Cources</a>
                                </li>
                            </ul>
                            </li> -->
                    <li class="label">Order Data</li>
                   
                        <?php if($page_title=='New Orders'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/newOrders"><i class="ti-shopping-cart"></i>New Orders</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/newOrders"><i class="ti-shopping-cart"></i>New Orders</a>
                                </li>
                            </ul>
                            </li>
                            <?php if($page_title=='Completed Orders'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/completed"><i class="ti-check-box"></i>Completed Orders</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/completed"><i class="ti-check-box"></i>Completed Orders</a>
                                </li>
                            </ul>
                            </li>
                            <?php if($page_title=='Cancelled Orders'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                                <a href="<?php echo base_url();?>Trainerdashboard/cancelled"><i class="ti-close"></i>Cancelled Orders</a>
                                <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/cancelled"><i class="ti-close"></i> Cancelled Orders</a>
                                </li>
                            </ul>
                            </li>
                    
               <!-- <li class="label">Reports</li> -->
                    
                     <!-- <?php if($page_title=='Sales Report'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                        <a href="<?php //echo base_url();?>Trainerdashboard/salesReport" class="">
                            <i class="ti-receipt"></i> Sales Report</a>
                            <ul>
                                <li>
                                    <a href="<?php //echo base_url();?>Trainerdashboard/salesReport"><i class="ti-receipt"></i> Sales Report</a>
                                </li>
                            </ul>
                            
                    </li> -->
                    
                                       
                     <li class="label">My Profile</li>
                      <?php if($page_title=='Profile Setting'){?>
                            <li class="active">
                            <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>Trainerdashboard/profile" class="">
                            <i class="ti-settings"></i> Profile Setting</a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/profile"><i class="ti-settings"></i> Profile Setting</a>
                                </li>
                            </ul>
                    </li>
                   
                    <li>
                        <a href="<?php echo base_url();?>Trainerdashboard/logout"><i class="ti-power-off"></i> Logout</a>
                        <ul>
                                <li>
                                    <a href="<?php echo base_url();?>Trainerdashboard/logout"><i class="ti-power-off"></i> Logout</a>
                                </li>
                            </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>