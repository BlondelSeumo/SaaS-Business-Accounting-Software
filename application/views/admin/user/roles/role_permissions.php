<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="nav-tabs-custom">
      <?php $this->load->view("admin/user/include/profile_menu"); ?>
    </div>

    <div class="bus_area">
      <div class="box m-10 add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "block";} ?> ">
        
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo trans('role-permissions') ?> </h3>
        </div>

        <div class="box-body">
          <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/role_management/update_permissions')?>" role="form" novalidate>

            <div class="row">
              <?php for ($i=1; $i <= 3; $i++) { ?>
                <div class="col-md-4">
                  <p class="mb-20 mt-10 fs-20">
                      <?php if ($i==1) {
                        echo trans('admin'); $j=10;
                        $value = 'subadmin';
                      }else if ($i==2) {
                        echo trans('editor'); $j=32;
                        $value = 'editor';
                      }else {
                        echo trans('viewer'); $j=50;
                        $value = 'viewer';
                      }
                      ?>
                  </p> 

                  <div class="permission_list">
                      <?php $f=4; foreach ($features as $feature): ?>
                        <div class="form-group">
                          <input type="checkbox" id="md_checkbox_<?php echo $f*$j; ?>" class="filled-in chk-col-blue view_only_<?php echo $i; ?>" value="<?php echo $feature->id; ?>" name="features_<?php echo $i; ?>[]" <?php if(check_role_assign_features($value, $feature->id) == 1){echo "checked";} ?> <?php if($i == 3){echo "disabled";} ?>>
                          <label for="md_checkbox_<?php echo $f*$j; ?>"> <?php echo html_escape($feature->name); ?></label>
                        </div>
                      <?php $f++; endforeach ?>
                  </div>  
                </div>  
              <?php } ?>
            </div>


            <input type="hidden" name="id" value="<?php echo html_escape($user['0']['id']); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row mt-10">
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> <?php echo trans('update') ?></button>
              </div>
            </div>

          </form>
        </div>
      </div>

    </div>

  </section>
</div>