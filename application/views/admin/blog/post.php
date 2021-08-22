<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">


    <div class="col-md-6 m-auto box add_area mt-50" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit-blog-post') ?></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('add-new-blog-post') ?> </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <a href="<?php echo base_url('admin/blog') ?>" class="pull-right btn btn-default btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php else: ?>
            <a href="#" class="text-right btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/blog/add')?>" role="form" novalidate>

          <div class="form-group">
              <label class="col-sm-2 control-label p-0" for="example-input-normal"><?php echo trans('category') ?> <span class="text-danger">*</span></label>
              <select class="form-control" name="category" required>
                  <option value=""><?php echo trans('select') ?></option>
                  <?php foreach ($categories as $category): ?>
                      <option value="<?php echo html_escape($category->id); ?>" 
                        <?php echo ($blog[0]['category_id'] == $category->id) ? 'selected' : ''; ?>>
                        <?php echo html_escape($category->name); ?>
                      </option>
                  <?php endforeach ?>
              </select>
          </div>

          <div class="form-group">
            <label><?php echo trans('title') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="title" value="<?php echo html_escape($blog[0]['title']); ?>" >
          </div>

          <?php if (isset($page_title) && $page_title != "Edit"): ?>
          <div class="form-group">
              <label><?php echo trans('slug') ?></label>
              <input type="text" class="form-control" name="slug">
          </div>
          <?php endif; ?>

          <div class="form-group">
              <label><?php echo trans('tags') ?></label>
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <input type="text" data-role="tagsinput" name="tags[]" value="<?php echo html_escape($tags) ?>" />
              <?php else: ?>
                <input type="text" data-role="tagsinput" name="tags[]" placeholder="<?php echo trans('enter-your-tags') ?>" />
              <?php endif ?>
          </div>

          <div class="form-group">
              <label><?php echo trans('post-description') ?></label>
              <textarea id="summernote" class="form-control" name="details"><?php echo html_escape($blog[0]['details']); ?></textarea>
          </div>
          
          <div class="form-group">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <img src="<?php echo base_url($blog[0]['thumb']) ?>"> <br><br>
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


          <div class="row m-t-30">
            <div class="col-sm-2 text-left">
              <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio1" value="1" name="status" <?php if($blog[0]['status'] == 1){echo "checked";} ?>>
                <label for="inlineRadio1"> <?php echo trans('active') ?> </label>
              </div>
            </div>
            <div class="col-sm-1 text-left">
              <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio2" value="2" name="status" <?php if($blog[0]['status'] == 2){echo "checked";} ?>>
                <label for="inlineRadio2"> <?php echo trans('inactive') ?> </label>
              </div>
            </div>
          </div>


          <input type="hidden" name="id" value="<?php echo html_escape($blog['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <hr>

          <div class="row m-t-30">
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

      <div class="box-footer">

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

    <div class="list_area container">

        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title"><?php echo trans('edit-blog-post') ?> <a href="<?php echo base_url('admin/blog') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
        <?php else: ?>
          <h3 class="box-title"><?php echo trans('all-blog-posts') ?> <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-blog-post') ?></a></h3>
        <?php endif; ?>
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0">
            <table class="table table-hover cushover <?php if(count($posts) > 10){echo "datatable";} ?>" id="dg_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo trans('thumb') ?></th>
                        <th><?php echo trans('title') ?></th>
                        <th><?php echo trans('details') ?></th>
                        <th><?php echo trans('status') ?></th>
                        <th><?php echo trans('category') ?></th>
                        <th><?php echo trans('action') ?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($posts as $post): ?>
                    <tr id="row_<?php echo html_escape($post->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><img width="100px" src="<?php echo base_url($post->thumb) ?>"></td>
                        <td><?php echo html_escape($post->title); ?></td>
                        <td><?php echo character_limiter($post->details, 80); ?></td>
                        <td>
                          <?php if ($post->status == 1): ?>
                            <span class="label label-info"><?php echo trans('active') ?></span>
                          <?php else: ?>
                            <span class="label label-danger"><?php echo trans('inactive') ?></span>
                          <?php endif ?>
                        </td>

                        <td>
                            <span class="label label-success"><?php echo html_escape($post->category); ?></span>
                        </td>

                        <td class="actions" width="12%">
                          <a href="<?php echo base_url('admin/blog/edit/'.html_escape($post->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                          <a data-val="Category" data-id="<?php echo html_escape($post->id); ?>" href="<?php echo base_url('admin/blog/delete/'.html_escape($post->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                          <?php if ($post->status == 1): ?>
                            <a href="<?php echo base_url('admin/blog/deactive/'.html_escape($post->id));?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a> &nbsp;
                          <?php else: ?>
                            <a href="<?php echo base_url('admin/blog/active/'.html_escape($post->id));?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
                          <?php endif ?>
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
