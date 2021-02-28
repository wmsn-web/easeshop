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
<?php include("inc/detail_layout.php"); ?>
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
<body>
    <body class="cnt-home">
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 
  
      <!-- ============================================== TOP MENU ============================================== -->
      <div id="mob-view">
        <?php include("inc/header_top.php"); ?>
      
      <!-- /.header-top --> 
      <!-- ============================================== TOP MENU : END ============================================== -->
      <?php include("inc/main_header.php"); ?>
      <!-- /.main-header --> 
      
      <!-- ============================================== NAVBAR ============================================== -->
      <?php include("inc/menuNew.php"); ?>
      <!-- /.header-nav --> 
      <!-- ============================================== NAVBAR : END ============================================== --> 
    </div>
  <div class="mob-header">
    <?php include("inc/goback.php"); ?>
  </div>
  <?= br(3); ?>
</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<?php if(!empty($cartData["cartData"])): ?>
		<div class="row ">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>
					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Rate</th>
					<th class="cart-total last-item">Subtotal</th>
				</tr>
			</thead><!-- /thead -->
			
			<tbody>
				
					<?php foreach($cartData["cartData"] as $cart): ?>
						<tr>
							<td class="romove-item"><a href="<?= base_url('My-Cart/delCart/'.$cart['cart_id']); ?>" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
							<td class="cart-image">
								<a class="entry-thumbnail" href="<?= base_url('Product_details/index/'.$cart['pro_id']); ?>">
								    <img src="<?= base_url('uploads/products/'.$cart['mnImg']); ?>" alt="" width="150">
								</a>
							</td>
							<td class="cart-product-name-info">
								<h4 class='cart-product-description'><a href="<?= base_url('Product_details/index/'.$cart['pro_id']); ?>"><?= $cart['prod_name']; ?></a></h4>
								<!-- /.row -->
								<div class="cart-product-info">
									<span class="product-color"><?= $cart['varname']; ?></span>
								</div>
							</td>
							
							<td class="cart-product-quantity">
								<div class="quant-input">
						                
						                <input id="qt_<?= $cart['cart_id']; ?>" onchange="edtQtyPrc('<?= $cart['cart_id'].'_'.$cart['sale_price']; ?>')" type="number"  value="<?= $cart['qty']; ?>">
					              </div>
				            </td>
							<td class="cart-product-sub-total"><span class="cart-sub-total-price">
								&#8377; <?= $cart['sale_price']; ?></span></td>
							<td class="cart-product-grand-total"><span class="cart-grand-total-price">&#8377; <?= number_format($cart['price'],2); ?></span></td>
						</tr>
					<?php endforeach; ?>
				
			</tbody><!-- /tbody -->
		</table><!-- /table -->
	</div>
</div><!-- /.shopping-cart-table -->

