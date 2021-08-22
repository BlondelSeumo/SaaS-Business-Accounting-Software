<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-25"><?php echo trans('profit-loss') ?> <a href="#" class="btn btn-default btn-rounded print pull-right"><i class="fa fa-print"></i> <?php echo trans('print') ?> </a></h2>

                    <form method="GET" class="sort_report_form validate-form" action="<?php echo base_url('admin/reports/profit_loss') ?>">
                        <div class="reprt-box">
                          <div class="row mb-10 pl-15">
                              <div class="col-md-5 col-xs-12 mt-5 pl-0">
                                  <select class="form-control single_select report_type" required name="report_type">
                                      <option value=""><?php echo trans('report-types') ?></option>
                                      <option <?php echo(isset($_GET['report_type']) && $_GET['report_type'] == 1) ? 'selected' : ''; ?> value="1"><?php echo trans('paid-unpaid') ?> (<?php echo trans('paid-unpaid-inv-bill') ?>)</option>
                                      <option <?php echo(isset($_GET['report_type']) && $_GET['report_type'] == 2) ? 'selected' : ''; ?> value="2"><?php echo trans('paid') ?> (<?php echo trans('paid-inv-bill') ?>)</option>
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
                         
                              <div class="col-md-3 col-xs-12 mt-5 pl-0 text-right">
                                  <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> <?php echo trans('show-report') ?></button>
                              </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
            


            <div class="print_area">

              <div class="profit-and-loss-report mt-50">
                  <div class="profit-and-loss-single">
                    <p class="mb-0"><?php echo trans('income') ?></p>
                    <h1 class="fs-40 text-dark"><?php echo $this->business->currency_symbol.''.number_format($incomes, 2); ?></h1>
                  </div>
                  <div class="seperater-minus profit-and-loss-seperater">-</div>

                  <div class="profit-and-loss-single">
                    <p class="mb-0"><?php echo trans('expenses') ?></p>
                    <h1 class="fs-40 text-dark"><?php echo $this->business->currency_symbol.''.number_format($expenses, 2); ?></h1>
                  </div>
                  <div class="seperater-minus profit-and-loss-seperater">=</div>

                  <div class="profit-and-loss-single">
                    <p class="mb-0"><?php echo trans('net-profit') ?></p>
                    <?php if ($profitloss < 0):?>
                      <h1 class="fs-40 text-danger"><?php echo '- '.$this->business->currency_symbol.''.abs($profitloss); ?></h1>
                    <?php else: ?>
                      <h1 class="fs-40 text-success"><?php echo $this->business->currency_symbol.''.$profitloss; ?></h1>
                    <?php endif; ?>
                  </div>
              </div>

              <div class="profit-and-loss-report mt-30 bb-2">
                  <div>
                    <h4 class="mb-0"><?php echo trans('profit-loss') ?> <?php echo trans('reports') ?></h4>
                  </div>

                  <div class="mb-10">
                    <p class="p-0 m-0">&emsp;<?php if(isset($_GET['start'])){echo $_GET['start'];} ?></p>
                    <p class="p-0 m-0"><strong>to</strong> <?php if(isset($_GET['end'])){echo $_GET['end'];} ?></p>
                  </div>
              </div>

              <div class="profit-and-loss-report mt-20">
                  <div>
                    <h4 class="m-0 fwn"><?php echo trans('income') ?></h4>
                  </div>

                  <div class="mb-10">
                    <p class="p-0 m-0 fs-20"><?php echo $this->business->currency_code.' '.number_format($incomes, 2); ?></p>
                  </div>
              </div>

              <div class="profit-and-loss-report pt-10 pb-10 bb-2">
                  <div>
                    <h4 class="m-0 fwn"><?php echo trans('expense') ?></h4>
                  </div>

                  <div class="mb-10">
                    <p class="p-0 m-0 fs-20"><?php echo $this->business->currency_code.' '.number_format($expenses, 2); ?></p>
                  </div>
              </div>

              <div class="profit-and-loss-report pt-10">
                  <div>
                    <h4 class="m-0 fwn"><?php echo trans('net-profit') ?></h4>
                  </div>

                  <div class="mb-10">
                    <?php if ($profitloss < 0):?>
                      <p class="fs-20 p-0 m-0 text-danger"><?php echo '- '.$this->business->currency_code.' '.abs($profitloss); ?></p>
                    <?php else: ?>
                      <p class="fs-20 p-0 m-0 text-success"><?php echo $this->business->currency_code.' '.$profitloss; ?></p>
                    <?php endif; ?>
                  </div>
              </div>

            </div>

        </div>
    </section>
</div>