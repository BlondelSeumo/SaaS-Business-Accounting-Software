<section class="section">
    <div class="container">
        <div class="row justify-content-center">

            <?php if (isset($user) && $user->approve == 1): ?>
                <div class="spacer py-8"></div>
                <div class="col-12 col-md-6 text-center minh-500 pt-6 pb-6">
                    <i class="icon-close text-danger fa-3x"></i>
                    <h3 class="text-danger"><?php echo trans('oops-invalid-invitation') ?></h3>
                    <p><?php echo trans('this-invitation-to-collaborate-in') ?> <strong><?php echo html_escape(settings()->site_name) ?></strong> <?php echo trans('is-expired-or-has-been-already-used') ?></p>
                </div>
                <div class="spacer py-8"></div>
            <?php else: ?>
                <div class="col-12 col-md-6 text-center">
                    <img class="mb-1" src="<?php echo base_url('assets/images/user.png') ?>">
                    <h3><?php echo trans('accept-invitation') ?></h3>
                    <p><?php echo trans('setup-your-password-to-collaborate') ?> <?php echo html_escape(settings()->site_name) ?></p>

                    <form method="post" action="<?php echo base_url('auth/invitation/'.$user_id); ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-wrp">
                                    <input class="textfield textfield--grey" placeholder="<?php echo trans('password') ?>" required name="password" type="text" />
                                </div>
                            </div>
                        </div>
                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <button class="btn btn-primary btn-block" type="submit" role="button"><?php echo trans('continue') ?> <i class="fa fa-long-arrow-right"></i></button>

                        <div class="formnote"></div>
                    </form>
                </div>
            <?php endif ?>

            <div class="spacer py-6"></div>
        </div>
    </div>
</section>

