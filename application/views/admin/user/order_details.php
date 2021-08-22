<?php $settings = get_settings(); ?>
<?php $currency_symbol = helper_get_customer($invoice->customer)->currency_symbol ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="col-md-10 m-auto">

                <div class="row">
                    <div class="col-md-4">
                        <h2 class="mt-0"><?php echo trans('bill'); ?> #<?php echo html_escape($invoice->number) ?></h2>
                        <p><?php echo trans('created') ?>: <?php echo my_date_show($invoice->created_at); ?></p>
                    </div>

                    <div class="col-md-8 text-right">
                        <a href="<?php echo base_url('admin/bills/edit/'.md5($invoice->id)) ?>" class="btn btn-default btn-rounded mr-5"><i class="icon-pencil"></i> <?php echo trans('edit') ?> </a>
                        <div class="btn-group mr-5">
                            <button type="button" class="btn btn-default btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="icon-settings"></i> <?php echo trans('actions') ?>
                            </button>
                            <div class="dropdown-menu st" x-placement="bottom-start">
                                <a class="dropdown-item print_invoice" href="#"><?php echo trans('print') ?></a>

                                <a href="#" data-id="bill_<?php echo rand() ?>" class="dropdown-item btnExport"><?php echo trans('download-pdf') ?> </a>
                                
                                <!-- <a target="_blank" class="dropdown-item" href="<?php //echo base_url('readonly/export_pdf/'.md5($invoice->id)) ?>"><?php //echo trans('export-as-pdf') ?></a> -->

                                <a class="dropdown-item mr-5" href="#recordPayment" data-toggle="modal"><?php echo trans('record-a-payment') ?></a>
                                <a class="dropdown-item" data-toggle="modal" href="#sendEstimateModal_<?php echo html_escape($invoice->id) ?>"><?php echo trans('send') ?></a>
                                <a class="dropdown-item delete_item" href="<?php echo base_url('admin/bills/delete/'.md5($invoice->id)) ?>"><?php echo trans('delete') ?></a>
                            </div>
                        </div>
                        <a href="<?php echo base_url('admin/bills/create') ?>" class="btn btn-info btn-rounded"><i class="fa fa-plus"></i> <?php echo trans('create-new-bill'); ?></a>
                    </div>
                    <input type="hidden" class="set_value" name="check_value">
                </div><br>
              

                <div id="invoice_save_area" class="card inv save_area print_area">
                    <?php include"include/invoice_style_1.php"; ?>
                </div>



                <?php if (!empty(get_invoice_payments($invoice->id))): ?>
                <div class="box">
                    
                    <div class="box-header">
                        <div class="box-title"><h5 class="mb-0"><?php echo trans('payment-records') ?></h5></div>
                    </div>
                    

                    <div class="box-body">
                    <?php foreach (get_invoice_payments($invoice->id) as $payment): ?>
                        <div class="payment_record flex-parent-between" id="row_<?php echo html_escape($payment->id) ?>">
                            <p>
                                <?php echo trans('payments-received') ?> 
                                <strong class="text_mark"><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($payment->amount,2) ?></strong> at

                                <strong class="text_mark"><?php echo my_date_show($payment->payment_date) ?></strong> <?php echo trans('using') ?> <strong class="text_mark"><?php echo get_using_methods($payment->payment_method) ?></strong></span>
                            </p>

                            <p>
                                <span class="flex-parent-between">
                                <a href="#editRecordPayment_<?php echo html_escape($payment->id) ?>" data-toggle="modal"><span class="custom-label-sm label-light-info"><i class="ficon flaticon-pencil"></i> <?php echo trans('edit-payment') ?></span></a>

                                <a data-toggle="tooltip" data-placement="top" data-title="<?php echo trans('delete') ?>" href="<?php echo base_url('admin/invoice/delete_payment_record/'.$payment->id) ?>" data-id="<?php echo html_escape($payment->id) ?>" class="delete_item"><span class="custom-label-sm label-light-danger"><i class="icon-trash"></i></span></a>
                                </span>
                            </p>
                        </div>
                    <?php endforeach ?>
                    </div>

                </div>
                <?php endif ?>

            </div>
        </div>
    </section>
</div>










