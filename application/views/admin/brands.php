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
							<h4 class="content-title mb-0 my-auto"><a href="<?= base_url(); ?>">Dashboard</a></h4>
								<span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Brands</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header bg-primary">
								<h5 class="text-white">Add New Brand</h5>
							</div>
							<div class="card-body">
								<form action="<?= base_url('admin_panel/Brands/addBrand'); ?>" method="post"  enctype="multipart/form-data">
									<div class="row justify-content-center">
										<div class="col-md-8">
											<div class="form-group">
												<label>Brand/Sub-Category Name</label>
												<input type="text" name="brand" class="form-control" required>
											</div>
											<div class="form-group">
												<label>Parent Category Name</label>
												<select name="cat_id" class="form-control">
													<?php if(!empty($catData)): ?>
														<?php foreach($catData as $cats): ?>
															<option value="<?= $cats['catId'] ?>"><?= $cats['cat_name']; ?></option>
														<?php endforeach; ?>
													<?php endif; ?>
												</select>
											</div>
											
											<div class="form-group">
												<button class="btn btn-primary btn-round">Save Brand</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header bg-primary">
								<h5 class="text-white">All Brands</h5>
							</div>
							<div class="card-body">
								<div class="row justify-content-center">
									<div class="table-responsive">
										<table id="example1" class="table table-bordered table-stripe">
											<thead>
												<tr>
													<th>Brand Name</th>
													<th>Parent Category</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($brnd as $brands): ?>
													<tr>
													<td>
														<a id="br_<?= $brands['brand_id']; ?>" href="#" data-toggle="modal" data-target="#editBrand" class="eedt">
														<?= $brands['brand']; ?>
															
														</td>
													<td><?= $brands['cat_name']; ?></td>
													<td><a onclick="return confirm('Delete this Brand?');" href="<?= base_url('admin_panel/Brands/delbrand/'.$brands['brand_id']); ?>">
														<button class="btn btn-danger btn-rounded">Delete</button>
													</a></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
			<div class="modal fade" id="editBrand" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <h4 class="modal-title">Edit Brand</h4>
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          
		        </div>
		        <div class="modal-body">
		        	<form action="<?= base_url('admin_panel/Brands/UpdateBrand'); ?>" method="post"  enctype="multipart/form-data">
			        	<div class="row justify-content-center">
			        		<div class="form-group col-md-6">
								<label>Brand Name</label>
								<input type="text" id="brName" name="brand" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label>Parent Category Name</label>
								<select id="ctId" name="cat_id" class="form-control">
									<?php if(!empty($catData)): ?>
										<?php foreach($catData as $cats): ?>
											<option value="<?= $cats['catId'] ?>"><?= $cats['cat_name']; ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>
							<input type="hidden" name="brand_id" id="brand_id">
							<div class="form-group col-md-8">
								<button class="btn btn-primary btn-round">Update Brand</button>
							</div>
			        	</div>
		        	</form>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/form_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
					$(".flashd").fadeOut(5000);
				$(".eedt").click(function(){
					//alert("ll")
					ids = this.id;
					spl = ids.split("_");
					brand_id = spl[1];
					$.post("<?= base_url('admin_panel/Brands/getBrandById'); ?>",
					{
						brand_id: brand_id
					},
						function(data)
						{
							//alert(data);
							obj = JSON.parse(data);
							$("#brName").val(obj.brand);
							$("#brand_id").val(obj.brand_id);
							$("#ctId").html(obj.option);
							$("#Imggs").html("<img src='<?= base_url('uploads/brand/'); ?>"+obj.image+"' width='150' />");
							$("#chFile").hide();
							$("#lbl2").hide();

						}
					)
				})
			});

			function dispCh()
			{
				$("#chFile").show();
				$("#Imggs").hide();
				$("#lbl1").hide();
				$("#lbl2").show();
			}
			function hidepCh()
			{
				$("#chFile").hide();
				$("#Imggs").show();
				$("#lbl1").show();
				$("#lbl2").hide();
			}
		</script>
	</body>
</html>