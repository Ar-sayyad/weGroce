<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Aasif Sayyad" />
<!-- Document Title -->
<title> WeGrocers.com | Online Grocery site </title>

<!-- Favicon -->
 <link rel="shortcut icon" href="<?php echo base_url();?>home/images/img/favicon.png" type="image/x-icon">

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>home/rs-plugin/css/settings.css" media="screen" />
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<!-- StyleSheets -->
<link rel="stylesheet" href="<?php echo base_url();?>home/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>home/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>home/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>home/css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>home/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>home/css/responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>home/css/trainerd.css">
<link href="<?php echo base_url();?>home/css/meratrainer.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url();?>home/js/vendors/bootstrap.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!-- Fonts Online -->
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

<!-- JavaScripts -->
<!--<script src="<?php echo base_url();?>home/js/vendors/modernizr.js"></script>-->
</head>
<input type="hidden" id="base" value="<?php echo base_url(); ?>">
<div class="col-md-2 col-xs-4 prod_filtering" style="display: none;text-align: center;top:30%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 1.8;">
        <img width="80%" src="<?php echo base_url();?>home/images/img/loadings.gif">
</div>

<div class="col-md-2 col-xs-4 cart_process" style="display: none;text-align: center;top:50%;z-index: 999999;color:#fff;padding: 10px;position: fixed;left: 0;right: 0;margin: auto;opacity: 0.8;background-color: rgb(189, 36, 65);">
Going to Cart...
</div>
<?php include 'modal.php';?>