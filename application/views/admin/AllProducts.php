<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title> All Products</title>
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
							<h4 class="content-title mb-0 my-auto">All Products</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">All Products</h3>
							</div>
							<div class="card-body">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Image</th>
											<th>Product Name</th>
											<th>Brand</th>
											<th>Category</th>
											<th>Quantity</th>
											<th>Units</th>
											<th>Price</th>
											<th>Offer</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($data)){
										$s = 1;
											foreach($data as $key){ $sl=$s++;
												/*
												if($key['pro_type']=="various"):
													$proName = '<a id="pr_'.$key['pro_id'].'" class="modal-effect" data-effect="effect-newspaper" data-toggle="modal" onclick="showVerPro('')" href="#modaldemo8">'.$key['prod_name'].'</a>';
													else: $proName = $key['prod_name']; 
													endif;
													*/
											 ?>
											<tr>
												<td><?= $sl; ?></td>
												<td><img src="<?= base_url('uploads/products/'.$key['img']); ?>" width="30"></td>
												<td>
													<?php if($key['pro_type']=="various"):?>
														<a class="modal-effect text-warning" data-effect="effect-newspaper" data-toggle="modal" href="#modaldemo8" onclick="showVerPro('pr_<?= $key['pro_id']; ?>')"><?= $key['prod_name']; ?></a>
													<?php else: ?>
														<span><?= $key['prod_name']; ?></span>
													<?php endif; ?>
												</td>
												<td><?= $key['brand']; ?></td>
												<td><?= $key['cat_name']; ?></td>
												<td><?= $key['qty']; ?></td>
												<td><?= $key['units']; ?></td>
												<td>
													<?php if($key['pro_type']=="various"){ ?>
														<a class="modal-effect text-warning" data-effect="effect-newspaper" data-toggle="modal" href="#modaldemo8" onclick="showVerPro('pr_<?= $key['pro_id']; ?>')">Various ProductPrice</a>
													<?php }else{ echo $key['price']; } ?>
												</td>
												<td><?= $key['offer']; ?>%</td>
												<td>
													<a href="<?= base_url('admin_panel/AllProducts/EditProd/'.$key['prId']); ?>">
													<button class="btn btn-warning">Edit</button></a>
													<a onclick="return confirm('Are You Sure ? Delete this product.');" href="<?= base_url('admin_panel/AllProducts/DelProd/'.$key['prId']); ?>">
													<button class="btn btn-danger">Delete</button></a>
												</td>
											</tr>

									   <?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal" id="modaldemo8">
			<div class="modal-dialog modal-md modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 id="proName" class="modal-title">Product Name</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									
									<th>Product Various</th>
									<th>Price</th>
									<th>Sale Price</th>
									
								</tr>
							</thead>
							<tbody id="proTbl">
								
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
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
				/*
				$(".varPro").click(function(){
					ids = this.id;
					spl = ids.split("_");
					pro_id = spl[1];
					$.post("<?= base_url('admin_panel/AllProducts/getVarious'); ?>", 
						 {
						 	pro_id: pro_id
						 },
						 function(response,status)
						 {
						 	$("#proTbl").html(response);
						 }
					)
				});
				*/
			});

			function maketick(name)
				{
					spl = name.split("_");
					numId = spl[1];
					$("#lb_"+numId).html("<i class='fas fa-check-circle text-success'></i>");
					$("#bt_"+numId).show();
				}
			function showVerPro(ids)
			{

					spl = ids.split("_");
					pro_id = spl[1];
					$.post("<?= base_url('admin_panel/AllProducts/getVarious'); ?>", 
						 {
						 	pro_id: pro_id
						 },
						 function(response,status)
						 {
						 	$("#proTbl").html(response);
						 }
					)
			}
		</script>
	</body>
</html>