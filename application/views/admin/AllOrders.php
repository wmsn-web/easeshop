<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title> All Orders</title>
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
							<h4 class="content-title mb-0 my-auto">All Orders</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">All Orders</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>Date</th>
											<th>Order ID</th>
											<th>Username</th>
											<th>Price</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										
											<tr id="">
												<td>05-05-2020</td>
												<td>#55422698</td>
												<td>anuj123</td>
												<td>5690.00</td>
												<td>New</td>
												<td>	
													<button class="btn btn-warning">View Details</button>
													<button id="cncl" class="btn btn-danger">Cancel Order</button>
												</td>
											</tr>
											<tr id="">
												<td>05-05-2020</td>
												<td>#55422698</td>
												<td>anuj123</td>
												<td>5690.00</td>
												<td>Completed</td>
												<td>	
													<button class="btn btn-warning">View Details</button>
													<button id="cncl" class="btn btn-danger">Cancel Order</button>
												</td>
											</tr>
											<tr id="">
												<td>05-05-2020</td>
												<td>#55422698</td>
												<td>anuj123</td>
												<td>5690.00</td>
												<td>Processing</td>
												<td>	
													<button class="btn btn-warning">View Details</button>
													<button id="cncl" class="btn btn-danger">Cancel Order</button>
												</td>
											</tr>
											<tr id="">
												<td>05-05-2020</td>
												<td>#55422698</td>
												<td>anuj123</td>
												<td>5690.00</td>
												<td>Cancelled</td>
												<td>	
													<button class="btn btn-warning">View Details</button>
													<button id="cncl" class="btn btn-danger">Cancel Order</button>
												</td>
											</tr>

										
									  
									</tbody>
								</table>
								<div class="table-responsive">
							</div>
						</div>
					</div>
					
				</div>
				
				<!-- row closed -->
			</div>
			<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#cncl").click(function(){
					$("#tr_1").remove();
				});
			});
		</script>
	</body>
</html>