<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/dash_layout.php"); ?>
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
							<h4 class="content-title mb-0 my-auto">Product Settings</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Cashback Offer Setup (<?= $prodata['prod_name']; ?>)</h4>
							</div>
							<div class="card-body">
								<form action="<?= base_url('admin_panel/Product_setting/saveSetting'); ?>" method="post">
									<div class="row">
										<div class="form-group col-sm-4">
											<label>Cash back type</label>
											<select name="cashback_type" class="form-control">
												<?php if($offers['offer_type']=="Flat"): $fl = "selected"; $pr = ""; else: $fl= ""; $pr="selected";
												endif; ?> 
												<option value="">Select</option>
												<option <?= $pr; ?> value="Percent">Percent</option>
												<option <?= $fl; ?> value="Flat">Flat</option>
											</select>
										</div>
										<div class="form-group col-sm-4">
											<label>Cash back Value</label>
											<input type="text" name="cashback_value" class="form-control" value="<?= $offers['offer_value']; ?>">
												
										</div>
										<div class="form-group col-sm-4">
											<label>Cash back Valid upto</label>
											<input type="date" name="limit_date" class="form-control" value="<?= $offers['date_limit']; ?>">
												
										</div>
										<div class="form-group col-sm-4">
											<label>Debit Card</label>
											<?php if($offers['debit_card']=="yes"): $ysd = "selected"; $nod = ""; else: $ysd= ""; $nod="selected";
												endif; ?> 
											<select name="debit_card" class="form-control">
												<option value="">Select</option>
												<option <?= $ysd; ?> value="yes">Yes</option>
												<option <?= $nod; ?> value="no">no</option>
											</select>
										</div>
										<div class="form-group col-sm-4">
											<label>Credit Card</label>
											<?php if($offers['credit_card']=="yes"): $ysc = "selected"; $noc = ""; else: $ysc= ""; $noc="selected";
												endif; ?> 
											<select name="credit_card" class="form-control">
												<option value="">Select</option>
												<option <?= $ysc; ?> value="yes">Yes</option>
												<option <?= $noc; ?> value="no">no</option>
											</select>
										</div>
										<div class="form-group col-sm-4">
											<label>UPI Payment</label>
											<?php if($offers['upi']=="yes"): $ysu = "selected"; $nou = ""; else: $ysu= ""; $nou="selected";
												endif; ?> 
											<select name="upi" class="form-control">
												<option value="">Select</option>
												<option <?= $ysu; ?> value="yes">Yes</option>
												<option <?= $nou; ?> value="no">no</option>
											</select>
										</div>
										<div class="form-group col-sm-6" style="border-right: solid 1px #ccc">
											<h5>Debit card banks</h5>
											<div class="row">
												<?php if(!empty($banks)): ?>
													<?php foreach($banks as $bank):

														
													 ?>
														<div class="col-sm-6">
															<input onclick="chSts('db_<?= $bank['drbId']; ?>')" id="db_<?= $bank['drbId']; ?>" <?= $bank['slct']; ?> type="checkbox" name="bank_debit[]" value="<?= $bank['bank_code']; ?>">
															<label><?= $bank['bank_name']; ?></label>
														</div>
													<?php endforeach; ?>
												<?php endif; ?>
											</div>
											
										</div>
										<div class="form-group col-sm-6">
											<h5>Credit card banks</h5>
											<div class="row">
												<?php if(!empty($banks)): ?>
													<?php foreach($banks as $bank): ?>
														<div class="col-sm-6">
															<input  onclick="chSts2('cb_<?= $bank['crbId']; ?>')" id="cb_<?= $bank['crbId']; ?>" <?= $bank['slct2']; ?> type="checkbox" name="bank_credit[]" value="<?= $bank['bank_code']; ?>">
															<label><?= $bank['bank_name']; ?></label>
														</div>
													<?php endforeach; ?>
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group col-sm-6">
											<input type="hidden" name="proId" value="<?= $proId; ?>">
											<button class="btn btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<?php if($feed = $this->session->flashdata("Feed")): ?>
			<div class="flashd">
				<?= $feed; ?>
			</div>
		<?php endif; ?>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/dash_js.php"); ?>
		<script type="text/javascript">
			function chSts(ids)
			{
				var spl = ids.split("_");
				if($("#"+ids).prop("checked") == true){
                
            	}
            	else if($("#"+ids).prop("checked") == false){
                	$.post("<?= base_url('admin_panel/Product_setting/removeDbank'); ?>",{
                		id: spl[1]
                	},function(resp){

                	})
            	}
			}

			function chSts2(ids)
			{
				var spl = ids.split("_");
				if($("#"+ids).prop("checked") == true){
                
            	}
            	else if($("#"+ids).prop("checked") == false){
                	$.post("<?= base_url('admin_panel/Product_setting/removeCbank'); ?>",{
                		id: spl[1]
                	},function(resp){

                	})
            	}
			}
		</script>
	</body>
</html>