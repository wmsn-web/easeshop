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
<?php include("inc/detail_layout.php"); ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/rating/themes/fontawesome-stars.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/rating/themes/css-stars.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/rating/themes/bootstrap-stars.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/rating/themes/fontawesome-stars-o.css">
<link rel="stylesheet"  type='text/css' href="<?= base_url('assets/css/customnewxfinal.css'); ?>">
<style type="text/css">
  @media only screen and (max-width: 991px) 
{
  #mob-view
  {
    display: none !important;
  }
}
.rt{letter-spacing: 3px}
</style>
</head>
<body>
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
  <div style="width: 100%; background: #f1f3f6; height: 75px"></div>
</header>

<!-- ============================================== HEADER : END ============================================== --> 

<!-- ============================================== HEADER : END ============================================== -->
  <div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="#">Home</a></li>
          <li><a href="#">Product</a></li>
          <li class='active'><?= $proData['prod_name'] ?></li>
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
                    <h3 class="name"><?= $proData['prod_name']; ?></h3>
                    
                    <div class="rating-reviews m-t-20">
                      <div class="row">
                        <div class="col-sm-3">
                          <?php
                          $remn1 = 5 - $proData['revs'];
                          for ($i=0; $i < $proData['revs'] ; $i++) { 
                            echo '<i class="fa fa-star rt star-orange"></i>';
                          }
                          for ($i=0; $i < $remn1 ; $i++) { 
                            echo '<i class="fa fa-star-o rt star-grey"></i>';
                          }
                           ?>
                           <span class="badge badge-success"><?= $proData['cashback']; ?></span>
                        </div>
                        <div class="col-sm-8">
                          <div class="reviews">
                            <a href="#" class="lnk">(<?= $proData['totRev']; ?> Reviews)</a>
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
                            <?php if($proData['upcoming']=="0"): ?>
                              <span class="value"><?= $proData['stock']; ?></span>
                            <span class="badge badge-danger"><?= round($proData['discount']); ?>% Off</span>
                              <?php else: ?>
                                <span class="value">Upcoming</span>
                            
                              <?php endif; ?>
                            
                          </div>  
                        </div>
                      </div><!-- /.row -->  
                    </div><!-- /.stock-container -->

                    <div class="description-container m-t-20">
                      <?= $proData['descr']; ?>
                    </div><!-- /.description-container -->

                    <div class="price-container info-container m-t-20">
                      <div class="row">
                        
                        <?php if($proData['upcoming']=="0"): ?>
                          <div class="col-sm-6">
                            <div class="price-box">
                              <span class="price">&#8377; <span id="slprc"><?= round($proData['sale_price']); ?></span></span>
                              <?php if(!$proData['discount']=="0"): ?>
                                <span class="price-strike">&#8377; <?= round($proData['price']); ?></span>
                              <?php endif; ?>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="favorite-button m-t-10">
                              <?php if(!$this->session->userdata('userId')): ?>
                                <a class="btn btn-primary wishbtn" data-toggle="tooltip" data-placement="right" title="Wishlist" href="<?= base_url('Login'); ?> ">
                                  <i class="fa fa-heart"></i>
                              </a>
                              <?php else: ?>
                                <a class="btn btn-primary wishbtn" data-toggle="tooltip" data-placement="right" title="Wishlist" href="<?= base_url('My_wishlist/AddWish/'.$proData['pro_id'].'/'.$this->session->userdata('userId')); ?> ">
                                  <i class="fa fa-heart"></i>
                              </a>
                              <?php endif; ?>
                            </div>
                          </div>
                          <?php elseif($proData['stock']=="Out Of Stock"): ?>
                            <div class="col-sm-12">
                              <h5 class="text-warning">Available Soon</h5>
                              <form action="<?= base_url('Product_details/notifyme'); ?>" method="post">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <input type="text" name="notEmail" class="form-control" placeholder="emanple@example.com" >
                                    <input type="hidden" name="proId" value="<?= $this->uri->segment(3); ?>">
                                  </div>
                                  <div class="col-sm-6">
                                    <button class="btn btns-warn">Notify Me</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          <?php endif; ?>

                      </div><!-- /.row -->
                    </div><!-- /.price-container -->
                    <?php if($proData['upcoming']=="1"){$stl = "style='display:none'"; }else{$stl = "style='display:block'";} ?>
                    <div <?= $stl; ?>>
                    <div class="quantity-container info-container">
                      
                      <form action="<?= base_url('Product_details/addToCart'); ?>" method="post">
                      <div class="row">
                        <div class="col-sm-4">
                          
                          <?php if(!empty($proData['varData'])): ?>
                                <select name="varnm" class="form-control" id="varss">  
                                <?php $vrr = 1; foreach($proData['varData'] as $vars): $vr = $vrr++; ?>
                                <option value="<?= $vars['varId'].'_'.$vars['sale_price'].'_'.$vars['varName']; ?>"><?= $vars['varName']; ?></option>
                                 <?= nbs(5); ?>
                            <?php endforeach; ?>
                            </select>
                          <?php endif; ?>
                          
                          
                        </div>
                        <div class="col-sm-4">
                          <div class="row">
                            <div class="col-sm-6">
                              <span class="label">Qty :</span>
                            </div>
                            
                            <div class="col-sm-6">
                              <div class="cart-quantity">
                                <div class="quant-input">
                                      <input type="number" name="qty" id="qty" value="1">
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <?php if($proData['stock']=="Out Of Stock"): ?>
                              <h5 class="text-danger">Product is Out Of Stock</h5>
                            <?php else: ?>
                          <input type="hidden" name="sale_price" id="slprcFixed" value="<?= $proData['sale_price']; ?>">
                            <input type="hidden" name="price" id="nowPrc" value="<?= $proData['sale_price']; ?>">
                            <input type="hidden" name="proId" value="<?= $proData['pro_id']; ?>">
                            <input type="hidden" name="pro_type" value="<?= $proData['pro_type']; ?>">
                            <input type="hidden" name="cat_id" value="<?= $proData['cat_id']; ?>">
                            <input type="hidden" name="user_id" value="<?= $this->session->userdata('userId'); ?>">
                          <?php if(!$this->session->userdata("userId")): ?>
                            <a href="<?= base_url('Login'); ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                             
                          <?php else: ?>
                            
                            
                            <button class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                          <?php endif; ?>
                          <?php endif; ?>
                        </div>
                     
                        <div class="clearfix"></div>
                        
                        
                      </div><!-- /.row -->
                    </form>
                   
                    </div><!-- /.quantity-container -->
                  </div>
                    
 
                    

                    
                  </div><!-- /.product-info -->

                </div><!-- /.col-sm-7 -->
              </div><!-- /.row -->
              <?php if(!empty($proData['cashback'])): ?>
                <h5>Cashback Offers</h5>
                <span class="badge badge-success"><?= $proData['cashback']; ?></span> On 
                <?= $proData['offeron']; ?>
                <div class="row">
                  <?php if(!empty($proData['bnkDataDr'])): ?>
                    <div class="col-md-6">
                      <h5><b>Banks allow for debit card</b></h5>
                      <p>
                      <?php foreach($proData['bnkDataDr'] as $drbnk): ?>
                        <i class="fa fa-check-circle text-success"></i> <?= $drbnk['bank_name'].br(); ?>
                      <?php endforeach; ?>
                    </p>
                    </div>
                  <?php endif; ?>
                  <?php if(!empty($proData['bnkDataCr'])): ?>
                    <div class="col-md-6">
                      <h5><b>Banks allow for credit card</b></h5>
                      <p>
                      <?php foreach($proData['bnkDataCr'] as $crbnk): ?>
                        <i class="fa fa-check-circle text-success"></i> <?= $crbnk['bank_name'].br(); ?>
                      <?php endforeach; ?>
                    </p>
                    </div>
                  <?php endif; ?>
                </div>
                
                
              <?php endif; ?>
               
                </div>
        
        <div class="product-tabs inner-bottom-xs  wow fadeInUp">
          <div class="row">
            <div class="col-sm-3">
              <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                <li class="active"><a data-toggle="tab" href="#review">REVIEW</a></li>
                <li><a data-toggle="tab" href="#tags">FAQ</a></li>
              </ul><!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-9">

              <div class="tab-content">
                
                <!-- /.tab-pane -->

                <div id="review" class="tab-pane in active">
                  <div class="product-tab">
                                        
                    
                    

                    <?php if($this->session->userdata('userId')):
                    $user_id =  $this->session->userdata('userId');
                    $proId =  $this->uri->segment(3);
                      $chkPostRview = $this->ThemeModel->chkPostRview($user_id,$proId);
                      if($chkPostRview == "notExst"): 
                       ?>

                    <div class="product-add-review">

                      <h4 class="title">Write your own review</h4>

                        <form action="<?= base_url('My-Account/AddReviews'); ?> " method="post" role="form" class="">
                        <div class="rating-stars block" id="rating" name="rating">
                          <input type="hidden"   readonly="readonly" class="rating-value" name="stars" id="rating-stars-value" value="1">
                          <input type="hidden" id="proId" name="proId" value="<?= $this->uri->segment(3); ?>">
                          <input type="hidden" name="user_id" value="<?= $this->session->userdata('userId'); ?>">
                          <div class="rating-stars-container">
                              <div class="rating-star">
                                  <i class="fa fa-star"></i>
                              </div>
                              <div class="rating-star">
                                  <i class="fa fa-star"></i>
                              </div>
                              <div class="rating-star">
                                  <i class="fa fa-star"></i>
                              </div>
                              <div class="rating-star">
                                  <i class="fa fa-star"></i>
                              </div>
                              <div class="rating-star">
                                  <i class="fa fa-star"></i>
                              </div>
                          </div>
                      </div><!-- /.table-responsive -->
                      <div class="review-form">
                        <div class="form-container">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                  <textarea name="review" class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="Write your own review" required></textarea>
                                </div><!-- /.form-group -->
                              </div>
                            </div><!-- /.row -->
                            
                            <div class="action text-right">
                              <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                            </div><!-- /.action -->

                         
                        </div><!-- /.form-container -->
                      </div><!-- /.review-form -->
                    </form>
                    </div><!-- /.product-add-review -->  
                    <?php endif; ?> 
                    <?php endif; ?>                 
                    <div class="product-reviews">
                      <h4 class="title">Customer Reviews</h4>

                      <div class="reviews">
                        <?php if(!empty($allReviews)): ?>
                          <?php foreach($allReviews as $rev): ?>
                            <div class="review">
                              <div class="review-title"><span class="summary"><?= $rev['name']; ?></span><span class="date"><i class="fa fa-calendar"></i><span><?= $rev['date']; ?></span></span></div>
                              <?php
                              $greyStar = 5-$rev['rates']; 
                                for ($i=0; $i < $rev['rates']; $i++) { 
                                  echo '<i class="fa fa-star rt star-orange"></i>'.nbs(1);
                                }
                                for ($i=0; $i < $greyStar; $i++) { 
                                  echo '<i class="fa fa-star rt star-grey"></i>'.nbs(1);
                                }
                              ?>
                              
                              <div class="text"><?= $rev['review']; ?></div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      
                      </div><!-- /.reviews -->
                    </div><!-- /.product-reviews -->
                      </div><!-- /.product-tab -->
                </div><!-- /.tab-pane -->

                <div id="tags" class="tab-pane">
                  <div class="product-tag">
                    
                    <h4 class="title">FAQ</h4>
                    <?php if(!empty($faqData)): ?>
                      <?php foreach($faqData as $faq): ?>
                        <div class="fq">
                          <span class="qs"><?= $faq['qstn']; ?></span>
                          <span class="ans"> <?= $faq['ans']; ?></span>
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    

                  </div><!-- /.product-tab -->
                </div><!-- /.tab-pane -->

              </div><!-- /.tab-content -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.product-tabs -->

        <!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
  <?php if(!empty($proData['relProData'])): ?>
  <h3 class="section-title">Related products</h3>
  <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
    <?php foreach($proData['relProData'] as $relPro): ?>    
    <div class="item item-carousel">
      <div class="products">
        
  <div class="product">   
    <div class="product-image">
      <div class="image">
        <a href="<?= base_url('Product_details/index/'.$relPro['pro_id']); ?>"><img  src="<?= base_url('uploads/products/'.$relPro['mnImg']); ?>" alt=""></a>
      </div><!-- /.image -->      

                         
    </div><!-- /.product-image -->

      
    
    <div class="product-info text-left">
      <h3 class="name"><a href="<?= base_url('Product_details/index/'.$relPro['pro_id']); ?>"><?= $relPro['prod_name']; ?></a></h3>
      <?php
        $remn1 = 5 - $relPro['revs'];
        for ($i=0; $i < $relPro['revs'] ; $i++) { 
          echo '<i class="fa fa-star rt star-orange"></i>';
        }
        for ($i=0; $i < $remn1 ; $i++) { 
          echo '<i class="fa fa-star-o rt star-grey"></i>';
        }
         ?>
      <div class="description"><span class="badge badge-danger"><?= round($relPro['discount']); ?>% Off</span></div>

      <div class="product-price"> 
        <span class="price">
          &#8377; <?= $relPro['sale_price']; ?>      </span>
                         <span class="price-before-discount">&#8377; <?= $relPro['price']; ?></span>
                  
      </div><!-- /.product-price -->
      
    </div><!-- /.product-info -->
          <div class="cart clearfix animate-effect">
        <div class="action">
          <ul class="list-unstyled">
            <li class="add-cart-button btn-group">
              <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                <a href="<?= base_url('Product_details/index/'.$relPro['pro_id']); ?>">
                <i class="fa fa-shopping-cart"></i> </a>                        
              </button>
              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          
            </li>
                     
                    <li class="lnk wishlist">
              <a class="add-to-cart" href="<?= base_url('Product_details/index/'.$relPro['pro_id']); ?>" title="">
                 <i class="icon fa fa-heart"></i>
              </a>
            </li>

            <li class="lnk">
              <a class="add-to-cart" href="<?= base_url('Product_details/index/'.$relPro['pro_id']); ?>" title="">
                  <i class="fa fa-signal"></i>
              </a>
            </li>
          </ul>
        </div><!-- /.action -->
      </div><!-- /.cart -->
      </div><!-- /.product -->
      
      </div><!-- /.products -->
    </div><!-- /.item -->
  <?php endforeach; ?>
  
      </div><!-- /.home-owl-carousel -->
    <?php endif; ?>
