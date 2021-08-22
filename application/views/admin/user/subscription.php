<div class="content-wrapper">
  <!-- Main content -->
  <section class="content"> 
    <div class="row">
        <div class="col-md-4">
            <div class="box add_area">
              <div class="box-header">
                <h3 class="box-title"><?php echo trans('subscription') ?>
                  
                  <a target="_blank" href="<?php echo base_url('admin/payment/lists') ?>" class="pull-right btn btn-default btn-xs mt-5 brd-30"><i class="fa fa-file-text-o"></i> <?php echo trans('view-invoice') ?></a>
                </h3>
              </div>

              <div class="box-body">
                <p><?php echo trans('your-subscription') ?>: <strong><?php echo html_escape($user->package_name) ?> <?php echo trans('plan') ?></strong></p>
                <p><?php echo trans('price') ?>: <strong><?php echo html_escape($user->amount) ?> <?php echo html_escape($settings->currency) ?></strong></p>
                <p><?php echo trans('billing-frequency') ?> : <strong><?php echo ucfirst(html_escape($user->billing_type)) ?></strong> </p>
                <p><?php echo trans('last-billing') ?> : <strong><?php echo my_date_show($user->created_at) ?></strong> </p>
                <p><?php echo trans('next-billing') ?> : <strong><?php echo my_date_show($user->expire_on); ?></strong> 
                 <strong class="text-danger">(<?php echo date_dif(date('Y-m-d'), $user->expire_on) ?> <?php echo trans('days-left') ?>)</strong></strong></p>
              </div>
              <div class="box-footer text-center soft-<?php if($user->status == 'verified'){echo "success";}else{echo "danger";} ?>">
                <?php echo trans('payment-status') ?>: &emsp; <i class="fa fa-<?php if($user->status == 'verified'){echo "check";}else{echo "times";} ?>"></i> <?php echo ucfirst(html_escape($user->status)) ?>
              </div>
            </div>

        </div>

        <div class="col-md-8">
              <div class="box add_area">
                <div class="box-header">
                  <h3 class="box-title"><?php echo trans('upgrade-plan') ?> </h3>
                </div>

                <div class="box-body">
                 
                  <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
                    <div class="col-md-12 col-sm-12 col-xs-12 scroll">

                      <div class="pricing-switcher mb-5 text-center">
                          <p class="fieldset">
                              <input type="radio" name="billing_type" value="monthly" class="switch_price" id="monthly-1" <?php if($user->billing_type == 'monthly'){echo "checked";} ?>>
                              <label for="monthly-1"><?php echo trans('monthly') ?></label> &emsp;&emsp;
                              <input type="radio" name="billing_type" value="yearly" class="switch_price" id="yearly-1" <?php if($user->billing_type == 'yearly'){echo "checked";} ?>>
                              <label for="yearly-1"><?php echo trans('yearly') ?></label>
                              <span class="switch"></span>
                          </p>
                      </div>

                      <table class="table table-hover table-bordered">
                          <tbody>
                              <tr>
                                  <td width="30%"><h2></h2></td>
                                  <?php $i=1; foreach ($packages as $package): ?>
                                    <td class="text-center">
                                      <h2 class="mt-10"><?php if($user->package == $package->id){echo '<i class="fa fa-check-circle text-success"></i>';} ?> <?php echo html_escape($package->name); ?></h2>

                                      <?php if (settings()->enable_discount == 1): ?>
                                        <h4>
                                          <?php if ($package->dis_month != 0 && $package->monthly_price != 0): ?>
                                            <span class="monthly_show soft-blue price_month" style="display: <?php if($user->billing_type == 'monthly'){echo "inline-block";}else{echo "none";} ?>;">
                                                <?php echo html_escape($package->dis_month); ?>% <?php echo trans('off') ?>
                                            </span>
                                          <?php endif ?>
                                          
                                          <?php if ($package->dis_year != 0 && $package->price != 0): ?>
                                            <span class="yearly_show soft-blue price_year" style="display: <?php if($user->billing_type == 'yearly'){echo "inline-block";}else{echo "none";} ?>;">
                                                <?php echo html_escape($package->dis_year); ?>% <?php echo trans('off') ?>
                                            </span>
                                          <?php endif ?>
                                        </h4>
                                      <?php endif ?>

                                      <h4 class="mb-15">
                                        <span class="price_year <?php if(settings()->enable_discount == 1 && $package->dis_year != 0 && $package->price != 0){echo"price-off";} ?>" style="display: <?php if($user->billing_type == 'yearly'){echo "inline-block";}else{echo "none";} ?>">
                                          <?php echo currency_to_symbol(settings()->currency); ?><?php echo round($package->price); ?>
                                        </span>  

                                        <?php if(settings()->enable_discount == 1 && $package->dis_year != 0 && $package->price != 0): ?>
                                          <span class="price_year" style="display: <?php if($user->billing_type == 'yearly'){echo "inline-block";}else{echo "none";} ?>">
                                          <?php echo currency_to_symbol(settings()->currency); ?><?php echo get_discount($package->price, $package->dis_year) ?>
                                          </span>
                                        <?php endif ?>

                                        <span class="price_month <?php if(settings()->enable_discount == 1 && $package->dis_month != 0 && $package->price != 0){echo"price-off";} ?>" style="display: <?php if($user->billing_type == 'monthly'){echo "inline-block";}else{echo "none";} ?>;">
                                          <?php echo currency_to_symbol(settings()->currency); ?><?php echo round($package->monthly_price); ?> 
                                        </span>

                                        <?php if(settings()->enable_discount == 1 && $package->dis_month != 0 && $package->price != 0): ?>
                                        <span class="price_month" style="display: <?php if($user->billing_type == 'monthly'){echo "inline-block";}else{echo "none";} ?>">
                                          <?php echo currency_to_symbol(settings()->currency); ?><?php echo get_discount($package->monthly_price, $package->dis_month) ?>
                                        </span>
                                        <?php endif ?>
                                      </h4>

                                      <p class="mt-0 bill_type">
                                        <?php if ($user->billing_type == 'monthly'): ?>
                                          <?php echo trans('per-month') ?>
                                        <?php elseif ($user->billing_type == 'yearly'): ?>
                                          <?php echo trans('per-year') ?>
                                        <?php else: ?>
                                          <?php echo trans('per-year') ?>
                                        <?php endif ?>
                                      </p>

                                    </td>
                                  <?php $i++; endforeach; ?>
                              </tr>
                              
                              <?php foreach ($features as $feature): ?>
                                <tr class="monthly_row" style="display: <?php if($user->billing_type == 'yearly'){echo "none";} ?>">
                                    <td width="30%"><?php echo trans($feature->slug); ?></td>
                                    
                                    <?php if (check_package_status('basic') == true): ?>
                                    <td class="text-center">
                                      <?php if ($feature->basic == 0): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                      <?php elseif($feature->basic == -1): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                      <?php elseif($feature->basic == -2): ?>
                                        <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                      <?php else: ?>
                                        <?php echo html_escape($feature->basic); ?>
                                      <?php endif ?>
                                    </td>
                                    <?php endif ?>

                                    <?php if (check_package_status('standared') == true): ?>
                                    <td class="text-center">
                                      <?php if ($feature->standared == 0): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                      <?php elseif($feature->standared == -1): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                      <?php elseif($feature->standared == -2): ?>
                                        <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                      <?php else: ?>
                                        <?php echo html_escape($feature->standared); ?>
                                      <?php endif ?>
                                    </td>
                                    <?php endif ?>

                                    <?php if (check_package_status('premium') == true): ?>
                                    <td class="text-center">
                                      <?php if ($feature->premium == 0): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                      <?php elseif($feature->premium == -1): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                      <?php elseif($feature->premium == -2): ?>
                                        <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                      <?php else: ?>
                                        <?php echo html_escape($feature->premium); ?>
                                      <?php endif ?>
                                    </td>
                                    <?php endif ?>
                                </tr>

                                <tr class="yearly_row" style="display: <?php if($user->billing_type == 'monthly'){echo "none";} ?>">
                                    <td width="30%"><?php echo trans($feature->slug); ?></td>
                                    
                                    <?php if (check_package_status('basic') == true): ?>
                                    <td class="text-center">
                                      <?php if ($feature->year_basic == 0): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                      <?php elseif($feature->year_basic == -1): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                      <?php elseif($feature->year_basic == -2): ?>
                                        <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                      <?php else: ?>
                                        <?php echo html_escape($feature->year_basic); ?>
                                      <?php endif ?>
                                    </td>
                                    <?php endif; ?>
                                    
                                    <?php if (check_package_status('standared') == true): ?>
                                    <td class="text-center">
                                      <?php if ($feature->year_standared == 0): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                      <?php elseif($feature->year_standared == -1): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                      <?php elseif($feature->year_standared == -2): ?>
                                        <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                      <?php else: ?>
                                        <?php echo html_escape($feature->year_standared); ?>
                                      <?php endif ?>
                                    </td>
                                    <?php endif; ?>
                                    
                                    <?php if (check_package_status('premium') == true): ?>
                                    <td class="text-center">
                                      <?php if ($feature->year_premium == 0): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-times text-danger"></i></p>
                                      <?php elseif($feature->year_premium == -1): ?>
                                        <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                      <?php elseif($feature->year_premium == -2): ?>
                                        <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                      <?php else: ?>
                                        <?php echo html_escape($feature->year_premium); ?>
                                      <?php endif ?>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                              <?php endforeach ?>

                              <tr>
                                  <td></td>
                                  <?php $b=1; foreach ($packages as $package): ?>
                                      <td class="<?php if($b==2){echo"active";} ?> text-center">
                                          <a href="<?php echo base_url('admin/subscription/upgrade/'.$package->slug) ?>" class="btn btn-<?php if($b==2){echo"default";}else{echo "default";} ?> package_btn"><?php if($b==1){echo trans('upgrade');}else{echo trans('upgrade');} ?></a>
                                      </td>
                                  <?php $b++; endforeach; ?>
                                  <input type="hidden" name="billing_type" class="billing_type" value="<?php if($user->billing_type == 'monthly'){echo "monthly";}else{echo "yearly";} ?>">
                              </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>
        </div>
    </div>
  </section>

</div>
