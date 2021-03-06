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
<title>easeshop</title>
<?php include("inc/layout.php"); ?>
<link rel="stylesheet"  type='text/css' href="<?= base_url('assets/css/customnewxfinal.css'); ?>">
<style type="text/css">
  @media only screen and (max-width: 991px) 
{
  #mob-view
  {
    display: none !important;
  }
}
.rt
{
  letter-spacing: 5px;
}
</style>
</head>
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
    <?php include("inc/mobheadermenu.php"); ?>
  </div>
  <div class="mobSpace">
    <div class="search-area">
    <form action="<?= base_url('Search/posts'); ?>" method="post">
      <div class="control-group">
        <input name="keys" class="search-field" id="keywords2" placeholder="Search here..." autocomplete="off" />
        <button class="search-button" ></button> </div>
        
    </form>
  </div>
</div>
  <div id="results2">
    <ul id="resContent2"></ul>
  </div>
</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-vs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 
      <!-- ============================================== SIDEBAR ============================================== -->
      
      <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
            <?php if(!empty($banData)): ?>
              <?php foreach($banData as $ban): ?>
                  <div class="item" style="background-image: url(<?= base_url('uploads/banners/'.$ban['banImg']); ?>);">
                    <div class="container-fluid">
                      <div class="caption bg-color vertical-center text-left">
                        <div class="slider-header fadeInDown-1">Top Brands</div>
                        <div class="big-text fadeInDown-1"> <?= $ban['title']; ?> </div>
                        <div class="excerpt fadeInDown-2 hidden-xs"> <span><?= $ban['sl_text']; ?></span> </div>
                        <div class="button-holder fadeInDown-3"> <a href="#" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>

                      </div>
                      <!-- /.caption --> 
                    </div>
                    <!-- /.container-fluid --> 
                  </div>
              <?php endforeach; ?>
            <?php endif; ?>
            
            <!-- /.item -->
            
            
            <!-- /.item --> 
            
          </div>
          <!-- /.owl-carousel --> 
        </div>
        </div>
        <!-- ========================================= SECTION – HERO : END ========================================= --> 
        

        
       
        <!-- ============================================== SCROLL TABS ============================================== -->
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              
            </ul>
            <!-- /.nav-tabs --> 
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                  <?php if(!empty($new_pro)): ?>
                      <?php foreach($new_pro as $nPro): ?>
                        <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="<?= base_url('Product_details/index/'.$nPro['pro_id']); ?>"><img  src="<?= base_url('uploads/products/'.$nPro['mnImg']); ?>" alt=""></a> </div>
                          <!-- /.image -->
                          
                          <div class="tag new"><span>new</span></div>
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name"><a href="<?= base_url('Product_details/index/'.$nPro['pro_id']); ?>"><?= $nPro['prod_name']; ?></a></h3>
                          <?php
                          $remn = 5 - $nPro['revs'];
                          for ($i=0; $i < $nPro['revs'] ; $i++) { 
                            echo '<i class="fa fa-star rt star-orange"></i>';
                          }
                          for ($i=0; $i < $remn ; $i++) { 
                            echo '<i class="fa fa-star-o rt star-grey"></i>';
                          }
                           ?>
                          <div class="description"></div>
                          <div class="product-price"> <span class="price">&#8377; <?= $nPro['sale_price']; ?> </span> <span class="price-before-discount">&#8377; <?= $nPro['price']; ?></span> </div>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li onclick="location.href='<?= base_url('Product_details/index/'.$nPro['pro_id']); ?>'" class="add-cart-button btn-group">
                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>
                              <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="<?= base_url('Product_details/index/'.$nPro['pro_id']); ?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                              
                            </ul>
                          </div>
                          <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                      </div>
                      <!-- /.product --> 
                      
                    </div>
                    <!-- /.products --> 
                  </div>
                      <?php endforeach; ?>
                   <?php endif; ?>
                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
          </div>
          <!-- /.tab-content --> 
        </div>
        <!-- /.scroll-tabs --> 
        <!-- ============================================== SCROLL TABS : END ============================================== --> 
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <!--div class="wide-banners wow fadeInUp outer-bottom-xs">
          <div class="row">
            <div class="col-md-7 col-sm-7">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="<?= base_url(); ?>assets/images/banners/home-banner1.jpg" alt=""> </div>
              </div>
              
            </div>
            
            <div class="col-md-5 col-sm-5">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="<?= base_url(); ?>assets/images/banners/home-banner2.jpg" alt=""> </div>
              </div>
              
            </div>
           
          </div>
         
        </div-->
       
        
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
      <?php if(!empty($fetPro)): ?>
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Featured products</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
           
              <?php foreach($fetPro as $fPro): ?>
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image"> <a href="<?= base_url('Product_details/index/'.$fPro['pro_id']); ?>"><img  src="<?= base_url('uploads/products/'.$fPro['mnImg']); ?>" alt=""></a> </div>
                        <!-- /.image -->
                        
                        
                      </div>
                      <!-- /.product-image -->
                      
                      <div class="product-info text-left">
                        <h3 class="name"><a href="<?= base_url('Product_details/index/'.$fPro['pro_id']); ?>"><?= $fPro['prod_name']; ?></a></h3>
                        <?php
                          $remn1 = 5 - $fPro['revs'];
                          for ($i=0; $i < $fPro['revs'] ; $i++) { 
                            echo '<i class="fa fa-star rt star-orange"></i>';
                          }
                          for ($i=0; $i < $remn1 ; $i++) { 
                            echo '<i class="fa fa-star-o rt star-grey"></i>';
                          }
                           ?>
                        <div class="description"></div>
                        <div class="product-price"> <span class="price">&#8377; <?= $fPro['sale_price']; ?> </span> <span class="price-before-discount">&#8377; <?= $fPro['price']; ?></span> </div>
                        <!-- /.product-price --> 
                        
                      </div>
                      <!-- /.product-info -->
                      <div class="cart clearfix animate-effect">
                        <div class="action">
                          <ul class="list-unstyled">
                            <li onclick="location.href='<?= base_url('Product_details/index/'.$fPro['pro_id']); ?>'" class="add-cart-button btn-group">
                              <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                            </li>
                            <li class="lnk wishlist"> <a class="add-to-cart" href="<?= base_url('Product_details/index/'.$fPro['pro_id']); ?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                            <li class="lnk"> <a class="add-to-cart" href="<?= base_url('Product_details/index/'.$fPro['pro_id']); ?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                          </ul>
                        </div>
                        <!-- /.action --> 
                      </div>
                      <!-- /.cart --> 
                    </div>
                    <!-- /.product --> 
                    
                  </div>
                  <!-- /.products --> 
                </div>
            <!-- /.item -->
                <?php endforeach; ?>
              
          </div>
          <!-- /.home-owl-carousel --> 
        </section>
        <?php endif; ?>
        <?php if(!empty($morePro)): ?>
          <?php foreach($morePro as $mp): ?>
            <section class="section featured-product wow fadeInUp">
              <h3 class="section-title"><?= $mp['cat_name'] ?></h3>
              <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                <?php if(!empty($mp['proData'])): ?>
                  <?php foreach($mp['proData'] as $pr): ?>
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="<?= base_url('Product_details/index/'.$pr['pro_id']); ?>"><img  src="<?= base_url('uploads/products/'.$pr['mnImg']); ?>" alt=""></a> </div>
                          <!-- /.image -->
                          
                          
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name"><a href="<?= base_url('Product_details/index/'.$pr['pro_id']); ?>"><?= $pr['prod_name']; ?></a></h3>
                          <?php
                          $remn2 = 5 - $pr['revs'];
                          for ($i=0; $i < $pr['revs'] ; $i++) { 
                            echo '<i class="fa fa-star rt star-orange"></i>';
                          }
                          for ($i=0; $i < $remn2 ; $i++) { 
                            echo '<i class="fa fa-star-o rt star-grey"></i>';
                          }
                           ?>
                          <div class="description"></div>
                          <div class="product-price"> <span class="price">&#8377; <?= $pr['sale_price']; ?> </span> <span class="price-before-discount">&#8377; <?= $pr['price']; ?></span> </div>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li onclick="location.href='<?= base_url('Product_details/index/'.$pr['pro_id']); ?>'" class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>
                              <li class="lnk wishlist"> <a class="add-to-cart" href="<?= base_url('Product_details/index/'.$pr['pro_id']); ?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                              <li class="lnk"> <a class="add-to-cart" href="<?= base_url('Product_details/index/'.$pr['pro_id']); ?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            </ul>
                          </div>
                          <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                      </div>
                    <!-- /.product --> 
                    
                  </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
              </div>
            </section>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

          <div class=" animate-dropdown"><br></div>
          <div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">Special Offer</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
              <?php if(!empty($spalOffer)): ?>
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
                            <h3 class="name"><a href="<?= base_url('Product_details/index/'.$spl['pro_id']); ?>"><?= $spl['prod_name']; ?></a></h3>
                            <?php
                          $remn3 = 5 - $spl['revs'];
                          for ($i=0; $i < $spl['revs'] ; $i++) { 
                            echo '<i class="fa fa-star rt star-orange"></i>';
                          }
                          for ($i=0; $i < $remn3 ; $i++) { 
                            echo '<i class="fa fa-star-o rt star-grey"></i>';
                          }
                           ?>
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
          <div class="home-banner"> <img src="<?= base_url(); ?>assets/images/banners/LHS-banner22.jpg" alt="Image"> </div>
          <?= br(3); ?>
          <p>&nbsp;</p>
        </div>
      
    </div>
    
  </div>
  <!-- /.container --> 
</div>
<!-- /#top-banner-and-menu --> 

<?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="toastMsg">
      <div class="Msgs"><?= $feed; ?></div>
    </div>
  <?php endif; ?>
<?php include("inc/bottomMenu.php"); ?>
<div id="mob-view">
  <?php include("inc/footer.php"); ?>
</div>
<!-- ============================================================= FOOTER : END============================================================= --> 


<?php include("inc/js.php"); ?>
<?php include("inc/searchjs.php"); ?>
<script type="text/javascript">
  $(".toastMsg").fadeOut(6000);
</script>
</body>

</html>