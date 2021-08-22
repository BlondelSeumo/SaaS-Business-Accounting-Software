<div class="content-wrapper">
  <section class="content container">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/business/invoice_customize') ?>" role="form" class="form-horizontal">

        <div class="nav-tabs-custom">
          
            <?php include"include/profile_menu.php"; ?>

            <div class="row m-5 mt-20">
              <div class="col-md-12 box">
                
                <div class="box-header">
                    <h3 class="box-title"><?php echo trans('invoice-customization') ?></h3>
                </div>

                <div class="box-body p-10">

                    
                    <div class="row p-30 mb-0">
                        <div class="col-md-12 p-5">
                            <p class="m-0"><?php echo trans('choose-invoice-templates') ?></p>
                        </div>
                        <?php 
                            if (user()->user_type == 'trial') {
                                $limit = 6;
                            } else {
                                $limit = check_package_limit('invoice_template');
                                if ($limit == -2) {
                                    $limit = 6;
                                }elseif ($limit == -1) {
                                    $limit =1;
                                } else {
                                    $limit = $limit;
                                }
                            }
                        ?>
                   
                        <?php for ($i=1; $i <= $limit; $i++) { ?>
                            <div class="col-md-2 text-center p-5">
                                <div class="invoice-layout <?php if($i==$this->business->template_style){echo "active";} ?>">
                                    <div class="invoice-img">
                                        <img src="<?php echo base_url() ?>assets/admin/layouts/invoice<?php echo $i ?>.png">
                                        <div class="iconv"><a data-toggle="modal" href="#templateModal_<?php echo $i ?>"><i class="icon-eye"></i></a></div>
                                    </div>
                                    <div class="radio radio-info radio-inline mt-10">
                                      <input type="radio" id="inlineRadio<?php echo $i ?>" <?php if($i==$this->business->template_style){echo "checked";} ?> value="<?php echo $i ?>" name="template_style">
                                      <label class="<?php if($i==$this->business->template_style){echo "text-primary";} ?>" for="inlineRadio<?php echo $i ?>"> <?php echo trans('template') ?> <?php echo $i ?> </label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="row pl-30">
                        
                        <div class="col-2 p-10">
                            <div class="form-group p-0">
                                <p><?php echo trans('accent-color') ?></p>
                                <input type="text" name="color" class="colorpicker-default form-control colorpicker-element" value="<?php echo html_escape($this->business->color) ?>">
                            </div>
                        </div>
                        <div class="col-10 text-left">
                            <p></p><br>
                            <a class="colors-trigger colorpicker-advanced colorpicker-element mt-10" style="background-color: <?php echo html_escape($this->business->color) ?>" href="#"></a>
                        </div>
                    </div>

                    <div class="row pl-30">
                        <div class="col-md-12 pl-10">
                            <div class="form-group">
                                  <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-blue" value="1" name="enable_stock" <?php if($this->business->enable_stock == 1){echo "checked";} ?>>
                                  <label for="md_checkbox_1"> <?php echo trans('enable-stock') ?></label>
                                  <p><?php echo trans('enable-sotck-help') ?></p>
                              </div>
                        </div>
                    </div>

                    <div class="row pl-30 mt-50">
                        <div class="col-md-12 pl-10">
                            <p class="m-0"><?php echo trans('set-default-footer-note') ?></p>
                        </div>
                        <div class="col-md-11 p-10">
                            <div class="form-group p-0">
                                <textarea id="summernote" class="form-control" name="footer_note" rows="4"><?php echo html_escape($this->business->footer_note) ?></textarea>
                            </div>
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


<?php for ($a=1; $a <= 6; $a++) { ?>
    <div id="templateModal_<?php echo html_escape($a) ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom modal-lg">
            <div class="modal-content modal-md" style="margin-top: 10%">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Invoice template - <?php echo html_escape($a) ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo base_url() ?>assets/admin/layouts/invoice<?php echo $a ?>.png">
                </div>
            </div>
        </div>
    </div>
<?php } ?>