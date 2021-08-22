<div class="content-wrapper">
    <section class="content">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
            		<h2 class="p-10"><?php echo trans('estimates') ?>  <a href="<?php echo base_url('admin/estimate/create') ?>" class="btn btn-info btn-rounded pull-right"><i class="fa fa-plus"></i> <?php echo trans('new-estimates') ?></a></h2>
            	    
                    <form method="GET" class="sort_invoice_form" action="<?php echo base_url('admin/estimate') ?>">
                        <div class="row p-15 mt-20 mb-20">
                            <div class="col-md-5 col-xs-12 mt-5 pl-0">
                                <select class="form-control single_select sort" name="customer">
                                    <option value=""><?php echo trans('all-customers') ?></option>
                                    <?php foreach ($customers as $customer): ?>
                                      <option value="<?php echo html_escape($customer->id) ?>" <?php echo(isset($_GET['customer']) && $_GET['customer'] == $customer->id) ? 'selected' : ''; ?>
                                      ><?php echo html_escape($customer->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="<?php echo trans('from') ?>" name="start_date" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="<?php echo trans('to') ?>" name="end_date" value="<?php if(isset($_GET['end_date'])){echo $_GET['end_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        
                            <div class="col-md-1 col-xs-12 mt-5 pl-0">
                                <button type="submit" class="btn btn-default btn-block custom_search"><i class="flaticon-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </form>


                    <div class="tab-content">
                        <!-- unpaid -->
                        <div class="tab-pane active" id="home2" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover cushover">
                                    <thead>
                                        <tr class="item-row">
                                            <th><?php echo trans('status') ?></th>
                                            <th></th>
                                            <th><?php echo trans('date') ?></th>
                                            <th><?php echo trans('number') ?></th>
                                            <th><?php echo trans('customer') ?></th>
                                            <th><?php echo trans('amount') ?></th>
                                            <th class="text-right"><?php echo trans('actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($estimates)): ?>
                                            <tr>
                                                <td colspan="6" class="text-center p-30"><strong><?php echo trans('no-data-founds') ?></strong></td>
                                            </tr>
                                        <?php else: ?>

                                            <?php foreach ($estimates as $estimate): ?>
                                                <tr id="row_<?php echo html_escape($estimate->id) ?>">
                                                    <td>
                                                        <?php if (date("Y-m-d") > date("Y-m-d", strtotime($estimate->created_at))): ?>
                                                            <span data-toggle="tooltip" data-placement="right" title="<?php echo trans('expire-estimate') ?>" class="custom-label-sm label-light-danger"><?php echo trans('expire') ?></span>
                                                        <?php else: ?>
                                                    
                                                            <?php if ($estimate->status == 0): ?>
                                                                <span class="custom-label-sm label-light-warning"><?php echo trans('pending') ?></span>
                                                            <?php elseif ($estimate->status == 2): ?>
                                                                <span class="custom-label-sm label-light-danger"><?php echo trans('rejected') ?></span>
                                                            <?php else: ?>
                                                                <span class="custom-label-sm label-light-success"><?php echo trans('approved') ?></span>
                                                            <?php endif; ?>
                                                 
                                                         <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($estimate->reject_reason)): ?>
                                                            <p class="mb-0 mt-10"><?php echo trans('reject-reason') ?></p>
                                                            <p class="text-danger"><?php echo $estimate->reject_reason; ?></p>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?php echo my_date_show($estimate->date); ?></td>
                                                    <td><?php echo html_escape($estimate->number) ?></td>
                                                    <td>
                                                        <?php if (!empty(helper_get_customer($estimate->customer))): ?>
                                                            <?php echo helper_get_customer($estimate->customer)->name ?>
                                                            <?php 
                                                                $currency_symbol = helper_get_customer($estimate->customer)->currency_symbol;
                                                                if (isset($currency_symbol)) {
                                                                    $currency_symbol = $currency_symbol;
                                                                } else {
                                                                    $currency_symbol = $this->business->currency_symbol;
                                                                }
                                                            ?>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?php echo html_escape($currency_symbol); ?><?php echo html_escape($estimate->grand_total) ?></td>
                                                    <td class="text-right">

                                                        <?php if ($estimate->status == 1): ?>
                                                            <a class="convert_to_invoice mr-5 hide_viewer" href="<?php echo base_url('admin/estimate/convert/'.md5($estimate->id)) ?>"><?php echo trans('convert-to-invoice') ?></a>
                                                        <?php endif ?>

                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default rounded btn-sm dropdown-toggle d-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               <?php echo trans('actions') ?>
                                                            </button>
                                                            <div class="dropdown-menu st" x-placement="bottom-start">
                                                                <?php if(auth('role') != 'viewer'): ?>
                                                                    <a class="dropdown-item" href="<?php echo base_url('admin/estimate/details/'.md5($estimate->id)) ?>"><?php echo trans('view') ?></a>
                                                                    <a class="dropdown-item" data-toggle="modal" href="#sendEstimateModal_<?php echo html_escape($estimate->id) ?>"><?php echo trans('send') ?></a>
                                                                    <a class="dropdown-item convert_to_invoice" href="<?php echo base_url('admin/estimate/convert/'.md5($estimate->id)) ?>"><?php echo trans('convert-to-invoice') ?></a>
                                                                    <a target="_blank" class="dropdown-item" href="<?php echo base_url('readonly/estimate/preview/'.md5($estimate->id)) ?>"><?php echo trans('preview-as-a-customer') ?></a>
                                                                    <a class="dropdown-item" href="<?php echo base_url('admin/estimate/details/'.md5($estimate->id)) ?>"><?php echo trans('print') ?></a>
                                                                    <div class="dropdown-divider"></div>
                                                                    
                                                                    <a class="dropdown-item" href="<?php echo base_url('admin/estimate/edit/'.md5($estimate->id)) ?>"><?php echo trans('edit') ?> </a>

                                                                    <a class="dropdown-item delete_item" data-id="<?php echo html_escape($estimate->id); ?>" href="<?php echo base_url('admin/estimate/delete/'.$estimate->id) ?>"><?php echo trans('delete') ?></a>
                                                                <?php else: ?>
                                                                    <a target="_blank" class="dropdown-item" href="<?php echo base_url('readonly/estimate/preview/'.md5($estimate->id)) ?>"><?php echo trans('preview-as-a-customer') ?></a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>

                                        <?php endif ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


<?php foreach ($estimates as $estimate): ?>
<div id="sendEstimateModal_<?php echo html_escape($estimate->id) ?>" class="modal fade estimate_modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="send-estimate-form" method="post" enctype="multipart/form-data" class="validate-form send-estimate-form" action="<?php echo base_url('admin/estimate/send')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter"><?php echo trans('send-estimate') ?> <?php echo html_escape($estimate->id) ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 text-right control-label col-form-label"><?php echo trans('to') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email_to" value="<?php echo helper_get_customer($estimate->customer)->email ?>" required>
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
                    <input type="hidden" name="send_estimate_id" class="send_estimate_id" value="<?php echo md5($estimate->id) ?>">
                    <input type="hidden" name="customer_id" value="<?php echo html_escape($estimate->customer) ?>">
                    <button type="submit" class="btn btn-info rounded waves-effect pull-right submit_btn"><?php echo trans('send') ?></button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php endforeach; ?>