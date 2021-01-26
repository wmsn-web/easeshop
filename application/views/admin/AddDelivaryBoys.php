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
							<h4 class="content-title mb-0 my-auto">Register Delivary Boys</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card">
							<div class="card-body">
								<form action="<?= base_url('admin_panel/AddDelivaryBoys/addBoys'); ?>" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="form-group col-sm-6">
											<label>Full Name</label>
											<input type="text" name="name" class="form-control" required>
										</div>
										
										<div class="form-group col-sm-6">
											<label>Mobile Number</label>
											<input type="text" name="phone" class="form-control" required>
										</div>
										<div class="form-group col-sm-12">
											<label>Email</label>
											<input type="text" name="email" class="form-control" required>
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
										<div class="form-group col-sm-4">
											<label>Profile Image</label>
											<input type="file" name="pro_img" class="dropify" data-height="150" required="required" />
										</div>
										<div class="form-group col-sm-12">
											<button id="reg" class="btn btn-primary">Register</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- row closed -->
				<?php
					if($feed = $this->session->flashdata("Feed")):
				  ?>
				  <div class="flashd"><?= $feed; ?></div>
				<?php endif; ?>
			</div>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/form_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
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
				
			});
		</script>
	</body>
</html>