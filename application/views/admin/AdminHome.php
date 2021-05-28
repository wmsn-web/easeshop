<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/dash_layout.php"); ?>
		<title> Admin Panel</title>
	</head>
	<body class="main-body app sidebar-mini dark-theme">
		<div id="global-loader" class="light-loader">
			<img src="<?= base_url(); ?>admin_assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
		</div>
		<?php include("inc/sidemenu.php"); ?>
		<div class="main-content app-content">
			<?php include("inc/header.php"); ?>
			<div class="container-fluid"> 

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row row-cards">
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="card bg-primary card-img-holder text-white">
							<div class="card-body">
								<img src="<?= base_url(); ?>admin_assets/img/svgicons/circle.svg" class="card-img-absolute" alt="circle-image">
								<h4 class="font-weight-normal  mb-3">Users
									<i class="fas fa-user-tie  tx-30 float-right"></i>
								</h4>
								<h2 class="mb-0"><?= $dashdata['totUser']; ?></h2>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="card bg-warning card-img-holder text-white">
							<div class="card-body">
								<img src="<?= base_url(); ?>admin_assets/img/svgicons/circle.svg" class="card-img-absolute" alt="circle-image">
								<h4 class="font-weight-normal  mb-3">New Orders
									<i class="far fa-heart tx-30 float-right"></i>
								</h4>
								<h2 class="mb-0"><?= $dashdata['newOrder']; ?></h2>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="card bg-info card-img-holder text-white">
							<div class="card-body">
								<img src="<?= base_url(); ?>admin_assets/img/svgicons/circle.svg" class="card-img-absolute" alt="circle-image">
								<h4 class="font-weight-normal mb-3">Products
									<i class="fas fa-layer-group tx-30 float-right"></i>
								</h4>
								<h2 class="mb-0"><?= $dashdata['totProducts']; ?></h2>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="card bg-success card-img-holder text-white">
							<div class="card-body">
								<img src="<?= base_url(); ?>admin_assets/img/svgicons/circle.svg" class="card-img-absolute" alt="circle-image">
								<h4 class="font-weight-normal  mb-3">Return Request
									<i class="far fa-paper-plane tx-30 float-right"></i>
								</h4>
								<h2 class="mb-0"><?= $dashdata['requests']; ?></h2>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-3">
						<div class="card bg-success card-img-holder text-white">
							<div class="card-body">
								<a class="text-white" href="<?= base_url('admin_panel/AllVisitors'); ?>">
									<img src="<?= base_url(); ?>admin_assets/img/svgicons/circle.svg" class="card-img-absolute" alt="circle-image">
									<h4 class="font-weight-normal  mb-3">Visitors
										<i class="far fa-paper-plane tx-30 float-right"></i>
									</h4>
									<h2 class="mb-0"><?= $dashdata['visitors']; ?></h2>
								</a>
							</div>
						</div>
					</div>
				</div>
				
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/dash_js.php"); ?>
	</body>
</html>