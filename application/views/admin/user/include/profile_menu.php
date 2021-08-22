<ul class="nav nav-tabs admin mb-4">
  <li><a class="<?php if(isset($page_title) && $page_title == 'Personal Information'){echo "active";} ?>" href="<?php echo base_url('admin/profile') ?>"><i class="fa fa-cog"></i> <span class="hidden-xs"><?php echo trans('general-settings') ?></span> 	</a></li>
  
  <li><a class="<?php if(isset($page_title) && $page_title == 'Change Password'){echo "active";} ?>" href="<?php echo base_url('admin/profile/change_password') ?>"><i class="fa fa-lock"></i> <span class="hidden-xs"><?php echo trans('change-password') ?></span></a></li>
  
  <?php if (auth('role') == 'user' || auth('role') == 'subadmin'): ?>
	  <li><a class="<?php if(isset($page_title) && $page_title == 'Business' || $page == 'Business'){echo "active";} ?>" href="<?php echo base_url('admin/business') ?>"><i class="fa fa-briefcase"></i> <span class="hidden-xs"><?php echo trans('business') ?></span></a></li>

	  <li><a class="<?php if(isset($page_title) && $page_title == 'Invoice Customization'){echo "active";} ?>" href="<?php echo base_url('admin/business/invoice_customize') ?>"><i class="fa fa-paint-brush"></i> <span class="hidden-xs"><?php echo trans('invoice-customization') ?></span></a></li>

	  <li><a class="<?php if(isset($page_title) && $page_title == 'Role Permissions'){echo "active";} ?>" href="<?php echo base_url('admin/role_management/permissions') ?>"><i class="fa fa-check-circle"></i> <span class="hidden-xs"><?php echo trans('role-permissions') ?></span></a></li>

	  <li><a class="<?php if(isset($page_title) && $page_title == 'Role Management'){echo "active";} ?>" href="<?php echo base_url('admin/role_management') ?>"><i class="fa fa-users"></i> <span class="hidden-xs"><?php echo trans('role-management') ?></span></a></li>
  <?php endif; ?>

</ul>