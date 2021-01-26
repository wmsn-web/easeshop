<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/form_layout.php"); ?>
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
							<h4 class="content-title mb-0 my-auto">Add Membership Plans</h4> 
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									Membership Plans <?= nbs(5); ?> 
									<a href="<?= base_url('admin_panel/MembershipPlans/'); ?>">
										<i class="fas fa-plus"></i> View Plans
									</a>
								</h3>
							</div>
							<div class="card-body">
								<?php if($err= $this->session->flashdata("err")){ ?>
									<span class="text-danger"><?= $err; ?></span>
								<?php } ?>
								<form action="<?= base_url('admin_panel/MembershipPlans/addPlanDetails'); ?>" method="post">
									<div class="form-group">
										<label>Plan Title</label>
										<input type="text" name="title" class="form-control" required="required">
									</div>
									<div class="form-group">
										<label>Plan Features</label>
										<textarea name="descr" class="form-control" required="required"></textarea>
									</div>
									<div class="form-group">
										<label>Plan Description</label>
										<textarea name="full_descr" class="form-control" required="required"></textarea>
									</div>
									<div class="form-group">
										<label>Plan Price</label>
										<input type="text" name="price" class="form-control" required="required">
									</div>
									<div class="form-group">
										<label>Plan Duration (Days)</label>
										<input type="number" name="duration" class="form-control" required="required">
									</div>
									<div class="form-group">
										<button class="btn btn-primary">Save</button>
									</div>
								</form>
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
		<?php include("inc/form_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".flashd").fadeOut(5000);
			});
		</script>
	</body>
</html>