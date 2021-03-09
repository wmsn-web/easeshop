<?php
  $user_id = $this->session->userdata("userId");
  $getCart = $this->ThemeModel->getCart($user_id);
  //print_r($getCart);
  
?>
<div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="<?= base_url(); ?>"> <img src="<?= base_url(); ?>assets/images/smallLogo.png" alt="logo"> </a> </div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form action="<?= base_url('Search/posts'); ?>" method="post">
              <div class="control-group">
                <input name="keys" class="search-field" id="keywords" placeholder="Search here..." autocomplete="off" />
                <button class="search-button" ></button> </div>
                
            </form>
          </div>
          <div id="results">
            <ul id="resContent"></ul>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          
          <div class="dropdown dropdown-cart"> <a href="<?= base_url("My-Cart"); ?>" class="lnk-cart">
            <div class="items-cart-inner">
              <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
              <div class="basket-item-count"><span class="count"><?= $getCart['numCart']; ?></span></div>
              <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign">&#8377;</span><span class="value"><?= number_format($getCart['totAmt'],2); ?></span> </span> </div>
            </div>
            </a>
            
            <!-- /.dropdown-menu--> 
          </div>
          <!-- /.dropdown-cart --> 
          
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>