<div class="col-md-8 col-sm-12 estimate-ship-tax">
	<?php if(empty($cartData['shipData'])): ?>
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">shipping Address</span>
					<p>Enter your destination .</p>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
			<form>
				<tr>
					<td>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="info-title control-label">Address <span>*</span></label>
								<small class="text-danger" id="msg1"></small>
								<input id="addr" class="form-control unicase-form-control" type="text" name="address" id="addr" />
							</div>
							<div class="form-group col-sm-6">
								<label class="info-title control-label">City <span>*</span></label>
								<small class="text-danger" id="msg2"></small>
								<input id="city" class="form-control unicase-form-control" type="text" name="address" id="addr" />
							</div>
							<div class="form-group col-sm-4">
								<label class="info-title control-label">State <span>*</span></label>
								<small class="text-danger" id="msg3"></small>
								<select id="state" class="form-control unicase-form-control">
									<option value="">Select State</option>
									<option value="Andhra Pradesh">Andhra Pradesh</option>
									<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
									<option value="Arunachal Pradesh">Arunachal Pradesh</option>
									<option value="Assam">Assam</option>
									<option value="Bihar">Bihar</option>
									<option value="Chandigarh">Chandigarh</option>
									<option value="Chhattisgarh">Chhattisgarh</option>
									<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
									<option value="Daman and Diu">Daman and Diu</option>
									<option value="Delhi">Delhi</option>
									<option value="Lakshadweep">Lakshadweep</option>
									<option value="Puducherry">Puducherry</option>
									<option value="Goa">Goa</option>
									<option value="Gujarat">Gujarat</option>
									<option value="Haryana">Haryana</option>
									<option value="Himachal Pradesh">Himachal Pradesh</option>
									<option value="Jammu and Kashmir">Jammu and Kashmir</option>
									<option value="Jharkhand">Jharkhand</option>
									<option value="Karnataka">Karnataka</option>
									<option value="Kerala">Kerala</option>
									<option value="Madhya Pradesh">Madhya Pradesh</option>
									<option value="Maharashtra">Maharashtra</option>
									<option value="Manipur">Manipur</option>
									<option value="Meghalaya">Meghalaya</option>
									<option value="Mizoram">Mizoram</option>
									<option value="Nagaland">Nagaland</option>
									<option value="Odisha">Odisha</option>
									<option value="Punjab">Punjab</option>
									<option value="Rajasthan">Rajasthan</option>
									<option value="Sikkim">Sikkim</option>
									<option value="Tamil Nadu">Tamil Nadu</option>
									<option value="Telangana">Telangana</option>
									<option value="Tripura">Tripura</option>
									<option value="Uttar Pradesh">Uttar Pradesh</option>
									<option value="Uttarakhand">Uttarakhand</option>
									<option value="West Bengal">West Bengal</option>
								</select>
							</div>
							<div class="form-group col-sm-4">
								<label class="info-title control-label">Zip/Postal Code <span>*</span></label><small class="text-danger" id="msg4"></small>
								<input id="zip" type="text" class="form-control unicase-form-control text-input" placeholder="">
							</div>
							<div class="form-group col-sm-4">
								<label class="info-title control-label">Land Mark</label>
								<input id="lm" type="text" class="form-control unicase-form-control text-input" placeholder="">
							</div>
						</div>
					</td>
				</tr>
			</form>
		</tbody>
	</table>
<?php else: ?>
	<h3>Shipping Address</h3>
	<h4><i class="fa fa-user"></i> <?= $getUser['name']; ?></h4>
	<p><i class="fa fa-phone"></i> <?= $getUser['phone']; ?><br>
		<i class="fa fa-map-marker"></i> <?= $cartData['shipData']['address']; ?>,
		<?= $cartData['shipData']['city']; ?><br>
		<?= $cartData['shipData']['state']; ?>,<?= $cartData['shipData']['pin']; ?><br>
		<?= $cartData['shipData']['landMark']; ?><br>
		
	</p>
	
<?php endif; ?>
</div><!-- /.estimate-ship-tax -->



<div class="col-md-4 col-sm-12 cart-shopping-total"> 
	<table class="table">
		<thead>
			<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">&#8377; <?= number_format($cartData['totAmt'],2); ?></span> 
					</div>
					<div class="cart-sub-total">
						TAX <?= $cartData['tax']; ?>%<?= nbs(2); ?> <span class="inner-left-md">&#8377; <?= number_format($cartData['nowTx'],2); ?></span> 
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">&#8377; <?= number_format($cartData['grand'],2); ?></span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		
			<input type="hidden" id="user_id" value="<?= $this->session->userdata('userId'); ?>">
			<input type="hidden" id="ship_id" value="<?= @$cartData['shipData']['ship_id']; ?>">
			<input type="hidden" id="carts" value='<?= json_encode($cartData['cartall']); ?>'>
			<input type="hidden" id="subtot" value='<?= $cartData['totAmt']; ?>'>
			<input type="hidden" id="tax" value='<?= $cartData['tax']; ?>'>
			<input type="hidden" id="grosstot" value='<?= $cartData['grand']; ?>'>
			
		
		<form id="checkout" method="post" action="<?= base_url('pgRedirect'); ?>"> 
		<input id="ORDER_ID" tabindex="1" maxlength="20" size="20" type="hidden"
			name="ORDER_ID"  value='<?= rand(); ?>'>
		<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?= $this->session->userdata('userId'); ?>">
		<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
		<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
		<input type="hidden" title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="<?= $cartData['grand']; ?>">
		<input value="CheckOut" type="hidden" 	onclick="">
	</form>
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<?php if(empty($cartData['shipData'])): ?>
								<button id="AddShip" type="button" class="btn btn-primary checkout-btn">Add Shipping Address</button>
							<?php else: ?>
								<button id="addOrd" type="button" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</button>
							<?php endif; ?>
							
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
		<?php else: ?>
			<div class="row">
				<div class="col-md-12 text-center">
					<h4 class="text-danger">Cart is Empty!</h4>
				</div>
			</div>
		<?php endif; ?>
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

