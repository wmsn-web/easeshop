<div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
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
                                  <ul class="links">
                                    <?php if(!empty($menu["subData"])): ?>
                                      <?php foreach($menu["subData"] as $submenu): ?>
                                        <li><a href="<?= base_url($submenu['links']); ?>"><?= $submenu["subCat"]; ?></a></li>
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
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
    
  </div>