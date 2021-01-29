		<?php
	$logedas = $this->session->userdata("UserAdmin");
	$this->db->where("admin_user",$logedas);
	$lgs = $this->db->get("admin")->row();
	$loggedAs = $lgs->login_type;
?>
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll ">
			<div class="main-sidebar-header">
				<a class=" desktop-logo logo-light" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>admin_assets/img/brand/easeshop_white2.png" class="main-logo" alt="logo"></a>
				<a class=" desktop-logo logo-dark" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>admin_assets/img/brand/easeshop_white2.png" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>admin_assets/img/brand/favicon.png" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>admin_assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidebar-body circle-animation "> 

				<ul class="side-menu circle">
					<li><h3 class="">Dashboard</h3></li>
					<li class="slide">
						<a class="side-menu__item" href="<?= base_url(); ?>/admin_panel/"><i class="side-menu__icon ti-desktop"></i><span class="side-menu__label">Dashboard</span></a>
					</li>
					<?php if($loggedAs=="admin"): ?>
					<li><h3>Category & Products</h3></li>
					
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-layers  menu-icons"></i><span class="side-menu__label">Category</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/AddCategory'); ?>">Add Category</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/Brands'); ?>">Brands/Sub-category</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/AllCategory'); ?>">View All Category</a></li>
							
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-briefcase"></i><span class="side-menu__label">Products</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/AddProducts'); ?>">Add New Products</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/AllProducts'); ?>">View All Products</a></li>
							
						</ul>
					</li>
					<?php endif; ?>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/SliderBanner'); ?>"><i class="side-menu__icon ti-help-alt menu-icon"></i><span class="side-menu__label">Slider Banner</span></a>
						
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-help-alt menu-icon"></i><span class="side-menu__label">Orders</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/Orders/NewOrders/Pending'); ?>">New Orders</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/Orders/NewOrders/Processing'); ?>">Order Processing</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/Orders/NewOrders/Packed'); ?>">Order Packed</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/Orders/NewOrders/Despatched'); ?>">Order Despatched</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/Orders/NewOrders/Delivered'); ?>">Order Delivered</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/Orders/NewOrders/Cancel'); ?>">Order Cancelled</a></li>
						</ul>
					</li>
					<?php if($loggedAs=="admin"): ?>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/Return-Requests'); ?>"><i class="side-menu__icon ti-help-alt menu-icon"></i><span class="side-menu__label">Return Requests</span></a>
						
					</li>
					

					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-bell menu-icon"></i><span class="side-menu__label">Notifications</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/Send-Offer-Notification'); ?>">Send Offer Notification</a></li>
							
							
						</ul>
					</li>

					

					
					<li><h3>Users Management</h3></li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-user menu-icon"></i><span class="side-menu__label">Users Profile</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/AllUsers'); ?>">All Users</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/PremiumUsers'); ?>"><i class="fas fa-crown"></i> <?= nbs(3); ?>Premium Users</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/AddDelivaryBoys'); ?>">Register Delivary Boys</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/AllDelivaryBoys'); ?>">All Delivary Boys</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/Staff'); ?>">Staff</a></li>

						</ul>
					</li>
					
					<li><h3>Settings</h3></li>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/OtherSettings'); ?>"><i class="side-menu__icon fas fa-cog fa-spin menu-icon"></i><span class="side-menu__label">Other Settings</span></a>
					</li>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/ShippingZone'); ?>"><i class="side-menu__icon fas fa-map-marker  menu-icon"></i><span class="side-menu__label">Shipping Zone</span></a>
					</li>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/ChangePassword'); ?>"><i class="side-menu__icon ti-key menu-icon"></i><span class="side-menu__label">Change Password</span></a>
					</li>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/MembershipPlans'); ?>"><i class="side-menu__icon ti-id-badge menu-icon"></i><span class="side-menu__label">Membership Plans</span></a>
					</li>
				<?php endif; ?>
			
					<?= br(5); ?>
					
				</ul>
			</div>
		</aside>