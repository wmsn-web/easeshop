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
		<title>easeshop</title>
		<?php include("inc/layout.php"); ?>
		<link rel="stylesheet"  type='text/css' href="<?= base_url('assets/css/customnewxfinal.css'); ?>">
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
								<h4>Forgot Password</h4>
							</div>
							<div class="card-body">
								<div class="row justify-content-center">
									
									<div class="col-sm-7">
										<div id="rreegg">
											<?php if($feed = $this->session->flashdata("Feed")): ?>
												<h5 class="text-danger"><?= $feed; ?></h5>
											<?php endif; ?>
											<form id="loggin" action="" method="post">
												<div class="form-group">
													<label>Registered Mobile Number</label>
													<small class="text-danger" id="msg"></small>
													<input type="tel" name="phone" id="phone" class="form-control unicase-form-control text-input" placeholder="Enter Mobile Number">
												</div>
												
												<div class="form-group">
													<div id="loading" style="display: none">
														<img src="<?= base_url('assets/images/loading.gif'); ?>">
													</div>
													<button id="llog" type="button" class="btn btn-primary" >Verify Mobile Number</button>
													
												</div>
												<div align="center">
													<a href="<?= base_url('Login'); ?>">Login</a>
												</div>
											</form>
										</div>
										<div id="veriffy" style="display: none">
											<div class="form-group">
												<h5>Verification Code has been sent to your Given Number</h5>
												<label>Enter Verification code</label>
												<input type="text" id="verificationCode" placeholder="Enter verification code" class="form-control unicase-form-control text-input">
											</div>
											<div class="form-group">
												<div id="loading3" style="display: none">
														<img src="<?= base_url('assets/images/loading.gif'); ?>">
													</div>
    											<button type="button" id="vrcd" class="btn btn-primary" onclick="codeverify();">Verify code</button>
    											<a href="javascript:void(0)" id="resend">Resend</a>
    											<div id="loading2" style="display: none">
														<img src="<?= base_url('assets/images/loading.gif'); ?>">
													</div>
											</div>
										</div>
										<div id="resetPass" style="display: none">
											<form action="<?= base_url('Login/ChangePassword'); ?>" method="post">
												<input type="hidden" name="fphone" id="fphone">
												<div class="form-group">
													<label>Password</label>
													<input type="password" name="password" id="pass1" class="form-control unicase-form-control text-input" placeholder="Password">
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input type="password" name="conpass" id="conpass" class="form-control unicase-form-control text-input" placeholder="Confirm Password"><br>
													<span id="msg2"></span>
												</div>
												<input type="hidden" name="phone" id="phh">
												<div class="form-group">
													<button id="chps" disabled="true" class="btn btn-primary">Change Password</button>
												</div>
											</form>
										</div>
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

					var phones = $("#phone").val();
					var phone = phones;
					if(phones ==""){$("#phone").addClass("inpDanger"); $("#phone").attr("placeholder","invalid Mobile Number!");$("#phone").focus();}
					
					else
					{
						$("#llog").hide();
						$("#loading").show();
						$.post("<?= base_url('Login/verifyExist'); ?>",
						{
							number: phones
						},
						function(response)
						{
							if(response=="no")
							{
								$("#llog").show();
								$("#loading").hide();
								$("#msg").html("");
								$("#msg").html("");
									$.post("<?= base_url('Login/GetSms'); ?>",{
										phone: phone
									},function(msgs){
										//alert(msgs);
										if(msgs == "success")
										{
											$("#veriffy").show();
											$("#rreegg").hide();
											$("#fphone").val(phone);
										}
									})
							}else
							{
								$("#llog").show();
								$("#loading").hide();
								$("#msg").html("Mobile Number is not Registered!");
								//$("#resetPass").show();
							}
							//alert(response);
						}
						)
					}
				});

				$("#phone").blur(function(){
					$("#llog").hide();
						$("#loading").show();
					var phones = $("#phone").val();
					var phone = phones;
					$.post("<?= base_url('Login/verifyExist'); ?>",
						{
							number: phones
						},
						function(response)
						{
							if(response=="no")
							{
								$("#llog").show();
								$("#loading").hide();
								$("#msg").html("");
								$("#msg").html("");
								$.post("<?= base_url('Login/GetSms'); ?>",{
										phone: phone
									},function(msgs){
										//alert(msgs);
										if(msgs == "success")
										{
											$("#veriffy").show();
											$("#rreegg").hide();
											$("#fphone").val(phone);
										}
									})
							}else
							{
								$("#llog").show();
								$("#loading").hide();
								$("#msg").html("Mobile Number is not Registered!");
								//$("#resetPass").show();
							}
							//alert(response);
						}
						)
				});

				$("#resend").click(function(){
					$("#loading2").show();
					var phones = $("#phone").val();
					var phone = phones;
					$.post("<?= base_url('Login/GetSms'); ?>",{
										phone: phone
									},function(msgs){
										//alert(msgs);
										if(msgs == "success")
										{
											$("#veriffy").show();
											$("#rreegg").hide();
											$("#loading2").hide();
											$("#fphone").val(phone);
										}
									})
				})

				$("#conpass").keyup(function(){
					var pass = $("#pass1").val();
					var conpass = $("#conpass").val();
					if(conpass == pass)
					{
						$("#chps").attr("disabled", false);
						$("#msg2").html("<b style='color:#090'>Password  matched</b>")
					}
					else
					{
						$("#msg2").html("<b style='color:#f00'>Password does not match!!</b>");
						$("#chps").attr("disabled", true);
					}
				});
			})

			function codeverify()
			{
				var phones = $("#phone").val();
					var phone = phones;
					$("#vrcd").hide();
					$("#loading3").show();
				var verCode = $("#verificationCode").val();

				$.post("<?= base_url('Login/verifyCodes'); ?>",{
					phone: phone,
					code: verCode
				},function(verCodes){
					if(verCodes == "empty")
					{
						$("#verificationCode").attr("placeholder","invalid OTP Number!");
						$("#verificationCode").addClass("inpDanger");
						$("#verificationCode").val("");
						$("#loading3").hide();
						$("#vrcd").show();
					}
					else
					{
						$("#resetPass").show();
						$("#veriffy").hide();
						$("#loading3").hide();
						$("#vrcd").show();
					}
					
				})
			}
		</script>
		
	</body>
</html>