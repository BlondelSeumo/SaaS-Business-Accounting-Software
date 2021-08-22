<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container mt-300 mb-20">
        <div class="text-center m-auto">
            <div class="alert alert-info p-20">
              <strong><i class="fa fa-question-circle"></i> <?php echo trans('are-you-sure') ?> <?php echo trans('upgrade').' '.trans('package') ?></strong>
            </div>
            <a class="btn btn-default" href="<?php echo base_url('admin/subscription/upgrade/'.$slug.'/'.$billing_type.'/1') ?>"><?php echo trans('yes').' '.trans('continue') ?> <i class="fa fa-long-arrow-right"></i></a>
        </div>
    </div>
  </section>
</div>