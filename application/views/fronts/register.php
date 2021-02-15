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
								<h4>User Registration</h4>
							</div>
							<div class="card-body">
								<div class="row justify-content-center">
									<div class="col-sm-7">
										<div id="rreegg">
											<form id="regForm" action="<?= base_url('Login/ProcessReg'); ?>" method="post">
												<div class="form-group">
													<label>Name</label>
													<input type="text" name="name" id="name" class="form-control unicase-form-control text-input" placeholder="Enter Your Full Name">
												</div>
												<div class="form-group">
													<label>Mobile Number</label>
													<span class="text-primary"></span>
													<small class="text-danger" id="msg"></small>
													<input type="tel" name="phone" id="phone" class="form-control unicase-form-control text-input" placeholder="Enter Mobile Number">
												</div>
												<div class="form-group">
													<label>Password</label>
													<input type="password" name="password" id="pass" class="form-control unicase-form-control text-input" placeholder="Password">
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input type="password" name="conpass" id="conpass" class="form-control unicase-form-control text-input" placeholder="Confirm Password">
												</div>
												<input type="hidden" name="backUrl" value="<?= @$_GET['url']; ?>">
												<input type="hidden" name="deviceid" value="<?= md5($_SERVER['HTTP_USER_AGENT']); ?>">
												<div class="form-group">
													<div id="recaptcha-container"></div>
												</div>
												<div class="form-group">
													<button id="reg" type="button" class="btn btn-primary" >Register</button>
													
												</div>
												<div align="center">
													Already have an account? <a href="<?= base_url('Login'); ?>">Login Here</a>
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
				$("#reg").click(function(){
					var name = $("#name").val();
					var phones = $("#phone").val();
					var phone = "+91"+phones;
					var pass = $("#pass").val();
					var conpass = $("#conpass").val();
					/*if(name == "" || phone=="" || pass=="" || conpass=="")
					{
						$("#name").addClass("inpDanger"); $("#name").attr("placeholder","invalid Name!");$("#name").focus();$("#phone").addClass("inpDanger"); $("#phone").attr("placeholder","invalid Mobile Number!");$("#pass").addClass("inpDanger"); $("#pass").attr("placeholder","invalid Password!");$("#conpass").addClass("inpDanger"); $("#conpass").attr("placeholder","invalid Password!");
					}*/
					if(name==""){$("#name").addClass("inpDanger"); $("#name").attr("placeholder","invalid Name!");$("#name").focus()}
					else if(phone==""){$("#name").removeClass("inpDanger"); $("#phone").addClass("inpDanger"); $("#phone").attr("placeholder","invalid Mobile Number!");$("#phone").focus();}
					else if(pass==""){$("#phone").removeClass("inpDanger"); $("#pass").addClass("inpDanger"); $("#pass").attr("placeholder","invalid Password!");$("#pass").focus()}
					else if(conpass==""){$("#pass").removeClass("inpDanger"); $("#conpass").addClass("inpDanger"); $("#conpass").attr("placeholder","invalid Password!");$("#conpass").focus()}
					else{
						var number = $("#phone").val();
							$.post("<?= base_url('Login/verifyExist'); ?>",
							{
								number: number
							},
							function(response)
							{
								if(response=="no")
								{
									$("#reg").attr("disabled", true);
									$("#msg").html("Mobile Number Already Registered!")
								}else
								{
									$("#reg").attr("disabled", false);
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
								}
							}
							)
							
						}
				});

				$("#conpass").keyup(function(){
					var pass = $("#pass").val();
					var conpass = $("#conpass").val();
					if(conpass == pass)
					{
						$("#reg").attr("disabled", false);
					}
					else
					{
						$("#reg").attr("disabled", true);
					}
				});
				
				$("#phone").blur(function(){
					
					var number = $("#phone").val();
					$.post("<?= base_url('Login/verifyExist'); ?>",
					{
						number: number
					},
					function(response)
					{
						if(response=="no")
						{
							$("#reg").attr("disabled", true);
							$("#msg").html("Mobile Number Already Registered!")
						}else
						{
							$("#reg").attr("disabled", false);
							$("#msg").html("");
						}
					}
					)
				})
				
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
		    var code=document.getElementById('verificationCode').value;
		    coderesult.confirm(code).then(function (result) {
		        //alert("Successfully registered");
		        var user=result.user;
		        console.log(user);
		        $("#regForm").submit();
		    }).catch(function (error) {
		        alert(error.message);
		    });
		}
		</script>
	</body>
</html>