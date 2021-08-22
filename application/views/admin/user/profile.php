<div class="content-wrapper">
  <section class="content container">
    
    <?php if(auth('role') == 'user'){$action = 'update';}else{$action = 'update_role';} ?>
    
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/profile/'.$action) ?>" role="form" class="form-horizontal">
        <div class="nav-tabs-custom">
          
            <?php include"include/profile_menu.php"; ?>

            <div class="row m-5 mt-20">
              <div class="col-md-8 box">
                
                <div class="box-header">
                    <h3 class="box-title"><?php echo trans('personal-information') ?></h3>
                </div>

                <div class="box-body p-10">

                    <div class="form-group">
                        <div class="avatar-upload text-center">
                              <div class="avatar-edit">
                                  <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                  <label for="imageUpload"></label>
                              </div>
                              <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url(<?php echo base_url($user->thumb); ?>);">
                                </div>
                              </div>
                        </div>
                    </div>

                    <div class="form-group m-t-20">
                        <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('name') ?></label>
                        <div class="col-sm-12">
                            <input type="text" name="name" value="<?php echo html_escape($user->name); ?>" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group m-t-20">
                        <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('email') ?></label>
                        <div class="col-sm-12">
                            <input type="text" name="email" value="<?php echo html_escape($user->email); ?>" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal"><?php echo trans('country') ?></label>
                        <div class="col-sm-12">
                            <select class="form-control single_select" name="country">
                              <option value="0"><?php echo trans('select') ?></option>
                              <?php foreach ($countries as $country): ?>
                                  <option value="<?php echo html_escape($country->id); ?>" 
                                    <?php echo ($user->country == $country->id) ? 'selected' : ''; ?>>
                                    <?php echo html_escape($country->name); ?>
                                  </option>
                              <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal"><?php echo trans('city') ?></label>
                        <div class="col-sm-12">
                            <input type="text" name="city" class="form-control" value="<?php echo html_escape($user->city); ?>">
                        </div>
                    </div>

                    <?php if (auth('role') == 'user'): ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal"><?php echo trans('state') ?></label>
                        <div class="col-sm-12">
                            <input type="text" name="state" class="form-control" value="<?php echo html_escape($user->state); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal"><?php echo trans('postcode') ?></label>
                        <div class="col-sm-12">
                            <input type="text" name="postcode" class="form-control" value="<?php echo html_escape($user->postcode); ?>">
                        </div>
                    </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="example-input-normal"><?php echo trans('adderss') ?></label>
                        <div class="col-sm-12">
                            <input type="text" name="address" class="form-control" value="<?php echo html_escape($user->address); ?>">
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info waves-effect rounded w-md waves-light"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
                </div>

              </div>
            </div>
        </div>
    </form>
  </section>
</div>