<?php foreach (get_invoice_payments($invoice->id) as $payment): ?>
    <div id="editRecordPayment_<?php echo html_escape($payment->id) ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom modal-md">
            <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/update_record_payment/'.$payment->id)?>" role="form" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter"><?php echo trans('edit-payment') ?> </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <?php $records = get_customer_advanced_record($invoice->customer) ?>
                        <?php if (!empty($records) && $records->customer_id == $invoice->customer): ?>
                            <?php if ($records->amount != 0): ?>
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> <strong>You have reserve amount for this customer: <?php echo $records->amount.' '.$records->currency; ?></strong>
                                </div>
                            <?php endif ?>
                        <?php endif ?>

                        <div class="form-group m-t-30" style="display: none;">
                            <input type="checkbox" name="is_autoload_amount" value="1" <?php if($this->business->is_autoload_amount == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"></span>

                            <label> is autoload advance amount in your next invoice?</label>
                        </div>
                            
                        <p class="text-muted"><?php echo trans('record-payment-info') ?></p><br>
                        
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('payment-date') ?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="payment_date" value="<?php echo html_escape($payment->payment_date) ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calender"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('amount') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="amount" value="<?php echo html_escape($payment->amount) ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('payment-method') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control" id="tax" name="payment_method">
                                    <option value="0"><?php echo trans('select-payment-method') ?></option>
                                    <?php $i=1; foreach (get_payment_methods() as $payments): ?>
                                        <option value="<?php echo $i; ?>" <?php if($i == $payment->payment_method){echo "selected";} ?>><?php echo html_escape($payments); ?></option>
                                    <?php $i++; endforeach ?>
                                </select>  
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('memo-notes') ?></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="note"><?php echo $payment->note ?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="invoice_id" value="<?php echo html_escape(md5($payment->invoice_id)) ?>">
                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <button type="submit" class="btn btn-info waves-effect pull-right"><?php echo trans('update') ?></button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>


<div id="recordPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="record_payment_form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/bills/record_payment')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vendor"><?php echo trans('record-payment-bill') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p class="text-muted"><?php echo trans('record-payment-info') ?></p><br>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('payment-date') ?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="payment_date" value="<?php echo date('Y-m-d') ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-calender"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('amount') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="amount" value="<?php echo html_escape($invoice->grand_total) ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('payment-method') ?></label>
                        <div class="col-sm-8">
                            <select class="form-control" id="tax" name="payment_method">
                                <option value=""><?php echo trans('select-payment-method') ?></option>
                                <?php $i=1; foreach (get_payment_methods() as $payment): ?>
                                    <option value="<?php echo $i; ?>"><?php echo html_escape($payment); ?></option>
                                <?php $i++; endforeach ?>
                            </select>  
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 text-right control-label col-form-label"><?php echo trans('memo-notes') ?></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="note"> </textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="invoice_id" value="<?php echo html_escape(md5($invoice->id)) ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info waves-effect pull-right"><?php echo trans('add-payment') ?></button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div id="sendEstimateModal_<?php echo html_escape($invoice->id) ?>" class="modal fade estimate_modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="send-bill-form" method="post" enctype="multipart/form-data" class="validate-form send-bill-form" action="<?php echo base_url('admin/bills/send')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter"><?php echo trans('send-bills') ?> <?php echo html_escape($invoice->id) ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 text-right control-label col-form-label"><?php echo trans('to') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email_to" value="<?php echo helper_get_customer($invoice->customer)->email ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 text-right control-label col-form-label"><?php echo trans('message') ?></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="message"> </textarea>
                        </div>
                    </div>

                    <div class="form-group row mt-10">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-blue" value="1" name="is_myself" aria-invalid="false">
                            <label for="md_checkbox_1"> <?php echo trans('send-a-copy-to-myself-at') ?> <b><?php echo user()->email ?></b></label>
                            <input type="hidden" class="form-control" value="<?php echo user()->email ?>" name="email_myself">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" name="send_bill_id" class="send_bill_id" value="<?php echo md5($invoice->id) ?>">
                    <input type="hidden" name="customer_id" value="<?php echo html_escape($invoice->customer) ?>">
                    <button type="submit" class="btn btn-info rounded waves-effect pull-right submit_btn"><?php echo trans('send') ?></button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>