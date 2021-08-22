<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="nav-tabs-custom">
      <?php include"include/profile_menu.php"; ?>
    </div>

    <div class="bus_area">
      <div class="col-md-8 box m-10 add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?> ">
        <div class="box-header with-border">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <h3 class="box-title"><?php echo trans('edit-business') ?></h3>
          <?php else: ?>
            <h3 class="box-title"><?php echo trans('add-new-business') ?> </h3>
          <?php endif; ?>

          <div class="box-tools pull-right">
            <?php if (isset($page_title) && $page_title == "Edit"): ?>
              <a href="<?php echo base_url('admin/business') ?>" class="pull-right rounded btn btn-default btn-sm"><i class="fa fa-angle-left"></i> Back</a>
            <?php else: ?>
              <a href="#" class="text-right rounded btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
            <?php endif; ?>
          </div>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/business/add')?>" role="form" novalidate>

            <div class="form-group">
              <div class="avatar-uploadb text-center">
                    <div class="avatar-edit">
                        <input type='file' name="photo1" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <?php if (isset($page_title) && $page_title == "Edit"): ?>
                          <div id="imagePreview" style="background-image: url(<?php echo base_url($busines[0]['logo']); ?>);">
                          </div>
                        <?php else: ?>
                          <div id="imagePreview">
                          <p class="upload-text"><i class="fa fa-plus"></i> <br> <?php echo trans('upload-business-logo') ?></p>
                          </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
              <input type="text" class="form-control" required name="name" value="<?php echo html_escape($busines[0]['name']); ?>" >
            </div>

            <div class="form-group">
              <label><?php echo trans('title') ?></label>
              <input type="text" class="form-control" name="title" value="<?php echo html_escape($busines[0]['title']); ?>" >
            </div>

            <div class="form-group">
              <label><?php echo trans('business').' '.trans('number') ?></label>
              <input type="text" class="form-control" name="biz_number" value="<?php echo html_escape($busines[0]['biz_number']); ?>" >
            </div>

            <div class="form-group">
              <label><?php echo trans('tax').'/vat '.trans('number') ?></label>
              <input type="text" class="form-control" name="vat_code" value="<?php echo html_escape($busines[0]['vat_code']); ?>" >
            </div>

            <div class="form-group">
              <label><?php echo trans('phone') ?>, <?php echo trans('address') ?></label>
              <textarea id="ckEditor" class="form-control" name="address"><?php echo html_escape($busines[0]['address']); ?></textarea>
            </div>

            <div class="form-group">
                <select class="selectfield textfield--grey single_select col-sm-12 single_select" name="category" required style="width: 100%">
                    <option value=""><?php echo trans('select-business-category') ?></option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo html_escape($category->id); ?>" <?php if($category->id == $busines[0]['category']){echo "selected";} ?>>
                            <?php echo html_escape($category->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <?php if (isset($page_title) && $page_title != "Edit"): ?>
            <div class="form-group">
                <select class="selectfield textfield--grey single_select col-sm-12 single_select" id="country" name="country" style="width: 100%">
                    <option value=""><?php echo trans('select-country') ?></option>
                    <?php foreach ($countries as $country): ?>
                        <option value="<?php echo html_escape($country->id); ?>" <?php if($country->id == $busines[0]['country']){echo "selected";} ?>>
                            <?php echo html_escape($country->name); ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <?php endif; ?>

            <div class="form-group" id="currency">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <p><?php echo html_escape($busines[0]['currency_code']) ?> - <?php echo html_escape($busines[0]['currency_name']) ?> (<?php echo html_escape($busines[0]['currency_symbol']) ?>)</p>
                <?php endif; ?>
            </div>
            <p class="info callout callout-default">
              <?php echo trans('currency-notice') ?>
            </p>

            <input type="hidden" name="id" value="<?php echo html_escape($busines['0']['id']); ?>">
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
            <h3 class="box-title"><?php echo trans('edit-business') ?> <a href="<?php echo base_url('admin/business') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
          <?php else: ?>
            <h3 class="box-title"><?php echo trans('business') ?> <a href="#" class="pull-right btn btn-info rounded btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-business') ?></a></h3>
          <?php endif; ?>

            <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
                  <table class="table table-hover cushover <?php if(count($business) > 10){echo "datatable";} ?>" id="dg_table">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th><?php echo trans('logo') ?></th>
                              <th><?php echo trans('informations') ?></th>
                              <th></th>
                              <th><?php echo trans('action') ?></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($business as $busines): ?>
                          <tr id="row_<?php echo html_escape($busines->id); ?>">
                              
                              <td><?php echo $i; ?></td>
                              <td>
                                <?php if (!empty($busines->logo)): ?>
                                <img width="60px" class="img-thumbnails" src="<?php echo base_url($busines->logo); ?>">
                                <?php endif ?>
                              </td>
                              <td>
                                <h3 class="mt-0 mb-0"><?php echo html_escape($busines->name); ?></h3>
                                <p class="mb-0">Category: <strong><?php echo html_escape($busines->category_name) ?></strong></p>
                                <p class="mb-0"><?php echo html_escape($busines->currency_code.' - '.$busines->currency_name . ' (' .$busines->currency_symbol. ')'); ?></p>
                              </td>
                              <td class="text-center">
                                <?php if ($busines->is_primary == 1): ?>
                                  <a href="#" class="btn btn-default" disabled data-toggle="tooltip" data-placement="top" title="This is your default business"><i class="fa fa-check text-success"></i> <?php echo trans('active') ?></a>
                                <?php else: ?>
                                  <a data-val="<?php echo html_escape($busines->name); ?>" data-id="<?php echo html_escape($busines->id); ?>" href="<?php echo base_url('admin/business/set_primary/'.md5($busines->id));?>" class="btn btn-default primary_item" data-toggle="tooltip" data-placement="top" title="<?php echo trans('default-business') ?>"> <?php echo trans('set-default') ?></a>
                                <?php endif ?>
                              </td>

                              <td class="actions" width="15%">
                                <a href="<?php echo base_url('admin/business/edit/'.md5($busines->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                <?php if (count($business) > 1): ?>
                                  <?php if ($busines->is_primary != 1): ?>
                                      <a href="#deleteModal_<?php echo md5($busines->id); ?>" data-toggle="modal" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                                  <?php endif ?>
                                <?php endif ?>

                              </td>
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

<?php foreach ($business as $busines): ?>
<div id="deleteModal_<?php echo md5($busines->id); ?>" class="modal fade" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="customer-form" method="post" enctype="multipart/form-data" class="validate-form" action="" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title text-danger"><?php echo trans('delete-confirmation') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <h3><?php echo trans('sure-delete-business') ?> <strong class="text-info"><?php echo html_escape($busines->name); ?></strong> <?php echo trans('permanently') ?>?</h3>
                    <p><?php echo trans('affect-business') ?></p>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <a class="btn btn-danger waves-effect pull-left" href="<?php echo base_url('admin/business/delete/'.$busines->id);?>"><i class="fa fa-trash"></i> <?php echo trans('delete') ?></a>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php endforeach; ?>