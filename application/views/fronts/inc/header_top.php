
<div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            <?php if($this->session->userdata("userId")): ?>
            <li><a href="<?= base_url('My-Account'); ?>"><i class="icon fa fa-user"></i>My Account</a></li>
            <li><a href="#"><i class="icon fa fa-heart"></i>Wishlist</a></li>
            <li><a href="<?= base_url('My-Cart'); ?>"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
            
              <li><a href="<?= base_url("Logout"); ?>"><i class="icon fa fa-lock"></i>Logout</a></li>
            <?php else: ?>
              <li><a href="<?= base_url("Login"); ?>"><i class="icon fa fa-lock"></i>Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
        <!-- /.cnt-account -->
        
        
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
