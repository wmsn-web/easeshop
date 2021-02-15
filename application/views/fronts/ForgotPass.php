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
														<div id="recaptcha-container"></div>
													</div>
												<div class="form-group">
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
    											<button type="button" class="btn btn-primary" onclick="codeverify();">Verify code</button>
											</div>
										</div>
										<div id="resetPass" style="display: none">
											<form action="<?= base_url('Login/ChangePassword'); ?>" method="post">
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
		<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
		<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyAkKC4If-q2jAyoE_FRTSB6laUIfz3oRzc",
    authDomain: "easeshop-13604.firebaseapp.com",
    projectId: "easeshop-13604",
    storageBucket: "easeshop-13604.appspot.com",
    messagingSenderId: "927322896059",
    appId: "1:927322896059:web:33fcb0ffb29beb2317db9e",
    measurementId: "G-FHSPDJ1EHJ"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  
</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#llog").click(function(){
					var phones = $("#phone").val();
					var phone = "+91"+phones;
					if(phones ==""){$("#phone").addClass("inpDanger"); $("#phone").attr("placeholder","invalid Mobile Number!");$("#phone").focus();}
					
					else
					{
						$.post("<?= base_url('Login/verifyExist'); ?>",
						{
							number: phones
						},
						function(response)
						{
							if(response=="no")
							{
								$("#llog").attr("disabled", false);
								$("#msg").html("");
								$("#msg").html("");
										firebase.auth().signInWithPhoneNumber(phone,window.recaptchaVerifier).then(function (confirmationResult) {
								        //s is in lowercase
								        window.confirmationResult=confirmationResult;
								        coderesult=confirmationResult;
								        console.log(coderesult);
								        //alert("Message sent");
								        $("#rreegg").hide();
								        $("#veriffy").show();
								    }).catch(function (error) {
								        alert(error.message);
								    });
							}else
							{
								$("#llog").attr("disabled", true);
								$("#msg").html("Mobile Number is not Registered!")
							}
							//alert(response);
						}
						)
					}
				});

				$("#phone").blur(function(){
					var phones = $("#phone").val();
					var phone = "+91"+phones;
					$.post("<?= base_url('Login/verifyExist'); ?>",
						{
							number: phones
						},
						function(response)
						{
							if(response=="no")
							{
								$("#llog").attr("disabled", false);
								$("#msg").html("");
								$("#msg").html("");
										firebase.auth().signInWithPhoneNumber(phone,window.recaptchaVerifier).then(function (confirmationResult) {
								        //s is in lowercase
								        window.confirmationResult=confirmationResult;
								        coderesult=confirmationResult;
								        console.log(coderesult);
								        //alert("Message sent");
								        $("#rreegg").hide();
								        $("#veriffy").show();
								    }).catch(function (error) {
								        alert(error.message);
								    });
							}else
							{
								$("#llog").attr("disabled", true);
								$("#msg").html("Mobile Number is not Registered!")
							}
							//alert(response);
						}
						)
				});

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
		</script>
		<script type="text/javascript">
			window.onload=function () {
			  render();
			};
			function render() {
			    window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
			    recaptchaVerifier.render();
			}

			function codeverify() {
				var phones = $("#phone").val();
				var phone = "+91"+phones;
		    var code=document.getElementById('verificationCode').value;
		    coderesult.confirm(code).then(function (result) {
		        //alert("Successfully registered");
		        var user=result.user;
		        console.log(user);
		        //$("#regForm").submit();
		        $("#rreegg").hide();
				$("#veriffy").hide();
				$("#resetPass").show();
				$("#phh").val(phones);
		    }).catch(function (error) {
		        alert(error.message);
		    });
		}
		</script>
	</body>
</html>