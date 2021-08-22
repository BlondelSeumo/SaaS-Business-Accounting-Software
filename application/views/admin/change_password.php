<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">


    <div class="row">

      <div class="col-md-8">
        <div class="box">

          <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('change-password') ?></h3>
          </div>

          <?php if (auth('role') == 'admin' || auth('role') == 'user'): ?>
            <form method="post" id="cahage_pass_form" action="<?php echo base_url('admin/dashboard/change') ?>">
          <?php else: ?>
            <form method="post" id="cahage_pass_form" action="<?php echo base_url('admin/profile/change') ?>">
          <?php endif ?>

            <div class="col-md-12 mt-20">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label><?php echo trans('old-password') ?></label>
                    <input type="password" class="form-control" name="old_pass" />
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label><?php echo trans('new-password') ?></label>
                    <input type="password" class="form-control" name="new_pass" />
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label><?php echo trans('confirm-new-password') ?></label>
                    <input type="password" class="form-control" name="confirm_pass" />
                  </div>
                </div>

                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                <div class="col-sm-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-info"><?php echo trans('change') ?></button>
                  </div>
                </div>

              </div>
            </div>

          </form>
          
        </div>
      </div>

    </div>

    
  </section>

</div>