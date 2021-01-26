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
							<h4 class="content-title mb-0 my-auto">All Staff</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<button  data-toggle="modal" data-target="#staffs" class="btn btn-outline-primary">Add Staff</button><?= br(2); ?>
								<div class="table-responsive">
									<table id="example2" class="table table-bordered">
										<thead>
											<tr>
												<th>Username</th>
												<th>Mobile</th>
												<th>Designation</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($staffData)): ?>
												<?php foreach ($staffData as $key):
													if($key['status']=="1")
													{
														$on = "on";
													}
													else
													{
														$on = "";
													}
												 ?>
													<tr>
														<td><?= $key['user']; ?></td>
														<td><?= $key['mobile']; ?></td>
														<td><?= strtoupper($key['login_type']); ?></td>
														<td>
															<div id="st_<?= $key['id']; ?>" class="main-toggle main-toggle-success <?= $on; ?>">
																<span></span>
															</div>
														</td>
														<td>
															<a href="#" onclick="Edtstf('<?= $key['id']; ?>')" data-toggle="modal" data-target="#Edtstaffs" class="text-warning"><i class="fas fa-pen"></i> Edit</a><?= nbs(4); ?>
															<a onclick="return confirm('Delete This Staff?');" href="<?= base_url('admin_panel/Staff/DelStaff/'.$key['id']); ?>" class="text-danger"><i class="fas fa-trash"></i> Delete</a>
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
				</div>
				
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<div class="modal fade" id="staffs" role="dialog">
		    <div class="modal-dialog modal-sm">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <h4 class="modal-title">Add Staff</h4>
		        </div>
		        <div class="modal-body">
		        	<form action="<?= base_url('admin_panel/Staff/addStaff'); ?>" method="post">
		        		<div class="form-group">
		        			<label>Username</label>
		        			<input type="text" name="userName" class="form-control" required>
		        		</div>
		        		<div class="form-group">
		        			<label>Password</label>
		        			<input type="password" name="pass" class="form-control" required>
		        		</div>
		        		<div class="form-group">
		        			<label>Mobile</label>
		        			<input type="text" name="mob" class="form-control" required>
		        		</div>
		        		<div class="form-group">
		        			<button class="btn btn-primary">Add Staff</button>
		        		</div>
			        </form>
		        </div>
		      </div>
		    </div>
		</div>
		<div class="modal fade" id="Edtstaffs" role="dialog">
		    <div class="modal-dialog modal-sm">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <h4 class="modal-title">Add Staff</h4>
		        </div>
		        <div class="modal-body">
		        	<form action="<?= base_url('admin_panel/Staff/updateStaff'); ?>" method="post">
		        		<div class="form-group">
		        			<label>Username</label>
		        			<input id="nm" type="text" name="userName" class="form-control" required>
		        		</div>
		        		<div class="form-group">
		        			<label>Change Password?</label><br>
		        			<input id="postageyes" type="radio" name="chpas" value="yes">
		        			<label>Yes</label>
		        			<input id="postageno" type="radio" checked name="chpas" value="no">
		        			<label>No</label>
		        		</div>
		        		<div id="pasfield" class="form-group">
		        			<label>Password</label>
		        			<input id="pas" type="password" name="pass" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label>Mobile</label>
		        			<input id="mob" type="text" name="mob" class="form-control" required>
		        		</div>
		        		<input type="hidden" name="id" id="stId">
		        		<div class="form-group">
		        			<button class="btn btn-primary">Edit Staff</button>
		        		</div>
			        </form>
		        </div>
		      </div>
		    </div>
		</div>
		<?php if($feed = $this->session->flashdata("Feed")): ?>
			<div class="flashd"><?= $feed; ?></div>
		<?php endif; ?>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.main-toggle').on('click', function() {
					$(this).toggleClass('on');
					ids = this.id;
					spl = ids.split("_");
					id = spl[1];
					$.post("<?= base_url('admin_panel/Staff/ChangeStatus'); ?>",
							{
								id: id
							},
							function(response)
							{
								//alert(response);
							}
						)

				});

				$("#pasfield").hide();
				$('input:radio[name="chpas"]').change(function () {
				    if ($(this).val() == 'yes') {
				        $("#pasfield").show();
				        $("#pas").attr("required",true);
				    } else {
				        $("#pasfield").hide();
				        $("#pas").attr("required",false);
				    }
				});
			});
				
			function Edtstf(id)
			{
				$.post("<?= base_url('admin_panel/Staff/getStafById'); ?>",
						{
							id: id
						},
						function(data)
						{
							ob = JSON.parse(data);
							$("#nm").val(ob.user);
							$("#mob").val(ob.mobile);
							$("#stId").val(ob.id);
						}
					)
			}
		</script>
	</body>
</html>