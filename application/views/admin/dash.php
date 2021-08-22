<div class="content-wrapper">

  <section class="content"> 

    <div class="row">

      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><strong class="text-right"><?php echo trans('last-12-months-income') ?> </strong></h3>
          </div>
          <div class="box-body">
            <div id="incomeChart"></div>
          </div>
        </div>

        <div class="box mt-10">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo trans('net-income') ?></h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th><?php echo trans('fiscal-year') ?> <i class="fa fa-info-circle" data-toggle="tooltip" data-title="Fiscal year start is January 01"></i></th>
                    <?php foreach ($net_income as $netincome): ?>
                      <th><?php echo show_year($netincome->payment_date) ?></th>
                    <?php endforeach ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo trans('income') ?></td>
                    <?php foreach ($net_income as $netincome): ?>
                      <td><?php echo html_escape($this->business->currency_symbol) ?><?php echo number_format($netincome->total,2) ?></td>
                    <?php endforeach ?>
                  </tr>
                  <tr>
                    <td><?php echo trans('expense') ?></td> 
                    <?php foreach ($net_income as $netincome): ?>
                      <td><?php echo html_escape($this->business->currency_symbol) ?><?php echo get_expense_by_year(show_year($netincome->payment_date)) ?></td>
                    <?php endforeach ?>
                  </tr>
                  <tr>
                    <td><?php echo trans('net-income') ?> </td>
                    <?php foreach ($net_income as $netincome): ?>
                      <td><strong><?php echo html_escape($this->business->currency_symbol) ?><?php echo number_format($netincome->total - get_expense_by_year(show_year($netincome->payment_date)),2) ?></strong></td>
                    <?php endforeach ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-6">


          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('upcomming-recurring-payments') ?></h3>
              </div>

              <div class="box-body">
                <?php if (empty($upcoming_payments)): ?>
                  <p><?php echo trans('no-data-founds') ?></p>
                <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                        <tr>
                         <th><?php echo trans('customer') ?></th>
                         <th><?php echo trans('total') ?></th>
                         <th><?php echo trans('amount-due') ?></th>
                         <th><?php echo trans('next-payment') ?></th>
                         <th><?php echo trans('status') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($upcoming_payments as $payment): ?>
                          
                            <tr>
                              <td><?php echo html_escape($payment->customer_name) ?></td>
                              <td><?php echo html_escape($this->business->currency_symbol.''.$payment->grand_total) ?></td>
                              <td><?php echo html_escape($this->business->currency_symbol.''.($payment->grand_total - get_total_invoice_payments($payment->id, $payment->parent_id))) ?></td>
                              <td><?php echo my_date_show($payment->next_payment) ?></td>
                              <td>
                                <span class="custom-label-lg label-light-info"><?php echo trans('upcomming') ?></span>
                              </td>
                            </tr>
                          <?php endforeach ?>
                      </tbody>
                    </table>
                </div>
                <?php endif ?>
              </div>

              <?php if (!empty($upcoming_payments) && check_permissions(auth('role'), 'invoices') == TRUE): ?>
                <div class="text-center bt-1 border-light p-10">
                  <a class="d-block font-size-14" href="<?php echo base_url('admin/invoice/type/3?recurring=1') ?>"><?php echo trans('all-invoices') ?>  <i class="fa fa-long-arrow-right"></i></a>
                </div>
              <?php endif ?>

          </div>


          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo trans('overdue-invoices') ?></h3>
            </div>

            <div class="box-body">
              <?php if (empty($overdues)): ?>
                <p><?php echo trans('no-data-founds') ?></p>
              <?php else: ?>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><?php echo trans('customer') ?></th>
                      <th><?php echo trans('amount') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($overdues as $due): ?>
                          <tr>
                            <td><?php echo html_escape($due->customer_name) ?></td>
                            <td><?php echo html_escape($this->business->currency_symbol.''.$due->grand_total) ?></td>
                          </tr>
                        <?php endforeach ?>
                  </tbody>
                  </table>
                </div>
                <?php endif ?>
              </div>

              <?php if (!empty($overdues) && check_permissions(auth('role'), 'invoices') == TRUE): ?>
                <div class="text-center bt-1 border-light p-10">
                  <a class="d-block font-size-14" href="<?php echo base_url('admin/invoice/type/1') ?>"><?php echo trans('see-all-overdue-invoices') ?>  <i class="fa fa-long-arrow-right"></i></a>
                </div>
              <?php endif ?>
          </div>



          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo trans('pending-invoices') ?></h3>
            </div>

            <div class="box-body">
              <?php if (empty($pending)): ?>
                  <p><?php echo trans('no-data-founds') ?></p>
              <?php else: ?>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><?php echo trans('customer') ?></th>
                      <th><?php echo trans('amount') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($pending as $pending): ?>
                          <tr>
                            <td><?php echo html_escape($pending->customer_name) ?></td>
                            <td><?php echo html_escape($this->business->currency_symbol.''.$pending->grand_total) ?></td>
                          </tr>
                        <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <?php endif ?>
              </div>

              <?php if (!empty($overdues)): ?>
                <div class="text-center bt-1 border-light p-10">
                  <a class="d-block font-size-14" href="<?php echo base_url('admin/invoice/type/1') ?>"><?php echo trans('all-invoices') ?>  <i class="fa fa-long-arrow-right"></i></a>
                </div>
              <?php endif ?>
          </div>

          <div class="box hide">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans('recently-paid-invoices') ?></h3>
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                       <th><?php echo trans('customer') ?></th>
                       <th><?php echo trans('amount') ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (empty($paids)): ?>
                        <p><?php echo trans('no-data-founds') ?></p>
                        <?php else: ?>
                          <?php foreach ($paids as $paid): ?>
                            <tr>
                              <td><?php echo html_escape($paid->customer_name) ?></td>
                              <td><?php echo html_escape($this->business->currency_symbol.''.$paid->grand_total) ?></td>
                            </tr>
                          <?php endforeach ?>
                        <?php endif ?>
                      </tbody>
                    </table>
                </div>
              </div>

                <?php if (!empty($paids)): ?>
                  <div class="text-center bt-1 border-light p-10">
                    <a class="d-block font-size-14" href="<?php echo base_url('admin/invoice/type/3') ?>"><?php echo trans('see-all-paid-invoices') ?>  <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                <?php endif ?>

          </div>


        </div>

        </div>

      </section>

    </div>