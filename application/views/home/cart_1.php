<?php include 'header-top.php';?>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
	
	<?php include 'header.php';?>
	<!-- /header -->
	
	<?php include 'main-menu.php';?>
	<!-- /main_menu -->
	
	<main>
		<section id="hero_in" class="cart_section">
			<div class="wrapper">
				<div class="container">
					<div class="bs-wizard clearfix">
						<div class="bs-wizard-step active">
							<div class="text-center bs-wizard-stepnum">Your cart</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="#0" class="bs-wizard-dot"></a>
						</div>

						<div class="bs-wizard-step disabled">
							<div class="text-center bs-wizard-stepnum">Payment</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="#0" class="bs-wizard-dot"></a>
						</div>

						<div class="bs-wizard-step disabled">
							<div class="text-center bs-wizard-stepnum">Finish!</div>
							<div class="progress">
								<div class="progress-bar"></div>
							</div>
							<a href="#0" class="bs-wizard-dot"></a>
						</div>
					</div>
					<!-- End bs-wizard -->
				</div>
			</div>
		</section>
		<!--/hero_in-->

		<div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
				<div class="col-lg-8">
				 <div class="shopcarttable" ></div>
					<!-- /col -->
				</div>
				<div class="col-lg-4">
					<div class="carttotal"> </div>
				</div>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
	</main>
	<!--/main-->
	
	<?php include 'footer.php';?>
	<!--/footer-->
	
	<!-- Search Menu -->
	<?php include 'searchbar.php';?>
        <!-- / Search Menu -->
	
	<!-- COMMON SCRIPTS -->
    <?php include 'footer-contents.php';?>
	
  
</body>

</html>