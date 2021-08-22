<div id="sendInvoiceModal_<?php echo html_escape($invoice->id) ?>" class="modal fade invoice_modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="send-invoice-form" method="post" class="validate-form send-invoice-form" action="<?php echo base_url('admin/invoice/send')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter"><?php echo trans('send-invoice') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label"><?php echo trans('invoice-to') ?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email_to" value="<?php echo helper_get_customer($invoice->customer)->email ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label"><?php echo trans('subject') ?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="subject" value="Invoice #<?php echo html_escape($invoice->number) ?> from <?php echo user()->name ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label"><?php echo trans('message') ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="message"> </textarea>
                        </div>
                    </div>

                    <div class="form-group row mt-10">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <input type="checkbox" id="md_checkbox_22" class="filled-in chk-col-blue" value="1" name="is_myself" aria-invalid="false">
                            <label for="md_checkbox_22"> <?php echo trans('send-a-copy-to-myself-at') ?> <b><?php echo user()->email ?></b></label>
                            <input type="hidden" class="form-control" value="<?php echo user()->email ?>" name="email_myself">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" name="send_invoice_id" class="send_invoice_id" value="<?php echo html_escape($invoice->id) ?>">
                    <input type="hidden" name="customer_id" value="<?php echo html_escape($invoice->customer) ?>">

                    <button type="submit" class="submit_btn btn btn-info rounded waves-effect pull-right"><?php echo trans('send') ?></button>
                    <button type="button" class="btn btn-default rounded waves-effect pull-right" data-dismiss="modal" aria-hidden="true"><?php echo trans('close') ?></button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>