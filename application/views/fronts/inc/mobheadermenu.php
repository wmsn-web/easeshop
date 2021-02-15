<div class="mob-nav">
	<div class="container">
		<div class="row">
			<div class="cols-2">
				<i id="barIcon" onclick="hideSidemenu()" class="fa fa-bars" aria-hidden="true"></i>
			</div>
			<div class="cols-10">
				<div class="logo"> <a href="home.html"> <img src="<?= base_url(); ?>assets/images/easeshop_white2.png" alt="logo"> </a> </div>
			</div>
		</div>
	</div>
</div>
<div id="sideMenus" class="tabmenu">
	<div class="prof">
		<div class="circle">
			<i class="fa fa-user"></i>
		</div>
		<?php if($this->session->userdata("userId")): ?>
			<h5>Sanjay Natta</h5>
			<span><a href="#">Edit Shipping Addtess</a></span><br>
			<span><a href="<?= base_url('Logout'); ?>" style="color: #f00"><b>Logout</b></a></span>
		<?php else: ?>
			<h5><a href="<?= base_url('Login'); ?>" style="color: #f00"><b>Login</b></a></h5>
		<?php endif; ?>
	</div>
	<div class="tmenu">
		<div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active dropdown yamm-fw"> <a href="<?= base_url(); ?>"  class="dropdown-toggle">Home</a> </li>
                <?php if(!empty($menus)): ?>
                  <?php foreach($menus as $menu): ?>
                      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><?= $menu['catName']; ?></a>
                        <ul class="dropdown-menu pages">
                          <li>
                            <div class="yamm-content">
                              <div class="row">
                                <div class="col-xs-12 col-menu">
                                  <ul style="margin-left: 25px;" class="links">
                                    <?php if(!empty($menu["subData"])): ?>
                                      <?php foreach($menu["subData"] as $submenu): ?>
                                        <li style="padding: 4px 12px; font-size: 14px; "><a href="<?= base_url($submenu['links']); ?>"><?= $submenu["subCat"]; ?></a></li>
                                      <?php endforeach; ?>
                                    <?php endif; ?>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </li>
                  <?php endforeach; ?>
                <?php endif; ?>
                
               
                
                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
	</div>
</div>