<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
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
							<h4 class="content-title mb-0 my-auto">Premium Members</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								
								<div class="table-responsive">
									<table id="example2" class="table table-bordered">
										<thead>
											<tr>
												<th>Name</th>
												<th>Email</th>
												<th>Mobile</th>
												<th>Plan</th>
												<th>Amount</th>
												<th>Valid Upto</th>
												<th>Features</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($subscr)): ?>
												<?php foreach ($subscr as $key):
													if ($key['status']=="0") {
														$rowDisb = "style='background:#FFE9E1'; color:#fff";
														$expStatus ="<b class='text-danger'>Expired</b>";
													}
													else
													{
														$rowDisb ="style='background:#E5FFE1'";
														$expStatus ="<b class='text-success'>Active</b>";
													}
												 ?>
													<tr <?= $rowDisb; ?>>
														<td><i class="fas fa-crown text-warning"> <?= $key['name']; ?></td>
														<td><?= $key['email']; ?></td>
														<td><?= $key['mobile']; ?></td>
														<td><?= $key['plan_name']; ?></td>
														<td><?= $key['amount']; ?></td>
														<td><?= $key['valiupto']; ?></td>
														<td><?= $key['descr']; ?></td>
														<td><?= $expStatus; ?></td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
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
		<?php include("inc/table_js.php"); ?>
	</body>
</html>