</section><!-- /.section -->
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
      
      </div>
      <div class='col-md-3 sidebar'> 
        <!-- ================================== TOP NAVIGATION ================================== -->
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
                              <div class="image"> <a href="<?= base_url('Product_details/index/'.$spl['pro_id']); ?>"> <img src="<?= base_url('uploads/products/'.$spl['mnImg']); ?>" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="<?= base_url('Product_details/index/'.$spl['pro_id']); ?>"><?= $spl['prod_name']; ?></a></h3>
                              <?php
                                $remn1 = 5 - $spl['revs'];
                                for ($i=0; $i < $spl['revs'] ; $i++) { 
                                  echo '<i class="fa fa-star rt star-orange"></i>';
                                }
                                for ($i=0; $i < $remn1 ; $i++) { 
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
          <div class="home-banner"> <img src="<?= base_url(); ?>assets/images/banners/LHS-banner22.jpg" alt="Image"> </div>
          <?= br(3); ?>
          <p>&nbsp;</p>
          <!-- /.sidebar-module-container --> 
        </div>
        <div style="width: 100%; height: 100px"></div>
      <div class="clearfix"></div>
      </div>
    </div>
  </div>
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


<?php include("inc/detail_js.php"); ?>
<?php include("inc/searchjs.php"); ?>
<script src="<?= base_url(); ?>assets/plugins/rating/jquery.rating-stars.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/rating/jquery.barrating.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/rating/ratings.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var ratingOptions = {
        selectors: {
            starsSelector: '.rating-stars',
            starSelector: '.rating-star',
            starActiveClass: 'is--active',
            starHoverClass: 'is--hover',
            starNoHoverClass: 'is--no-hover',
            targetFormElementSelector: '.rating-value'
        }
    };
    $(".rating-stars").ratingStars(ratingOptions);
    $(".toastMsg").fadeOut(6000);
    <?php if(!empty($proData['varData'])): ?>
      var varss = $("#varss").val();
      var spl = varss.split("_");
      var salPrc = spl[1];
      $("#slprc").html(salPrc);
      $("#slprcFixed").val(salPrc);
      $("#nowPrc").val(salPrc);
    <?php endif; ?>

    $("#qty").change(function(){
      var price = $("#slprcFixed").val();
      var qty = $("#qty").val();
      if(qty > 0)
       { 
        var nowSalePrc = parseInt(price*qty);
        //var slprc = nowSalePrc.toFixed(2);
        var slprc = nowSalePrc;
        //$("#slprc").html(slprc);
        $("#nowPrc").val(slprc);
        //alert();
      }
      else
      {
        $("#qty").val("1");
        return false;
      }
    });
    $("#varss").change(function(){
      var varss = $("#varss").val();
      var spl = varss.split("_");
      var salPrc = spl[1];
    $("#slprc").html(salPrc);
    $("#slprcFixed").val(salPrc);
      var qty = $("#qty").val();
      if(qty > 0)
       { 
        var nowSalePrc = salPrc*qty;
        //var slprc = nowSalePrc.toFixed(2);
        var slprc = nowSalePrc;
        $("#slprc").html(slprc);
        $("#nowPrc").val(slprc);
        //alert();
      }
      else
      {
        $("#qty").val("1");
        return false;
      }
    })
  })
</script>
</body>
</html>