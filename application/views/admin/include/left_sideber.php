  
  <?php if (isset($page_title) && $page_title != 'Online Payment'): ?>
  
  <aside class="main-sidebar">
    <section class="sidebar mt-10">
      
      <ul class="sidebar-menu" data-widget="tree">
  
        <?php if (is_admin()): ?>
          <li class="<?php if(isset($page_title) && $page_title == "Dashboard"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/dashboard') ?>">
              <i class="flaticon-home-2"></i> <span><?php echo trans('dashboard') ?></span>
            </a>
          </li>

          <li class="treeview <?php if(isset($main_page) && $main_page == "Settings"){echo "active";} ?>">
            <a href="#"><i class="flaticon-settings-1"></i>
              <span><?php echo trans('settings') ?></span>
              <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>

            <ul class="treeview-menu">
                <li class="<?php if(isset($page_title) && $page_title == "Settings"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/settings') ?>">
                    <i class="flaticon-layout"></i> <span><?php echo trans('website-settings') ?></span>
                  </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Appearance"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/settings/appearance') ?>">
                    <i class="flaticon-ui"></i> <span><?php echo trans('appearance') ?></span>
                  </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Preferences"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/settings/preferences') ?>">
                    <i class="flaticon-intelligent"></i> <span><?php echo trans('preferences') ?></span>
                  </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Payment Settings"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/payment') ?>">
                    <i class="flaticon-save-money"></i> <span><?php echo trans('payment-settings') ?></span>
                  </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Discounts"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/discount') ?>">
                    <i class="flaticon-tax"></i> <span><?php echo trans('discount') ?></span>
                  </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Categories"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/business/categories') ?>">
                    <i class="flaticon-menu-1"></i> <span><span><?php echo trans('business').' '.trans('categories') ?></span>
                  </a>
                </li>
            </ul>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Language"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/language') ?>" class="waves-effect"><i class="flaticon-accept"></i> <span><?php echo trans('testimonials') ?> <?php echo trans('language') ?> </span> </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Users"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/users') ?>">
              <i class="flaticon-group"></i> <span><span><?php echo trans('users') ?></span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Package"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/package') ?>">
              <i class="flaticon-box-1"></i> <span><?php echo trans('pricing-package') ?></span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Feature"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/feature') ?>">
              <i class="flaticon-feature"></i> <span><?php echo trans('features') ?></span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Pages"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/pages') ?>">
              <i class="flaticon-document"></i> <span><?php echo trans('pages') ?></span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Faqs"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/faq') ?>">
              <i class="flaticon-info"></i> <span><?php echo trans('faqs') ?></span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Testimonial"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/testimonial') ?>">
              <i class="flaticon-rating"></i> <span><?php echo trans('testimonial') ?></span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Contact"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/contact') ?>">
              <i class="flaticon-hired"></i> <span><?php echo trans('contact') ?></span>
            </a>
          </li>
          

          <li class="treeview <?php if(isset($page) && $page == "Blog"){echo "active";} ?>">
            <a href="#"><i class="flaticon-blogging-1"></i>
              <span><?php echo trans('blog') ?></span>
              <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if(isset($page_title) && $page_title == "Blog Category"){echo "active";} ?>"><a href="<?php echo base_url('admin/blog_category') ?>"><?php echo trans('add-category') ?> </a></li>
              <li class="<?php if(isset($page_title) && $page_title == "Blog Posts"){echo "active";} ?>"><a href="<?php echo base_url('admin/blog') ?>"><?php echo trans('bolg-posts') ?></a></li>
            </ul>
          </li> 
          
        <?php else: ?>
        
        <li class="<?php if(isset($page_title) && $page_title == "User Dashboard"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/dashboard/business') ?>">
            <i class="flaticon-home-1"></i> <span><?php echo trans('dashboard') ?></span>
          </a>
        </li>

        <?php if (check_payment_status() == TRUE || settings()->enable_paypal == 0 || user()->user_type == 'trial'): ?>
        
          <?php if (auth('role') == 'user' || auth('role') == 'subadmin'): ?>
            <li class="<?php if(isset($page_title) && $page_title == "Profile"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/profile') ?>">
                <i class="flaticon-settings-1"></i> <span><?php echo trans('settings') ?></span>
              </a>
            </li>
          

            <?php if (check_package_limit('invoice-payments') == -1): ?>
              <li class="<?php if(isset($page_title) && $page_title == "Payment Settings"){echo "active";} ?>">
                <a href="<?php echo base_url('admin/payment/user') ?>">
                  <i class="flaticon-save-money"></i> <span><?php echo trans('payment-settings') ?></span>
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>


          <li class="treeview <?php if(isset($main_page) && $main_page == "Sales"){echo "active";} ?>">
            
            <a href="#"><i class="flaticon-business-cards"></i>
              <span><?php echo trans('sales') ?></span>
              <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>

            <ul class="treeview-menu">
        
                <?php if (check_permissions(auth('role'), 'customers') == TRUE): ?>
                  <li class="<?php if(isset($page_title) && $page_title == "Customers"){echo "active";} ?>">
                    <a href="<?php echo base_url('admin/customer') ?>">
                      <i class="flaticon-network"></i> <span><?php echo trans('customers') ?></span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if (check_permissions(auth('role'), 'products') == TRUE): ?>
                <li class="<?php if(isset($page_title) && $page_title == "Products"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/product/all/sell') ?>">
                    <i class="flaticon-box-1"></i> <span><?php echo trans('products-services') ?></span>
                  </a>
                </li>
                <?php endif; ?>

                <?php if (check_permissions(auth('role'), 'estimates') == TRUE): ?>
                <li class="<?php if(isset($page_title) && $page_title == "Estimate"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/estimate') ?>">
                    <i class="flaticon-contract"></i> <span><?php echo trans('estimates') ?></span>
                  </a>
                </li>
                <?php endif; ?>

                <?php if (check_permissions(auth('role'), 'invoices') == TRUE): ?>
                <li class="<?php if(isset($page_title) && $page_title == "Invoices"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/invoice/type/1') ?>">
                    <i class="flaticon-approve-invoice"></i> <span><?php echo trans('invoices') ?></span>
                  </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Create Recurring Invoice"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/invoice/create/1') ?>">
                    <i class="flaticon-iterative"></i> <span><?php echo trans('recurring-invoice') ?> </span>
                  </a>
                </li>
                <?php endif; ?>

            </ul>
          </li> 

          <li class="treeview <?php if(isset($main_page) && $main_page == "Purchases"){echo "active";} ?>">
            
            <a href="#"><i class="icon-basket"></i>
              <span><?php echo trans('purchases') ?></span>
              <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                
                <?php if (check_permissions(auth('role'), 'bills') == TRUE): ?>
                <li class="<?php if(isset($page_title) && $page_title == "Bills"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/bills') ?>">
                    <i class="flaticon-credit-card"></i> <span><?php echo trans('bills') ?></span>
                  </a>
                </li>
                <?php endif; ?>

                <li class="<?php if(isset($page_title) && $page_title == "Vendor"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/vendor') ?>">
                    <i class="flaticon-group"></i> <span><?php echo trans('vendors') ?></span>
                  </a>
                </li>

                <?php if (check_permissions(auth('role'), 'expenses') == TRUE): ?>
                <li class="<?php if(isset($page_title) && $page_title == "Expense"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/expense') ?>">
                    <i class="flaticon-bill"></i> <span><?php echo trans('expense') ?></span>
                  </a>
                </li>
                <?php endif; ?>

                <?php if (check_permissions(auth('role'), 'products') == TRUE): ?>
                <li class="<?php if(isset($page_title) && $page_title == "Products"){echo "active";} ?>">
                  <a href="<?php echo base_url('admin/product/all/buy') ?>">
                    <i class="flaticon-box-1"></i> <span><?php echo trans('products-services') ?></span>
                  </a>
                </li>
                <?php endif; ?>

            </ul>
          </li> 
         
          <?php if (auth('role') == 'user' || auth('role') == 'subadmin'): ?>
            <li class="<?php if(isset($page_title) && $page_title == "Category"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/category') ?>">
                <i class="flaticon-folder-1"></i> <span><?php echo trans('categories') ?></span>
              </a>
            </li>

            <li class="<?php if(isset($page_title) && $page_title == "Tax"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/tax') ?>">
                <i class="flaticon-tax"></i> <span><?php echo trans('tax') ?></span>
              </a>
            </li>
          <?php endif; ?>
          
          <?php if (check_permissions(auth('role'), 'reports') == TRUE): ?>
          <li class="treeview <?php if(isset($main_page) && $main_page == "Report"){echo "active";} ?>">
            
            <a href="#"><i class="icon-pie-chart"></i>
              <span><?php echo trans('reports') ?></span>
              <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                
                <li class="<?php if(isset($page_title) && $page_title == "Profit & Loss"){echo "active";} ?>">
                    <a href="<?php echo base_url('admin/reports/profit_loss?end='.date('Y-m-d').'&start='.date('Y').'-01-01&report_type=1') ?>">
                      <span><?php echo trans('profit-loss') ?></span>
                    </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Sales Tax"){echo "active";} ?>">
                    <a href="<?php echo base_url('admin/reports/sales_tax?end='.date('Y-m-d').'&start='.date('Y').'-01-01&report_type=1') ?>">
                      <span><?php echo trans('sales-tax-report') ?></span>
                    </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Customers"){echo "active";} ?>">
                    <a href="<?php echo base_url('admin/reports/customers?end='.date('Y-m-d').'&start='.date('Y').'-01-01&report_type=1') ?>">
                      <span><?php echo trans('income-by-customer'); ?></span>
                    </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Vendors"){echo "active";} ?>">
                    <a href="<?php echo base_url('admin/reports/vendors?end='.date('Y-m-d').'&start='.date('Y').'-01-01&report_type=1') ?>">
                      <span><?php echo trans('purchases-by-Vendor'); ?></span>
                    </a>
                </li>

                <li class="<?php if(isset($page_title) && $page_title == "Reports"){echo "active";} ?>">
                    <a href="<?php echo base_url('admin/reports') ?>">
                      <span> <?php echo trans('general').' '.trans('reports') ?></span>
                    </a>
                </li>

            </ul>
          </li> 
          <?php endif ?>


        <?php endif ?>

          <?php if (auth('role') == 'user' || auth('role') == 'subadmin'): ?>
            <li class="<?php if(isset($page_title) && $page_title == "Subscription"){echo "active";} ?>">
              <a href="<?php echo base_url('admin/subscription') ?>">
                <i class="flaticon-time-is-money"></i> <span><?php echo trans('subscription') ?></span>
              </a>
            </li>
          <?php endif; ?>

        <?php endif; ?>

          <li class="<?php if(isset($page_title) && $page_title == "Country"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/country') ?>">
              <i class="flaticon-menu-3"></i> <span><?php echo trans('country') ?></span>
            </a>
          </li>


          <li class="<?php if(isset($page_title) && $page_title == "Change Password"){echo "active";} ?>">
            <a href="<?php echo base_url('change_password') ?>">
              <i class="flaticon-lock-1"></i> <span><?php echo trans('change-password') ?></span>
            </a>
          </li>

          <li class="">
            <a href="<?php echo base_url('auth/logout') ?>">
              <i class="flaticon-exit"></i> <span><?php echo trans('logout') ?></span>
            </a>
          </li>

          <?php if (is_admin()): ?>
            <?php if (file_exists(APPPATH.'controllers/addons/Razorpay.php')): ?>
              <li class="treeview <?php if(isset($main_page) && $main_page == "Addons"){echo "active";} ?>">
                <a href="#" class=""><i class="flaticon-favorites"></i>
                  <span><?php echo trans('addons') ?></span>
                  <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php if(isset($page_title) && $page_title == "Razorpay"){echo "active";} ?>"><a href="<?php echo base_url('addons/razorpay') ?>">Razorpay </a></li>
                </ul>
              </li> 
            <?php endif ?>
          <?php endif; ?>

      </ul>

      <?php if (is_admin()): ?>
          <a href="#" class="btn btn-secondary upgrade_btn">
            <i class="fa fa-info-circle"></i> <span><?php echo trans('version') ?> <?php echo html_escape(settings()->version) ?></span>
          </a>
      <?php else: ?>
          <a href="<?php echo base_url('admin/subscription') ?>" class="btn btn-info upgrade_btn">
            <i class="fa fa-rocket"></i> <span><?php echo trans('upgrade') ?></span>
          </a>
      <?php endif; ?>

    </section>
  </aside>

  <?php endif ?>