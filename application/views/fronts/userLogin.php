<!DOCTYPE html>
<html lang="en"> 
	<head>
	<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="MediaCenter, Template, eCommerce">
		<meta name="robots" content="all">
		<title>Easeshop</title>
		<?php include("inc/layout.php"); ?>
		<link rel="stylesheet"  type='text/css' href="<?= base_url('assets/css/customnewx.css'); ?>">
		<style type="text/css">
		  @media only screen and (max-width: 991px) 
		{
		  #mob-view
		  {
		    display: none !important;
		  }
		}
		</style>
	</head>
	<body class="cnt-home">
		<div class="mob-header">
		    <?php include("inc/goback.php"); ?>
		  </div>
		  <?= br(3); ?>
		<section class="login">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="card">
							<div class="card-title">
								<h4>User Login</h4>
							</div>
							<div class="card-body">
								<div class="row justify-content-center">
									
									<div class="col-sm-7">
										<?php if($feed = $this->session->flashdata("Feed")): ?>
											<h5 class="text-danger"><?= $feed; ?></h5>
										<?php endif; ?>
										<form id="loggin" action="<?= base_url('Login/loginProcess'); ?>" method="post">
											<div class="form-group">
												<label>Mobile Number</label>
												<input type="tel" name="phone" id="phone" class="form-control unicase-form-control text-input" placeholder="Enter Mobile Number">
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="password" id="pass" class="form-control unicase-form-control text-input" placeholder="Password">
											</div>
											<input type="hidden" name="deviceid" value="<?= md5($_SERVER['HTTP_USER_AGENT']); ?>">
											<input type="hidden" name="backUrl" value="<?php if($bk = $this->session->flashdata("Bk")): echo $bk; else: echo @$_SERVER['HTTP_REFERER']; endif; ?>">
											<div class="form-group">
												<button id="llog" type="button" class="btn btn-primary" >Login</button>
												<?= nbs(6); ?>
												<a href="<?= base_url('Login/ForgotPass'); ?>">Forgot Password?</a>
											</div>
											<div align="center">
												Don't have account? <a href="<?= base_url('Login/Register/?url='.@urlencode($_SERVER['HTTP_REFERER'])); ?>">Register Here</a>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php include("inc/js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#llog").click(function(){
					var phone = $("#phone").val();
					var pass = $("#pass").val();
					if(phone==""){$("#phone").addClass("inpDanger"); $("#phone").attr("placeholder","invalid Mobile Number!");$("#phone").focus();}
					else if(pass==""){$("#phone").removeClass("inpDanger"); $("#pass").addClass("inpDanger"); $("#pass").attr("placeholder","invalid Password!");$("#pass").focus()}
					else
					{
						$("#loggin").submit();
					}
				})
			})
		</script>
	</body>
</html>