<div class="content-wrapper">
  <section class="content container">
    
      <div class="nav-tabs-custom">
        
          <?php include"include/profile_menu.php"; ?>

          <div class="row m-5 mt-20">
            <div class="col-md-8 box">
              
              <div class="box-header">
                  <h3 class="box-title"><?php echo trans('change-password') ?></h3>
              </div>

              <div class="box-body p-10">

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
      </div>

  </section>
</div>