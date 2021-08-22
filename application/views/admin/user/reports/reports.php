<div class="content-wrapper">
    <section class="content">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2>
                    <i class="flaticon-bar-chart"></i> <?php echo trans('reports') ?>
                    <span class="pull-right"></span>
                  </h2>
                  <form method="GET" class="sort_report_form validate-form" action="<?php echo base_url('admin/reports/generate') ?>">
                      <div class="reprt-box">
                        <div class="row mb-10 pl-15">
                            <div class="col-md-3 col-xs-12 mt-5 pl-0">
                                <select class="form-control single_select report_types" required name="report_types">
                                    <option value=""><?php echo trans('report-types') ?></option>
                                    <option <?php echo(isset($_GET['report_types']) && $_GET['report_types'] == 1) ? 'selected' : ''; ?> value="1"><?php echo trans('invoices') ?></option>
                                    <option <?php echo(isset($_GET['report_types']) && $_GET['report_types'] == 2) ? 'selected' : ''; ?> value="2"><?php echo trans('estimates') ?></option>
                                    <option <?php echo(isset($_GET['report_types']) && $_GET['report_types'] == 3) ? 'selected' : ''; ?> value="3"><?php echo trans('expenses') ?></option>
                                </select>
                            </div>

                            <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start_date" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                <div class="input-group">
                                    <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end_date" value="<?php if(isset($_GET['end_date'])){echo $_GET['end_date'];} ?>" autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        
                            <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                <select class="form-control single_select" name="tax_info">
                                    <option value=""><?php echo trans('tax-info') ?></option>
                                    <option <?php echo(isset($_GET['tax_info']) && $_GET['tax_info'] == 0) ? 'selected' : ''; ?> value="0"><?php echo trans('all') ?></option>
                                    <option <?php echo(isset($_GET['tax_info']) && $_GET['tax_info'] == 1) ? 'selected' : ''; ?> value="1"><?php echo trans('with-tax') ?></option>
                                    <option <?php echo(isset($_GET['tax_info']) && $_GET['tax_info'] == 2) ? 'selected' : ''; ?> value="2"><?php echo trans('without-tax') ?></option>
                                </select>
                            </div>

                            <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                <select class="form-control single_select income_items" name="status">
                                    <option value="0"><?php echo trans('all-status') ?></option>
                                    <option value="2" <?php echo(isset($_GET['status']) && $_GET['status'] == 2) ? 'selected' : ''; ?>
                                      ><?php echo trans('paid') ?></option>
                                    <option value="1" <?php echo(isset($_GET['status']) && $_GET['status'] == 1) ? 'selected' : ''; ?>
                                      ><?php echo trans('unpaid') ?></option>
                                </select>
                            </div>

                            <div class="col-md-4 col-xs-12 mt-5 pl-0 expense_items" style="display: <?php echo(isset($_GET['report_types']) && $_GET['report_types'] == 3) ? 'block' : 'none'; ?>;">
                                <select class="form-control single_select" name="vendor">
                                    <option value="0"><?php echo trans('vendors') ?></option>
                                    <?php foreach ($vendors as $vendor): ?>
                                      <option value="<?php echo html_escape($vendor->id) ?>" <?php echo(isset($_GET['vendor']) && $_GET['vendor'] == $vendor->id) ? 'selected' : ''; ?>
                                      ><?php echo html_escape($vendor->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-4 col-xs-12 mt-5 pl-0 income_items" style="display: <?php echo(isset($_GET['report_types']) && $_GET['report_types'] != 3) ? 'block' : 'none'; ?>;">
                                <select class="form-control single_select" name="customer">
                                    <option value="0"><?php echo trans('all-customers') ?></option>
                                    <?php foreach ($customers as $customer): ?>
                                      <option value="<?php echo html_escape($customer->id) ?>" <?php echo(isset($_GET['customer']) && $_GET['customer'] == $customer->id) ? 'selected' : ''; ?>
                                      ><?php echo html_escape($customer->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12 mt-15 pl-0">
                            <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> <?php echo trans('show-report') ?></button>
                            <a href="<?php echo base_url('admin/reports') ?>" class="btn btn-default reset-report"><i class="flaticon-reload"></i> <?php echo trans('reset-filter') ?></a>
                        </div>
                      </div>
                  </form>
              </div>



              <?php if (isset($page_title) && $page_title == 'Reports'): ?>
                <div class="col-md-12 text-center">
                    <div class="p-50 smshadow">
                        <h4 class="m-auto"><?php echo trans('no-data-founds') ?></h4>
                    </div>
                </div>
              <?php endif ?>


     
              <?php if (isset($page_title) && $page_title == 'Income Reports'): ?>
                <div class="col-md-12 mt-50">
                    <div class="table-responsive">
                        <table class="table table-bordered dshadow table-hover dt_btn datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo trans('status') ?></th>
                                    <th><?php echo trans('invoice-number') ?></th>
                                    <th><?php echo trans('customer') ?></th>
                                    <th><?php echo trans('tax') ?></th>
                                    <th><?php echo trans('amount') ?></th>
                                    <th><?php echo trans('net-amount') ?></th>
                                    <th><?php echo trans('date') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $total_ex_tax=0; $total=0; $r=1; foreach ($reports as $report): ?>
                                <tr id="row_<?php echo html_escape($report->id); ?>">
                                    <td><?php echo $r; ?></td>
                                    <td>
                                      <?php if ($report->status == 0): ?>
                                          <span class="custom-label-sm label-light-default"><?php echo trans('draft') ?></span>
                                      <?php elseif($report->status == 2): ?>
                                          <span class="custom-label-sm label-light-success"><?php echo trans('paid') ?></span>
                                      <?php elseif($report->status == 1): ?>
                                          <span class="custom-label-sm label-light-danger"><?php echo trans('unpaid') ?></span>
                                      <?php endif ?>
                                    </td>
                                    <td><?php echo html_escape($report->number); ?></td>
                                    <td>
                                      <?php if (!empty(helper_get_customer($report->customer))): ?>
                                          <?php echo helper_get_customer($report->customer)->name ?>
                                      <?php endif ?>
                                    </td>
                                    <td>
                                      <?php if (!empty($report->tax)): ?>
                                        <?php echo html_escape($report->tax); ?>%
                                      <?php endif ?>
                                    </td>
                                    <td><?php echo html_escape($this->business->currency_symbol.''.$report->convert_total); ?></td>
                                    <td><?php echo html_escape($this->business->currency_symbol.''.$report->convert_total); ?></td>
                                    <td><span class="label label-default"> <?php echo my_date_show($report->date); ?> </span></td>
                                    <?php $total += $report->convert_total; ?>
                                    <?php $total_ex_tax += $report->sub_total; ?>
                                </tr>
                              <?php $r++; endforeach; ?>

                           
                              <div class="row report_info">
                                  <div class="col-md-6">
                                  
                                    <p>
                                      <span><?php echo trans('report-types') ?>:</span> 
                                      <?php if (isset($_GET['report_types']) && $_GET['report_types'] == 1): ?>
                                        <?php echo trans('invoices') ?>
                                      <?php elseif (isset($_GET['report_types']) && $_GET['report_types'] == 2): ?>
                                        <?php echo trans('estimates') ?>
                                      <?php else: ?>
                                        <?php echo trans('expenses') ?>
                                      <?php endif ?>
                                    </p>

                                    <p><span><?php echo trans('tax-info') ?>:</span> 
                                      <?php if (isset($_GET['tax_info']) && $_GET['tax_info'] == 1): ?>
                                        <?php echo trans('with-tax') ?>
                                      <?php elseif (isset($_GET['tax_info']) && $_GET['tax_info'] == 2): ?>
                                        <?php echo trans('without-tax') ?>
                                      <?php else: ?>
                                        <?php echo trans('all') ?>
                                      <?php endif ?>
                                    </p>

                                    <p><span><?php echo trans('status') ?>:</span>
                                      <?php if (isset($_GET['status']) && $_GET['status'] == 1): ?>
                                        <?php echo trans('unpaid') ?>
                                      <?php elseif (isset($_GET['status']) && $_GET['status'] == 2): ?>
                                        <?php echo trans('paid') ?>
                                      <?php else: ?>
                                        <?php echo trans('all') ?>
                                      <?php endif ?>
                                    </p>

                                    <p><span><?php echo trans('customers') ?>:</span>
                                      <?php if (isset($_GET['customer']) && $_GET['customer'] != 0): ?>
                                         <?php if (!empty(helper_get_customer($_GET['customer']))): ?>
                                              <?php echo helper_get_customer($_GET['customer'])->name ?>
                                          <?php endif ?>
                                      <?php else: ?>
                                        <?php echo trans('all') ?>
                                      <?php endif ?>
                                    </p>

                                    <?php if (isset($_GET['start_date']) && $_GET['start_date'] != ''): ?>
                                      <p><span><?php echo trans('start-date') ?>:</span> <?php echo html_escape($_GET['start_date']); ?></p>
                                    <?php endif ?>
                                    
                                    <?php if (isset($_GET['end_date']) && $_GET['end_date'] != ''): ?>
                                      <p><span><?php echo trans('end-date') ?>:</span> <?php echo html_escape($_GET['end_date']); ?></p>
                                    <?php endif ?>

                                  </div>

                                  <div class="col-md-6 text-right">
                                    <?php if (isset($_GET['tax_info']) && $_GET['tax_info'] == 1): ?>
                                      <p><span><?php echo trans('total') ?> (<?php echo trans('with-tax') ?>):</span> <?php echo $this->business->currency_symbol.number_format($total,2); ?></p>
                                    <?php elseif (isset($_GET['tax_info']) && $_GET['tax_info'] == 2): ?>
                                      <p><span><?php echo trans('total') ?> (<?php echo trans('without-tax') ?>):</span> <?php echo $this->business->currency_symbol.number_format($total_ex_tax,2); ?></p>
                                    <?php else: ?>
                                      <p><span><?php echo trans('total') ?>:</span> <?php echo $this->business->currency_symbol.number_format($total,2); ?></p>
                                    <?php endif ?>
                                  </div>
                              </div>

                            </tbody>
                        </table>
                    </div>
                </div>

              <?php endif ?>

              <?php if (isset($page_title) && $page_title == 'Expense Reports'): ?>
                <div class="col-md-12 mt-50">
                    <div class="table-responsive dshadow">
                        <table class="table table-hover datatable dt_btn">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo trans('vendors') ?></th>
                                    <th><?php echo trans('tax') ?></th>
                                    <th><?php echo trans('amount') ?></th>
                                    <th><?php echo trans('net-amount') ?></th>
                                    <th><?php echo trans('date') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $total_ex_tax=0; $total=0; $e=1; foreach ($reports as $report): ?>
                                <tr id="row_<?php echo html_escape($report->id); ?>">
                                    <td><?php echo $e; ?></td>
                                    <td>
                                      <?php if (!empty(helper_get_vendor($report->vendor))): ?>
                                          <?php echo helper_get_vendor($report->vendor)->name ?>
                                      <?php endif ?>
                                    </td>
                                    <td><?php echo html_escape($report->tax); ?>%</td>
                                    <td><?php echo html_escape($this->business->currency_symbol.''.$report->amount); ?></td>
                                    <td><?php echo html_escape($this->business->currency_symbol.''.$report->net_amount); ?></td>
                                    <td><span class="label label-default"> <?php echo my_date_show($report->date); ?> </span></td>
                                    <?php $total += $report->net_amount; ?>
                                    <?php $total_ex_tax += $report->amount; ?>
                                </tr>
                              <?php $e++; endforeach; ?>

                              <div class="row report_info">
                                  <div class="col-md-6">
                                  
                                    <p>
                                      <span><?php echo trans('report-types') ?>:</span> 
                                      <?php if (isset($_GET['report_types']) && $_GET['report_types'] == 1): ?>
                                        <?php echo trans('invoices') ?>
                                      <?php elseif (isset($_GET['report_types']) && $_GET['report_types'] == 2): ?>
                                        <?php echo trans('estimates') ?>
                                      <?php else: ?>
                                        <?php echo trans('expenses') ?>
                                      <?php endif ?>
                                    </p>

                                    <p><span><?php echo trans('tax-info') ?>:</span> 
                                      <?php if (isset($_GET['tax_info']) && $_GET['tax_info'] == 1): ?>
                                        <?php echo trans('with-tax') ?>
                                      <?php elseif (isset($_GET['tax_info']) && $_GET['tax_info'] == 2): ?>
                                        <?php echo trans('without-tax') ?>
                                      <?php else: ?>
                                        <?php echo trans('all') ?>
                                      <?php endif ?>
                                    </p>

                                    <p><span><?php echo trans('vendors') ?>:</span>
                                      <?php if (isset($_GET['vendor']) && $_GET['vendor'] != 0): ?>
                                         <?php if (!empty(helper_get_vendor($_GET['vendor']))): ?>
                                              <?php echo helper_get_vendor($_GET['vendor'])->name ?>
                                          <?php endif ?>
                                      <?php else: ?>
                                        <?php echo trans('all') ?>
                                      <?php endif ?>
                                    </p>

                                    <?php if (isset($_GET['start_date']) && $_GET['start_date'] != ''): ?>
                                      <p><span><?php echo trans('start-date') ?>:</span> <?php echo html_escape($_GET['start_date']); ?></p>
                                    <?php endif ?>
                                    
                                    <?php if (isset($_GET['end_date']) && $_GET['end_date'] != ''): ?>
                                      <p><span><?php echo trans('end-date') ?>:</span> <?php echo html_escape($_GET['end_date']); ?></p>
                                    <?php endif ?>

                                  </div>

                                  <div class="col-md-6 text-right">
                                    <?php if (isset($_GET['tax_info']) && $_GET['tax_info'] == 1): ?>
                                      <p><span><?php echo trans('total') ?> (<?php echo trans('with-tax') ?>):</span> <?php echo $this->business->currency_symbol.number_format($total, 2); ?></p>
                                    <?php elseif (isset($_GET['tax_info']) && $_GET['tax_info'] == 2): ?>
                                      <p><span><?php echo trans('total') ?> (<?php echo trans('without-tax') ?>):</span> <?php echo $this->business->currency_symbol.number_format($total_ex_tax, 2); ?></p>
                                    <?php else: ?>
                                      <p><span><?php echo trans('total') ?>:</span> <?php echo $this->business->currency_symbol.number_format($total, 2); ?></p>
                                    <?php endif ?>
                                  </div>
                              </div>
                            </tbody>
                        </table>
                    </div>
                </div>
              <?php endif ?>

          </div>
        </div>
    </section>
</div>