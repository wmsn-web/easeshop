<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/form_layout.php"); ?>
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
							<h4 class="content-title mb-0 my-auto">Push Notifications For All Users</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-body">
								<form action="<?= base_url('admin_panel/GlobalOfferNotice'); ?>" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-12 col-lg-6">
											<div class="row">
												<div class="form-group col-sm-6">
													<label>Notification Title</label>
													<input type="text" name="title" class="form-control" placeholder="Title" required="">
												</div>
												<div class="form-group col-sm-6">
													<label>Select Category</label>
													<select type="text" name="cat_id" class="form-control" placeholder="" required="">
														<option selected value="">Select Category</option>
														<?php if(!empty($catData)): ?>
															<?php foreach($catData as $cat): ?>
																<option value="<?= $cat['catId']; ?>"><?= $cat['cat_name']; ?></option>
															<?php endforeach; ?>
														<?php endif; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label>Notification Message</label>
												<textarea name="message" class="form-control" placeholder="Message" required="" rows="5"></textarea>
											</div>
											<div class="form-group">
												<button class="btn btn-primary"><i class="far fa-paper-plane"></i> Send</button>
											</div>
										</div>
										<div class="col-md-12 col-lg-6">
											<div class="form-group">
												<label>Notification Image</label>
											<input type="file" name="main_img" class="dropify" data-height="190"  required="" />
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- row closed -->
			</div>
			<!-- Container closed -->
			<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/form_js.php"); ?>
	</body>
</html>