<?php include("inc/bottomMenu.php"); ?>
<div id="mob-view">
  <?php include("inc/footer.php"); ?>
</div>
<?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="toastMsg">
      <div class="Msgs"><?= $feed; ?></div>
    </div>

  <?php endif; ?>
<!-- ============================================================= FOOTER : END============================================================= --> 


<?php include("inc/detail_js.php"); ?>
<?php include("inc/searchjs.php"); ?>
<script type="text/javascript">
	$(document).ready(function(){
    $(".toastMsg").fadeOut(6000);

    $("#AddShip").click(function(){
    	addr = $("#addr").val();
    	city = $("#city").val();
    	state = $("#state").val();
    	zip = $("#zip").val();
    	lm = $("#lm").val();
    	user_id = "<?= $this->session->userdata('userId'); ?>";
    	if(addr == ""){$("#addr").addClass("inpDanger").focus(); $("#msg1").html("Please Enter your address");}
    	else if(city == ""){$("#addr").removeClass("inpDanger"); $("#msg1").html("");$("#city").addClass("inpDanger").focus(); $("#msg2").html("Please Enter your City Name");}
    	else if(state == ""){$("#city").removeClass("inpDanger"); $("#msg2").html("");$("#state").addClass("inpDanger").focus(); $("#msg3").html("Please Enter your State Name");}
    	else if(zip == ""){$("#state").removeClass("inpDanger"); $("#msg3").html("");$("#zip").addClass("inpDanger").focus(); $("#msg4").html("Please Enter your PIN/ZIP");}
    	else
    	{
    		$("#addr").removeClass("inpDanger"); $("#msg1").html("");
    		$("#city").removeClass("inpDanger"); $("#msg2").html("");
    		$("#state").removeClass("inpDanger"); $("#msg3").html("");
    		$("#zip").removeClass("inpDanger"); $("#msg4").html("");

    		//Insert into database
    		$.post("<?= base_url('My-Cart/AddShipAddr'); ?>",{
    			addr: addr,
    			city: city,
    			state: state,
    			zip: zip,
    			lm: lm,
    			user_id: user_id
    		},function(resp){
    			if(resp == "done")
    			{
    				location.href="<?= base_url('My-Cart'); ?>";
    			}
    			else
    			{
    				return false;
    			}
    		})
    	}
    });

    $("#addOrd").click(function(){
    	user_id = $("#user_id").val();
    	ship_id = $("#ship_id").val();
    	subtot = $("#subtot").val();
    	tax = $("#tax").val();
    	grosstot = $("#grosstot").val();
    	carts = $("#carts").val();
    	orderId = $("#ORDER_ID").val();
    	$.post("<?= base_url('My-Cart/AddOrder'); ?>",{
    		user_id: user_id,
    		ship_id:ship_id,
    		subtot:subtot,
    		tax: tax,
    		grosstot: grosstot,
    		carts: carts,
    		orderId: orderId
    	},function(response){
    		if(response=="done")
    		{
    			$("#checkout").submit();
    		}
    	})
    })
});
	function edtQtyPrc(ids)
	{
		var spl = ids.split("_");
		var id = spl[0];
		var fixPrc = spl[1];
		var qty = $("#qt_"+id).val();
		if(qty >0)
		{
			$.post("<?= base_url('My-Cart/edtQtyPrc'); ?>",{
				id: id,
				fixPrc: fixPrc,
				qty: qty
			},function(resp){
				location.href="";
			})
		}
		else
		{
			$("#qt_"+id).val("1");
			return false;
		}
	}
</script>

</body>

</html>
