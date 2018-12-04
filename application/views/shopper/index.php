<?php include 'header-top.php';?>
<style>
    .highcharts-credits{
        display: none;
    }
</style>
<body>

    <!-- # sidebar -->
    <?php include 'sidebar.php';?>
    <!-- /# sidebar -->


    <!-- # header -->
    <?php include 'header.php';?>
    <!-- /# header -->
    
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
             
                <!---page title-->
                <?php include 'page-title.php';?>

                  <div id="containerr" style=""></div>
                <!---/page-title--->
                               
                <section id="main-content">
                    <div class="row">                       
                      
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">Total Users</div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <i style="font-size:40px" class="ti-user color-danger"></i>
                                            <span class="stat-digit">
                                         <?php echo $user_cnt;?>
                                               </span>
                                        </div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">Total Categories</div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <i style="font-size:40px" class="ti-view-list-alt color-danger"></i>
                                            <span class="stat-digit"> 
                                                   <?php echo $category_cnt;?>
                                            </span>
                                        </div>
                                       
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">New Orders</div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <i style="font-size:40px" class="ti-shopping-cart color-danger"></i>
                                            <span class="stat-digit"> 
                                                   <?php echo $trainer_neworder_cnt;?>
                                            </span>
                                        </div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">Total Products</div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <i style="font-size:40px" class="ti-layout-grid2 color-danger"></i>
                                            <span class="stat-digit"> 
                                                <?php  echo $trainer_product_cnt; ?>
                                            </span>

                                        </div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
                        </div>
                      
                      
                    </div>
                  
                    
                 
                  
                    <!-- /# row -->
                    <!--FOOTER CONTENTS--->
                     <?php include 'footer-contents.php';?>
                    <!---/FOOTER CONTENTS-->
                </section>
            </div>
        </div>
    </div>

  

<script>
Highcharts.chart('containerr', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: 'Todays Sale By Vendor.'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Todays  Fuel Cost'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: 'Rs.{point.y:.1f}'
            }
        }
    },

    tooltip: {
        pointFormat: '<span style="color:{point.color}">Todays Sale of {point.name} Rs:</span><b>{point.y:.2f}</b><br/>'
    },

    series: [{
        name: 'Vendor',
        colorByPoint: true,

        data:  [ <?php echo $maainseries;?> ]
    }],
    
});
</script>

     <!-- # footer -->
    <?php include 'footer.php';?>
    <!-- /# footer -->
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="<?php echo base_url();?>mypanel/assets/js/lib/chart-js/chartjs-init.js"></script>
</body>


</html>