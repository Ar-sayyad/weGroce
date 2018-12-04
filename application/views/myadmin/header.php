<?php include 'modal.php';?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>


<div class="header">
        <div class="pull-left">
            <div class="logo"><a style="color: #ff0582;font-size: 20px;font-weight: 600;" href="<?php echo base_url();?>Admin"><img style="width:50px" src="<?php echo base_url();?>home/images/img/favicon.png" alt="Wegrocers" /> WeGrocers.com</a></div>
            <div class="hamburger sidebar-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="pull-right p-r-15">
            <ul>

                <li class="header-icon dib">
                    <img class="avatar-img" src="<?php echo base_url();?>assets/uploads/profile/<?php echo $this->session->userdata('log_image');?>" alt="" /> 
                    <span class="user-avatar"><?php echo $this->session->userdata('log_admin_name');?> <i class="ti-angle-down f-s-10"></i></span>
                    <div class="drop-down dropdown-profile">                        
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="<?php echo base_url();?>Admin/profile"><i class="ti-user"></i> <span>Profile</span></a></li>
                                <li><a href="<?php echo base_url();?>Admin/profile"><i class="ti-settings"></i> <span>Setting</span></a></li>
                                <li><a href="<?php echo base_url();?>Admin/logout"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>