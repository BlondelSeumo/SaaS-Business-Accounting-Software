<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

    <div class="box add_area" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit page</h3>
        <?php else: ?>
          <h3 class="box-title">Add new page </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/page') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-primary btn-sm cancel_btn"><i class="fa fa-list"></i> All pages</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/page/add')?>" role="form" novalidate>

          <div class="form-group">
              <label class="col-sm-2 control-label" for="example-input-normal">States <span class="require-field">*</span></label>
              <select class="form-control" name="state_id" required>
                  <option value=""> Select States</option>
                  <?php foreach ($states as $state): ?>
                      <option value="<?php echo html_escape($state->id); ?>" 
                        <?php echo ($page[0]['state_id'] == $state->id) ? 'selected' : ''; ?>>
                        <?php echo html_escape($state->name); ?>
                      </option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="form-group">
            <label>English page Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="<?php echo html_escape($page[0]['name']); ?>" >
          </div>

          <div class="form-group">
            <label>Arabic page Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="ar_name" value="<?php echo html_escape($page[0]['ar_name']); ?>" >
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($page['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <hr>

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info pull-left">Save Changes</button>
              <?php else: ?>
                <button type="submit" class="btn btn-info pull-left"> Save page</button>
              <?php endif; ?>
            </div>
          </div>

        </form>

      </div>

      <div class="box-footer">

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

    <div class="box list_area">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit page <a href="<?php echo base_url('admin/page') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
        <?php else: ?>
          <h3 class="box-title">All page </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> Add new page</a>
        </div>
      </div>

      <div class="box-body">
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll">
            <table class="table table-bordered datatable" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>English</th>
                        <th>Arabic</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($pages as $cat): ?>
                    <tr id="row_<?php echo html_escape($cat->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo html_escape($cat->name); ?></td>
                        <td><?php echo html_escape($cat->ar_name); ?></td>

                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/pagse/edit/'.html_escape($cat->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="page" data-id="<?php echo html_escape($cat->id); ?>" href="<?php echo base_url('admin/pages/delete/'.html_escape($cat->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

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
    <?php endif; ?>



  </section>
</div>
