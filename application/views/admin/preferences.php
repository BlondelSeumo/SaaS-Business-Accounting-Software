<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">
      <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo trans('preferences') ?></h3>
            </div>

            <div class="box-body">

              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_preferences') ?>" role="form" class="form-horizontal">

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('enable-frontend') ?> 
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('enable-frontend-info') ?> </small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_frontend" value="1" <?php if(settings()->enable_frontend == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"> 
                  </div>

                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('enable-multilingual') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('enable-multilingual-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_multilingual" value="1" <?php if(settings()->enable_multilingual == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5">Google reCaptcha
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('enable-captcha-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_captcha" value="1" <?php if(settings()->enable_captcha == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('registration-system') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('registration-system-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_registration" value="1" <?php if(settings()->enable_registration == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('email-verification') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('email-verification-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_email_verify" value="1" <?php if(settings()->enable_email_verify == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('enable-payment') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('enable-payment-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_paypal" value="1" <?php if(settings()->enable_paypal == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('delete').' '.trans('invoice') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('delete-invoice-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_delete_invoice" value="1" <?php if(settings()->enable_delete_invoice == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('discount') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('discount-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_discount" value="1" <?php if(settings()->enable_discount == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('blogs') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('blogs-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_blog" value="1" <?php if(settings()->enable_blog == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <div class="form-group flex-parent-between mb-20">
                  <label class="mt-5"><?php echo trans('faqs') ?>
                    <br><small class="fs-14 text-muted"><i class="fa fa-info-circle"></i> <?php echo trans('faqs-info') ?></small>
                  </label>
                  <div class="switch">
                    <input type="checkbox" name="enable_faq" value="1" <?php if(settings()->enable_faq == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100">
                  </div>
                </div>

                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <button type="submit" class="btn btn-info btn-md btn-block mt-20 waves-effect w-md waves-light m-b-5"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
              </form>

            </div>
          </div>
      </div>
  </section>
</div>
