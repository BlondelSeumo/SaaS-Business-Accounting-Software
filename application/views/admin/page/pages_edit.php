<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
             <div class="btn-group pull-right m-t-5 m-b-20" style="display: none;">
                  <?php if (isset($message) && $message != ''): ?>
                      <div class="alert alert-success">
                        <strong>Success!</strong> <?php echo html_escape($message); ?>
                      </div>
                  <?php endif ?>
              </div>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Edit Page</li>
            </ol>
        </div>
    </div>

    <div class="row">

      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Edit Page</h3>
              </div>
              <div class="panel-body">
                  <form method="post" action="<?php echo base_url('admin/pages/edit/'.html_escape($page->id))?>" role="form">
                      <div class="form-group">
                          <label>Page title</label>
                          <input type="text" class="form-control" name="title" value="<?php echo html_escape($page->title) ?>">
                      </div>
                      <div class="form-group">
                          <label>Page slug or url</label>
                          <input type="text" class="form-control" name="slug" value="<?php echo html_escape($page->slug) ?>">
                      </div>

                      <div class="form-group">
                          <label>Page description</label>
                          <textarea id="ckEditor" class="form-control" name="details"><?php echo html_escape($page->details) ?></textarea>
                      </div>

                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <button type="submit" class="btn btn-info">Save changes</button>
                  </form>
              </div>
          </div>
      </div>

      
    </div>

  </div>
</div>

