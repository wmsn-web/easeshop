<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title>Membership Plans - Admin Panel</title>
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
							<h4 class="content-title mb-0 my-auto">Membership Plans</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									Membership Plans <?= nbs(5); ?> 
									<a href="<?= base_url('admin_panel/MembershipPlans/AddPlan'); ?>">
										<i class="fas fa-plus"></i> Add Plan
									</a>
								</h3>
							</div>
							<div class="card-body">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>Plan Title</th>
											<th>Description</th>
											<th>Price</th>
											<th>Duration</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($data)){
										foreach($data as $key){ ?>
										<tr>
											<td><?= $key['title']; ?></td>
											<td><?= substr(html_entity_decode($key['descr']),0,100); ?></td>
											<td><?= $key['price']; ?></td>
											<td><?= $key['duration']; ?></td>
											<td>
												<a href="<?= base_url('admin_panel/MembershipPlans/EditPlans/'.$key['id']); ?>">
													<button class="btn btn-warning">Edit</button>
												</a>
												<a href="<?= base_url('admin_panel/MembershipPlans/delPlans/'.$key['id']); ?>">
													<button class="btn btn-danger">Delete</button>
												</a>
											</td>
										</tr>
									<?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<!-- row closed -->
				<?php if($feed= $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
			</div>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
	</body>
</html>