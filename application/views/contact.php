<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center">
                <h2><?php echo trans('get-in-touch') ?></h2>
                <form method="post" action="<?php echo base_url('home/send_message'); ?>">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="input-wrp">
                                <input class="textfield textfield--grey" placeholder="<?php echo trans('full-name') ?>" name="name" type="text" />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="input-wrp">
                                <input class="textfield textfield--grey" placeholder="<?php echo trans('email') ?>" name="email" type="email" inputmode="email" x-inputmode="email" required />
                            </div>
                        </div>
                    </div>

                    <label class="input-wrp">
                        <textarea class="textfield textfield--grey" placeholder="<?php echo trans('write-your-message') ?>" name="message" required></textarea>
                    </label>

                    <div class="input-wrp">
                        <?php if ($settings->enable_captcha == 1 && $settings->captcha_site_key != ''): ?>
                            <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape($settings->captcha_site_key); ?>"></div>
                        <?php endif ?>
                    </div>
                    
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button class="btn btn-light-primary btn-block" type="submit" role="button"><?php echo trans('send') ?></button>

                    <div class="formnote"></div>
                </form>
            </div>
            <div class="spacer py-4 d-lg-none"></div>
        </div>
    </div>
</section>