<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-25"><?php echo trans('sales-tax-report') ?> <a href="#" class="btn btn-default btn-rounded print pull-right"><i class="fa fa-print"></i> <?php echo trans('print') ?> </a></h2>

                    <form method="GET" class="sort_report_form validate-form" action="<?php echo base_url('admin/reports/sales_tax') ?>">
                        <div class="reprt-box">
                          <div class="row pl-15">
                              <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                  <select class="form-control single_select report_type" required name="report_type">
                                      <option value=""><?php echo trans('report-types') ?></option>
                                      <option <?php echo(isset($_GET['report_type']) && $_GET['report_type'] == 1) ? 'selected' : ''; ?> value="1"><?php echo trans('paid-unpaid') ?></option>
                                      <option <?php echo(isset($_GET['report_type']) && $_GET['report_type'] == 2) ? 'selected' : ''; ?> value="2"><?php echo trans('paid') ?></option>
                                  </select>
                              </div>

                              <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                  <div class="input-group">
                                      <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start" value="<?php if(isset($_GET['start'])){echo $_GET['start'];} ?>" autocomplete="off">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                                  <small><?php echo trans('start-date') ?></small>
                              </div>

                              <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                  <div class="input-group">
                                      <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end" value="<?php if(isset($_GET['end'])){echo $_GET['end'];} ?>" autocomplete="off">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                                  <small><?php echo trans('end-date') ?></small>
                              </div>
                              <div class="col-md-6 col-xs-12 mt-5 pl-0 text-right">
                                <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> <?php echo trans('show-report') ?></button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
              

            <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-50 p-0 print_area">
              <table class="table cushover table-hover">
                  <thead class="bg-pale-secondary">
                      <tr>
                          <th><?php echo trans('tax') ?></th>
                          <th><?php echo trans('sales-product-tax') ?></th>
                          <th><?php echo trans('tax-amount-sale') ?></th>
                          <th><?php echo trans('purchase-subject') ?></th>
                          <th><?php echo trans('tax-amount-purchase') ?></th>
                          <th><?php echo trans('tax-owing') ?></th>
                      </tr>
                  </thead>

                  <tbody>
                    <?php $sale_tax_sum=0; $purchase_tax_sum=0; $net_tax_sum=0; ?>

                    <?php $i=1; foreach ($taxes as $tax): ?>
                      <tr id="row_<?php echo html_escape($tax->id); ?>">
                          
                          <td><strong><?php echo $tax->tax_name.' ('.round($tax->rate).'%)'; ?></strong></td>
                          
                          <td>
                            <?php $total_subtotal = 0; $total_sale = 0; foreach ($tax->type as $type): ?>
                              <?php foreach ($type->sales as $sale): ?>
                                <?php 
                                  $total_sale += $sale->convert_total;
                                  $total_subtotal += $sale->sub_total;
                                ?>
                              <?php endforeach ?>
                            <?php endforeach ?>
                            <?php echo $this->business->currency_code.' '.number_format($total_sale, 2); ?>
                          </td>

                          <td>
                            <?php $sale_tax = $total_subtotal*$tax->rate/100; ?>
                            <?php echo $this->business->currency_code.' '.number_format($sale_tax, 2); ?>
                          </td>

                          <td>
                            <?php $total_pur_subtotal = 0; $total_purchase = 0; foreach ($tax->type as $type): ?>
                              <?php foreach ($type->purchases as $purchase): ?>
                                <?php 
                                  $total_purchase += $purchase->convert_total;
                                  $total_pur_subtotal += $purchase->sub_total;
                                ?>
                              <?php endforeach ?>
                            <?php endforeach ?>
                            <?php echo $this->business->currency_code.' '.number_format($total_purchase, 2); ?>
                          </td>

                          <td>
                            <?php $purchase_tax = $total_pur_subtotal*$tax->rate/100; ?>
                            <?php echo $this->business->currency_code.' '.number_format($purchase_tax, 2); ?>
                          </td>

                          <td>
                            <?php echo $this->business->currency_code.' '.number_format($sale_tax-$purchase_tax, 2); ?>
                          </td>
                         
                      </tr>

                      <?php 
                        $sale_tax_sum += $sale_tax; 
                        $purchase_tax_sum += $purchase_tax; 
                        $net_tax_sum += $sale_tax+$purchase_tax; 
                      ?>

                    <?php $i++; endforeach; ?>
                  </tbody>

                  <thead class="bg-light">
                      <tr>
                          <th class="fs-20"><?php echo trans('total') ?></th>
                          <th></th>
                          <th class="fs-20"><?php echo $this->business->currency_code.' '. number_format($sale_tax_sum, 2); ?></th>
                          <th></th>
                          <th class="fs-20"><?php echo $this->business->currency_code.' '. number_format($purchase_tax_sum, 2); ?></th>
                          <th class="fs-20"><?php echo $this->business->currency_code.' '. number_format($net_tax_sum, 2); ?></th>
                      </tr>
                  </thead>


              </table>
            </div>
           
        </div>
    </section>
</div>