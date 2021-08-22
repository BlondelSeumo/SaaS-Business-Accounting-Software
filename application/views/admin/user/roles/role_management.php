<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="nav-tabs-custom">
      <?php $this->load->view("admin/user/include/profile_menu"); ?>
    </div>

    <?php $success = $this->session->flashdata('msg'); ?>
    <?php if (isset($success)): ?>
    <div class="row">
        <div class="col-md-6 m-15">
          <div class="alert alert-info alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-top: -8px">&times;</a>
            <strong>Invitation send Successfully!</strong> Default user password is: 1234
          </div>
        </div>
    </div>
    <?php endif ?>

    <div class="bus_area">
      <div class="box m-10 add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?> ">
        
        <div class="box-header with-border">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title"><?php echo trans('edit') ?></h3>
          <?php else: ?>
            <h3 class="box-title"> <?php echo trans('add-new-user') ?> </h3>
          <?php endif; ?>

          <div class="box-tools pull-right">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <a href="<?php echo base_url('admin/role_management') ?>" class="pull-right rounded btn btn-default btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
            <?php else: ?>
              <a href="#" class="text-right rounded btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
            <?php endif; ?>
          </div>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/role_management/add')?>" role="form" novalidate>

            <div class="row">
              <div class="col-md-6 mr-auto">
                  
                  <div class="form-group">
                    <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="name" value="<?php echo html_escape($user[0]['name']); ?>">
                  </div>

                  <div class="form-group">
                    <label><?php echo trans('email') ?></label>
                    <input type="text" class="form-control" name="email" value="<?php echo html_escape($user[0]['email']); ?>">
                  </div>

                  <div class="form-group">
                      <label><?php echo trans('position-at-the-business') ?></label>
                      <select class="selectfield textfield--grey form-control col-sm-12" name="position" required style="width: 100%">
                          <?php $p=1; foreach (get_business_position() as $position): ?>
                              <option value="<?php echo html_escape($p); ?>" <?php if($user[0]['position'] == $p){echo "selected";} ?>>
                                  <?php echo html_escape($position); ?>
                              </option>
                          <?php $p++; endforeach ?>
                      </select>
                  </div>

                  <div class="form-group">
                      <label><?php echo trans('user-role') ?></label><br>

                      <input type="radio" id="md_radio_1" class="filled-in chk-col-blue user_role" value="subadmin" name="role" <?php if($user[0]['role'] == 'subadmin'){echo "checked";} ?>>
                      <label for="md_radio_1"> <?php echo trans('admin') ?></label><br>

                      <input type="radio" id="md_radio_2" class="filled-in chk-col-blue user_role" value="editor" name="role" <?php if($user[0]['role'] == 'editor'){echo "checked";} ?>>
                      <label for="md_radio_2"> <?php echo trans('editor') ?></label><br>

                      <input type="radio" id="md_radio_3" class="filled-in chk-col-blue user_role" value="viewer" name="role" <?php if($user[0]['role'] == 'viewer'){echo "checked";} ?>>
                      <label for="md_radio_3"> <?php echo trans('viewer') ?></label><br>
                  </div>
              </div>  

              <div class="col-md-5">
                  <div class="right_role_area mt-20 pl-20">
                    
                      <div class="role_area_subadmin">
                        <h5 class="mb-0"><?php echo trans('admin-permissions') ?></h5>
                        <p class="text-muted"><?php echo trans('admin-permissions-info') ?></p>
                        <ul class="list-group list-group-flush">
                          <?php foreach ($features as $feature): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center pl-0 pr-0">
                              <?php echo html_escape($feature->name) ?>
                              <?php if (check_role_assign_features('subadmin', $feature->id) == 1): ?>
                                <span class="badge badge-default bg-success text-white"><i class="fa fa-check"></i> <?php echo trans('full-access') ?></span>
                              <?php else: ?>
                                <span class="badge badge-default"><i class="icon-lock"></i> <?php echo trans('no-access') ?></span>
                              <?php endif ?>
                            </li>
                          <?php endforeach ?>
                        </ul>
                      </div>

                      <div class="role_area_editor" style="display: none;">
                        <h5 class="mb-0"><?php echo trans('editor-permissions') ?></h5>
                        <p class="text-muted"><?php echo trans('editor-permissions-info') ?></p>
                        <ul class="list-group list-group-flush">
                          <?php foreach ($features as $feature): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center pl-0 pr-0">
                              <?php echo html_escape($feature->name) ?>

                              <?php if (check_role_assign_features('editor', $feature->id) == 1): ?>
                                <span class="badge badge-default bg-success text-white"><i class="fa fa-check"></i> <?php echo trans('full-access') ?></span>
                              <?php else: ?>
                                <span class="badge badge-default"><i class="icon-lock"></i> <?php echo trans('no-access') ?></span>
                              <?php endif ?>
                      
                            </li>
                          <?php endforeach ?>
                        </ul>
                      </div>

                      <div class="role_area_viewer" style="display: none;">
                        <h5 class="mb-0"><?php echo trans('viewer-permissions') ?></h5>
                        <p class="text-muted"><?php echo trans('viewer-permissions-info') ?></p>
                        <ul class="list-group list-group-flush">
                          <?php foreach ($features as $feature): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center pl-0 pr-0">
                              <?php echo html_escape($feature->name) ?>
                              <span class="badge badge-default"><i class="icon-eye"></i> <?php echo trans('view-only') ?></span>
                            </li>
                          <?php endforeach ?>
                        </ul>
                      </div>

                  </div>
              </div>  
            </div>


            <input type="hidden" name="id" value="<?php echo html_escape($user['0']['id']); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row mt-10">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> <?php echo trans('save-changes') ?></button>
                <?php else: ?>
                  <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> <?php echo trans('save') ?></button>
                <?php endif; ?>
              </div>
            </div>

          </form>
        </div>
      </div>

     


      <?php if (isset($page_title) && $page_title != "Edit"): ?>
        <div class="list_area container">
        
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/role_management') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
          <?php else: ?>
            <h3 class="box-title"><?php echo $this->business->name ?> <?php echo trans('users') ?> 
            <?php if (auth('role') == 'user'): ?>
              <a href="#" class="pull-right btn btn-info rounded btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-user') ?> <?php echo trans('') ?></a>
            <?php endif; ?>
            </h3>
          <?php endif; ?>

            <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
                  <table class="table table-hover cushover <?php if(count($users) > 10){echo "datatable";} ?>" id="dg_table">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th><?php echo trans('users') ?></th>
                              <th><?php echo trans('permissions') ?></th>
                              <?php if (auth('role') == 'user'): ?>
                                <th><?php echo trans('action') ?></th>
                              <?php endif; ?>
                          </tr>
                      </thead>
                      <tbody>

                        <?php if (auth('role') != 'user'): ?>
                          <tr>
                              <td></td>
                              <td>
                                <h3 class="mt-0 mb-0"><?php echo get_by_id($this->business->user_id, 'users')->name; ?></h3>
                              </td>

                              <td>
                                <h4 class="mb-0"><?php echo trans('owner') ?></h4>
                              </td>

                              <?php if (auth('role') == 'user'): ?>
                                <td class="actions" width="15%">
                                  <a href="<?php echo base_url('admin/role_management/edit/'.html_escape($user->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>

                                  <a data-id="<?php echo html_escape($user->id); ?>" href="<?php echo base_url('admin/role_management/delete/'.html_escape($user->id));?>" class="on-default edit-row delete_item" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                              <?php endif ?>
                          </tr>
                        <?php endif ?>

                        <?php $i=1; foreach ($users as $user): ?>
                          <tr id="row_<?php echo html_escape($user->id); ?>">
                              
                              <td><?php echo $i;?> </td>
                             
                              <td>
                                <h3 class="mt-0 mb-0"><?php echo html_escape($user->name); ?></h3>
                                <p class="mb-0"><?php echo html_escape($user->email); ?></p>
                                <p class="mb-0"><?php echo trans('joined') ?>: <strong><?php echo my_date_show($user->created_at); ?></strong></p>
                              </td>

                              <td>
                                <h4 class="mb-0"><?php echo get_role_name($user->role); ?></h4>
                                <p class="mb-0"><?php echo get_business_position($user->position); ?></p>
                              </td>

                              <?php if (auth('role') == 'user'): ?>
                                <td class="actions" width="15%">
                                  <a href="<?php echo base_url('admin/role_management/edit/'.html_escape($user->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>

                                  <a data-id="<?php echo html_escape($user->id); ?>" href="<?php echo base_url('admin/role_management/delete/'.html_escape($user->id));?>" class="on-default edit-row delete_item" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                              <?php endif ?>
                          </tr>
                          
                        <?php $i++; endforeach; ?>
                      </tbody>
                  </table>
              </div>


        </div>
      <?php endif; ?>
    </div>

  </section>
</div>