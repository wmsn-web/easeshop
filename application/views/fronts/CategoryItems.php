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
<?php include("inc/layout.php"); ?>
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
<body class="cnt-home">
	<header class="header-style-1"> 
  
		  <!-- ============================================== TOP MENU ============================================== -->
		  <div id="mob-view">
		    <?php include("inc/header_top.php"); ?>
		  </div>
		  <!-- /.header-top --> 
		  <!-- ============================================== TOP MENU : END ============================================== -->
		  <?php include("inc/main_header.php"); ?>
		  <!-- /.main-header --> 
		  
		  <!-- ============================================== NAVBAR ============================================== -->
		  <?php include("inc/menuNew.php"); ?>
		  <!-- /.header-nav --> 
		  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">

          <div class=" animate-dropdown"><br></div>
          <div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">Special Offer</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
              <?php if(!empty($spalOffer)): ?>
              	heheheh
                <?php foreach($spalOffer as $spl): ?>
              <div class="item">
                <div class="products special-product">
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="#"> <img src="<?= base_url('uploads/products/'.$spl['mnImg']); ?>" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="#"><?= $spl['prod_name']; ?></a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> <span class="price">&#8377; <?= $spl['sale_price']; ?> </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                
                </div>
              </div>
              <?php endforeach; ?>
                <?php endif; ?>
              
              
            </div>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>

        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
          <h3 class="section-title">Newsletters</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <p>Sign Up for Our Newsletter!</p>
            <form>
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
              </div>
              <button class="btn btn-primary">Subscribe</button>
            </form>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
          <div class="home-banner"> <img src="<?= base_url(); ?>assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
        	<div class="clearfix filters-container m-t-10">
	          <div class="row">
	            <div class="col col-sm-6 col-md-2">
	              <div class="filter-tabs">
	                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
	                  <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
	                  <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
	                </ul>
	              </div>
	              <!-- /.filter-tabs --> 
	            </div>
	            <!-- /.col -->
	            <div class="col col-sm-12 col-md-6">
	              <div class="col col-sm-3 col-md-6 no-padding">
	                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
	                  <div class="fld inline">
	                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
	                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
	                      <ul role="menu" class="dropdown-menu">
	                        <li role="presentation"><a href="#">position</a></li>
	                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
	                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
	                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
	                      </ul>
	                    </div>
	                  </div>
	                  <!-- /.fld --> 
	                </div>
	                <!-- /.lbl-cnt --> 
	              </div>
	              <!-- /.col -->
	              <div class="col col-sm-3 col-md-6 no-padding">
	                <div class="lbl-cnt"> <span class="lbl">Show</span>
	                  <div class="fld inline">
	                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
	                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
	                      <ul role="menu" class="dropdown-menu">
	                        <li role="presentation"><a href="#">1</a></li>
	                        <li role="presentation"><a href="#">2</a></li>
	                        <li role="presentation"><a href="#">3</a></li>
	                        <li role="presentation"><a href="#">4</a></li>
	                        <li role="presentation"><a href="#">5</a></li>
	                        <li role="presentation"><a href="#">6</a></li>
	                        <li role="presentation"><a href="#">7</a></li>
	                        <li role="presentation"><a href="#">8</a></li>
	                        <li role="presentation"><a href="#">9</a></li>
	                        <li role="presentation"><a href="#">10</a></li>
	                      </ul>
	                    </div>
	                  </div>
	                  <!-- /.fld --> 
	                </div>
	                <!-- /.lbl-cnt --> 
	              </div>
	              <!-- /.col --> 
	            </div>
	            <!-- /.col -->
	            <div class="col col-sm-6 col-md-4 text-right">
	              <div class="pagination-container">
	                <!--ul class="list-inline list-unstyled">
	                  <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
	                  <li><a href="#">1</a></li>
	                  <li class="active"><a href="#">2</a></li>
	                  <li><a href="#">3</a></li>
	                  <li><a href="#">4</a></li>
	                  <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
	                </ul-->
	                <ul class="list-inline list-unstyled">
	                  <?= $links; ?>
	                </ul>
	                <!-- /.list-inline --> 
	              </div>
	              <!-- /.pagination-container --> </div>
	            <!-- /.col --> 
	          </div>
	          <!-- /.row --> 
	        </div>
	        <div class="search-result-container ">
          		<div id="myTabContent" class="tab-content category-list">
            		<div class="tab-pane active"  id="list-containerXX">
		              <div class="category-product">
		              	<?php if(!empty($brandItem)): ?>
		              		<?php foreach($brandItem as $brI): ?>
		              			<div class="category-product-inner wow fadeInUp">
				                  <div class="products">
				                    <div class="product-list product">
				                      <div class="row product-list-row">
				                        <div class="col col-sm-4 col-lg-4">
				                          <div class="product-image">
				                            <div class="image"> <img src="<?= base_url(); ?>assets/images/products/p3.jpg" alt=""> </div>
				                          </div>
				                          <!-- /.product-image --> 
				                        </div>
				                        <!-- /.col -->
				                        <div class="col col-sm-8 col-lg-8">
				                          <div class="product-info">
				                            <h3 class="name"><a href="detail.html"><?= $brI['prod_name']; ?></a></h3>
				                            <div class="rating rateit-small"></div>
				                            <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
				                            <!-- /.product-price -->
				                            <div class="description m-t-10">Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus. Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget.</div>
				                            <div class="cart clearfix animate-effect">
				                              <div class="action">
				                                <ul class="list-unstyled">
				                                  <li class="add-cart-button btn-group">
				                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
				                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
				                                  </li>
				                                  <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
				                                  <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
				                                </ul>
				                              </div>
				                              <!-- /.action --> 
				                            </div>
				                            <!-- /.cart --> 
				                            
				                          </div>
				                          <!-- /.product-info --> 
				                        </div>
				                        <!-- /.col --> 
				                      </div>
				                      <!-- /.product-list-row -->
				                      <div class="tag new"><span>new</span></div>
				                    </div>
				                    <!-- /.product-list --> 
				                  </div>
				                  <!-- /.products --> 
				                </div>
		              		<?php endforeach; ?>
		              	<?php endif; ?>
		                <div class="col col-sm-6 col-md-4 text-right">
	              <div class="pagination-container">
	                <!--ul class="list-inline list-unstyled">
	                  <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
	                  <li><a href="#">1</a></li>
	                  <li class="active"><a href="#">2</a></li>
	                  <li><a href="#">3</a></li>
	                  <li><a href="#">4</a></li>
	                  <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
	                </ul-->
	                <ul class="list-inline list-unstyled">
	                  <?= $links; ?>
	                </ul>
	                <!-- /.list-inline --> 
	              </div>
	              <!-- /.pagination-container --> </div>
		                
		                
		              </div>
              <!-- /.category-product --> 
            </div>
        		</div>
        	

<div id="mob-view">
  <?php include("inc/footer.php"); ?>
</div>
<!-- ============================================================= FOOTER : END============================================================= --> 


<?php include("inc/js.php"); ?>
<?php include("inc/searchjs.php"); ?>
</body>