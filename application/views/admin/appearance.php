<div class="content-wrapper">
  <section class="content container">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_appearance') ?>" role="form" class="form-horizontal">

        <div class="nav-tabs-custom">
          
            <div class="row m-5 mt-20">
              <div class="col-md-12 box">
                
                <div class="box-header">
                    <h3 class="box-title"><?php echo trans('set-theme') ?></h3>
                </div>

                <div class="box-body p-10">

                    
                    <div class="row p-30 mb-0">
                        <?php for ($i=1; $i <= 2; $i++) { ?>
                            <div class="col-md-6 text-center p-5">
                                <?php if ($i==settings()->theme): ?>
                                    <i class="flaticon-checked-1 fa-3x text-success"></i>
                                <?php else: ?>
                                    <i class="flaticon-checked1-1 fa-3x text-success"></i><br>
                                <?php endif ?>
                                <div class="invoice-layout <?php if($i==settings()->theme){echo "active";} ?>">
                                    <div class="invoice-img">
                                        <img src="<?php echo base_url() ?>assets/admin/layouts/theme_<?php echo $i ?>.jpg">
                                        <div class="iconv"><a data-toggle="modal" href="#templateModal_<?php echo $i ?>"><i class="icon-eye"></i></a></div>
                                    </div>
                                    <div class="radio radio-info radio-inline mt-10">
                                      <input type="radio" id="inlineRadio<?php echo $i ?>" <?php if($i==settings()->theme){echo "checked";} ?> value="<?php echo $i ?>" name="theme">
                                      <label class="<?php if($i==settings()->theme){echo "text-primary";} ?>" for="inlineRadio<?php echo $i ?>"> <?php echo trans('template') ?> <?php echo $i ?> </label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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


<?php for ($a=1; $a <= 2; $a++) { ?>
    <div id="templateModal_<?php echo html_escape($a) ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom modal-lg">
            <div class="modal-content modal-md" style="margin-top: 10%">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Theme - <?php echo html_escape($a) ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo base_url() ?>assets/admin/layouts/theme_<?php echo $a ?>.jpg">
                </div>
            </div>
        </div>
    </div>
<?php } ?>