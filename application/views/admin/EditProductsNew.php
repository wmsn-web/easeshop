<!doctype html>
<html lang="en" dir="ltr"> 
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<?php include("inc/form_layout.php"); ?>

		<title>Edit Products- Admin Panel</title>
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
							<h4 class="content-title mb-0 my-auto">Edit Products</h4>
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
									Edit Products
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
														<option value="">Select</option>
														<option <?= $slSingle; ?> value="single">Single Product</option>
														<option <?= $slVarious; ?> value="various">Various Product</option>
													</select>
												</div>
												<div class="form-group col-sm-6"  id="varr1New">
													<?php if($prodata['var_type']=="size"):
															$slSize = "selected";
															$slclr = ""; 
														elseif($prodata['var_type']=="color"):
															$slSize = "";
															$slclr = "selected";
														else:
															$slSize = "";
															$slclr = "";
															 endif; ?>
													<label>Various Type</label>
													<select name="var_type" id="vt" class="form-control">
														<option value="">Select</option>
														<option <?= $slSize; ?> value="size">Size</option>
														<option <?= $slclr; ?> value="color">Color</option>
													</select>
												</div>
												<div class="col-md-12" id="snl">
													<div class="row">
														<div class="form-group col-sm-3">
															<label>Stock</label>
															<?php if($prodata['qty'] == "In stock"): $instk = "selected"; $outstk = ""; else: $instk = ""; $outstk = "selected"; endif; ?> 
															<select name="qty" class="form-control" required="required">
																<option <?= $instk; ?> value="In stock">In Stock</option>
																<option <?= $outstk; ?> value="Out Of Stock">Out Of Stock</option>
															</select>
														</div>
														<div class="form-group col-sm-3">
															<label>Product Qty</label>
															<input type="text" name="nm" class="form-control" value="<?= $prodata['nm']; ?>" required="required" placeholder="1">
														</div>
														<div class="form-group col-sm-3">
															<label>Unit</label>
															<select name="units" class="form-control" required="required">
																<option value="">Select</option>
																<?php foreach ($units as $key) { 
																	if($prodata['units']==$key['unt_name'])
																	{
																		$slunt = "selected";
																	}else{ $slunt = "";}
																	?>
																	<option <?= $slunt; ?> value="<?= $key['unt_name']; ?>"><?= $key['unt_name']; ?></option>
																<?php } ?>
															</select>
														</div>
														<div class="form-group col-sm-3">
															<label>Product Price</label>
															<input type="text" name="price" class="form-control" required="required" placeholder="100.00" value="<?= $prodata['price']; ?>">
														</div>
													</div>
												</div>
												<div class="form-group col-sm-8">&nbsp;</div>
												<div class="container-fluid"  id="varr1">
													
													<div class="field_wrapper">
														<?php foreach($prodata['various'] as $vars): ?>
														<div id="row_<?= $vars['var_id']; ?>" class="row">
															
														<div class="form-group col-sm-3">
															<label>Color</label>
															<input type="text" id="cl_<?= $vars['var_id']; ?>" name="colors[]" class="form-control clr clrd"  value="<?= $vars['size']; ?>">
														</div>
														
														<div class="form-group col-sm-4">
															<label>Price</label>
															<input type="text" id="clp_<?= $vars['var_id']; ?>" name="prcce[]" class="form-control  clrP" value="<?= $vars['price']; ?>"  placeholder="Price">
														</div>
														</div>
													<?php endforeach; ?>
													</div>
													<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i> Add More</a>
												</div>

												<!--================Size===============-->
												<div class="container-fluid"  id="varr2">
													
													<div class="field_wrapper2">
														<?php foreach($prodata['various'] as $vars): ?>
														<div class="row">
															
														<div class="form-group col-sm-3">
															<label>Size</label>
															<input type="text" id="sz_<?= $vars['var_id']; ?>" name="size[]" class="form-control siz sizd" value="<?= $vars['size']; ?>"  placeholder="10 gm">
														</div>
														
														<div class="form-group col-sm-4">
															<label>Price</label>
															<input type="text" id="clz_<?= $vars['var_id']; ?>" name="prcce2[]" class="form-control siz priz" value="<?= $vars['price']; ?>"  placeholder="Price">
														</div>
														
														    
														</div>
													<?php endforeach; ?>
													</div>
													<a href="javascript:void(0);" class="add_button2" title="Add field"><i class="fas fa-plus"></i> Add More</a>
												</div>
												<!--================Size End===========-->
												<div class="form-group col-sm-4">&nbsp;</div>
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
												
												<div class="form-group col-sm-4">
													<label>Product Offer(%)</label>
													<input type="text" name="offer" class="form-control" value="<?= $prodata['offer']; ?>" >
												</div>
												<div class="form-group col-sm-12">
													<label>Short Description</label>
													<textarea name="descr" class="form-control" required="required" placeholder="Short Description"><?= $prodata['descr']; ?></textarea> 
													
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<label>Select an Image</label>
											<input type="file" name="main_img" class="dropify" data-height="200" data-default-file="<?= base_url('uploads/products/'.$prodata['img']); ?>" />

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
											<a data-toggle="modal" data-target="#morImg" href="javascript:void(0)">Upload More Images</a>
										</div>
										
										<input type="hidden" name="id" value="<?= $prodata['prId']; ?>">
										<input type="hidden" name="proId" value="<?= $prodata["proId"]; ?>">
										<div class="col-md-12">
											<button class="btn btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
							
						</div>
					</div>
					
				</div>

				<div class="modal fade" id="morImg" role="dialog">
			    <div class="modal-dialog modal-lg">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Upload More Pictures</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<div class="card-body">
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
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
				<?php if($prodata['pro_type']=="various"): ?>
					$("#varr1New").show();
					<?php else: ?>
					$("#varr1New").hide();
				<?php endif; ?>
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
				$("#varr1").hide();
				//$("#varr1New").hide();
				$("#varr2").hide();
					var vt = $("#vt").val();
					if(vt == "size")
					{
						$("#varr2").show();
					}
					else if(vt == "color")
					{
						$("#varr1").show();
					}
					else
					{
						$("#varr1").hide();
						$("#varr2").hide();
					}
				$("#vrs").change(function(){
					var vrs = $("#vrs").val();
					if(vrs == "various")
					{
						$("#varr1New").show();
						$("#vt").attr("required","required");
						//alert("kk")
						
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
						$(".siz").removeAttr("required");
						$(".clr").attr("required","required");
						
					}
					else
					{
						$("#varr1").hide();
						$("#varr2").show();
						$(".siz").attr("required","required");
						$(".clr").removeAttr("required");
						
					}
				});


	var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="form-group col-sm-3"><label>Color</label><input type="text" name="colors_new[]" class="form-control clr"  placeholder="10 gm"></div><div class="form-group col-sm-4"><label>Product Quantity</label><input type="text" name="prcce_new[]" class="form-control clr"  placeholder="Price"></div><a href="javascript:void(0);" class="remove_button"><i class="fas fa-times text-danger"></i> Remove</a></div>'; //New input field html 
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
    var fieldHTML2 = '<div class="row"><div class="form-group col-sm-3"><label>Size</label><input type="text" name="size_new[]" class="form-control siz"  placeholder="10 gm"></div><div class="form-group col-sm-4"><label>Product Quantity</label><input type="text" name="prcce2_new[]" class="form-control siz"  placeholder="Price"></div><a href="javascript:void(0);" class="remove_button2"><i class="fas fa-times text-danger"></i> Remove</a></div>'; //New input field html 
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
    $(".sizd").blur(function(){
    	var ids = this.id;
    	var size = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	$.post("<?= base_url('admin_panel/AllProducts/ChangeVarSize'); ?>",
    			{
    				id: id,
    				size: size
    			},
    			function(resp)
    			{
    				//alert("dd")
    			}
    		)
    });

    $(".priz").blur(function(){
    	var ids = this.id;
    	var price = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	$.post("<?= base_url('admin_panel/AllProducts/ChangeVarSize_prize'); ?>",
    			{
    				id: id,
    				price: price
    			},
    			function(resp)
    			{
    				//alert();
    			}
    		)
    });


    //Change Colors data===========================================================
    $(".clr").blur(function(){
    	var ids = this.id;
    	var colorcode = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	$.post("<?= base_url('admin_panel/AllProducts/ChangeVarColor'); ?>",
    			{
    				id: id,
    				colorcode: colorcode
    			},
    			function(resp)
    			{
    				//alert(colorcode)
    			}
    		)
    });

    $(".clrP").blur(function(){
    	var ids = this.id;
    	var price = this.value;
    	spl = ids.split("_");
    	id = spl[1];
    	$.post("<?= base_url('admin_panel/AllProducts/ChangeVarColor_prize'); ?>",
    			{
    				id: id,
    				price: price
    			},
    			function(resp)
    			{
    				//alert();
    			}
    		)
    })
			});
		</script>
	</body>
</html>