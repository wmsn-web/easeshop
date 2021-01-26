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
							<h4 class="content-title mb-0 my-auto">Return Requests</h4>
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
									<table id="example2" class="table table-bordered">
										<thead>
											<tr>
												<th>SL</th>
												<th>Customer Name</th>
												<th>Order ID</th>
												<th>Product Name</th>
												<th>Reason</th>
												<th>QTY</th>
												<th>Price</th>
												<th>Dispute Image</th>
												<th>Asign for pickup</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($retrnData)): ?>
												<?php $s = 1; foreach($retrnData as $retrn): $sl=$s++; ?>
													<tr>
														<td><?= $sl; ?></td>
														<td><?= $retrn['custName']; ?></td>
														<td><?= $retrn['order_id']; ?></td>
														<td><?= $retrn['product_name']; ?></td>
														<td><?= $retrn['reason']; ?></td>
														<td><?= $retrn['qty']; ?></td>
														<td><?= $retrn['price']; ?></td>
														<td class="cp" data-toggle="modal" data-target="#imgModal" onclick="getImg('<?= $retrn['photo']; ?>@<?= $retrn['product_name']; ?>')">
															<img style="width: 45px; height: 45px" src="<?= $retrn['photo']; ?>">
														</td>
														<td>
															<select onchange="asignBoys(this.value)">
																<option value="">Asign for pickup</option>
																<?php if(!empty($delBoys)): ?>
																	<?php foreach($delBoys as $dlb):
																		if($retrn["status"]=="1")
																		{
																			$disb = "disabled";
																			$link = "#";
																			$text = "Return Accepted";
																			$class = "btn btn-danger";
																		}
																		else
																		{
																			$disb = "";
																			$link = base_url('admin_panel/Return_Requests/AcceptReturn/'.$retrn['price'].'/'.$retrn['user_id'].'/'.$retrn['id']);
																			$text = "Accept & Complete";
																			$class = "btn btn-primary";
																		}
																		if($retrn['asigned_del_boy']==$dlb['id'])
																		{
																			$dlnSlct = "selected";
																		}
																		else
																		{
																			$dlnSlct = "";
																		}
																	 ?>
																		<option <?= $disb; ?> <?= $dlnSlct; ?> value="<?= $dlb['id']; ?>_<?= $retrn['id']; ?>_<?= $retrn['user_id']; ?>"><?= $dlb['name']; ?></option>
																	<?php endforeach; ?>
																<?php endif; ?>
															</select>
															<p><?= $retrn['pickup_date']; ?></p>
														</td>
														<td><button onclick="location.href='<?= $link; ?>'" class="<?= $class; ?>"><?= $text; ?></button></td>

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
		<div class="modal fade" id="imgModal" role="dialog">
		    <div class="modal-dialog modal-sm">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <h4 id="proName" class="modal-title"></h4>
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          
		        </div>
		        <div class="modal-body">
		        	<div id="imgg"></div>
		        </div>
		        
		      </div>
		      
		    </div>
		  </div>
		  <div class="modal fade" id="pickTime" role="dialog">
		    <div class="modal-dialog modal-sm">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <h4 id="proName" class="modal-title"></h4>
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          
		        </div>
		        <div class="modal-body">
		        	<div class="form-group">
		        		<label>Select Pickup date</label>
		        		<input type="date" id="pickUpDate" class="form-control" />
		        	</div>
		        	<div class="form-group">
		        		<label>Select Pickup Time</label>
		        		<input type="time" id="pickUpTime" class="form-control" />
		        	</div>
		        	<div class="form-group">
		        		<button id="subDate" class="btn btn-primary">Submit</button>
		        	</div>
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
			function getImg(name)
			{
				spl = name.split('@');
				img = spl[0];
				proname = spl[1];
				$("#proName").html(proname);
				$("#imgg").html("<img src='"+img+"' width='180' />");
			}
			function asignBoys(names)
		{
			spl = names.split("_");
			dlbId = spl[0];
			id = spl[1];
			user_id = spl[2];
			if(names =="")
			{
				alert("Select to Asign");
			}
			else
			{
				$("#pickTime").modal('show');
				$("#subDate").click(function(){
					pickUpDate = $("#pickUpDate").val();
					pickUpTime = $("#pickUpTime").val();		
					dateTime = pickUpDate+" "+pickUpTime;

					$.post("<?= base_url('admin_panel/Return_Requests/ChangeAsign'); ?>",
						{
							dlbId: dlbId,
							id: id,
							pickUpDate: dateTime,
							user_id: user_id
						},
						function(data)
						{
							location.href="";
						}
					)
				});
			}
			
		}
		</script>
	</body>
</html>