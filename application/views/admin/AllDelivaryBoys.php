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
							<h4 class="content-title mb-0 my-auto">All Delivery Boys</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="example2">
										<thead>
											<tr>
												<th>SL</th>
												<th>Image</th>
												<th>Name</th>
												<th>Email</th>
												<th>Mobile</th>
												<th>Join Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($delBoys)): ?>
												<?php $s = 1; foreach($delBoys as $key): $sl = $s++;
												 ?>
													<tr>
														<td><?= $sl; ?></td>
														<td><img src="<?= base_url('uploads/delivary_boys/'.$key['pro_pic']); ?>" class="brround avatar avatar-sm mx-auto" /></td>
														<td><?= $key['name']; ?></td>
														<td><?= $key['email']; ?></td>
														<td><?= $key['phone']; ?></td>
														<td><?= $key['join_date']; ?></td>
														<td>
															<div class="dropdown">
																<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
																data-toggle="dropdown" id="dropdownMenuButton" type="button">Actions <i class="fas fa-caret-down ml-1"></i></button>
																<div  class="dropdown-menu tx-13">
																	<a data-toggle="modal" data-target="#delBDetails" onclick="getDelB('<?= $key['id']; ?>')" class="dropdown-item" href="#">Edit</a>
																	<a class="dropdown-item" href="<?= base_url('admin_panel/AddDelivaryBoys/DelDelvrBoys/'.$key['id']); ?>">Delete</a>
																	<a data-toggle="modal" data-target="#delBpass" onclick="getDelB('<?= $key['id']; ?>')" class="dropdown-item" href="#">Change Password</a>
																</div>
															</div>
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
			<?php
					if($feed = $this->session->flashdata("Feed")):
				  ?>
				  <div class="flashd"><?= $feed; ?></div>
				<?php endif; ?>
		</div>
		<div class="modal fade" id="delBDetails" role="dialog">
			    <div class="modal-dialog modal-lg">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Edit Delivery Boy</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<form action="<?= base_url('admin_panel/AddDelivaryBoys/updateBoys'); ?>" method="post" enctype="multipart/form-data">
			        		<div align="center">
			        			<label for="chngImg" title="Change Image" class="cp">
			        				<img id="imgs"  class="brround avatar avatar-xl mx-auto" />
			        			</label>
			        			<input type="file" name="pro_pic" id="chngImg" style="display:none;">
			        			<?= br(2); ?>
			        		</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label>Full Name</label>
									<input type="text" id="nm" name="name" class="form-control" required>
								</div>
								
								<div class="form-group col-sm-6">
									<label>Mobile Number</label>
									<input type="text" name="phone" id="ph" class="form-control" required>
								</div>
								<div class="form-group col-sm-12">
									<label>Email</label>
									<input type="text" name="email" id="eml" class="form-control" required>
								</div>
								<input type="hidden" name="id" id="idds">
								
								<div class="form-group col-sm-12">
									<button id="reg" class="btn btn-primary">Update</button>
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

			  <div class="modal fade" id="delBpass" role="dialog">
			    <div class="modal-dialog modal-lg">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Change Password</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<form action="<?= base_url('admin_panel/AddDelivaryBoys/ChangePawword'); ?>" method="post">
			        		<div class="row">
			        			<div class="col-sm-12">
			        				<h3 id="nms"></h3>
			        			</div>
			        			<div class="form-group col-sm-6">
									<label>Password</label>
									<input type="text" id="pass" name="pass" class="form-control" required>
								</div>
								<div class="form-group col-sm-6">
									<label>Confirm Password</label><?= nbs(6); ?>
									<span id="msg"></span>
									<input type="text" id="conpass" name="password" class="form-control" required>
								</div>
								<input type="hidden" name="id" id="iddss">
								<div class="form-group col-sm-12">
									<button id="reg" class="btn btn-primary">Update</button>
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
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script type="text/javascript">
			function getDelB(id)
			{
				$.post("<?= base_url('admin_panel/AllDelivaryBoys/getDelBId'); ?>",{ id: id},
						function(response)
						{
							delb = JSON.parse(response);
							$("#nm").val(delb.name);
							$("#ph").val(delb.phone);
							$("#eml").val(delb.email);
							$("#imgs").attr("src","<?= base_url(); ?>uploads/delivary_boys/"+delb.pro_pic);
							$("#idds").val(delb.id);
							$("#nms").html(delb.name);
							$("#iddss").val(delb.id);
						}
					)
			}

			function readURL(input) {
			  if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    
			    reader.onload = function(e) {
			      $('#imgs').attr('src', e.target.result);
			    }
			    
			    reader.readAsDataURL(input.files[0]); // convert to base64 string
			  }
			}

			$("#chngImg").change(function() {
			  readURL(this);
			});
			$("#pass").blur(function(){
					pass = $("#pass").val();
					if(pass.length >= 8)
					{
						
					}
					else
					{
						alert("Password Character minimum 8 words");
						$("#pass").val("");
					}
				});
				$("#conpass").keyup(function(){
					pass = $("#pass").val();
					conpass = $("#conpass").val();
					if(conpass == pass)
					{
						$("#msg").html("Password match");
						$("#msg").css("color","#090");
						$("#reg").attr("disabled",false);
					}
					else
					{
						$("#msg").html("Password Does not match!");
						$("#msg").css("color","#f00");
						$("#reg").attr("disabled",true); 
					}
				})
		</script>
	</body>
</html>