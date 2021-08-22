<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">


  <div class="row mt-20">
    
    <div class="col-md-12">
      <form method="post" action="<?php echo base_url('admin/payment/user_update') ?>" role="form" class="form-horizontal">
        <div class="row">

          <?php if (settings()->rpa_enable == 1): ?>
          <div class="col-sm-4">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title d-block">Razorpay <span class="addons_badge"><?php echo trans('addon') ?></span> <span class="pull-right"><input type="checkbox" name="razorpay_payment" value="1" <?php if(user()->razorpay_payment == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"></span></h3>
              </div>

              <div class="box-body">
                  <div class="form-group mt-20">
                      <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('key-id') ?> </label>
                      <div class="col-sm-12">
                        <input type="text" name="razorpay_key_id" value="<?php echo html_escape(user()->razorpay_key_id); ?>" class="form-control" >
                      </div>
                  </div>

                  <div class="form-group mt-20">
                      <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('key-secret') ?> </label>
                      <div class="col-sm-12">
                        <input type="text" name="razorpay_key_secret" value="<?php echo html_escape(user()->razorpay_key_secret); ?>" class="form-control" >
                      </div>
                  </div>
              </div>

            </div>
          </div>
          <?php endif; ?>

          <div class="col-sm-4">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title d-block"><?php echo trans('stripe-payment') ?> <span class="pull-right"><input type="checkbox" name="stripe_payment" value="1" <?php if(user()->stripe_payment == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"></span></h3>
              </div>

              <div class="box-body">
                  <div class="form-group mt-20">
                      <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('publish-key') ?> </label>
                      <div class="col-sm-12">
                        <input type="text" name="publish_key" value="<?php echo html_escape(user()->publish_key); ?>" class="form-control" >
                      </div>
                  </div>

                  <div class="form-group mt-20">
                      <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('secret-key') ?> </label>
                      <div class="col-sm-12">
                        <input type="text" name="secret_key" value="<?php echo html_escape(user()->secret_key); ?>" class="form-control" >
                      </div>
                  </div>
              </div>

            </div>
          </div>

          <div class="col-sm-4">
            <div class="box">
              
              <div class="box-header with-border">
                <h3 class="box-title d-block"><?php echo trans('paypal-payment') ?> <span class="pull-right"><input type="checkbox" name="paypal_payment" value="1" <?php if(user()->paypal_payment == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"></span></h3>
              </div>

              <div class="box-body">
                  <div class="form-group">
                      <label class="col-sm-6 control-label" for="example-input-normal"><?php echo trans('paypal-merchant-account') ?></label>
                      <div class="col-sm-12">
                          <input type="text" name="paypal_email" value="<?php echo html_escape(user()->paypal_email); ?>" class="form-control" >
                      </div>
                  </div>
              </div>

            </div>
          </div>

        </div>

        <!-- csrf token -->
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

        <div class="div">
          <button type="submit" class="btn btn-info btn-lgs waves-effect w-md waves-light m-b-5"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
        </div>

      </form>
    </div>

  </div>
 
  </section>
</div>
