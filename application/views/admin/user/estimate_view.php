<!DOCTYPE html>
<html lang="en">
<head>

  <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
  <title><?php echo html_escape($settings->site_name); ?> - <?php if(isset($page_title)){echo html_escape($page_title);}else{echo "Dashboard";} ?></title>
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/admin_style.css?var=<?php echo settings()->version ?>&time=<?=time();?>">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/theme_<?php echo settings()->theme ?>.css"> 
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
</head>

<body>

    <?php $currency_symbol = helper_get_customer($invoice->customer)->currency_symbol ?>
    <div class="content-wrappers">
        <section class="content p-0">
           
            <?php if (isset($mode) && $mode == 'preview'): ?>
                <div class="preview-mood-top p-20 text-center readonly-title">
                    <a href="#" class="btn btn-default btn-rounded mr-5 disabled"><i class="fa fa-eye"></i> <?php echo trans('preview-mode') ?> </a>

                    <?php if (isset($link) && $link != ''): ?>
                        <a href="<?php echo $link ?>" class="btn btn-default btn-rounded mr-5"><i class="fa fa-long-arrow-left"></i> <?php echo trans('back') ?> </a>
                    <?php endif ?>
                    <p class="mt-10 c-1038"><i class="fa fa-info-circle"></i> <?php echo trans('preview-mode-msg') ?></p>
                </div>
            <?php endif ?>

            <div class="readonly-title">
                <h2><?php echo trans('estimate') ?> <?php echo html_escape($invoice->number) ?> <?php echo trans('from') ?> - <?php echo html_escape($invoice->business_name) ?></h2>
            </div>

            <div class="readonly-top-bar">
                <?php echo trans('estimate') ?> <?php echo html_escape($invoice->number) ?> <i class="fa fa-circle"></i>

                <?php if($invoice->status == 2): ?>
                    <?php echo trans('amount-due') ?>: <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?>0.00
                <?php else: ?>
                    <?php echo trans('amount-due') ?>: <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($invoice->grand_total - get_total_invoice_payments($invoice->id, $invoice->parent_id), 2); ?>
                <?php endif ?> <i class="fa fa-circle"></i>
                <?php echo trans('due-on') ?>: <?php echo my_date_show($invoice->payment_due) ?>

                <i class="fa fa-circle"></i>

                <?php if ($invoice->is_view == 1): ?>
                    &#128065; <?php echo trans('view') ?> on <?php echo my_date_show($invoice->view_date) ?>
                <?php else: ?>
                     <?php echo trans('not-viewed') ?>
                <?php endif; ?>
            </div>

            <div class="container">
                <div class="col-md-10" style="margin: 20px auto">
                    <div class="row mb-10">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-default btn-rounded mr-5 print_invoice"><i class="fa fa-print"></i> <?php echo trans('print') ?> </a>

                            <a href="#" data-id="estimate_<?php echo rand() ?>" class="btn btn-default btn-rounded mr-5 btnExport"><i class="fa fa-download"></i> <?php echo trans('download-pdf') ?> </a>
                        </div>

                        <div class="col-md-6">
                            <?php if ($invoice->status == 0): ?>
                                <a href="<?php echo base_url('readonly/approve/1/'.md5($invoice->id)) ?>" class="btn btn-info btn-rounded mr-5 pull-right"><i class="fa fa-check"></i> <?php echo trans('approve') ?> </a>

                                <a href="#rejectModal" data-toggle="modal" class="btn btn-danger btn-rounded mr-5 pull-right"><i class="fa fa-times"></i> Reject</a>
                            <?php elseif($invoice->status == 1): ?>
                                <label class="label label-success pull-right mt-10"><?php echo trans('approved') ?></label>
                            <?php elseif($invoice->status == 2): ?>
                                <label class="label label-danger pull-right mt-10"><?php echo trans('rejected') ?></label>
                            <?php endif ?>
                        </div>
                    </div>

                    <div id="invoice_save_area mt-0" class="card inv save_area print_area">
                        <?php include"include/invoice_style_".$invoice->template_style.".php"; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <?php if ($invoice->is_edit == 1 && $invoice->edit_reason != ''): ?>
   
        <div id="editModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Information</h4>
              </div>
              <div class="modal-body">
                <h4>Edit Reason: <?php echo $invoice->edit_reason ?></h4>
                <p>Estimate edited: <?php echo my_date_show($invoice->edit_date) ?> </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

    <?php endif ?>


    <div id="rejectModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('reject-reason') ?></h4>
          </div>
          <form method="post" class="validate-form" action="<?php echo base_url('readonly/approve/2/'.md5($invoice->id)) ?>" role="form" novalidate>
              <div class="modal-body">
                <div class="form-group">
                  <label><?php echo trans('describe-reject-reason') ?></label>
                  <textarea class="form-control" name="reject_reason"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <button type="submit" class="btn btn-info pull-left"><i class="fa fa-check"></i> <?php echo trans('submit') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </form>
        </div>

      </div>
    </div>


    <footer></footer>

    <!-- jQuery 3 -->
    <script src="<?php echo base_url() ?>assets/admin/js/jquery3.min.js"></script>
    <!-- popper -->
    <script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/printThis.js"></script>
    
    <script src="<?php echo base_url() ?>assets/admin/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/html2canvas.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>

    <script>
        $('.print_invoice').on("click", function () {
          $('.print_area').printThis({
            base: "https://jasonday.github.io/printThis/"
          });
        });
    </script>

    <script type="text/javascript">
        $(window).on('load',function(){
            $('#editModal').modal('show');
        });
    </script>

</body>
</html>