<div class="footMenu">
  <ul class="btm">
    <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
    <li><a href="<?= base_url('My-cart'); ?>"><i class="fa fa-shopping-cart"></i></a></li>
    <li class="hasSub"><a href="#" onclick="showMyAc()"><i id="Myac" class="fa fa-user"></i></a>
    	<ul id="subBtmMenuId" class="subBtmMenu">
    		<li><a href="<?= base_url('My-Account'); ?>">My Account</a></li>
    		<li><a href="<?= base_url('My-Orders'); ?>">My Orders</a></li>
            <li><a href="<?= base_url('My-wishlist'); ?>">My Wishlist</a></li>
    		<li><a href="<?= base_url('Change-Password'); ?>">Change Password</a></li>
    		<li><a href="<?= base_url('Logout'); ?>">Logout</a></li>
    	</ul>
    </li>
    <li><a href="<?= base_url('My-wishlist'); ?>"><i class="fa fa-heart"></i></a></li>
  </ul>
</div>