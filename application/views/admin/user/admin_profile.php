<!-- Start content -->
<div class="content">
  <div class="container">

    <!-- breadcrumb -->
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Profile</li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-sm-12 col-md-offset-3">
        <div class="text-center card-box" style="min-height: 377px;">
            <div class="dropdown pull-right">
              <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                <i class="zmdi zmdi-more-vert"></i>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="<?php echo base_url('admin/admin_users/edit/'.$user->id) ?>"><i class="fa fa-pencil"></i> Edit</a></li>
              </ul>
            </div>
          <div>

            <?php if ($user->thumb == ''): ?>
                <?php $avatar = 'assets/images/avatar.png'; ?> 
            <?php else: ?>
                <?php $avatar = $user->thumb; ?>
            <?php endif ?>

            <img src="<?php echo base_url($avatar) ?>" class="img-circle thumb-xl img-thumbnail m-b-10" alt="profile-image">


            <h5>
              <?php echo html_escape($user->name); ?>
            </h5>
            <p>
                <?php if ($user->role == 'admin'): ?>
                    <span class="label label-primary"> Admin</span>
                <?php endif ?>
                <?php if ($user->role == 'supervisor'): ?>
                    <span class="label label-info"> Supervisor</span>
                <?php endif ?>
            </p>
            <p class="font-13"><span class="m-l-15"><?php echo html_escape($user->email); ?></span></p>
            
            <p class="font-13">
                <strong>Status: </strong>
                <?php if ($user->status == 1): ?>
                    <i class="fa fa-check"></i> Active
                <?php else: ?>
                    <i class="fa fa-times"></i> Inactive
                <?php endif ?>
            </p>

            <p class="font-16 m-b-30">
              Member Since: <?php echo my_date_show($user->created_at); ?>
            </p>

            <div class="pull-right">
              <a href="<?php echo base_url('admin/admin_users') ?>">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
              </a>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>

</div>