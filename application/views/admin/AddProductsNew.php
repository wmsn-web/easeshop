<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<?php include("inc/form_layout.php"); ?>
		<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
		<title>Add Products- Admin Panel</title>
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
							<h4 class="content-title mb-0 my-auto">Add Products</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									Add Products
								</h3>
							</div>
							<div class="card-body">
								<form action="<?= base_url('admin_panel/AddProducts/insrtProduct'); ?>" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="form-group col-sm-6">
													<label>Product Name</label>
													<input type="text" name="prod_name" class="form-control" required="required" placeholder="Product Name">
												</div>
												<div class="form-group col-sm-6">
													<label>Product Category</label>
													<select name="cat_id" class="form-control" required="required" placeholder="Product Category">
														<option value="">Select</option>
														<?php foreach ($data as $key) { ?>
															<option value="<?= $key['catId']; ?>"><?= $key['cat_name']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-sm-6">
													<label>Product Brand</label>
													<select  name="brand" class="form-control" required="required">
														<option value="">Select Brand</option>
														<?php if(!empty($brand)): ?>
															<?php foreach($brand as $brnd): ?>
																<option value="<?= $brnd['brand_id']; ?>"><?= $brnd['brand']; ?></option>
															<?php endforeach; ?>
														<?php endif; ?>
													</select>
												</div>
												<div class="form-group col-sm-6">
													<label>Product Type</label>
													<select id="vrs" name="pro_type" class="form-control" required="required">
														<option value="">Select</option>
														<option value="single">Single Product</option>
														<option value="various">Various Product</option>
													</select>
												</div>
												<div class="form-group col-sm-6"  id="varr1New">
													<label>Various Type</label>
													<select name="var_type" id="vt" class="form-control">
														<option value="">Select</option>
														<option value="size">Size</option>
														<option value="color">Color</option>
													</select>
												</div>
												<div class="col-md-12" id="snl">
													<div class="row">
														<div class="form-group col-sm-3">
															<label>Stock</label>
															<select name="qty" class="form-control" required="required">
																<option value="In stock">In Stock</option>
																<option value="Out Of Stock">Out Of Stock</option>
															</select>
														</div>
														<div class="form-group col-sm-3">
															<label>Product Qty</label>
															<input type="text" name="nm" class="form-control" required="required" placeholder="1">
														</div>
														<div class="form-group col-sm-3">
															<label>Unit</label>
															<select name="units" class="form-control" required="required">
																<option value="">Select</option>
																<?php foreach ($units as $key) { ?>
																	<option value="<?= $key['unt_name']; ?>"><?= $key['unt_name']; ?></option>
																<?php } ?>
															</select>
														</div>
														<div class="form-group col-sm-3">
															<label>Product Price</label>
															<input type="text" name="price" class="form-control" required="required" placeholder="100.00">
														</div>
													</div>
												</div>
												<div class="form-group col-sm-8">&nbsp;</div>
												<div class="container-fluid"  id="varr1">
													
													<div class="field_wrapper">
														<div class="row">
															
														<div class="form-group col-sm-3"> 
															<label>Color</label>
															<input type="text" name="colors[]" class="form-control clr"  placeholder="">
														</div>
														
														<div class="form-group col-sm-4">
															<label>Price</label>
															<input type="text" name="prcce[]" class="form-control clr"  placeholder="Price">
														</div>
														
														    
														</div>
													</div>
													<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i> Add More</a>
												</div>

												<!--================Size===============-->
												<div class="container-fluid"  id="varr2">
													
													<div class="field_wrapper2">
														<div class="row">
															
														<div class="form-group col-sm-3">
															<label>Size</label>
															<input type="text" name="size[]" class="form-control siz"  placeholder="10 gm">
														</div>
														
														<div class="form-group col-sm-4">
															<label>Price</label>
															<input type="text" name="prcce2[]" class="form-control siz"  placeholder="Price">
														</div>
														
														    
														</div>
													</div>
													<a href="javascript:void(0);" class="add_button2" title="Add field"><i class="fas fa-plus"></i> Add More</a>
												</div>
												<!--================Size End===========-->
												<div class="form-group col-sm-4">&nbsp;</div>
												<div class="form-group col-sm-4">
													<label>Is this Product Returnable ?</label><br>
													<input type="radio"  name="returnable" value="yes">
													<label>Yes</label><?= nbs(10); ?>
													<input type="radio" checked name="returnable" value="no">
													<label>No</label><?= nbs(10); ?>
												</div>
												<div class="form-group col-sm-4">
													<label>Product Offer(%)</label>
													<input type="text" name="offer" class="form-control" value="0">
												</div>
												<div class="form-group col-sm-12">
													<label>Short Description</label>
													<textarea name="descr" id="ShortDesc" class="form-control" required="required" placeholder="Short Description"></textarea> 
													
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<label>Select an Image</label>
											<input type="file" name="main_img" class="dropify" data-height="200" />
										</div>
										<div class="col-md-12">
											<button class="btn btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
				
				<!-- row closed -->
				<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
			</div>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/form_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#varr1").hide();
				$("#varr1New").hide();
				$("#varr2").hide();
					var vrs = $("#vrs").val();
					if(vrs == "various")
					{
						$("#varr1").show();
					}
				$("#vrs").change(function(){
					var vrs = $("#vrs").val();
					if(vrs == "various")
					{
						$("#varr1New").show();
						$("#vt").attr("required","required");
						
					}
					else
					{
						$("#varr1New").hide();
						$("#vt").removeAttr("required");
						
						
					}
				});
				$("#vt").change(function(){
					var vrs = $("#vt").val();
					if(vrs == "color")
					{
						$("#varr1").show();
						$("#varr2").hide();
						$(".siz").val("");
						$(".siz").removeAttr("required");
						$(".clr").attr("required","required");
						
					}
					else
					{
						$("#varr1").hide();
						$("#varr2").show();
						$(".clr").val("");
						$(".siz").attr("required","required");
						$(".clr").removeAttr("required");
						
					}
				});


	var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="form-group col-sm-3"><label>Color</label><input type="text" name="colors[]" class="form-control clr"  placeholder="Color Name"></div><div class="form-group col-sm-4"><label>Product Quantity</label><input type="text" name="prcce[]" class="form-control clr"  placeholder="Price"></div><a href="javascript:void(0);" class="remove_button"><i class="fas fa-times text-danger"></i> Remove</a></div>'; //New input field html 
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

    //Size===================================================================
    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div class="row"><div class="form-group col-sm-3"><label>Size</label><input type="text" name="size[]" class="form-control siz"  placeholder="Size"></div><div class="form-group col-sm-4"><label>Product Quantity</label><input type="text" name="prcce2[]" class="form-control siz"  placeholder="Price"></div><a href="javascript:void(0);" class="remove_button2"><i class="fas fa-times text-danger"></i> Remove</a></div>'; //New input field html 
    var x2 = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(x2 < maxField2){ 
            x++; //Increment field counter
            $(wrapper2).append(fieldHTML2); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper2).on('click', '.remove_button2', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    //========================================================================
			});
			CKEDITOR.replace('ShortDesc');
		</script>
	</body>
</html>