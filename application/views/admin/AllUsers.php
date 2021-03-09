<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title> All Users</title>
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
							<h4 class="content-title mb-0 my-auto">All Users</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">All Users</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Name</th>
											<th>Mobile</th>
											<th>Email</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($allUsers)): ?>
											<?php $s =1; foreach($allUsers as $users): $sl = $s++; ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?= $users['name']; ?></td>
													<td><?= $users['phone']; ?></td>
													<td><?= $users['email']; ?></td>
													<td><?= $users['status']; ?></td>
													<td class="text-center">	
														<button id="us_<?= $users['user_id']; ?>" class="btn btn-warning dtlssff" data-toggle="modal" data-target="#UserDetails" onclick="UserDetails('us_<?= $users['user_id']; ?>')">View Details</button>
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
			<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
			<!-- Container closed -->
			<div class="modal fade" id="UserDetails" role="dialog">
			    <div class="modal-dialog modal-lg">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Profile</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<div class="row justify-content-center">
			        		<div class="col-sm-12 col-lg-8">
						<div id="procard" class="card">
							<div class="card-body text-center">
								<div class="profile-pic mb-3">
									<div id="proImg"></div>
									
									<h5 id="name" class="mt-3 mb-0 font-weight-semibold tx-16">Rebbaca Noim</h5>
									<a id="email" href="#">rebaccanoim@gmail.com</a><br>
									<a id="phone" href="#">7063245845</a>
								</div>
								
							</div>
							<div class="p-4 b-t card-footer">
								<h4>Shipping Address</h4>
								<div class="row">
									<div class="col-6 border-right">
										<span>Address:</span> <span id="addr"></span><br>
										<span>City:</span> <span id="city"></span>
									</div>
									<div class="col-6">
										<span>State:</span> <span id="state"></span><br>
										<span>PIN:</span> <span id="pin"></span>
									</div>
									<div class="col-12 text-center"></div>
								</div>
							</div>
						</div>
						
					</div>
			        	</div>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				//$("#rechCard").show();
				$("#cncl").click(function(){
					$("#tr_1").remove();
				});

					$(".rech").click(function(){
						$("#rechCard").toggle(500);
						$("#rechAmt").focus()
					});

					$(".payDone").click(function(){
						user_id = $("#rechUserId").val();
						rechAmt = $("#rechAmt").val();
						$.post("<?= base_url('admin_panel/AllUsers/rechargeAmt'); ?>",
								{
									user_id: user_id,
									rechAmt: rechAmt
								},
								function(response)
								{
									$("#wlbal").html(response);
									$("#rechCard").hide();
									$("#rechAmt").val("");
								}
						)
					});

					$(".blks").click(function(){
						if(confirm("Block this User?"))
						{
							user_id = $("#rechUserId").val();
							//alert(user_id);
							$.post("<?= base_url('admin_panel/AllUsers/BlockUser'); ?>",
									{
										user_id: user_id
									},
									function(response)
									{
										alert(response);
									}
							)
						}
						else
						{

						}
					});

					$(".unblks").click(function(){
						if(confirm("Unblock this User?"))
						{
							user_id = $("#rechUserId").val();
							//alert(user_id);
							$.post("<?= base_url('admin_panel/AllUsers/unBlockUser'); ?>",
									{
										user_id: user_id
									},
									function(response)
									{
										alert(response);
									}
							)
						}
						else
						{

						}
					});
				
			});
			function UserDetails(userid)
			{
					spl = userid.split("_");
					id = spl[1];
					$.post("<?= base_url('admin_panel/AllUsers/getUserIndv'); ?>",
							{
								user_id: id
							},
							function(data)
							{
								//alert(data);
								
								obj = JSON.parse(data);
								$("#name").html(obj.name);
								$("#email").html(obj.email);
								$("#phone").html(obj.phone);
								$("#status").html(obj.status);
								$("#wlbal").html(obj.wldata);
								$("#rechUserId").val(obj.user_id);
								$("#rechAmt").val("");
								$("#addr").html(obj.addr);
								$("#city").html(obj.city);
								$("#state").html(obj.state);
								$("#pin").html(obj.pin);
								$("#lm").html(obj.lm);
								if(obj.proImg == null || obj.proImg == "")
								{
									pics = "<?= base_url('admin_assets/img/brand/favicon.png'); ?>";
								}
								else
								{
									pics = obj.proImg;
								}
								$("#proImg").html('<img src="'+pics+'" class="brround avatar avatar-lg mx-auto" alt="user">');
								if(obj.status == "Block")
								{
									$("#status").addClass("bg-warning text-white");
									$("#status").addClass("blks");
									$("#status").removeClass("unblks");
									$("#status").attr("onclick","blockUser()");
								}
								else
								{
									$("#status").addClass("bg-danger text-white");
									$("#status").addClass("unblks");
									$("#status").removeClass("blks");
									$("#status").attr("onclick","unblockUser()");

								}
								
							}
						)
					
			}

			function unblockUser()
			{
				if(confirm("Unblock this User?"))
						{
							user_id = $("#rechUserId").val();
							//alert(user_id);
							$.post("<?= base_url('admin_panel/AllUsers/unBlockUser'); ?>",
									{
										user_id: user_id
									},
									function(response)
									{
										alert("User Blocked");
										window.open("<?= base_url('admin_panel/AllUsers'); ?>","_self");
									}
							)
						}
			}
			function blockUser()
			{
				if(confirm("Block this User?"))
						{
							user_id = $("#rechUserId").val();
							//alert(user_id);
							$.post("<?= base_url('admin_panel/AllUsers/BlockUser'); ?>",
									{
										user_id: user_id
									},
									function(response)
									{
										alert("User Blocked");
										window.open("<?= base_url('admin_panel/AllUsers'); ?>","_self");
									}
							)
						}
			}
		</script>
	</body>
</html>