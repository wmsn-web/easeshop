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
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="#" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								<a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a>
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
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
</div><!-- /.shopping-cart-table -->				<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Estimate shipping and tax</span>
					<p>Enter your destination to get shipping and tax.</p>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<label class="info-title control-label">Country <span>*</span></label>
							<select class="form-control unicase-form-control selectpicker">
								<option>--Select options--</option>
								<option>India</option>
								<option>SriLanka</option>
								<option>united kingdom</option>
								<option>saudi arabia</option>
								<option>united arab emirates</option>
							</select>
						</div>
						<div class="form-group">
							<label class="info-title control-label">State/Province <span>*</span></label>
							<select class="form-control unicase-form-control selectpicker">
								<option>--Select options--</option>
								<option>TamilNadu</option>
								<option>Kerala</option>
								<option>Andhra Pradesh</option>
								<option>Karnataka</option>
								<option>Madhya Pradesh</option>
							</select>
						</div>
						<div class="form-group">
							<label class="info-title control-label">Zip/Postal Code</label>
							<input type="text" class="form-control unicase-form-control text-input" placeholder="">
						</div>
						<div class="pull-right">
							<button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
						</div>
					</td>
				</tr>
		</tbody>
	</table>
</div><!-- /.estimate-ship-tax -->

<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Discount Code</span>
					<p>Enter your coupon code if you have one..</p>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
						</div>
						<div class="clearfix pull-right">
							<button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.estimate-ship-tax -->

<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table">
		<thead>
			<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">$600.00</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">$600.00</span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<button type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</button>
							<span class="">Checkout with multiples address!</span>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
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
