<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="col-md-8">

      <div class="box add_area">
        <div class="box-header with-border">
          <h3 class="box-title">Edit User</h3>

          <div class="box-tools pull-right">
              <a href="<?php echo base_url('admin/users') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          </div>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/users/edit')?>" role="form" novalidate>

            <div class="form-group">
              <label>Name </label>
              <input type="text" class="form-control" required name="name" value="<?php echo html_escape($user->name); ?>" >
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" required name="email" value="<?php echo html_escape($user->email); ?>" >
            </div>

            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" name="phone" value="<?php echo html_escape($user->phone); ?>" >
            </div>

            <div class="form-group">
              <label>Designation</label>
              <input type="text" class="form-control" name="designation" value="<?php echo html_escape($user->designation); ?>" >
            </div>

            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" name="address"><?php echo html_escape($user->address); ?></textarea>
            </div>

            <div class="form-group m-t-20">
              <label>Account type</label>
                <div class="radio radio-info radio-inline">
                    <input <?php if($user->account_type == 'free'){echo "checked";} ?> type="radio" id="inlineRadio3" value="free" name="type">
                    <label for="inlineRadio3"> Free </label>
                </div>
               <div class="radio radio-info radio-inline">
                    <input <?php if($user->account_type == 'pro'){echo "checked";} ?> type="radio" id="inlineRadio4" value="pro" name="type">
                    <label for="inlineRadio4"> Pro </label>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <hr>

            <div class="row m-t-30">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-info pull-left">Save Changes</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-info pull-left"> Save Category</button>
                <?php endif; ?>
              </div>
            </div>

          </form>

        </div>

        <div class="box-footer">

        </div>
      </div>

    </div>

  </section>
</div>
