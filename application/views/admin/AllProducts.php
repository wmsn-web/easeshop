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
													<a class="text-warning" href="<?= base_url('admin_panel/AllProducts/EditProd/'.$key['prId']); ?>">
													<i class="fas fa-pen"></i></a>
													<?= nbs(2); ?>
													<a class="text-danger" onclick="return confirm('Are You Sure ? Delete this product.');" href="<?= base_url('admin_panel/AllProducts/DelProd/'.$key['prId']); ?>">
													<i class="fas fa-trash"></i></a>
													<?= nbs(2); ?>
													<a class="text-white" href="#" data-toggle="modal" data-target="#proSetting" onclick="getProsettings('pr_<?= $key['pro_id']; ?>')">
														<i class="fa fa-cog"></i>
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
			<div class="modal" id="proSetting">
					<div class="modal-dialog modal-md modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 id="proNameSS" class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form action="<?= base_url('admin_panel/AllProducts/SetProSetting'); ?>" method="post">
									<div class="form-group">
										<input type="checkbox" name="new_pro" id="Npro" value="1">
										<label>New Product</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="feature_pro" id="Fpro" value="1">
										<label>Featured Product</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="top_pro" id="Tpro" value="1">
										<label>Top Product</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="spl_offer" id="Spro" value="1">
										<label>Special Offered Product</label>
									</div>
									<input type="hidden" name="pro_id" id="pro_id">
									<button class="btn btn-warning">Save</button>
								</form>
							</div>
							<div class="modal-footer">
								
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						</div>
					</div>
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

			function getProsettings(name)
			{
				spl = name.split("_");
					pro_id = spl[1];

					$.post("<?= base_url('admin_panel/AllProducts/getProsettings'); ?>", 
						 {
						 	pro_id: pro_id
						 },
						 function(response,status)
						 {
						 	//$("#proTbl").html(response);
						 	var obj = JSON.parse(response);
						 	$("#pro_id").val(obj.pro_id);
						 	$("#proNameSS").html(obj.prod_name);
						 	//alert(obj.prod_name)
						 	if(obj.top_pro == "1")
						 	{
						 		$("#Tpro").attr("checked",true);
						 	}
						 	else
						 	{
						 		$("#Tpro").attr("checked",false);
						 	}
						 	if(obj.new_pro == "1")
						 	{
						 		$("#Npro").attr("checked",true);
						 	}
						 	else
						 	{
						 		$("#Npro").attr("checked",false);
						 	}
						 	if(obj.feature_pro == "1")
						 	{
						 		$("#Fpro").attr("checked",true);
						 	}
						 	else
						 	{
						 		$("#Fpro").attr("checked",false);
						 	}
						 	if(obj.spl_offer == "1")
						 	{
						 		$("#Spro").attr("checked",true);
						 	}
						 	else
						 	{
						 		$("#Spro").attr("checked",false);
						 	}
						 }
					)
			}
		</script>
	</body>
</html>