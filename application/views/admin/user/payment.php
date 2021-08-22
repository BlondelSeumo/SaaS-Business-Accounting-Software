<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <?php $settings = get_settings(); ?>
    <?php
        $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
        $paypal_id= html_escape($settings->paypal_email);
    ?>

    <?php if ($billing_type == 'monthly'): ?>
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



    <div class="container mt-50 mb-20">

        <div class="text-center m-auto">
            <ul class="nav nav-pills text-center m-auto">
                <?php if (settings()->paypal_payment == 1): ?>
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#paypal">Paypal</a>
                  </li>
                <?php endif ?>       
                <?php if (settings()->stripe_payment == 1): ?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#stripe">Stripe</a>
                  </li>
                <?php endif ?> 
                <?php if (settings()->razorpay_payment == 1 && settings()->rpa_enable == 1): ?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#razorpay">Razorpay</a>
                  </li>
                <?php endif ?>      
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="tab-content">
            
            <!-- paypal payment -->
            <?php if (settings()->paypal_payment == 1): ?>
                <div class="tab-pane container <?php if (settings()->paypal_payment == 1){echo "active";} ?>" id="paypal">
                   <div class="row">
                        <div class="box col-md-6 m-auto">
                            
                            <div class="box-body text-center">

                                <?php if (settings()->enable_discount == 1): ?>
                                    <?php if ($billing_type == 'monthly'): ?>
                                        <span class="soft-success dp"><?php echo $package->dis_month ?>% <?php echo trans('off') ?></span>
                                    <?php else: ?>
                                        <span class="soft-success dp"><?php echo $package->dis_year ?>% <?php echo trans('off') ?></span>
                                    <?php endif ?>
                                <?php endif ?>

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
                                            
                                      
                                        <div class="panel-body text-center p-0">
                                            <h3 class="mb-0"><?php echo trans('package-plan') ?>: <?php echo html_escape($package->name);?></h3>
                                            <p class="lead"><strong><?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong></p>
                                        </div>
                                        <div class="panel-footer">
                                            <button class="btn btn-lg btn-infocs p-0" href="#"><?php echo trans('pay-now') ?> <?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?></button>
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
                <div class="tab-pane container <?php if (settings()->stripe_payment == 1 && settings()->paypal_payment == 0){echo "active";}else{echo "fade";} ?>" id="stripe">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <h3 class="mb-0 text-center"><?php echo trans('package-plan') ?>: <?php echo html_escape($package->name);?></h3><br>
                            <div class="text-center mb-20">
                                <?php if (settings()->enable_discount == 1): ?>
                                    <?php if ($billing_type == 'monthly'): ?>
                                        <span class="soft-success dp text-center"><?php echo $package->dis_month ?>% <?php echo trans('off') ?></span>
                                    <?php else: ?>
                                        <span class="soft-success dp text-center"><?php echo $package->dis_year ?>% <?php echo trans('off') ?></span>
                                    <?php endif ?>
                                <?php endif ?><br>
                            </div>

                            <div class="box credit-card-box">
                                <div class="box-header">
                                    <h3 class="box-title flex-parent-between">
                                        <?php echo trans('payment').' '.trans('details') ?>
                                        <span><img class="img-responsive pull-right" width="40%" src="<?php echo base_url('assets/images/accept-cards.jpg') ?>"></span>
                                    </h3>
                                </div>
                                <div class="box-body">
                    
                                    <form role="form" action="<?php echo base_url('auth/stripe_payment') ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo settings()->publish_key; ?>" id="payment-form">
                     
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-12 form-group required'>
                                                <label class='control-label'><?php echo trans('name-on-card') ?></label> 
                                                <input class='form-control' type='text' value="">
                                            </div>
                                        </div>
                     
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-12 form-group card required'>
                                                <label class='control-label'><?php echo trans('card-number') ?></label> <input
                                                    autocomplete='off' class='form-control card-number'
                                                    type='text' value="">
                                            </div>
                                        </div>
                      
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                    type='text' value="">
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'><?php echo trans('expiration').' '.trans('month') ?></label> <input
                                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                                    type='text' value="">
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'><?php echo trans('expiration').' '.trans('year') ?></label> <input
                                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
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
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-info btn-lg payment_btn" type="submit">Pay Now <?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?></button>
                                            </div>
                                        </div>
                                             
                                    </form>
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>
            <?php endif ?>     

            <!-- paypal payment -->
            <?php if (settings()->razorpay_payment == 1 && settings()->rpa_enable == 1): ?>
               
                <?php
                    $productinfo = $package->name;
                    $txnid = time();
                    $price = $price;
                    $surl = $surl;
                    $furl = $furl;        
                    $key_id = settings()->razorpay_key_id;
                    $currency_code = settings()->currency;            
                    $total = ($price * 100); 
                    $amount = $price;
                    $merchant_order_id = $package->id;
                    $card_holder_name = user()->name;
                    $email = user()->email;
                    $phone = user()->phone;
                    $name = settings()->site_name;
                    $return_url = base_url().'addons/razorpay/payment';
                ?>

                <div class="tab-pane container" id="razorpay">
                   <div class="row">
                        <div class="box col-md-6 m-auto">
                            
                            <div class="box-body text-center">
                               
                                <?php if (settings()->enable_discount == 1): ?>
                                    <?php if ($billing_type == 'monthly'): ?>
                                        <span class="soft-success dp"><?php echo $package->dis_month ?>% <?php echo trans('off') ?></span>
                                    <?php else: ?>
                                        <span class="soft-success dp"><?php echo $package->dis_year ?>% <?php echo trans('off') ?></span>
                                    <?php endif ?>
                                <?php endif ?>

                                <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
                                  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                                  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                                  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                                  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
                                  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                                  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                                  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                                  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
                                  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>

                                   <input type="hidden" name="billing_type" value="<?php echo html_escape($billing_type); ?>" readonly>
                                  <!-- csrf token -->
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                </form>

                               
                                <h3 class="mb-0"><?php echo trans('package-plan') ?>: <?php echo html_escape($package->name);?></h3>
                                <p class="lead"><strong><?php echo currency_to_symbol(settings()->currency); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong></p>

                                <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-lg btn-infocs" />

                            </div>

                        </div>
                    </div>
                </div>

                <?php include APPPATH.'views/admin/include/razorpay-js.php'; ?>

                <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                <script>
                  var razorpay_options = {
                    key: "<?php echo $key_id; ?>",
                    amount: "<?php echo $total; ?>",
                    name: "<?php echo $name; ?>",
                    description: "Order # <?php echo $merchant_order_id; ?>",
                    netbanking: true,
                    currency: "<?php echo settings()->currency; ?>",
                    prefill: {
                      name:"<?php echo $card_holder_name; ?>",
                      email: "<?php echo $email; ?>",
                      contact: "<?php echo $phone; ?>"
                    },
                    notes: {
                      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
                    },
                    handler: function (transaction) {
                        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
                        document.getElementById('razorpay-form').submit();
                    },
                    "modal": {
                        "ondismiss": function(){
                            location.reload()
                        }
                    }
                  };
                  var razorpay_submit_btn, razorpay_instance;

                  function razorpaySubmit(el){
                    if(typeof Razorpay == 'undefined'){
                      setTimeout(razorpaySubmit, 200);
                      if(!razorpay_submit_btn && el){
                        razorpay_submit_btn = el;
                        el.disabled = true;
                        el.value = 'Please wait...';  
                      }
                    } else {
                      if(!razorpay_instance){
                        razorpay_instance = new Razorpay(razorpay_options);
                        if(razorpay_submit_btn){
                          razorpay_submit_btn.disabled = false;
                          razorpay_submit_btn.value = "Pay Now";
                        }
                      }
                      razorpay_instance.open();
                    }
                  }  
                </script> -->

            <?php endif ?>   

        </div>
             
    </div>


     
    <div class="container text-center">
        
    </div>

    
  </section>

</div>