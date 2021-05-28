<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/dash_layout.php"); ?>
		<title> Admin Panel</title>
		<style type="text/css">
			.faqs
			{
				padding: 4px;
				border:  solid 1px #FFBE87;
				background: #FFF1E8;
				margin-bottom: 8px;
			}
			.qstn
			{
				padding: 6px;
				font-size: 16px;
				font-weight: bold;
				font-style: italic;
				color: #E84300;
			}
			.ansr
			{
				padding-left: 16px;
				font-size: 13px;
				font-weight: 400;
				font-style: italic;
				color: #002AE8;
			}
		</style>
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
							<h4 class="content-title mb-0 my-auto">Settings</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
				<!-- Logic Active Class-->
					<?php
						if(isset($_GET['ref']))
						{
							$class = "btn btn-primary";
							$refShow = "style='display:block'";
						}
						else
						{
							$class = "btn btn-outline-primary";
							$refShow = "style='display:none'";
						}
					?>
				<!-- Logic Active Class-->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="dropdown">
						<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
						data-toggle="dropdown" id="dropdownMenuButton" type="button">Settings<i class="fas fa-caret-down ml-1"></i></button>
						<div  class="dropdown-menu tx-13">
							
							
							<a <?php if(isset($_GET['priv'])){ echo 'class="dropdown-item active"';}else{ echo 'class="dropdown-item"';} ?> href="<?= base_url('admin_panel/OtherSettings/?priv'); ?>">Set Privacy Policy</a>
							<a <?php if(isset($_GET['terms'])){ echo 'class="dropdown-item active"';}else{ echo 'class="dropdown-item"';} ?> href="<?= base_url('admin_panel/OtherSettings/?terms'); ?>">Terms and condition</a>
							<a <?php if(isset($_GET['help'])){ echo 'class="dropdown-item active"';}else{ echo 'class="dropdown-item"';} ?> href="<?= base_url('admin_panel/OtherSettings/?help'); ?>">Help Desk</a>
							<a <?php if(isset($_GET['tax'])){ echo 'class="dropdown-item active"';}else{ echo 'class="dropdown-item"';} ?> href="<?= base_url('admin_panel/OtherSettings/?tax'); ?>">Tax</a>
							<a <?php if(isset($_GET['coupon'])){ echo 'class="dropdown-item active"';}else{ echo 'class="dropdown-item"';} ?> href="<?= base_url('admin_panel/OtherSettings/?coupon'); ?>">Coupon Codes</a>
						</div>
					</div>
						
					</div>

				</div>
				<div class="row justify-content-center">
					<?php if(isset($_GET['ref']) || isset($_GET['mot']) || isset($_GET['moa'])): ?>
					<div class="col-md-12"><?= br(1); ?></div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">
									<?php if(isset($_GET['ref'])): ?>
										Referral Settings
									<?php elseif(isset($_GET['mot'])): ?>
										Manage Order Timing
									<?php elseif(isset($_GET['moa'])): ?>
										Minimum Order Amount
									<?php endif; ?>
								</h5>
							</div>
							<div class="card-body">
								<?php if(isset($_GET['ref'])): ?>
									<form action="<?= base_url('admin_panel/OtherSettings/updtRef'); ?>" method="post">
										<div class="form-group">
											<label>Amount per Refer (&#8377;)</label>
											<input type="text" name="amount" class="form-control" value="<?= $ref['amount']; ?>">
										</div>
										<div class="form-group">
											<button class="btn btn-info"><i class="fas fa-save"></i> Save</button>
										</div>
									</form>
									<?php elseif(isset($_GET['moa'])): ?>
									<form action="<?= base_url('admin_panel/OtherSettings/minOrdr'); ?>" method="post">
										<div class="form-group">
											<label>Minimum Order Amount (&#8377;)</label>
											<input type="text" name="amount" class="form-control" value="<?= $minOrd['minOrdAmt']; ?>">
										</div>
										<div class="form-group">
											<button class="btn btn-info"><i class="fas fa-save"></i> Save</button>
										</div>
									</form>
									
										
									<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php if(isset($_GET['priv'])): ?>
					<div class="col-md-10">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Set Privacy Policy</h4>
							</div>
							<div class="card-body">
								<?php if(!empty($getPrivacy)): ?>
									<a href="javascript:void(0);" class="add_button2" title="Add field"><i class="fas fa-plus"></i> Add More</a>
									<span id="updtMsg" class="text-success"></span>
									<?php foreach($getPrivacy as $privacy): ?>
										<div class="field_wrapperddx">
										<div class="row">
											<div class="form-group col-sm-4">
												<label>Heading</label>
												<input name="heading[]" id="hd_<?= $privacy['id']; ?>" class="form-control hdClass" required="required" value="<?= $privacy['heading']; ?>">
											</div>
											<div class="form-group col-sm-7">
												<label>Description</label>
												<textarea id="ds_<?= $privacy['id']; ?>" name="descr[]" rows="3" class="form-control descClass"  ><?= $privacy['descr']; ?></textarea>
											</div>
											<a href="<?= base_url('admin_panel/OtherSettings/delPrivacy/'.$privacy['id']); ?>" class=""><i class="fas fa-times text-danger"></i> Remove</a>
										</div>
									</div>
									<?php endforeach; ?>
									<form action="<?= base_url('admin_panel/OtherSettings/AddPrivacy'); ?>" method="post">
										<div class="field_wrapper2"></div>
										<button class="btn btn-primary">Save</button>
									</form>
								<?php else: ?>
									<form action="<?= base_url('admin_panel/OtherSettings/AddPrivacy'); ?>" method="post">
									<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i> Add More</a>
									<hr>
									<div class="field_wrapper">
										<div class="row">
											<div class="form-group col-sm-4">
												<label>Heading</label>
												<input name="heading[]" class="form-control" required="required">
											</div>
											<div class="form-group col-sm-8">
												<label>Description</label>
												<textarea name="descr[]" rows="3" class="form-control"  ></textarea>
											</div>
										</div>
									</div>
									<button class="btn btn-primary">Save</button>
								</form>
								<?php endif; ?>
								
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php if(isset($_GET['terms'])): ?>
					<div class="col-md-10">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Set Terms & Condition</h4>
							</div>
							<div class="card-body">
								<?php if(!empty($getTerms)): ?>
									<a href="javascript:void(0);" class="add_button2" title="Add field"><i class="fas fa-plus"></i> Add More</a>
									<span id="updtMsg" class="text-success"></span>
									<?php foreach($getTerms as $terms): ?>
										<div class="field_wrapperddx">
										<div class="row">
											<div class="form-group col-sm-4">
												<label>Heading</label>
												<input name="heading[]" id="hd_<?= $terms['id']; ?>" class="form-control hdTrm" required="required" value="<?= $terms['heading']; ?>">
											</div>
											<div class="form-group col-sm-7">
												<label>Description</label>
												<textarea id="ds_<?= $terms['id']; ?>" name="descr[]" rows="3" class="form-control descTrm"  ><?= $terms['descr']; ?></textarea>
											</div>
											<a href="<?= base_url('admin_panel/OtherSettings/delTerms/'.$terms['id']); ?>" class=""><i class="fas fa-times text-danger"></i> Remove</a>
										</div>
									</div>
									<?php endforeach; ?>
									<form action="<?= base_url('admin_panel/OtherSettings/Terms'); ?>" method="post">
										<div class="field_wrapper2"></div>
										<button class="btn btn-primary">Save</button>
									</form>
								<?php else: ?>
									<form action="<?= base_url('admin_panel/OtherSettings/Terms'); ?>" method="post">
									<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i> Add More</a>
									<hr>
									<div class="field_wrapper">
										<div class="row">
											<div class="form-group col-sm-4">
												<label>Heading</label>
												<input name="heading[]" class="form-control" required="required">
											</div>
											<div class="form-group col-sm-8">
												<label>Description</label>
												<textarea name="descr[]" rows="3" class="form-control"  ></textarea>
											</div>
										</div>
									</div>
									<button class="btn btn-primary">Save</button>
								</form>
								<?php endif; ?>
								
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php if(isset($_GET['tax'])): ?>
				<div class="row justify-content-center">
					<div class="col-md-12"><?= br(2); ?></div>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">
											Tax
										</h3>
									</div>
									<div class="card-body">
										<form action="<?= base_url('admin_panel/OtherSettings/ChTax'); ?>" method="post">
											<div class="form-group">
												<label>TAX</label>
												<input type="number" name="tax" class="form-control" placeholder="Update tax" value="<?= $tx['tax']; ?>">
											</div>
											<div class="form-group">
												<button class="btn btn-primary">Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>
					</div>
				</div>
			<?php endif; ?>
				<?php if(isset($_GET['help'])): ?>
					<div class="row">
						<div class="col-md-12"><?= br(2); ?></div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">
										Help & FAQ
									</h3>
								</div>
								<div class="card-body">
									<form action="<?= base_url('admin_panel/OtherSettings/setCnum'); ?>" method="post">
										
										<div class="form-group">
											<label>Customer Care Number</label>
											<input type="tel" name="cNum" class="form-control" required="required" value="<?= $getCnum; ?>">
										</div>
										<div class="form-group">
											<button class="btn btn-primary">Save</button>
										</div>
									</form>
									<hr>
									<h4>Frequent Ask Question Answer</h4>
									<?php if($this->uri->segment(4)=="edits"): ?>
										<form action="<?= base_url('admin_panel/OtherSettings/UpdateFaq'); ?>" method="post">
									<?php else: ?>
										<form action="<?= base_url('admin_panel/OtherSettings/addFaq'); ?>" method="post">
									<?php endif; ?>
										<div class="form-group">
											<label>Select Product</label>
											<select class="form-control" name="proId" required>
												<option value="">Select Product</option>
												<?php if(!empty($proData)): ?>
													<?php foreach($proData as $pro):
														if($pro['prId'] == $faqrow['proId'] )
														{
															$slc = "selected";
														}
														else
														{
															$slc = "";
														}
													 ?>

														<option <?= $slc; ?> value="<?= $pro['prId']; ?>"><?= $pro['prod_name']; ?></option>
													<?php endforeach; ?>
												<?php endif; ?>
											</select>
										</div>
										<div class="form-group">
											<label>Question</label>
											<input type="text" name="qstn" class="form-control" required="required" value="<?= $faqrow['qstn']; ?>">
										</div>
										<div class="form-group">
											<label>Answer</label>
											<textarea name="ansr" class="form-control" rows="4" required="required"><?= $faqrow['ansr']; ?></textarea>
										</div>
										<input type="hidden" name="id" value="<?= $this->uri->segment(5); ?>">
										<div class="form-group">
											<button class="btn btn-primary">Add</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">
										frequent ask question answer
									</h3>
								</div>
								<div class="card-body">
									<?php if(!empty($getFaqs)): ?>
										<?php foreach($getFaqs as $faqs): ?>
											<div id="fq_<?= $faqs['id']; ?>" class="faqs">
												<div class="qstn">
													<span class="qss"><i class="fas fa-question-circle"></i></span>
													<?= $faqs['qstn']; ?>
													<small>~~<?= $faqs['prod_name']; ?></small>
												</div>
												<div class="ansr">
													<?= $faqs['ansr']; ?>
												</div>
												<?= nbs(4); ?>
												<a id="l1_<?= $faqs['id']; ?>" href="<?= base_url('admin_panel/OtherSettings/index/edits/'.$faqs['id'].'/?help'); ?>" class="text-warning" title="Edit">
													<i class="fas fa-pen"></i>
												</a><?= nbs(5); ?>
												<a id="l2_<?= $faqs['id']; ?>" href="<?= base_url('admin_panel/OtherSettings/delFaq/'.$faqs['id']); ?>" class="text-danger" title="Delete">
													<i class="fas fa-trash"></i>
												</a>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>

				
				
				<!-- row closed -->
				<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
			</div>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/dash_js.php"); ?>
		<?php if($this->uri->segment(4)=="edits"): ?>
			<script type="text/javascript">
				var ids = "<?= $this->uri->segment(5); ?>";
				$("#fq_"+ids).css("opacity","0.25");
				$("#l1_"+ids).hide();
				$("#l2_"+ids).hide();
			</script>
		<?php endif; ?>
		<script type="text/javascript">
			function calculate() {
     var time1 = $(".Time1").val().split(':'), time2 = $(".Time2").val().split(':');
     var hours1 = parseInt(time1[0], 10), 
         hours2 = parseInt(time2[0], 10),
         mins1 = parseInt(time1[1], 10),
         mins2 = parseInt(time2[1], 10);
     var hours = hours2 - hours1, mins = 0;

     // get hours
     if(hours < 0) hours = 24 + hours;

     // get minutes
     if(mins2 >= mins1) {
         mins = mins2 - mins1;
     }
     else {
         mins = (mins2 + 60) - mins1;
         hours--;
     }

     // convert to fraction of 60
     mins = mins / 60; 

     hours += mins;
     hours = hours.toFixed(2);
     $(".Hours").val(hours);
 }

 $(document).ready(function(){
 	$("#esd").blur(function(){
 		esd = parseInt($("#esd").val());
 		hours = parseInt($(".Hours").val());
 		slots = Math.ceil(hours/esd);
 		$("#slots").val(slots);
 		slts = Math.ceil(slots+1);
 		//alert(slts);
 		slotInput = "";
 		var i;
 		for (i = 1; i < slts; i++) {
		  slotInput += '<div class="form-group col-sm-4"><label>Slot</label><input type="number" name="slot[]" class="form-control" readonly value="'+i+'"></div><div class="form-group col-sm-4"><label>Start</label><input type="time" name="start[]" class="form-control" value="" required="required"></div><div class="form-group col-sm-4"><label>End</label><input type="time" name="end[]" class="form-control" value="" required="required"></div>';

		  $("#slotTiming").html(slotInput);
		}

		
 		

 	});

 	var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="form-group col-sm-4"><label>Heading</label><input name="heading[]" class="form-control" required="required"></div><div class="form-group col-sm-7"><label>Description</label><textarea name="descr[]" rows="3" class="form-control"  ></textarea></div><a href="javascript:void(0);" class="remove_button"><i class="fas fa-times text-danger"></i> Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div class="row"><div class="form-group col-sm-4"><label>Heading</label><input name="heading[]" class="form-control" required="required"></div><div class="form-group col-sm-7"><label>Description</label><textarea name="descr[]" rows="3" class="form-control"  ></textarea></div><a href="javascript:void(0);" class="remove_button2"><i class="fas fa-times text-danger"></i> Remove</a></div>'; //New input field html 
    var xx = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(xx < maxField2){ 
            xx++; //Increment field counter
            $(wrapper2).append(fieldHTML2); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper2).on('click', '.remove_button2', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        xx--; //Decrement field counter
    });

    $(".hdClass").blur(function(){
    	ids = this.id;
    	headings = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	$.post("<?= base_url('admin_panel/OtherSettings/privChangeHdClass'); ?>",
    		{
    			id:id,
    			headings: headings
    		},
    		function(response)
    		{
    			if(response == "done")
    			{
	    			$("#updtMsg").html("Heading Updated");
				}
    		}
    	)
    });
    $(".descClass").blur(function(){
    	ids = this.id;
    	descr = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	//alert(descr);
    	$.post("<?= base_url('admin_panel/OtherSettings/privChangeDescClass'); ?>",
    		{
    			id:id,
    			descr: descr
    		},
    		function(response)
    		{
    			if(response == "done")
    			{
	    			$("#updtMsg").html("Description Updated");
				}
    		}
    	)
    });

    $(".hdTrm").blur(function(){
    	ids = this.id;
    	headings = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	$.post("<?= base_url('admin_panel/OtherSettings/termChangeHdClass'); ?>",
    		{
    			id:id,
    			headings: headings
    		},
    		function(response)
    		{
    			if(response == "done")
    			{
	    			$("#updtMsg").html("Heading Updated");
				}
    		}
    	)
    });

    $(".descTrm").blur(function(){
    	ids = this.id;
    	descr = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	//alert(descr);
    	$.post("<?= base_url('admin_panel/OtherSettings/termChangeDescClass'); ?>",
    		{
    			id:id,
    			descr: descr
    		},
    		function(response)
    		{
    			if(response == "done")
    			{
	    			$("#updtMsg").html("Description Updated");
				}
    		}
    	)
    });
 });
		</script>
	</body>
</html>