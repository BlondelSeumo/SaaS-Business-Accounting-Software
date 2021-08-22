<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row mt-20">
      <div class="col-md-8">
        <form method="post" action="<?php echo base_url('admin/payment/update') ?>" role="form" class="form-horizontal">
          <div class="row">
            <div class="col-sm-12">
              <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><i class="ficon flaticon-favorites"></i> <?php echo trans('addons') ?></h3>
                  </div>

                  <div class="box-body">
                    <div class="addon-items mt-20">
                      <div class="flex-parent-between">
                        <div>
                          <?php if (settings()->rpa_enable == 1): ?>
                            <p class="fs-20 mb-0"><i class="fa fa-check-circle text-success"></i> Razorpay Payment Gateway</p>
                          <?php else: ?>
                            <p class="fs-20 mb-0"><i class="fa fa-circle text-muted"></i> Razorpay Payment Gateway</p>
                          <?php endif ?>
                        </div>
                        <div>
                          <?php if (settings()->rpa_enable == 1): ?>
                            <a class="btn btn-success cusbtn" href="#" disabled="disabled"><i class="fa fa-check-circle"></i> Installed </a>
                          <?php else: ?>
                              <a class="btn btn-info cusbtn" href="<?php echo base_url('addons/razorpay/activate') ?>"><i class="fa fa-cog"></i> Install</a>
                          <?php endif ?>
                        </div>
                      </div>
                       
                    </div>
                  </div>

              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>