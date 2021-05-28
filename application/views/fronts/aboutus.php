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
<title>easeshop - About us</title>
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
</style>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 
  <style type="text/css">
    .card{
      margin-top: 5px;
      margin-bottom: 20px;
    }
    .card .card-header{
      padding: 8px;
      width: 100%;
      background: #0078FF;
      color: #FFFFFF;
      font-weight: bold;
    }
    .card .card-body{
      padding: 15px;
      width: 100%;
    }
  </style>
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
        <div class="card">
          <div class="card-header">
            <h4>About Us:</h4>
          </div>
          <div class="card-body">
            <p>We are online seller of Mobile and Electronics goods. We have started our business from Dec 2020. Our firm is a partnership registered firm. Initially we have started our online business with Branded Smart phones. But we have plan to include other item(s) also. We are trying to sale products with best price to our customer.  Customer will purchase items from our official website-https://easeshop.in only. Order will not be accepted via offline or phone call. Before purchasing product as a customer need to register himself/herself in our website. We are accepting all online payment methods like Net Banking, Debit card, Credit card and Virtual Payment.</p>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Mission:</h4>
          </div>
          <div class="card-body">
            <p>Our Mission is to sale products with best price with free delivery. We are taking order via our official website-https://easeshop.in only. Before purchasing/ordering product, as a customer need to register himself/herself in our website. We are accepting all online payment methods like Net Banking, Debit card, Credit card and Virtual Payment. Also we are taking customer’s feedback after purchasing product(s) from us.</p>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Vison:</h4>
          </div>
          <div class="card-body">
            <p>We have plan to grow our business via online only and we will introduce other products in our website. Also we will add seller who can sale their product with us using our ecommerce Platform.</p>
          </div>
        </div>
        <div style="height: 100px;"></div>
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