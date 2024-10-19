<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('admin/homecontroller'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo ucfirst($this->session->userdata('user_type')); ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('admin/homecontroller'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Settings
            </div>
            <?php
		     $menu_open =  'hide'; 
		     if($this->router->fetch_class()=="profile"||
			 $this->router->fetch_class()=="company"||
			 $this->router->fetch_class()=="employee" ||
			 $this->router->fetch_class()=="customers"	||
			 $this->router->fetch_class()=="change_password" ||
			 $this->router->fetch_class()=="phone" ||
			 $this->router->fetch_class()=="users" ||
			 $this->router->fetch_class()=="customer_group"
			 )
			 {
				$menu_open =  'show'; 
			 }
		    ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseTwo" class="collapse <?=$menu_open?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Settings:</h6>
                        <a class="collapse-item" href="<?php echo site_url('admin/change_password/index'); ?>">- Change Password</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/profile/index'); ?>">- Profile</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/company/index'); ?>">- Company</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/users/index'); ?>">- Users</a>
                    </div>
                </div>
            </li>
             <?php
		     $menu_open =  'hide'; 
		     if(
			 $this->router->fetch_class()=="type" ||
			 $this->router->fetch_class()=="gender" ||
			 $this->router->fetch_class()=="breed" ||
			 $this->router->fetch_class()=="production_type"
			 )
			 {
				$menu_open =  'show'; 
			 }
		    ?>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse  <?=$menu_open?>" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                         <a class="collapse-item" href="<?php echo site_url('admin/type/index'); ?>">- Type</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/gender/index'); ?>">- Gender</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/breed/index'); ?>">- Breed</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/production_type/index'); ?>">- Production type</a>
                    </div>
                </div>
            </li>
            
             <?php
		     $menu_open =  'hide'; 
		     if($this->router->fetch_class()=="animal"||
			 $this->router->fetch_class()=="events" ||
			 $this->router->fetch_class()=="production" ||
			 $this->router->fetch_class()=="transactions" ||	
			 $this->router->fetch_class()=="ad"	
			 )
			 {
				$menu_open =  'show'; 
			 }
		    ?>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubscription"
                    aria-expanded="true" aria-controls="collapseSubscription">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Animal & Report</span>
                </a>
                <div id="collapseSubscription" class="collapse  <?=$menu_open?>" aria-labelledby="headingSubscription"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom subscription:</h6>
                        <a class="collapse-item" href="<?php echo site_url('admin/animal/index'); ?>">- Animal</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/events/index'); ?>">- Events</a>
                        <a class="collapse-item" href="<?php echo site_url('admin/production/index'); ?>">- Production</a>
						<a class="collapse-item" href="<?php echo site_url('admin/transactions/index'); ?>">- Transactions</a>
						<a class="collapse-item" href="<?php echo site_url('admin/ad/index'); ?>">- Ad</a>
 
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>