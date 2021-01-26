<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title> All Category</title>
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
							<h4 class="content-title mb-0 my-auto">All Category</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">All Category</h3>
							</div>
							<div class="card-body">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th class="bg-primary text-white">Category Name</th>
											<th class="bg-warning text-white">Edit</th>
											<th class="bg-success text-white">Image</th>
											<th class="bg-danger text-white">Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($data)){ ?>
											<?php $s =1; foreach ($data as $key) { $sl = $s++;

											 ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><b><?= $key['cat_name']; ?></b>
													(<?= $key['prod']; ?> Products)</td>
													<td><a href="<?= base_url('admin_panel/AddCategory/index/edit/'.$key['catId']); ?>">Edit</a></td>
													<td><img src="<?= base_url('uploads/category/'.$key['cat_img']); ?>" width="50"></td>
													<td>
														<a onclick="return confirm('Are you Sure? Delete this Category.')" class="text-danger" href="<?= base_url('admin_panel/AddCategory/delCat/'.$key['catId']); ?>">
														Delete</a></td>
												</tr>
											<?php } ?>
									    <?php } ?>
									</tbody>
								</table>
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
	</body>
</html>