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
<title>Easeshop-MyAccount</title>
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
<div class="body-content outer-top-vs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row justify-content-center">
          <div class="col-md3">
            <div class="deskSide">
              <div class="card">
                <div class="card-title">
                  <h4>My Account</h4>
                </div>
                  <div class="card-body">
                    <ul  class="deskSidemenu">
                      <li><a href="<?= base_url('My-Account'); ?>">My Account</a></li>
                      <li><a href="<?= base_url('My-Orders'); ?>">My Orders</a></li>
                       <li><a class="active" href="<?= base_url('My-wishlist'); ?>">My Wishlist</a></li>
                      <li><a href="<?= base_url('Change-Password'); ?>">Change Password</a></li>
                      <li><a href="<?= base_url('Logout'); ?>">Logout</a></li>
                    </ul>
                  </div>
              </div>
            </div>
          </div>
          <div class="cardDiv2">
            <div class="card">
              <div class="card-title">
                <h4>My Wishlist</h4>
              </div>
                <div class="card-body">
                  <?php if (!empty($mywish)): ?>
                    <?php foreach($mywish as $wishPro): ?>
                  <div class="row">
                    <div class="cols2-2">
                      <div align="center">
                        <a onclick="location.href='<?= base_url('My-wishlist/delWish/'.$wishPro['id']); ?>'" href="#">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                    </div>
                    <div class="colss-10">
                      <div class="proDetails">
                        <div class="row">
                          <div class="cols2-2">
                            <img src="<?= base_url('uploads/products/'.$wishPro['proData']['mnImg']); ?>" width="60" alt="proImg" /></div>
                          
                          <div class="cols2-10">
                            <div class="product-info">
                              <h5 class="name"><a href="<?= base_url('Product_details/index/'.$wishPro['proData']['pro_id']); ?>"><?= $wishPro['proData']['prod_name']; ?></a></h5>
                              <div class="rating rateit-small"></div>
                              <div class="description"><span class="badge badge-danger"><?= $wishPro['proData']['discount']; ?>% Off</span></div>

                              <div class="product-price"> 
                                <span class="price">
                                  &#8377; <?= $wishPro['proData']['sale_price']; ?>      </span>
                                                 <span class="price-before-discount"><del>&#8377; <?= $wishPro['proData']['price']; ?></del></span>
                                          
                              </div><!-- /.product-price -->
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <h5 class="text-danger">Wishlist is empty!</h5>
                  <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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

<?php include("inc/js.php"); ?>
<?php include("inc/searchjs.php"); ?>
<script type="text/javascript">
  $(".toastMsg").fadeOut(6000);
</script>
</body>

</html>