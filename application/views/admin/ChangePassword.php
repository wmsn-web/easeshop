<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/layout.php"); ?>
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
							<h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Change Password</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<form action="<?= base_url('admin_panel/ChangePassword/chps'); ?>" method="post">
									<div class="form-group">
										<label>New Password</label>
										<input type="password" name="pass" class="form-control" id="pass" required="required">
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="password" name="password" class="form-control" id="conpass" required="required">
										<small id="msg"></small>
									</div>
									<div class="form-group">
										<button id="btn1" class="btn btn-primary">Change Password</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
				<!-- row closed -->
			</div>
			<?php if($feed = $this->session->flashdata("Feed")): ?>
				<div class="flashd"><?= $feed; ?></div>
				<?php endif; ?>
			<!-- Container closed -->
		</div>
		
		<?php include("inc/footer.php"); ?>
		<?php include("inc/js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#conpass").keyup(function(){
					pass = $("#pass").val();
					conpass = $("#conpass").val();
					if(conpass == pass)
					{
						$("#msg").html("Password Matched");
						$("#msg").css("color","#090");
						$("#btn1").attr("disabled",false);
					}
					else
					{
						$("#msg").html("Password did not Match!");
						$("#msg").css("color","#f00");
						$("#btn1").attr("disabled",true);
					}
				});

				$("#pass").blur(function(){
					pass = $("#pass").val();
					lngth = pass.length;
					if(lngth >=8)
					{

					}
					else
					{
						alert("Please Enter more than 8 characters password");
						$("#pass").val("");
						$("#pass").focus();
					}
				});
			});
		</script>

	</body>
</html>