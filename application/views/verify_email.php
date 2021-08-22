
<section class="section p-0 mt-100">
    <div class="container">
        
        <div class="spacer py-6"></div>

        <div class="row">
            <?php if (empty($code)): ?>
                <div class="col-md-12 text-center">
                    <h2 class="text-warning mb-0"><i class="icon-info"></i></h2>
                    <h3 class="mt-0 text-warning"><?php echo trans('verify-account') ?></h3>
                    <p class="mt-2"><?php echo trans('verify-acc-msg') ?></p>
                </div>
            <?php else: ?>
                <?php if ($code == 'invalid'): ?>
                    <div class="col-md-12 text-center">
                        <h1 class="text-danger mb-5"><i class="icon-close"></i></h1>
                        <h3 class="mt-5 text-danger"><?php echo trans('error') ?></h3>
                        <p class="mt-2"><?php echo trans('verify-failed') ?></p>
                        <a class="btn btn-primary btn-block" href="<?php echo base_url() ?>"><?php echo trans('back-home') ?></a>
                    </div>
                <?php else: ?>
                    <div class="col-md-12 text-center">
                        <h1 class="text-success"><i class="icon-check"></i></h1>
                        <h3 class="mb-0"><?php echo trans('congratulations') ?></h3>
                        <p class="mt-2"><?php echo trans('verify-success') ?></p>
                        <a class="btn btn-primary btn-block" href="<?php echo base_url('admin/dashboard/business') ?>"><?php echo trans('continue') ?></a>
                    </div>
                <?php endif ?>
            <?php endif ?>
        </div>

        <div class="spacer py-4"></div>

    </div>
</section>

