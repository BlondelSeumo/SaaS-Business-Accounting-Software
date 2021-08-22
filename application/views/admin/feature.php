<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

    <div class="col-md-6 m-auto box add_area mt-20" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit-features') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-feature') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/feature') ?>" class="pull-right btn btn-default btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/feature/add')?>" role="form">

          <div class="form-group">
            <label> <?php echo trans('title') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="<?php echo html_escape($feature[0]['name']); ?>" >
          </div>

          <div class="form-group">
            <label> <?php echo trans('order') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="orders" value="<?php echo html_escape($feature[0]['orders']); ?>" >
          </div>

          <div class="form-group">
            <label><?php echo trans('details') ?> <span class="text-danger">*</span></label>
            <textarea class="form-control" id="ckEditor" name="details" rows="6"><?php echo html_escape($feature[0]['details']); ?></textarea>
          </div>


          <div class="form-group">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <img src="<?php echo base_url($feature[0]['thumb']) ?>"> <br><br>
              <?php endif ?>
              <div class="input-group">
                  <span class="input-group-btn">
                      <span class="btn btn-info btn-file">
                        <i class="fa fa-cloud-upload"></i> <?php echo trans('upload-image') ?> <input type="file" id="imgInp" name="photo">
                      </span>
                  </span>
              </div><br>
              <img width="200px" id='img-upload'/>
          </div>


          <input type="hidden" name="id" value="<?php echo html_escape($feature['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row mb-20">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info pull-left"><?php echo trans('save-changes') ?></button>
              <?php else: ?>
                <button type="submit" class="btn btn-info pull-left"><?php echo trans('save') ?></button>
              <?php endif; ?>
            </div>
          </div>

        </form>

      </div>
    </div>

    <?php if (isset($page_title) && $page_title != "Edit"): ?>

    <div class="list_area container">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit-features') ?> <a href="<?php echo base_url('admin/feature') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('features') ?> <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-feature') ?></a></h3>
        <?php endif; ?>

        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0">
            <table class="table table-hover cushover <?php if(count($features) > 10){echo "datatable";} ?>" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('thumb') ?></th>
                        <th><?php echo trans('name') ?></th>
                        <th><?php echo trans('order') ?></th>
                        <th><?php echo trans('details') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($features as $feature): ?>
                    <tr id="row_<?php echo html_escape($feature->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><img width="100px" src="<?php echo base_url($feature->thumb) ?>"></td>
                        <td><?php echo html_escape($feature->name); ?></td>
                        <td><?php echo html_escape($feature->orders); ?></td>
                        <td><?php echo character_limiter($feature->details, 80); ?></td>
                        
                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/feature/edit/'.html_escape($feature->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Feature" data-id="<?php echo html_escape($feature->id); ?>" href="<?php echo base_url('admin/feature/delete/'.html_escape($feature->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                        </td>
                    </tr>
                    
                  <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

  </section>
</div>
