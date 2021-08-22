<div class="content-wrapper">

  <!-- Main content -->
    <section class="content">

      <div class="box list_area">
        <div class="box-header with-border">
            <h3 class="box-title">All Users </h3>
         </div>

       <div class="box-body">

        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive">
          <table class="table table-bordered datatable" id="dg_table">
            <thead>
              <tr>
                <th>#</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Total Views</th>
                <th></th>
                <th>Account type</th>
                <th>Payment status</th>
                <th>Role</th>
                <th>Status</th>
                <th>Join</th>
                <th>Expire</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach ($users as $user): ?>
              <tr id="row_<?php echo html_escape($user->id); ?>">

                <td><?php echo $i; ?></td>
                <td>
                  <?php if ($user->thumb == ''): ?>
                    <?php $avatar = 'assets/images/avatar.png'; ?> 
                  <?php else: ?>
                    <?php $avatar = $user->thumb; ?>
                  <?php endif ?>
                  <img width="40px" class="img-circle" src="<?php echo base_url($avatar); ?>">
                </td>
               
                <td><?php echo html_escape($user->name); ?></td>
                <td><?php echo html_escape($user->hit); ?></td>
                <td><a target="_blank" href="<?php echo base_url('profile/'.$user->slug) ?>"><span class="label label-default"><i class="icon-eye"></i> View profile</span></a></td>

                <td>
                  <span class="label label-<?php if($user->account_type == 'free'){echo "info";}else{echo "warning";} ?>">
                    <?php echo html_escape($user->account_type); ?>
                  </span>
                </td>
                <td><span class="label label-info"><?php echo html_escape($user->payment_status); ?></span></td>

                <td>
                  <?php if ($user->role == 'admin'): ?>
                    <span class="label label-primary"><i class="fa fa-user"></i> Admin</span>
                  <?php endif ?>
                  <?php if ($user->role == 'user'): ?>
                    <span class="label label-success"><i class="fa fa-user-o"></i> User</span>
                  <?php endif ?>
                </td>
                <td>
                  <?php if ($user->status == 1): ?>
                    <span class="label label-info">Active</span>
                  <?php else: ?>
                    <span class="label label-danger">Inactive</span>
                  <?php endif ?>
                </td>

                <td>
                  <?php echo get_time_ago($user->created_at) ?>
                </td>
                <td>
                  <span class="label label-warning"><b><?php echo date_difference($user->created_at); ?></b> days left</span>
                </td>

                <td class="actions">
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>

                    <ul class="dropdown-menu custom-dw" role="menu">

                      <?php if ($user->status == 1): ?>
                        <li><a href="<?php echo base_url('admin/users/status_action/2/'.$user->id) ?>"><i class="fa fa-times"></i> Deactive</a></li>
                      <?php endif ?>
                      <?php if ($user->status == 2 || $user->status == 0): ?>
                        <li><a href="<?php echo base_url('admin/users/status_action/1/'.$user->id) ?>"><i class="fa fa-check"></i> Active</a></li>
                      <?php endif ?>

                      <li><a href="#roleModal_<?php echo html_escape($user->id);?>" data-toggle="modal"><i class="fa fa-circle"></i> Change Account</a></li>

                      <li><a href="<?php echo base_url('admin/users/edit/'.$user->id);?>" class="on-defaults remove-row"><i class="fa fa-pencil"></i> Edit</a></li>

                      <li><a data-val="User" data-id="<?php echo html_escape($user->id); ?>" href="<?php echo base_url('admin/users/delete/'.$user->id);?>" class="on-defaults remove-row delete_item"><i class="fa fa-trash-o"></i> Delete</a></li>

                    </ul>
                  </div>
                </td>

              </tr>

              <?php $i++; endforeach; ?>
            </tbody>
          </table>
        </div>

        </div>

        <div class="box-footer">

        </div>
      </div>

    </section>
</div>



<?php foreach ($users as $user): ?>

  <div id="roleModal_<?php echo html_escape($user->id) ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <form method="post" action="<?php echo base_url('admin/users/change_account/'.html_escape($user->id))?>" role="form">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select account type</h4>
        </div>

        <div class="modal-body">
          
              <div class="form-group m-t-20">
                  <div class="radio radio-info radio-inline">
                      <input <?php if($user->account_type == 'free'){echo "checked";} ?> type="radio" id="inlineRadio3" value="free" name="type">
                      <label for="inlineRadio3"> Free </label>
                  </div>
                 <div class="radio radio-info radio-inline">
                      <input <?php if($user->account_type == 'pro'){echo "checked";} ?> type="radio" id="inlineRadio4" value="pro" name="type">
                      <label for="inlineRadio4"> Pro </label>
                  </div>
              </div>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

      </form>

    </div>
  </div>

<?php endforeach ?>