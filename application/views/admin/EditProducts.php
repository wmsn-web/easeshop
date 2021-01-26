<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<?php include("inc/form_layout.php"); ?>

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
								<form action="<?= base_url('admin_panel/AllProducts/updateProduct'); ?>" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="form-group col-sm-6">
													<label>Product Name</label>
													<input type="text" name="prod_name" class="form-control" required="required" placeholder="Product Name" value="<?= $prodata['prod_name']; ?>">
												</div>
												<div class="form-group col-sm-6">
													<label>Product Category</label>
													<select name="cat_id" class="form-control" required="required" placeholder="Product Category">
														<option value="">Select</option>
														<?php foreach ($data as $key) {
															if($prodata['cat_id']==$key['catId'])
															{
																$slct = "selected='selected'";
															}
															else
															{
																$slct = "";
															}

														 ?>
															<option <?= $slct; ?> value="<?= $key['catId']; ?>"><?= $key['cat_name']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-sm-6">
													<label>Product Brand</label>
													<select  name="brand" class="form-control" required="required">
														<option value="">Select Brand</option>
														<?php if(!empty($brand)): ?>
															<?php foreach($brand as $brnd):
																if($prodata['brand_id'] == $brnd['brand_id'])
																{
																	$slcts = "selected";
																}
																else
																{
																	$slcts = "";
																}
															 ?>

																<option <?= $slcts; ?> value="<?= $brnd['brand_id']; ?>"><?= $brnd['brand']; ?></option>
															<?php endforeach; ?>
														<?php endif; ?>
													</select>
												</div>
												<?php if($prodata['pro_type']=="single"):
													$slSingle = "selected";
													$slVarious = ""; else:
													$slSingle = "";
													$slVarious = "selected"; endif; ?>
												<div class="form-group col-sm-6">
													<label>Product Type</label>
													<select id="vrs" name="pro_type" class="form-control" required="required">
														<option <?= $slSingle; ?> value="single">Single Product</option>
														<option <?= $slVarious; ?> value="various">Various Product</option>
													</select>
												</div>
												<div class="form-group col-sm-3">
													<?php if($prodata['qty']=="In Stock")
													{
														$inst = "selected";
														$outst = "";
													}
													else
													{
														$inst = "";
														$outst = "selected";
													} ?>
													<label>Stock</label>
															<select name="qty" class="form-control" required="required">
																<option <?= $inst; ?> value="In Stock">In Stock</option>
																<option <?= $outst; ?> value="Out Of Stock">Out Of Stock</option>
															</select>
												</div>
												<div class="form-group col-sm-3">
													<label>Product Quantity</label>
													<input type="text" name="nm" class="form-control" required="required" placeholder="1" value="<?= $prodata['nm']; ?>">
												</div>
												<div class="form-group col-sm-2">
													<label>Unit</label>
													<select name="units" class="form-control" required="required">
														<option value="">Select</option>
														<?php foreach ($units as $key) {
															if($key['unt_name']==$prodata['units'])
															{
																$slct = "selected='selected'";
															}
															else
															{
																$slct = "";
															}
														 ?>
															<option <?= $slct; ?> value="<?= $key['unt_name']; ?>"><?= $key['unt_name']; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label>Product Price</label>
													<input type="text" name="price" class="form-control" required="required" placeholder="100.00" value="<?= $prodata['price']; ?>">
												</div>
												
												<div class="form-group col-sm-12">
													<div id="varr1">
														
													<?php if(!empty($prodata['various'])): ?>
														Update Various Product's Quantity and Price
														
														<?php foreach($prodata['various'] as $vars): ?>
															<div id="row_<?= $vars['var_id']; ?>" class="row">
																<div class="form-group col-sm-3">
															<label>Stock</label>
															<?php if($vars['stock']=="In Stock")
																{
																	$inst = "selected";
																	$outst = "";
																}
																else
																{
																	$inst = "";
																	$outst = "selected";
																} ?>
															<select id="stqt_<?= $vars['var_id']; ?>"  name="stqty[]" class="form-control stqt" required="required" placeholder="Product Quantity">
																<option <?= $inst; ?> value="In Stock">In Stock</option>
																<option <?= $outst; ?> value="Out Of Stock">Out Of Stock</option>
															</select>
														</div>
																<div class="form-group col-sm-3">
																	<label>Product Quantity</label>
																	<input id="qt_<?= $vars['var_id']; ?>" type="text" name="qtys" class="form-control qty"  placeholder="10 gm" value="<?= $vars['qty_unit']; ?>">
																</div>
																<div class="form-group col-sm-3">
																	<label>Price</label>
																	<input id="pr_<?= $vars['var_id']; ?>" type="text" name="prcce" class="form-control prc"  placeholder="Price" value="<?= $vars['price']; ?>">
																</div>
																<span id="rmv_<?= $vars['var_id']; ?>" class="cp removeVar"><br>Remove</span>
															</div>
														<?php endforeach; ?>
													<?php endif; ?>
													</div>
													<div id="varr2">
													<div class="field_wrapper"></div>
														<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i> Add More</a>
													</div>
												</div>
												<div class="form-group col-sm-4">&nbsp;</div>
												<div class="form-group col-sm-4">
													<label>Product Offer(%)</label>
													<input type="text" name="offer" class="form-control" value="<?= $prodata['offer']; ?>">
												</div>
												<div class="form-group col-sm-4">
													<?php
														if($prodata['returnable']=="yes")
														{
															$checked1 = "checked";
															$checked2 = "";
														}
														else
														{
															$checked1 = "";
															$checked2 = "checked";
														}
													?>
													<label>Is this Product Returnable ?</label><br>
													<input type="radio" <?= $checked1; ?> name="returnable" value="yes">
													<label>Yes</label><?= nbs(10); ?>
													<input type="radio" <?= $checked2; ?> name="returnable" value="no">
													<label>No</label><?= nbs(10); ?>
												</div>
												
												<div class="form-group col-sm-12">
													<label>Short Description</label>
													<textarea name="descr" class="form-control" required="required" placeholder="Short Description"><?= $prodata['descr']; ?></textarea> 
													
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<label>Select an Image</label>
											<input type="file" name="main_img" class="dropify" data-default-file="<?= base_url('uploads/products/'.$prodata['img']); ?>" data-height="200" />
											<div class="row">
												<?php if(!empty($getGal)){ ?>
													<?php foreach ($getGal as $gal) { ?>
														
														<div class="col-sm-2 imgThumb">
															<span class="closes">
																<a href="<?= base_url('admin_panel/AllProducts/delgal/'.$gal['id'].'/'.$prodata['prId']); ?>">
																	<i class="far fa-times-circle"></i>
																</a>
															</span>
															<img src="<?= base_url('uploads/products/'.$gal['images']); ?>">
														</div>
											    	<?php } ?>
											    <?php } ?>
											</div>
											<a id="mr" href="javascript:void(0)">Upload More Images</a>
										</div>
										<input type="hidden" name="id" value="<?= $prodata['prId']; ?>">
										<input type="hidden" name="proId" value="<?= $prodata["proId"]; ?>">
										<div class="col-md-12">
											<button class="btn btn-primary">Save</button>
										</div>
										
								</div>
								</form>
									</div>
								
								<div class="card-body" id="mrImg">
									<form action="<?= base_url('admin_panel/AllProducts/uplGal'); ?>" method="post" enctype="multipart/form-data">
										<div class="row">
		                                	<div class="gallerys col-md-12"></div>
		                                	
		                                </div>
		                                
		                                <input id="gallery-photo-add" type="file" name="proImg[]" accept=".jpg, .png, image/jpeg, image/png, html, zip, css,js" class="form-control" multiple>
		                                <div class="form-group">
		                                	<label for="gallery-photo-add">
		                                	<span class="upldd"><i class="far fa-image"></i><br>Add More</span>
		                                	</label><br><br>
		                                	<input type="hidden" name="id" value="<?= $prodata['prId']; ?>">
		                                	<button disabled="disabled" id="uplbtn" class="btn btn-warning text-white">Upload</button>
		                                </div>
	                                </form>
                                </div>
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
				<?php if($prodata['pro_type']=="single"): ?>
					$("#varr2").hide();
				<?php endif; ?>
				$("#mr").click(function(){
					$("#mrImg").toggle(300);
				})

				$(".stqt").blur(function(){
					ids = this.id;
					qty_unit = this.value;
					spl = ids.split("_");
					var_id = spl[1];
					$.post("<?= base_url('admin_panel/AllProducts/updtvariousStQty'); ?>",
							{
								var_id: var_id,
								stock: qty_unit
							},
							function(response)
							{

							}
					)
				});

				$(".qty").blur(function(){
					ids = this.id;
					qty_unit = this.value;
					spl = ids.split("_");
					var_id = spl[1];
					$.post("<?= base_url('admin_panel/AllProducts/updtvariousQty'); ?>",
							{
								var_id: var_id,
								qty_unit: qty_unit
							},
							function(response)
							{

							}
					)
				});

				$(".prc").blur(function(){
					ids = this.id;
					price = this.value;
					spl = ids.split("_");
					var_id = spl[1];
					//alert(price);
					$.post("<?= base_url('admin_panel/AllProducts/updtvariousPrice'); ?>",
							{
								var_id: var_id,
								price: price
							},
							function(response)
							{

							}
					)
				});

				$(".removeVar").click(function(){
					ids = this.id;
					spl = ids.split("_");
					id = spl[1];
					rrow = "row_"+id;
					$.post("<?= base_url('admin_panel/AllProducts/delvarious'); ?>",
							{
								var_id: id,
								
							},
							function(response)
							{

							}
					)
					$("#"+rrow).remove();

				})
			});
			$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="col-md-2">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallerys');
        $("#uplbtn").attr("disabled",false);
    });

    $("#vrs").change(function(){
					var vrs = $("#vrs").val();
					if(vrs == "various")
					{
						$("#varr1").show();
						$("#varr2").show();
					}
					else
					{
						$("#varr1").hide();
						$("#varr2").hide();
						$("#vrs").val("single");
					}
				});
});
			var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="form-group col-sm-3"><label>Stock</label><select name="stqty_new[]" class="form-control" required="required"><option value="In Stock">In Stock</option><option value="Out Of Stock">Out Of Stock</option></select></div><div class="form-group col-sm-3"><label>Product Quantity</label><input type="text" name="qtys_new[]" class="form-control"  placeholder="10 gm"></div><div class="form-group col-sm-4"><label>Price</label><input type="text" name="prcce_new[]" class="form-control"  placeholder="Price"></div><a href="javascript:void(0);" class="remove_button"><i class="fas fa-times text-danger"></i> Remove</a></div>'; //New input field html 
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
			
		</script>
	</body>
</html>