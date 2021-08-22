
<?php $settings = get_settings(); ?>
<?php
    $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
    $paypal_id= html_escape($settings->paypal_email);
?>

<section class="section">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                
                <div class="pay-boxs">

                    <div class="text-center mt-20">
                        <?php if (isset($success_msg) && $success_msg=='Success'): ?>
                            <h1 class="text-success"><i class="icon-check"></i> <br><?php echo trans('done') ?></h1>
                            <h5 class="text-successs"><?php echo trans('payment-success-msg') ?></h5><br>
                            <?php if ($settings->enable_email_verify == 1): ?>
                                <a href="<?php echo base_url('verify') ?>" class="custom-btn custom-btn--medium custom-btn--style-2"><?php echo trans('continue') ?> <i class="fa fa-long-arrow-right"></i></a>
                            <?php else: ?>
                                <a href="<?php echo base_url('admin/dashboard/business') ?>" class="custom-btn custom-btn--medium custom-btn--style-2">Continue <i class="fa fa-long-arrow-right"></i></a>
                            <?php endif ?>

                        <?php elseif (isset($error_msg) && $error_msg=='Error'): ?>
                            <h3 class="text-danger"><i class="icon-close"></i> <?php echo trans('error') ?></h3>
                            <h5 class="error"><?php echo trans('payment-error-msg') ?></h5><br>
                            <a href="<?php echo base_url() ?>" class="btn btn-secondary btn-lg"><?php echo trans('back') ?></a>
                        <?php else: ?>
                    </div>

                        <?php if ($payment->billing_type == 'monthly'): ?>
                            <?php 
                                if (settings()->enable_discount == 1){
                                    $price = get_discount($package->monthly_price, $package->dis_month); 
                                }else{
                                    $price = round($package->monthly_price); 
                                }
                                $frequency = trans('per-month');
                                $billing_type = 'monthly';
                            ?>
                        <?php else: ?>
                            <?php 
                                if (settings()->enable_discount == 1){
                                    $price = get_discount($package->price, $package->dis_year); 
                                }else{
                                    $price = round($package->price); 
                                }
                                $frequency = trans('per-year');
                                $billing_type = 'yearly';
                            ?>
                        <?php endif ?>



                        <div class="switch mb-20">
                            <div class="btn-group btn-group-toggle mb-50" data-toggle="buttons">
                                <label class="btn btn-outline-primary custom-btngp">
                                  <input type="radio" name="payment_type" value="paypal" class="switch_payment" id="paypal-1"> <i class="fa fa-cc-paypal fa-2x"></i>
                                </label>
                                <label class="btn btn-outline-primary custom-btngp">
                                  <input type="radio" name="payment_type" value="stripe" class="switch_payment" id="stripe-1"> <i class="fa fa-cc-stripe fa-2x"></i>
                                </label>
                              </div>
                            </div>
                        </div>

                        <div class="spacer py-4"></div>
              
                        <!-- Tab panes -->
                        <div class="tab-contents">
                            
                            <!-- paypal payment -->
                            <?php if (settings()->paypal_payment == 1): ?>
                                <div class="paypal_area container" id="paypal" style="display: <?php if (settings()->paypal_payment == 1){echo "block";}else{echo "none";} ?>">
                                   <div class="row">
                                        <div class="box col-md-6 m-auto">
                                            
                                            <div class="box-body text-center">

                                                <h4 class=""><?php echo trans('paypal-payment') ?> - <?php echo trans('upgrade-plan') ?></h4>
                                                <p class="mb-0 text-center"><?php echo trans('package-plan') ?>: <?php echo html_escape($package->name);?> (<strong><?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</p><br>

                                                <?php if (settings()->enable_discount == 1): ?>
                                                    <?php if ($billing_type == 'monthly'): ?>
                                                        <span class="soft-blue dp"><?php echo $package->dis_month ?>% <?php echo trans('off') ?></span>
                                                    <?php else: ?>
                                                        <span class="soft-blue dp"><?php echo $package->dis_year ?>% <?php echo trans('off') ?></span>
                                                    <?php endif ?>
                                                <?php endif ?><br><br>

                                                <!-- PRICE ITEM -->
                                                <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                                                    <div class="pipanel price panel-red">
                                                        <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                                        <input type="hidden" name="cmd" value="_xclick">
                                                        <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                                                        <input type="hidden" name="item_number" value="1">
                                                        <input type="hidden" name="amount" value="<?php echo html_escape($price) ?>" readonly>
                                                        <input type="hidden" name="no_shipping" value="1">
                                                        <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency);?>">
                                                        <input type="hidden" name="cancel_return" value="<?php echo base_url('admin/subscription/payment_cancel/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">
                                                        <input type="hidden" name="return" value="<?php echo base_url('admin/subscription/payment_success/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">  
                                                     
                                                        <!-- <div class="text-center p-0">
                                                            <p class="leads fs-30"><strong><?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong></p>
                                                        </div><br> -->
                                                        <div class="mt-30">
                                                            <button class="custom-btn custom-btn--medium custom-btn--style-2" href="#"><?php echo trans('pay-now') ?> <?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- /PRICE ITEM -->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>  

                            <!-- stripe payment -->
                            <?php if (settings()->stripe_payment == 1): ?>
                                <div class="stripe_area container" id="stripe" style="display: <?php if (settings()->stripe_payment == 1 && settings()->paypal_payment == 0){echo "block";}else{echo "none";} ?>">
                                   <div class="row justify-content-center">
                                        <div class="col-md-6 m-auto">
                                            <h4 class="text-center"><?php echo trans('stripe-payment') ?> - <?php echo trans('upgrade-plan') ?></h4>
                                            <p class="mb-0 text-center"><?php echo trans('package-plan') ?>: <?php echo html_escape($package->name);?> (<strong><?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</p><br>
                                            <div class="text-center mb-20">
                                                <?php if (settings()->enable_discount == 1): ?>
                                                    <?php if ($billing_type == 'monthly'): ?>
                                                        <span class="soft-blue dp text-center"><?php echo $package->dis_month ?>% <?php echo trans('off') ?></span>
                                                    <?php else: ?>
                                                        <span class="soft-blue dp text-center"><?php echo $package->dis_year ?>% <?php echo trans('off') ?></span>
                                                    <?php endif ?>
                                                <?php endif ?><br>
                                            </div>
                                            <div class="spacer py-4"></div>
                                            <div class="box credit-card-box">
                                                <h3 class="box-title text-left"><?php echo trans('payment').' '.trans('details') ?> <span class="pull-right mt--5"><img class="img-responsive" src="http://i76.imgup.net/accepted_c22e0.png"></span></h3>
                                                <hr>
                                                <div class="spacer py-1"></div>

                                                <div class="box-body">
                                    
                                                    <form role="form" action="<?php echo base_url('auth/stripe_payment') ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo settings()->publish_key; ?>" id="payment-form">
                                                        
                                                        <div class='form-row row'>
                                                            <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                            </div>
                                                            <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                            </div>
                                                        </div>

                                                        <div class='form-row row'>
                                                            <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                <label class='control-label'><?php echo trans('name-on-card') ?></label> 
                                                                <input class='textfield textfield--grey' type='text' value="" size='6'>
                                                            </div>
                                                            <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                <label class='control-label'><?php echo trans('card-number') ?></label> 
                                                                <input autocomplete='off' class='textfield textfield--grey card-number'
                                                                    type='text' value="" size='6'>
                                                            </div>
                                                        </div>

                                                        <div class="spacer py-2"></div>

                                                        <div class='form-row row'>
                                                            <div class='col-xs-12 col-md-4 form-group cvc required text-left'>
                                                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                    class='textfield textfield--grey card-cvc' placeholder='ex. 311' size='4'
                                                                    type='text' value="">
                                                            </div>
                                                            <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                                <label class='control-label'><?php echo trans('expiration').' '.trans('month') ?></label> <input
                                                                    class='textfield textfield--grey card-expiry-month' placeholder='MM' size='2'
                                                                    type='text' value="">
                                                            </div>
                                                            <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                                <label class='control-label'><?php echo trans('expiration').' '.trans('year') ?></label> <input
                                                                    class='textfield textfield--grey card-expiry-year' placeholder='YYYY' size='4'
                                                                    type='text' value="">
                                                            </div>
                                                        </div>

                                                        <div class="text-center text-success">
                                                            <div class="payment_loader" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading....</div><br>
                                                        </div>
                                                 
                                                        <!-- csrf token -->
                                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                                        <input type="hidden" name="billing_type" value="<?php echo $billing_type; ?>" readonly>
                                                        <input type="hidden" name="package_id" value="<?php echo $package->id; ?>" readonly>
                                                        <div class="row">
                                                            <div class="spacer py-2"></div>
                                                            <div class="col-md-12">
                                                                <button class="custom-btn custom-btn--medium custom-btn--style-2 payment_btn" type="submit">Pay Now <?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?></button>
                                                            </div>
                                                        </div>
                                                             
                                                    </form>
                                                </div>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>       

                        </div>
               

                        <div class="spacer py-6"></div>
                    <?php endif ?>

                </div>

            </div>
        </div>
    </div>
</section>
