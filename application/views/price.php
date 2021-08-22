
<!-- start section -->
<section class="section">
    <div class="container">

        <div class="section-heading section-heading--center">
            <h3 class="title"><?php echo trans('price-title') ?></h3>
            <p><?php echo trans('price-desc') ?></p>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="content-container">
                    <!-- start pricing table -->
                    <div class="pricing-table pricing-table--s4" data-aos="fade" data-aos-delay="150">
                        <div class="d-block">

                        <div class="spacer py-2"></div>

                            <div class="col-md-4 text-center m-auto mb-20 price-swicher">

                              <?php if (settings()->enable_discount == 1 && !empty($max_discount)): ?>
                                <figure class="discount-badge">
                                  <svg class="d-block mt-n2 ml-n4" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 99.3 57" width="48" transform="scale(-1,1)">
                                    <path fill="none" stroke="#bdc5d1" stroke-width="4" stroke-linecap="round" stroke-miterlimit="10" d="M2,39.5l7.7,14.8c0.4,0.7,1.3,0.9,2,0.4L27.9,42"></path>
                                    <path fill="none" stroke="#bdc5d1" stroke-width="4" stroke-linecap="round" stroke-miterlimit="10" d="M11,54.3c0,0,10.3-65.2,86.3-50"></path>
                                  </svg>
                                  <span class="badge badge-default soft-blue badge-pill py-sm-2 px-sm-3"><?php echo trans('save-upto') ?> <?php if(!empty($max_discount)){echo $max_discount;} ?>%</span>
                                </figure>
                              <?php endif ?>

                              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary custom-btngp">
                                  <input type="radio" name="payment_type" value="monthly" class="switch_price" id="monthly-1"> <?php echo trans('monthly') ?>
                                </label>
                                <label class="btn btn-outline-primary custom-btngp">
                                  <input type="radio" name="payment_type" value="yearly" class="switch_price" id="yearly-1" checked> <?php echo trans('yearly') ?>
                                </label>
                              </div>
                            </div><br><br>

                            <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0 mt-20">
                                <table class="text-center table table-striped rounded">
                                    <tbody>
                                        <thead class="thead mb-100">

                                            <tr class="">
                                                <th>
                                                    <div class="h2"></div>
                                                </th>
                                                <?php $i=1; foreach ($packages as $package): ?>
                                                    <th class="pt-0 text-center <?php if($i==2){echo"colm_2s";} ?>">
                                                        <div class="header">
                                                            <div class="title h3"><?php echo html_escape($package->name); ?></div>
                                                        </div>
                                                        <?php if (settings()->enable_discount == 1): ?>
                                                          <h4>
                                                            <?php if ($package->dis_month != 0 && $package->price != 0): ?>
                                                              <span class="monthly_show price-dis" style="display: none;">
                                                                  <?php echo html_escape($package->dis_month); ?>% <?php echo trans('off') ?>
                                                              </span>
                                                            <?php endif ?>
                                                            
                                                            <?php if ($package->dis_year != 0 && $package->price != 0): ?>
                                                              <span class="yearly_show price-dis">
                                                                  <?php echo html_escape($package->dis_year); ?>% <?php echo trans('off') ?>
                                                              </span>
                                                            <?php endif ?>
                                                          </h4>
                                                        <?php endif ?>
                                                    </th>
                                                <?php $i++; endforeach; ?>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h2></h2>
                                                </td>
                                                <?php $a=1; foreach ($packages as $package): ?>
                                                <td class="p-0">
                                                    <div class="theader <?php if($a==2){echo"colm_2s";} ?>">
                                                        <div class="price mb-5 <?php if($a==2){echo"colm_2s";} ?>">
                                                     
                                                            <span class="price_year <?php if(settings()->enable_discount == 1 && $package->dis_year != 0 && $package->price != 0){echo"price-off";} ?>">
                                                              <?php echo currency_to_symbol(settings()->currency); ?><?php echo round($package->price); ?>
                                                            </span>  

                                                            <?php if(settings()->enable_discount == 1 && $package->dis_year != 0 && $package->price != 0): ?>
                                                              <span class="price_year">
                                                              <?php echo currency_to_symbol(settings()->currency); ?><?php echo get_discount($package->price, $package->dis_year) ?>
                                                              </span>
                                                            <?php endif ?>

                                                            <span class="price_month <?php if(settings()->enable_discount == 1 && $package->dis_month != 0 && $package->price != 0){echo"price-off";} ?>" style="display: none;">
                                                              <?php echo currency_to_symbol(settings()->currency); ?><?php echo round($package->monthly_price); ?> 
                                                            </span>

                                                            <?php if(settings()->enable_discount == 1 && $package->dis_month != 0 && $package->price != 0): ?>
                                                              <span class="price_month" style="display: none;">
                                                                <?php echo currency_to_symbol(settings()->currency); ?><?php echo get_discount($package->monthly_price, $package->dis_month) ?>
                                                              </span>
                                                            <?php endif ?>

                                                        </div>
                                                        <p class="mt-0 bill_type"><?php echo trans('per-year') ?></p>
                                                    </div>
                                                </td>
                                                <?php $a++; endforeach; ?>
                                            </tr>
                                        </thead>

                                        <?php foreach ($features as $feature): ?>
                                            <tr class="monthly_row" style="display: none">
                                              <td class="text-left pl-20"><?php echo trans($feature->slug); ?></td>
                                              
                                              <?php if (check_package_status('basic') == true): ?>
                                              <td class="text-center">
                                                <?php if ($feature->basic == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="fa fa-close text-danger"></i></p>
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
                                                  <p class="mb-0 feature-item"><i class="fa fa-close text-danger"></i></p>
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
                                                  <p class="mb-0 feature-item"><i class="fa fa-close text-danger"></i></p>
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
                                        <?php endforeach; ?>

                                        <?php foreach ($features as $feature): ?>
                                            <tr class="yearly_row">
                                              <td class="text-left pl-20"><?php echo trans($feature->slug); ?></td>

                                              <?php if (check_package_status('basic') == true): ?>
                                              <td class="text-center colm_1">
                                                <?php if ($feature->year_basic == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="fa fa-close text-danger"></i></p>
                                                <?php elseif($feature->year_basic == -1): ?>
                                                  <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                                <?php elseif($feature->year_basic == -2): ?>
                                                  <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->year_basic); ?>
                                                <?php endif ?>
                                              </td>
                                              <?php endif ?>


                                              <?php if (check_package_status('standared') == true): ?>
                                              <td class="text-center">
                                                <?php if ($feature->year_standared == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="fa fa-close text-danger"></i></p>
                                                <?php elseif($feature->year_standared == -1): ?>
                                                  <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                                <?php elseif($feature->year_standared == -2): ?>
                                                  <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->year_standared); ?>
                                                <?php endif ?>
                                              </td>
                                              <?php endif ?>


                                              <?php if (check_package_status('premium') == true): ?>
                                              <td class="text-center colm_3">
                                                <?php if ($feature->year_premium == 0): ?>
                                                  <p class="mb-0 feature-item"><i class="fa fa-close text-danger"></i></p>
                                                <?php elseif($feature->year_premium == -1): ?>
                                                  <p class="mb-0 feature-item"><i class="fa fa-check text-success"></i></p>
                                                <?php elseif($feature->year_premium == -2): ?>
                                                  <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                                <?php else: ?>
                                                  <?php echo html_escape($feature->year_premium); ?>
                                                <?php endif ?>
                                              </td>
                                              <?php endif ?>

                                            </tr>
                                        <?php endforeach; ?>

                                        <tfoot>
                                            <tr class="btom">
                                                <td></td>
                                                <input type="hidden" name="billing_type" value="yearly" class="billing_type">
                                                <?php $b=1; foreach ($packages as $package): ?>
                                                  <td class="<?php if($b==2){echo"colm_2s";} ?>">
                                                      <a class="btn btn-sm btn-light-primary btn-block" href="<?php echo base_url('register?plan='.$package->slug) ?>"><?php echo trans('get-started') ?></a>
                                                  </td>
                                                <?php $b++; endforeach; ?>
                                            </tr>
                                        </tfoot>

                                        
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- end pricing table -->
                </div>

            </div>
        </div>
        <div class="spacer py-4"></div>
    </div>
</section>
<!-- end section -->