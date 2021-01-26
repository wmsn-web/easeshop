<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title>Shipping Zone - Admin Panel</title>
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
							<h4 class="content-title mb-0 my-auto">Shipping Zone</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Add Shipping Zone</h3>
							</div>
							<div class="card-body">
								<?= form_open_multipart('admin_panel/ShippingZone/addShipping'); ?>
							<div class="form-group">
								<label>Location Name</label>
								<input type="text" name="location_name" class="form-control" value="" />
							</div>
							
							<div class="form-group">
								<label>Zip Code</label>
								<input type="number" name="zip_code" class="form-control" value="" />
							</div>
							<button class="btn btn-primary">Add</button>
						</form>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card  scrolTbody">
							<div class="card-header">
								<h3 class="card-title">Shipping Zone</h3>
							</div>
							<div class="card-body">
								<table id="example2" class="table table-bordered">
									<thead>
										<tr>
											<th>SL</th>
											<th>Location Name</th>
											<th>Zip Code</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($data)): ?>
											<?php $s = 1; foreach($data as $zone): $sl = $s++; ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?= $zone['location_name']; ?></td>
													<td><?= $zone['zip_code']; ?></td>
													<td>
														<a href="#" id="zn_<?= $zone['zone_id']; ?>" class="text-warning edt" data-toggle="modal" data-target="#EditZone">Edit</a>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
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
		<div class="modal fade" id="EditZone" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Shipping Zone</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <?= form_open_multipart('admin_panel/ShippingZone/EditShipping'); ?>
							<div class="form-group">
								<label>Location Name</label>
								<input type="text" name="location_name" id="ln" class="form-control" value="" />
							</div>
							
							<div class="form-group">
								<label>Zip Code</label>
								<input type="number" name="zip_code" id="zc" class="form-control" value="" />
								<input type="hidden" name="zone_id" id="zi">
							</div>
							<button class="btn btn-primary">Add</button>
						</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".flashd").fadeOut(5000);
				$(".edt").click(function(){
	              ids = this.id;
	              spl = ids.split("_");
	              zone_id = spl[1];
	              $.post("<?= base_url('admin_panel/ShippingZone/getZoneById'); ?>",
	              		{
	              			zone_id: zone_id
	              		},
	              		function(data)
	              		{
	              			obj = JSON.parse(data);
	              			$("#ln").val(obj.location_name);
	              			$("#zc").val(obj.zip_code);
	              			$("#zi").val(obj.zone_id)
	              		}
	              	)
	          });
			});
		</script>
	</body>
</html>