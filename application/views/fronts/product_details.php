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
<link rel="stylesheet"  type='text/css' href="<?= base_url('assets/css/custom.css'); ?>">
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
<!-- ============================================== HEADER ============================================== -->
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

<!-- ============================================== HEADER : END ============================================== --> 

<!-- ============================================== HEADER : END ============================================== -->
  <div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="#">Home</a></li>
          <li class='active'><?= $this->uri->segment(3); ?></li>
        </ul>
      </div>
      <!-- /.breadcrumb-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.breadcrumb -->
  <div class="body-content outer-top-xs">
    <div class="container">
      <div class='row single-product'>
        <div class='col-md-3 sidebar'> 
        <!-- ================================== TOP NAVIGATION ================================== -->
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
          <!-- /.side-menu --> 
          <!-- ================================== TOP NAVIGATION : END ================================== -->
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
          <!-- /.sidebar-module-container --> 
        </div>
        <div class='col-md-9'>
            <div class="detail-block">
              <div class="row  wow fadeInUp">
                <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                  <div class="product-item-holder size-big single-product-gallery small-gallery">
                    <div id="owl-single-product">

                        <div class="single-product-gallery-item" id="slide1">
                            <a data-lightbox="image-1" data-title="Gallery" href="<?= base_url('uploads/products/'.$proData['mnImg']); ?>">
                                <img class="img-responsive" alt="" src="<?= base_url('uploads/products/'.$proData['mnImg']); ?>" data-echo="<?= base_url('uploads/products/'.$proData['mnImg']); ?>" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->
                        <?php if(!empty($proData['galData'])): ?>
                          <?php $sls = 2; foreach($proData['galData'] as $gals): $sl= $sls++; ?>
                            <div class="single-product-gallery-item" id="slide<?= $sl; ?>">
                                <a data-lightbox="image-1" data-title="Gallery" href="<?= base_url('uploads/products/'.$gals['galImg']); ?>">
                                    <img class="img-responsive" alt="" src="<?= base_url('uploads/products/'.$gals['galImg']); ?>" data-echo="<?= base_url('uploads/products/'.$gals['galImg']); ?>" />
                                </a>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- /.single-product-gallery-item -->
                    </div><!-- /.single-product-slider -->

                  <div class="single-product-gallery-thumbs gallery-thumbs">

                    <div id="owl-single-product-thumbnails">
                      <div class="item">
                          <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
                              <img class="img-responsive" width="85" alt="" src="<?= base_url('uploads/products/'.$proData['mnImg']); ?>" data-echo="<?= base_url('uploads/products/'.$proData['mnImg']); ?>" />
                          </a>
                      </div>
                      <?php if(!empty($proData['galData'])): ?>
                          <?php $sls = 2; foreach($proData['galData'] as $gals): $sl= $sls++; ?>
                            <div class="item">
                              <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="<?= $sl; ?>" href="#slide<?= $sl; ?>">
                                  <img class="img-responsive" width="85" alt="" src="<?= base_url('uploads/products/'.$gals['galImg']); ?>" data-echo="<?= base_url('uploads/products/'.$gals['galImg']); ?>" />
                              </a>
                          </div>
                          <?php endforeach; ?>
                        <?php endif; ?>
                    </div><!-- /#owl-single-product-thumbnails -->
                  </div><!-- /.gallery-thumbs -->
                </div><!-- /.single-product-gallery -->
              </div><!-- /.gallery-holder -->             
                <div class='col-sm-6 col-md-7 product-info-block'>
                  <div class="product-info">
                    <h1 class="name"><?= $proData['prod_name']; ?></h1>
                    
                    <div class="rating-reviews m-t-20">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="rating rateit-small"></div>
                        </div>
                        <div class="col-sm-8">
                          <div class="reviews">
                            <a href="#" class="lnk">(13 Reviews)</a>
                          </div>
                        </div>
                      </div><!-- /.row -->    
                    </div><!-- /.rating-reviews -->

                    <div class="stock-container info-container m-t-10">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="stock-box">
                            <span class="label">Availability :</span>
                          </div>  
                        </div>
                        <div class="col-sm-9">
                          <div class="stock-box">
                            <span class="value"><?= $proData['stock']; ?></span>
                          </div>  
                        </div>
                      </div><!-- /.row -->  
                    </div><!-- /.stock-container -->

                    <div class="description-container m-t-20">
                      <?= $proData['descr']; ?>
                    </div><!-- /.description-container -->

                    <div class="price-container info-container m-t-20">
                      <div class="row">
                        

                        <div class="col-sm-6">
                          <div class="price-box">
                            <span class="price">&#8377; <?= $proData['sale_price']; ?></span>
                            <span class="price-strike">&#8377; <?= $proData['price']; ?></span>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="favorite-button m-t-10">
                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                <i class="fa fa-heart"></i>
                            </a>
                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                               <i class="fa fa-signal"></i>
                            </a>
                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                <i class="fa fa-envelope"></i>
                            </a>
                          </div>
                        </div>

                      </div><!-- /.row -->
                    </div><!-- /.price-container -->

                    <div class="quantity-container info-container">
                      <div class="row">
                        <div class="col-sm-12">
                          <?php if(!empty($proData['varData'])): ?>
                            <?php $vrr = 1; foreach($proData['varData'] as $vars): $vr = $vrr++; ?>
                              <div class="color-thumb actv<?= $vr; ?> cp">
                                <span style="background: <?= $vars['colorcode']; ?>; display: inline-block; width: 45px; height: 45px; border-radius: 12px"></span>
                              </div>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </div>
                        <div class="col-sm-2">
                          <span class="label">Qty :</span>
                        </div>
                        
                        <div class="col-sm-2">
                          <div class="cart-quantity">
                            <div class="quant-input">
                                      <div class="arrows">
                                        <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                        <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                      </div>
                                      <input type="text" value="1">
                                  </div>
                                </div>
                        </div>

                        <div class="col-sm-7">
                          <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                        </div>
                        <div class="clearfix"></div>
                        
                        
                      </div><!-- /.row -->
                    </div><!-- /.quantity-container -->

                    

                    

                    
                  </div><!-- /.product-info -->
                </div><!-- /.col-sm-7 -->
              </div><!-- /.row -->
                </div>
        
        <div class="product-tabs inner-bottom-xs  wow fadeInUp">
          <div class="row">
            <div class="col-sm-3">
              <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
              </ul><!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-9">

              <div class="tab-content">
                
                <div id="description" class="tab-pane in active">
                  <div class="product-tab">
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  </div>  
                </div><!-- /.tab-pane -->

                <div id="review" class="tab-pane">
                  <div class="product-tab">
                                        
                    <div class="product-reviews">
                      <h4 class="title">Customer Reviews</h4>

                      <div class="reviews">
                        <div class="review">
                          <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
                          <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
                                                    </div>
                      
                      </div><!-- /.reviews -->
                    </div><!-- /.product-reviews -->
                    

                    
                    <div class="product-add-review">
                      <h4 class="title">Write your own review</h4>
                      <div class="review-table">
                        <div class="table-responsive">
                          <table class="table"> 
                            <thead>
                              <tr>
                                <th class="cell-label">&nbsp;</th>
                                <th>1 star</th>
                                <th>2 stars</th>
                                <th>3 stars</th>
                                <th>4 stars</th>
                                <th>5 stars</th>
                              </tr>
                            </thead>  
                            <tbody>
                              <tr>
                                <td class="cell-label">Quality</td>
                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                              </tr>
                              <tr>
                                <td class="cell-label">Price</td>
                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                              </tr>
                              <tr>
                                <td class="cell-label">Value</td>
                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                              </tr>
                            </tbody>
                          </table><!-- /.table .table-bordered -->
                        </div><!-- /.table-responsive -->
                      </div><!-- /.review-table -->
                      
                      <div class="review-form">
                        <div class="form-container">
                          <form role="form" class="cnt-form">
                            
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                  <input type="text" class="form-control txt" id="exampleInputName" placeholder="">
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                  <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                  <input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
                                </div><!-- /.form-group -->
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                  <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                </div><!-- /.form-group -->
                              </div>
                            </div><!-- /.row -->
                            
                            <div class="action text-right">
                              <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                            </div><!-- /.action -->

                          </form><!-- /.cnt-form -->
                        </div><!-- /.form-container -->
                      </div><!-- /.review-form -->

                    </div><!-- /.product-add-review -->                   
                    
                      </div><!-- /.product-tab -->
                </div><!-- /.tab-pane -->

                <div id="tags" class="tab-pane">
                  <div class="product-tag">
                    
                    <h4 class="title">Product Tags</h4>
                    <form role="form" class="form-inline form-cnt">
                      <div class="form-container">
                  
                        <div class="form-group">
                          <label for="exampleInputTag">Add Your Tags: </label>
                          <input type="email" id="exampleInputTag" class="form-control txt">
                          

                        </div>

                        <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                      </div><!-- /.form-container -->
                    </form><!-- /.form-cnt -->

                    <form role="form" class="form-inline form-cnt">
                      <div class="form-group">
                        <label>&nbsp;</label>
                        <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                      </div>
                    </form><!-- /.form-cnt -->

                  </div><!-- /.product-tab -->
                </div><!-- /.tab-pane -->

              </div><!-- /.tab-content -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.product-tabs -->

        <!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
  <h3 class="section-title">upsell products</h3>
  <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
        
    <div class="item item-carousel">
      <div class="products">
        
  <div class="product">   
    <div class="product-image">
      <div class="image">
        <a href="detail.html"><img  src="<?= base_url(); ?>assets/images/products/p1.jpg" alt=""></a>
      </div><!-- /.image -->      

                  <div class="tag sale"><span>sale</span></div>                  
    </div><!-- /.product-image -->
      
    
    <div class="product-info text-left">
      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
      <div class="rating rateit-small"></div>
      <div class="description"></div>

      <div class="product-price"> 
        <span class="price">
          $650.99       </span>
                         <span class="price-before-discount">$ 800</span>
                  
      </div><!-- /.product-price -->
      
    </div><!-- /.product-info -->
          <div class="cart clearfix animate-effect">
        <div class="action">
          <ul class="list-unstyled">
            <li class="add-cart-button btn-group">
              <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                <i class="fa fa-shopping-cart"></i>                         
              </button>
              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          
            </li>
                     
                    <li class="lnk wishlist">
              <a class="add-to-cart" href="detail.html" title="Wishlist">
                 <i class="icon fa fa-heart"></i>
              </a>
            </li>

            <li class="lnk">
              <a class="add-to-cart" href="detail.html" title="Compare">
                  <i class="fa fa-signal"></i>
              </a>
            </li>
          </ul>
        </div><!-- /.action -->
      </div><!-- /.cart -->
      </div><!-- /.product -->
      
      </div><!-- /.products -->
    </div><!-- /.item -->
  
    <div class="item item-carousel">
      <div class="products">
        
  <div class="product">   
    <div class="product-image">
      <div class="image">
        <a href="detail.html"><img  src="<?= base_url(); ?>assets/images/products/p2.jpg" alt=""></a>
      </div><!-- /.image -->      

                  <div class="tag sale"><span>sale</span></div>                  
    </div><!-- /.product-image -->
      
    
    <div class="product-info text-left">
      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
      <div class="rating rateit-small"></div>
      <div class="description"></div>

      <div class="product-price"> 
        <span class="price">
          $650.99       </span>
                         <span class="price-before-discount">$ 800</span>
                  
      </div><!-- /.product-price -->
      
    </div><!-- /.product-info -->
          <div class="cart clearfix animate-effect">
        <div class="action">
          <ul class="list-unstyled">
            <li class="add-cart-button btn-group">
              <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                <i class="fa fa-shopping-cart"></i>                         
              </button>
              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          
            </li>
                     
                    <li class="lnk wishlist">
              <a class="add-to-cart" href="detail.html" title="Wishlist">
                 <i class="icon fa fa-heart"></i>
              </a>
            </li>

            <li class="lnk">
              <a class="add-to-cart" href="detail.html" title="Compare">
                  <i class="fa fa-signal"></i>
              </a>
            </li>
          </ul>
        </div><!-- /.action -->
      </div><!-- /.cart -->
      </div><!-- /.product -->
      
      </div><!-- /.products -->
    </div><!-- /.item -->
  
    <div class="item item-carousel">
      <div class="products">
        
  <div class="product">   
    <div class="product-image">
      <div class="image">
        <a href="detail.html"><img  src="<?= base_url(); ?>assets/images/products/p3.jpg" alt=""></a>
      </div><!-- /.image -->      

                              <div class="tag hot"><span>hot</span></div>      
    </div><!-- /.product-image -->
      
    
    <div class="product-info text-left">
      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
      <div class="rating rateit-small"></div>
      <div class="description"></div>

      <div class="product-price"> 
        <span class="price">
          $650.99       </span>
                         <span class="price-before-discount">$ 800</span>
                  
      </div><!-- /.product-price -->
      
    </div><!-- /.product-info -->
          <div class="cart clearfix animate-effect">
        <div class="action">
          <ul class="list-unstyled">
            <li class="add-cart-button btn-group">
              <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                <i class="fa fa-shopping-cart"></i>                         
              </button>
              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          
            </li>
                     
                    <li class="lnk wishlist">
              <a class="add-to-cart" href="detail.html" title="Wishlist">
                 <i class="icon fa fa-heart"></i>
              </a>
            </li>

            <li class="lnk">
              <a class="add-to-cart" href="detail.html" title="Compare">
                  <i class="fa fa-signal"></i>
              </a>
            </li>
          </ul>
        </div><!-- /.action -->
      </div><!-- /.cart -->
      </div><!-- /.product -->
      
      </div><!-- /.products -->
    </div><!-- /.item -->
  
    <div class="item item-carousel">
      <div class="products">
        
  <div class="product">   
    <div class="product-image">
      <div class="image">
        <a href="detail.html"><img  src="<?= base_url(); ?>assets/images/products/p4.jpg" alt=""></a>
      </div><!-- /.image -->      

      <div class="tag new"><span>new</span></div>                              
    </div><!-- /.product-image -->
      
    
    <div class="product-info text-left">
      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
      <div class="rating rateit-small"></div>
      <div class="description"></div>

      <div class="product-price"> 
        <span class="price">
          $650.99       </span>
                         <span class="price-before-discount">$ 800</span>
                  
      </div><!-- /.product-price -->
      
    </div><!-- /.product-info -->
          <div class="cart clearfix animate-effect">
        <div class="action">
          <ul class="list-unstyled">
            <li class="add-cart-button btn-group">
              <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                <i class="fa fa-shopping-cart"></i>                         
              </button>
              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          
            </li>
                     
                    <li class="lnk wishlist">
              <a class="add-to-cart" href="detail.html" title="Wishlist">
                 <i class="icon fa fa-heart"></i>
              </a>
            </li>

            <li class="lnk">
              <a class="add-to-cart" href="detail.html" title="Compare">
                  <i class="fa fa-signal"></i>
              </a>
            </li>
          </ul>
        </div><!-- /.action -->
      </div><!-- /.cart -->
      </div><!-- /.product -->
      
      </div><!-- /.products -->
    </div><!-- /.item -->
  
    <div class="item item-carousel">
      <div class="products">
        
  <div class="product">   
    <div class="product-image">
      <div class="image">
        <a href="detail.html"><img  src="<?= base_url(); ?>assets/images/blank.gif" data-echo="<?= base_url(); ?>assets/images/products/p5.jpg" alt=""></a>
      </div><!-- /.image -->      

                              <div class="tag hot"><span>hot</span></div>      
    </div><!-- /.product-image -->
      
    
    <div class="product-info text-left">
      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
      <div class="rating rateit-small"></div>
      <div class="description"></div>

      <div class="product-price"> 
        <span class="price">
          $650.99       </span>
                         <span class="price-before-discount">$ 800</span>
                  
      </div><!-- /.product-price -->
      
    </div><!-- /.product-info -->
          <div class="cart clearfix animate-effect">
        <div class="action">
          <ul class="list-unstyled">
            <li class="add-cart-button btn-group">
              <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                <i class="fa fa-shopping-cart"></i>                         
              </button>
              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          
            </li>
                     
                    <li class="lnk wishlist">
              <a class="add-to-cart" href="detail.html" title="Wishlist">
                 <i class="icon fa fa-heart"></i>
              </a>
            </li>

            <li class="lnk">
              <a class="add-to-cart" href="detail.html" title="Compare">
                  <i class="fa fa-signal"></i>
              </a>
            </li>
          </ul>
        </div><!-- /.action -->
      </div><!-- /.cart -->
      </div><!-- /.product -->
      
      </div><!-- /.products -->
    </div><!-- /.item -->
  
    <div class="item item-carousel">
      <div class="products">
        
  <div class="product">   
    <div class="product-image">
      <div class="image">
        <a href="detail.html"><img  src="<?= base_url(); ?>assets/images/blank.gif" data-echo="<?= base_url(); ?>assets/images/products/p6.jpg" alt=""></a>
      </div><!-- /.image -->      

      <div class="tag new"><span>new</span></div>                              
    </div><!-- /.product-image -->
      
    
    <div class="product-info text-left">
      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
      <div class="rating rateit-small"></div>
      <div class="description"></div>

      <div class="product-price"> 
        <span class="price">
          $650.99       </span>
                         <span class="price-before-discount">$ 800</span>
                  
      </div><!-- /.product-price -->
      
    </div><!-- /.product-info -->
          <div class="cart clearfix animate-effect">
        <div class="action">
          <ul class="list-unstyled">
            <li class="add-cart-button btn-group">
              <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                <i class="fa fa-shopping-cart"></i>                         
              </button>
              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          
            </li>
                     
                    <li class="lnk wishlist">
              <a class="add-to-cart" href="detail.html" title="Wishlist">
                 <i class="icon fa fa-heart"></i>
              </a>
            </li>

            <li class="lnk">
              <a class="add-to-cart" href="detail.html" title="Compare">
                  <i class="fa fa-signal"></i>
              </a>
            </li>
          </ul>
        </div><!-- /.action -->
      </div><!-- /.cart -->
      </div><!-- /.product -->
      
      </div><!-- /.products -->
    </div><!-- /.item -->
      </div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
      
      </div>
      <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <?php include("inc/bottomMenu.php"); ?>
<div id="mob-view">
  <?php include("inc/footer.php"); ?>
</div>
<!-- ============================================================= FOOTER : END============================================================= --> 


<?php include("inc/detail_js.php"); ?>
<?php include("inc/searchjs.php"); ?>
</body>
</html>