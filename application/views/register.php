
<section class="section p-0 mt--50">
    <div class="container">
        <?php if ($settings->enable_registration == 0): ?>
            <div class="col-md-12 text-center">
                <h2 class="text-danger p-200"><?php echo trans('registration-system-is-disabled') ?>!</h2>
            </div>
        <?php else: ?>

            <div class="row">
                <div class="col-md-12 text-center">
                    <a class="site-logo" href="<?php echo base_url() ?>">
                        <img class="img-fluid" width="70%" src="<?php echo base_url($settings->logo) ?>" alt="demo" />
                    </a>
                    <h3 class="mb-0"><?php echo html_escape($settings->site_title) ?></h3>
                    <h4 class="mt-2"><?php echo html_escape($settings->site_name) ?><span> <?php echo trans('register-info') ?></span></h4>
                </div>
            </div>

            <div class="spacer py-2"></div>
           
            <div class="row">
                <ul class="progressbar" data-aos="zoom-in-up">
                    <li class="step_1 active"><?php echo trans('sign-up') ?></li>
                    <li class="step_2"><?php echo trans('business') ?></li>
                </ul>
            </div>

            <div class="account_area row justify-content-md-center mt-0">
                <div class="col-md-6 col-lg-6 col-sm-12 text-left d-none d-md-block" data-aos="fade-left">
                    <img class="mt-5" width="95%" src="<?php echo base_url() ?>assets/front/img/register.jpg">
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12 text-left" data-aos="fade-right">
                    
                    <div class="spacer py-7"></div>

                    <form id="register_form" class="authorizationform authorizationform--shadow leave_con" method="post" action="<?php echo base_url('register_user'); ?>" >
                        <h4 class="title"><?php echo trans('sign-up') ?></h4>
                        <div class="input-wrp">
                            <input class="textfield textfield--grey" type="text" name="name" placeholder="<?php echo trans('full-name') ?>" required />
                        </div>

                        <div class="input-wrp">
                            <input class="textfield textfield--grey" type="email" name="email" placeholder="<?php echo trans('email') ?>" required />
                        </div>

                        <div class="input-wrp">
                            <input class="textfield textfield--grey" type="password" name="password" placeholder="<?php echo trans('password') ?>" required />
                        </div>

                        <p>
                            <label class="checkbox mt-0">
                                <input name="agree" class="agree_btn" type="checkbox" value="ok" required />
                                <i class="fontello-check"></i><span><?php echo trans('agree-with') ?> <a target="_blank" href="<?php echo base_url('terms-of-service') ?>"><?php echo trans('terms-of-service') ?></a></span>
                            </label>
                        </p>

                        <input type="hidden" name="plan" value="<?php if(isset($_GET['plan'])){echo html_escape($_GET['plan']);}else{echo "basic";} ?>">
                        <input type="hidden" name="billing" value="<?php if(isset($_GET['billing'])){echo html_escape($_GET['billing']);}else{echo "monthly";} ?>">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="input-wrp">
                            <?php if ($settings->enable_captcha == 1 && $settings->captcha_site_key != ''): ?>
                                <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape($settings->captcha_site_key); ?>"></div>
                            <?php endif ?>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary btn-block submit_btn mb-4 loader_btn" type="submit" disabled="disabled"><?php echo trans('get-started') ?> </button>
                            <a class="create" href="<?php echo base_url('login'); ?>"><?php echo trans('sign-in') ?></a>
                        </div>

                    </form>
                </div>
            </div>




            <div class="business_area justify-content-md-center mt-0" style="display: none;">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 text-left d-none d-md-block" data-aos="fade-up">
                        <img src="<?php echo base_url() ?>assets/front/img/business.jpg">
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 text-left" data-aos="fade-down">
                        
                        <div class="spacer py-7"></div>

                        <form id="business_form" class="authorizationform authorizationform--shadow leave_con" method="post" action="<?php echo base_url('create-business'); ?>">
                            <h4 class="title"><?php echo trans('setup-your-first-business') ?></h4>
                            <div class="input-wrp">
                                <input class="textfield textfield--grey" type="text" name="name" placeholder="Business Name" />
                            </div>

                            <div class="input-wrp">
                                <select class="selectfield textfield--grey single_select col-sm-12 wd-100" id="country" name="country" style="width: 100%">
                                    <option value=""><?php echo trans('select-country') ?></option>
                                    <?php foreach ($countries as $country): ?>
                                        <option value="<?php echo html_escape($country->id); ?>" 
                                            >
                                            <?php echo html_escape($country->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="input-wrp">
                                <select class="selectfield textfield--grey single_select col-sm-12 wd-100" name="category" style="width: 100%">
                                    <option value=""><?php echo trans('select-business-type') ?></option>
                                    <?php foreach ($business as $busines): ?>
                                        <option value="<?php echo html_escape($busines->id); ?>" 
                                            >
                                            <?php echo html_escape($busines->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <button class="btn btn-primary btn-block loader_btn2" type="submit" role="button"><?php echo trans('create') ?></button>
                        </form>
                    </div>
                </div>
            </div>



            <div class="loader"></div>

            <div class="pricing_area row justify-content-md-center mt-0 text-center" style="display: none;">
               
               <div class="spacer py-4"></div>

                <h4 class="title"><?php echo trans('you-are-almost-done') ?>!</h4>
                <div class="col-md-12 col-lg-12 col-sm-12 text-left scroll-x" data-aos="fade-down">
                    <div class="pricing-table pricing-table--s4" data-aos="fade" data-aos-delay="150">
                        <div class="d-block">
                            <div class="col-md-4 text-center m-auto mb-20">
                              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary custom-btngp">
                                  <input type="radio" name="payment_type" value="monthly" class="switch_price" id="monthly-1"> <?php echo trans('monthly') ?>
                                </label>
                                <label class="btn btn-outline-primary custom-btngp">
                                  <input type="radio" name="payment_type" value="yearly" class="switch_price" id="yearly-1" checked> <?php echo trans('yearly') ?>
                                </label>
                              </div>
                            </div><br><br>

                            <table class="text-center rounded">
                                <tbody>
                                    <thead class="thead mb-100">

                                        <tr class="">
                                            <th>
                                                <div class="h2"></div>
                                            </th>
                                            <?php $i=1; foreach ($packages as $package): ?>
                                                <th class="pt-40 text-center <?php if($i==2){echo"colm_2";} ?>">
                                                    <div class="header">
                                                        <div class="title h3"><?php echo html_escape($package->name); ?> </div>
                                                    </div>
                                                    <?php if (settings()->enable_discount == 1): ?>
                                                      <h4>
                                                        <?php if ($package->dis_month != 0 && $package->price != 0): ?>
                                                          <span class="monthly_show soft-blue" style="display: none;">
                                                              <?php echo html_escape($package->dis_month); ?>% <?php echo trans('off') ?>
                                                          </span>
                                                        <?php endif ?>
                                                        
                                                        <?php if ($package->dis_year != 0 && $package->price != 0): ?>
                                                          <span class="yearly_show soft-blue">
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
                                                <div class="theader <?php if($a==2){echo"colm_2";} ?>">
                                                    <div class="price mb-5 <?php if($a==2){echo"colm_2";} ?>">
                                                 
                                                        <span class="price_year <?php if(settings()->enable_discount == 1 && $package->dis_year != 0 && $package->price != 0){echo"price-off";} ?>">
                                                          <?php echo currency_to_symbol(settings()->currency); ?><?php echo round($package->price); ?>
                                                        </span>  

                                                        <?php if(settings()->enable_discount == 1 && $package->dis_month != 0 && $package->price != 0): ?>
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
                                            <td class="text-right"><?php echo html_escape($feature->name); ?></td>
                                            <td class="text-center">
                                            <?php if ($feature->basic == 0): ?>
                                              <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                            <?php elseif($feature->basic == 1): ?>
                                              <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                            <?php elseif($feature->basic == 2): ?>
                                              <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                            <?php else: ?>
                                              <?php echo html_escape($feature->basic); ?>
                                            <?php endif ?>
                                          </td>
                                          <td class="text-center colm_2">
                                            <?php if ($feature->standared == 0): ?>
                                              <p class="mb-0 feature-item"><i class="ico-unchecked fontello-cancel"></i></p>
                                            <?php elseif($feature->standared == 1): ?>
                                              <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                            <?php elseif($feature->standared == 2): ?>
                                              <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                            <?php else: ?>
                                              <?php echo html_escape($feature->standared); ?>
                                            <?php endif ?>
                                          </td>
                                          <td class="text-center">
                                            <?php if ($feature->premium == 0): ?>
                                              <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                            <?php elseif($feature->premium == 1): ?>
                                              <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                            <?php elseif($feature->premium == 2): ?>
                                              <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                            <?php else: ?>
                                              <?php echo html_escape($feature->premium); ?>
                                            <?php endif ?>
                                          </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    <?php foreach ($features as $feature): ?>
                                        <tr class="yearly_row">
                                          <td class="text-right"><?php echo html_escape($feature->name); ?></td>
                                            <td class="text-center">
                                            <?php if ($feature->year_basic == 0): ?>
                                              <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                            <?php elseif($feature->year_basic == 1): ?>
                                              <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                            <?php elseif($feature->year_basic == 2): ?>
                                              <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                            <?php else: ?>
                                              <?php echo html_escape($feature->year_basic); ?>
                                            <?php endif ?>
                                          </td>
                                          <td class="text-center colm_2">
                                            <?php if ($feature->year_standared == 0): ?>
                                              <p class="mb-0 feature-item"><i class="ico-unchecked fontello-cancel"></i></p>
                                            <?php elseif($feature->year_standared == 1): ?>
                                              <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                            <?php elseif($feature->year_standared == 2): ?>
                                              <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                            <?php else: ?>
                                              <?php echo html_escape($feature->year_standared); ?>
                                            <?php endif ?>
                                          </td>
                                          <td class="text-center">
                                            <?php if ($feature->year_premium == 0): ?>
                                              <p class="mb-0 feature-item"><i class="ico-unchecked fontello-minus"></i></p>
                                            <?php elseif($feature->year_premium == 1): ?>
                                              <p class="mb-0 feature-item"><i class="ico-checked fontello-ok"></i></p>
                                            <?php elseif($feature->year_premium == 2): ?>
                                              <p class="mb-0 feature-item"><?php echo trans('unlimited') ?></p>
                                            <?php else: ?>
                                              <?php echo html_escape($feature->year_premium); ?>
                                            <?php endif ?>
                                          </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    <tfoot>
                                        <tr class="btom">
                                            <td></td>
                                            <?php $b=1; foreach ($packages as $package): ?>
                                                <td class="<?php if($b==2){echo"colm_2";} ?>">
                                                    <a class="custom-btn custom-btn--medium custom-btn--style-3 package_btn" href="<?php echo base_url('package/'.$package->id) ?>"><?php echo trans('choose-plan') ?></a>
                                                    <input type="hidden" name="billing_type" class="billing_type" value="yearly">
                                                </td>
                                            <?php $b++; endforeach; ?>
                                        </tr>
                                    </tfoot>
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="spacer py-4"></div>
            </div>

        <?php endif ?>
    </div>
</section>

