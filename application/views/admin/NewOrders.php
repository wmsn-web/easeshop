<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title> New Orders</title>
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
							<h4 class="content-title mb-0 my-auto">New Orders</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">New Orders</h3>
							</div>
							<div class="card-body">
								<div id="tblDv" class="table-responsive">
								<table class="table table-bordered" id="example"> 
									<thead>
										<tr>
											<th>SL</th>
											<th>Date</th>
											<th>Order ID</th>
											<th>User name</th>
											<th>Price</th>
											<th>Payment Status</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($orderData)): ?>
											<?php $s=1; foreach($orderData as $orders): $sl=$s++;
												
												if($orders['status']=="Processing"):
													$slc1 = "";
													$slc2 ="selected";
													$slc3 = "";
													$slc4 ="";
													$slc5 = "";
													$slc6 = "";
													$disb1 ="disabled";
													$disb2 = "";
													$disb3 = "";
													$disb4 = "";
													$disb5 = "disabled";
													$disb6 = "disabled";
												
												elseif($orders['status']=="Despatched"):
													$slc1 = "";
													$slc2 ="";
													$slc3 = "";
													$slc4 ="selected";
													$slc5 = "";
													$slc6 = "";
													$disb1 ="disabled";
													$disb2 = "disabled";
													$disb3 = "disabled";
													$disb4 = "";
													$disb5 = "";
													$disb6 = "disabled";
												elseif($orders['status']=="Delivered"):
													$slc1 = "";
													$slc2 ="";
													$slc3 = "";
													$slc4 ="";
													$slc5 = "selected";
													$slc6 = "";
													$disb1 ="disabled";
													$disb2 = "disabled";
													$disb3 = "disabled";
													$disb4 = "disabled";
													$disb5 = "";
													$disb6 = "disabled";
												elseif($orders['status']=="Cancel"):
													$slc1 = "";
													$slc2 ="";
													$slc3 = "";
													$slc4 ="";
													$slc5 = "";
													$slc6 = "selected";
													$disb1 ="disabled";
													$disb2 = "disabled";
													$disb3 = "disabled";
													$disb4 = "disabled";
													$disb5 = "disabled";
													$disb6 = "disabled";
												else:$slc1 = "";
													$slc2 ="";
													$slc3 = "";
													$slc4 ="";
													$slc5 = "";
													$slc6 = "";
													$disb1 ="";
													$disb2 = "";
													$disb3 = "";
													$disb4 = "";
													$disb5 = "";
													$disb6 = "";
												endif; 
												$trbg = "";
												if($orders['pay_method']=="cod" && $orders['pay_status']=="Pending"): 
													if($orders['status']=="Delivered"):
														$sts = "Pending <br><small><a href='".base_url('admin_panel/Orders/PaymentStatus/'.$orders['id'])."'><i class='fas fa-pen'></i> Mark as Paid</a></small>";
														$method = $orders['pay_method'];
														else:
														$sts = "Pending";
														$method = $orders['pay_method'];
													endif;
												elseif($orders['pay_method']=="Razor" && $orders['pay_status']=="Paid"):
													$sts=$orders['pay_status'];
													$method = $orders['pay_method'];
												elseif($orders['pay_method']=="Razor" && $orders['pay_status']=="Pending"):
													$sts= "<b class='text-danger'>Invalid Transaction</b>";
													$method = $orders['pay_method'];
													$trbg = "style='background:#FFE5E1'";
												elseif($orders['pay_method']=="cod" && $orders['pay_status']=="Paid"):
													$sts=$orders['pay_status'];
													$method = $orders['pay_method'];
												 else: $sts=$orders['pay_status'];
												 	$xpl = explode("_", $orders['pay_method']);
												 	$methods = @$xpl[0]."()<br>".@$xpl[1];
												 	
												  endif;

											?>
												<tr <?= $trbg; ?>>
													<td><?= $sl; ?></td>
													<td><?= $orders['date']; ?></td>
													<td><?= $orders['order_id']; ?></td>
													<td><?= $orders['user_name']; ?></td>
													<td><?= $orders['grossTotal']; ?></td>
													
													<td><?= $sts; ?></td>
													<td>
														<?php
															if($orders['status']=="Cancel")
															{
																echo "<b class='text-danger'>".$orders['status']."</b>";
															}
															else
															{

														?>
														<select onchange="slctStus(this.value)">
															<option <?= $slc1; ?> <?= $disb1; ?> value="Pending_<?= $orders['id']; ?>_<?= $orders['user_id']; ?>">Pending</option>
															<option <?= $slc2; ?> <?= $disb2; ?> value="Processing_<?= $orders['id']; ?>_<?= $orders['user_id']; ?>">Processing</option>
															
															<option <?= $slc4; ?> <?= $disb4; ?> value="Despatched_<?= $orders['id']; ?>_<?= $orders['user_id']; ?>">Despatched</option>
															<option <?= $slc5; ?> <?= $disb5 ?> value="Delivered_<?= $orders['id']; ?>_<?= $orders['user_id']; ?>">Delivered</option>
															<option <?= $slc6; ?> <?= $disb6 ?> value="Cancel_<?= $orders['id']; ?>_<?= $orders['user_id']; ?>">Cancel</option>
															
														</select>
													<?php } ?>
													</td>
													
													<td>	
														<button  data-toggle="modal" data-target="#InvoiceDetails" class="btn btn-warning" onclick="viewD('ord_<?= $orders['id']; ?>')">View Details</button>
														
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
				<div id="newFlash" class="flashdN">Order Status Changed</div>
			<!-- Container closed -->
			<div class="modal fade" id="refund" role="dialog">
			    <div class="modal-dialog modal-sm">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Refund Amount</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<h5>Refund the Amount to the user wallet?</h5>
			        	<h4>Refund Amount: &#8377; <span id="refAmt"></span></h4>
			        	<span style="display: none" id="userr"></span>
			        	<button class="btn btn-success" id="refnd">Refund</button>
			        	<button class="btn btn-danger" id="cancelled">Cancel</button>
			        </div>
			        
			      </div>
			      
			    </div>
			  </div>
		</div>

		
		<div align="center" class="loaderImg">
			<img src="<?= base_url('assets/img/loder.gif'); ?>" width="95">
		</div>
		<?php include("inc/invoice.php"); ?>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#newFlash").hide();
				$("#cncl").click(function(){
					$("#tr_1").remove();
				});
			});
			function viewD(ordId)
			{
				$(".main-body").removeClass("dark-theme").addClass("Light-mode");
				spl = ordId.split("_");
				id = spl[1];
				$.post("<?= base_url('admin_panel/Orders/orderDetails'); ?>",
				{
					id: id
				},
				function(data)
				{
					//alert(data);
					dt = JSON.parse(data);
					$("#compName").html("Easeshop");
					$("#username").html(dt.shipFullName);
					$("#addr").html(dt.shipAddr+", "+dt.shipCity+", "+dt.shipPin);
					$("#tel").html(dt.shipContact);
					$("#email").html(dt.email);
					$("#invNo").html("#00000"+dt.id);
					$("#orderId").html(dt.order_id);
					$("#fuldate").html(dt.fullDate);
					//$("#cartData").html(dt.cartData);
					var cartss ="";

					for (i = 0; i < dt.cartData.length; i++) {
					  cartss += "<tr><td><img src='"+dt.cartData[i].proImg+"' width='25px' /> </td><td>"+dt.cartData[i].product_name+" </td><td class='text-center'>"+dt.cartData[i].purchaseQty+"</td><td class='text-right'>"+addZeroes(dt.cartData[i].pricePer)+"</td><td class='text-right'>"+addZeroes(dt.cartData[i].cartPrice)+"</td></tr>";
					}

					subtotal = '<tr><td class="valign-middle" colspan="2" rowspan="4"><div class="invoice-notes"><label class="main-content-label tx-13">Notes</label><p></p></div><!-- invoice-notes --></td><td class="tx-right">Sub-Total</td><td class="tx-right" colspan="2">&#8377; '+addZeroes(dt.subTotal)+'</td></tr>';
						if(dt.tax == null)
						{
							taxes ="";
						}
						else
						{
							taxes = '<tr><td class="tx-right">Tax (18%)</td><td class="tx-right" colspan="2">&#8377; '+addZeroes(dt.tax)+'</td></tr>';
						}
						if(dt.discount==null)
						{
							discount = "";
						}
						else
						{
							discount = '<tr><td class="tx-right">Discount</td><td class="tx-right" colspan="2">- &#8377; '+addZeroes(dt.discount)+'</td></tr>';
						}

						totalGross = '<tr><td class="tx-right tx-uppercase tx-bold tx-inverse">Total Amount</td><td class="tx-right" colspan="2"><h4 class="tx-primary tx-bold">&#8377; '+addZeroes(dt.grossTotal)+'</h4></td></tr>';

					$("#cartData").html(cartss+subtotal+taxes+discount+totalGross);
				}

				)
			}

			function addZeroes(num) {
			    // Cast as number
			    var num = Number(num);
			    // If not a number, return 0
			    if (isNaN(num)) {
			        return 0;
			    }
			    // If there is no decimal, or the decimal is less than 2 digits, toFixed
			    if (String(num).split(".").length < 2 || String(num).split(".")[1].length<=2 ){
			        num = num.toFixed(2);
			    }
			    // Return the number
			    return num;
			}

			function printDiv(divName) {
			     var printContents = document.getElementById(divName).innerHTML;
			     var originalContents = document.body.innerHTML;

			     document.body.innerHTML = printContents;

			     window.print();

			     document.body.innerHTML = originalContents;
			}

			function slctStus(name)
			{
				$("#tblDv").css("opacity","0.15");
				$(".loaderImg").show();
				spll = name.split("_");
				order_id = spll[1];
				status = spll[0];
				userId = spll[2];
				if(status=="Cancel")
				{
					$.post("<?= base_url('admin_panel/Orders/orderDetails'); ?>",
					{
						id: order_id
					},
					function(data)
					{
						dt = JSON.parse(data);
						$("#refund").modal('show');
						$("#refAmt").html(dt.grossTotal);
						$("#userr").html(dt.user_id);
						$("#refnd").click(function(){
							$.post("<?= base_url('admin_panel/Orders/CancelStatus'); ?>",
							{
								order_id: order_id,
								status: status,
								user_id: dt.user_id,
								amt: dt.grossTotal
							},
							function(response)
							{
								$("#newFlash").show();
								$("#newFlash").fadeOut(8000);
								location.href="";
							}
						)
						});
						$("#cancelled").click(function(){
							location.href="";
						});
					}
					)
				}
				
				else
				{
					$.post("<?= base_url('admin_panel/Orders/ChangeStatus'); ?>",
							{
								order_id: order_id,
								user_id: userId,
								status: status
							},
							function(response)
							{
								
								setTimeout(function() { $("#newFlash").show(); }, 4000);
								$("#newFlash").fadeOut(5000);
								setTimeout(function() { location.href=""; }, 6000);
								
							}
						)
					//alert(name);
				}
				
			}
		function asignBoys(names)
		{
			spl = names.split("_");
			dlbId = spl[0];
			order_id = spl[1];
			$.post("<?= base_url('admin_panel/Orders/ChangeAsign'); ?>",
					{
						dlbId: dlbId,
						order_id: order_id
					},
					function(data)
					{
						alert(data)
					}
				)
		}

		</script>
	</body>
</html>