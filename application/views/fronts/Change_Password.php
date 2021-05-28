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
<title>easeshop-MyAccount</title>
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
                       <li><a href="<?= base_url('My-wishlist'); ?>">My Wishlist</a></li>
                       <li><a href="<?= base_url('My-wallet'); ?>">My wallet</a></li>
                      <li><a class="active" href="<?= base_url('Change-Password'); ?>">Change Password</a></li>
                      <li><a href="<?= base_url('Logout'); ?>">Logout</a></li>
                    </ul>
                  </div>
              </div>
            </div>
          </div>
          <div class="cardDiv2">
            <div class="card">
              <div class="card-title">
                <h4>My Orders</h4>
              </div>
                <div class="card-body">
                  <form id="chpasForm" action="<?= base_url('Change-Password/Chpass'); ?>" method="post">
                    <?php if($feed = $this->session->flashdata("Feed")): ?>
                      <h5 class="text-danger"><?= $feed; ?></h5>
                    <?php endif; ?>
                    <div class="form-group">
                      <label>Old Password <?= nbs(8); ?> <span id="olp" class="fa"></span></label>
                      <input type="password" name="oldPass" id="oldPass" class="form-control unicase-form-control text-input">
                    </div>
                    <div class="form-group">
                      <label>New Password <?= nbs(8); ?> <span id="np" class="fa"></span></label>
                      <input type="password" name="newPass" id="newPass" class="form-control unicase-form-control text-input">
                    </div>
                    <div class="form-group">
                      <label>Confirm New Password <?= nbs(8); ?> <span id="cnp" class="fa"></span></label><?= nbs(8); ?>
                      <small class="text-danger" id="msg"></small>
                      <input type="password" name="conPass" id="conPass" class="form-control unicase-form-control text-input">
                      <input type="hidden" name="userid" id="userid" value="<?= $this->session->userdata('userId'); ?>">
                    </div>
                    <div class="form-group">
                      <button type="button" id="chPass" class="btn btn-primary">Change Password</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("inc/bottomMenu.php"); ?>
<div id="mob-view">
  <?php include("inc/footer.php"); ?>
</div>

<?php include("inc/js.php"); ?>
<?php include("inc/searchjs.php"); ?>
<script type="text/javascript">
  $("#chPass").click(function(){
    var oldPass = $("#oldPass").val();
    var newPass = $("#newPass").val();
    var conPass = $("#conPass").val();
    var userid = $("#userid").val();
    if(oldPass == "" ){$("#olp").addClass("fa-times text-danger")}
    else if(newPass == "" ){$("#np").addClass("fa-times text-danger"); $("#olp").addClass("fa-check text-success").removeClass("fa-times text-danger") }
  else if(conPass == "" ){$("#cnp").addClass("fa-times text-danger"); $("#np").addClass("fa-check text-success").removeClass("fa-times text-danger")}
  else
  {
    //$("#cnp").addClass("fa-check text-success").removeClass("fa-times text-danger");
    if(newPass == conPass)
    {
      $("#cnp").addClass("fa-check text-success").removeClass("fa-times text-danger");
      $("#olp").addClass("fa-check text-success").removeClass("fa-times text-danger");
      $("#np").addClass("fa-check text-success").removeClass("fa-times text-danger");
      $("#msg").html("");
      $("#chpasForm").submit();
    }
    else
    {
      $("#cnp").addClass("fa-times text-danger").removeClass("fa-check text-success");
      $("#msg").html("Password Does not match!");
      return false;
    }
  }
  })
</script>
</body>

</html>