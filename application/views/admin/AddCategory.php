<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/form_layout.php"); ?>
		<title> Add Category - Admin Panel</title>
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
							<h4 class="content-title mb-0 my-auto">Add Category</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-5">
						<div class="card">
							<div class="card-header bg-primary text-center">
								<h3 class="text-white card-title">
									<?php if(!$this->uri->segment(4)=="edit"): ?>
									Add Product Category
									<?php ; else: ?>
									Edit Product Category
									<?php ; endif; ?>
								</h3>
							</div>
							<div class="card-body">
								<?php if(!$this->uri->segment(4)=="edit"): ?>
									<form action="<?= base_url('admin_panel/AddCategory/addCat'); ?>" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label>Category Name</label>
											<input type="text" name="cat_name" class="form-control" required="required">
										</div>
										<div class="form-group">
											<label>Category Image</label>
											<input type="file" name="cat_img" class="dropify" data-height="200" />
										</div>
										<div class="form-group">
											<button class="btn btn-primary">Save</button> 
										</div>
									</form>
								<?php ; else: ?>
								<?php if(empty($data)){ echo "Invalid Category!";} else{ ?>
									<form action="<?= base_url('admin_panel/AddCategory/editCat/'.$data['catId']); ?>" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label>Category Name</label>
											<input type="text" name="cat_name" class="form-control" required="required" value="<?= $data['cat_name']; ?>">
										</div>
										<div class="form-group">
											<label>Category Image</label>
											<input type="file" name="cat_img" class="dropify" data-height="200" data-default-file="<?= base_url('uploads/category/'.$data['cat_img']); ?>" />
										</div>
										<div class="form-group">
											<button class="btn btn-primary">Save</button>
										</div>
									</form>
								<?php } ?>
								<?php ; endif; ?>
							</div>
						</div>
					</div>
				</div>
				
				<!-- row closed -->
				<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
			</div>

			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/form_js.php"); ?>
	</body>
</html>