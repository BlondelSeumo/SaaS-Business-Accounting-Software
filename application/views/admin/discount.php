
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="row">

      <div class="col-md-5 m-auto">
        <div class="box mt-50">
          
          <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/discount/update')?>" role="form" novalidate>

            <div class="box-header with-border">
              <h3 class="box-title"><?php echo trans('discount') ?> <span class="pull-right"><input type="checkbox" name="enable_discount" value="1" <?php if(settings()->enable_discount == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"></span></h3>
            </div>

            <div class="box-body mt-20">

                <?php foreach ($packages as $package): ?>
                  <div class="row p-5">

                    <div class="col-md-3 exlh text-right">
                      <h5><?php echo html_escape($package->name) ?></h5>
                    </div>

                    <div class="col-md-4 form-group">
                      <label><?php echo trans('monthly') ?> <i class="fa fa-percent" aria-hidden="true"></i></label>
                      <input type="number" class="form-control" name="monthly[]) ?>" value="<?php echo html_escape($package->dis_month) ?>">
                    </div>

                    <div class="col-md-4 form-group">
                      <label><?php echo trans('yearly') ?> <i class="fa fa-percent" aria-hidden="true"></i></label>
                      <input type="number" class="form-control" name="yearly[] ?>" value="<?php echo html_escape($package->dis_year) ?>">
                    </div>

                  </div>
                <?php endforeach ?>

                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                <div class="row m-t-30">
                  <div class="col-sm-11">
                      <button type="submit" class="btn btn-info rounded pull-right mt-20"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
                  </div>
                </div>

            </div>

          </form>

        </div>
      </div>

    </div>

  </section>
</div>

