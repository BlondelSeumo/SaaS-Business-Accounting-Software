<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-25"><?php if($type == 1){echo trans('income-by-customer');}else{echo trans('purchases-by-Vendor');} ?> <a href="#" class="btn btn-default btn-rounded print pull-right"><i class="fa fa-print"></i> <?php echo trans('print') ?> </a></h2>

                    <?php if($type == 1){$url_type = "customers";}else{$url_type = "vendors";} ?>

                    <form method="GET" class="sort_report_form validate-form" action="<?php echo base_url('admin/reports/'.$url_type)?>">
                        <div class="reprt-box">
                          <div class="row pl-15">
                      
                              <div class="col-md-4 col-xs-12 pl-0 mb-5 mt-5">
                                  <select class="form-control single_select" name="customer">
                                      <option value=""><?php if($type == 1){echo trans('all').' '.trans($url_type);}else{echo trans('all').' '.trans($url_type);} ?></option>
                                      <?php foreach ($customers as $customer): ?>
                                        <option value="<?php echo html_escape($customer->id) ?>" <?php if(isset($_GET['customer']) && $_GET['customer'] == $customer->id){echo "selected";} ?>
                                        ><?php echo html_escape($customer->name) ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>

                              <div class="col-md-2 col-xs-12 pl-0 mb-5 mt-5">
                                  <div class="input-group">
                                      <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start" value="<?php if(isset($_GET['start'])){echo $_GET['start'];} ?>" autocomplete="off">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                                  <small><?php echo trans('start-date') ?></small>
                              </div>

                              <div class="col-md-2 col-xs-12 pl-0 mb-5 mt-5">
                                  <div class="input-group">
                                      <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end" value="<?php if(isset($_GET['end'])){echo $_GET['end'];} ?>" autocomplete="off">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                                  <small><?php echo trans('end-date') ?></small>
                              </div>
                      
                              <div class="col-md-4 col-xs-12 pr-20 mb-5 mt-5 text-right">
                                  <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> <?php echo trans('show-report') ?></button>
                              </div>
                          </div>

                        </div>
                    </form>
                </div>
            </div>
              
            <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-50 p-0 print_area">
              <table class="table table-hover">
                  <thead class="bg-light">
                      <tr>
                          <th><?php echo trans('customers') ?></th>
                          <th class="text-right"><?php echo trans('') ?><?php if($type == 1){echo trans('all').' '.trans('income');}else{echo trans('all').' '.trans('purchase');} ?></th>
                          <th class="text-right"><?php echo trans('') ?><?php if($type == 1){echo trans('paid').' '.trans('income');}else{echo trans('paid').' '.trans('purchase');} ?></th>
                      </tr>
                  </thead>

                  <tbody>
                    <?php if($type == 1){$report_type = 'income';}else{$report_type = 'expense';} ?>
                    
                    <?php $total_income=0; $total_paid=0; ?>
                    <?php $i=1; foreach ($users as $user): ?>
                      <tr id="row_<?php echo html_escape($user->customer); ?>">
                          <td width="60%"><strong><?php echo $user->name; ?></strong></td>
                          <td class="text-right"><?php echo $this->business->currency_code.' '. number_format(get_incomes_by_customer($user->customer, $type), 2); ?></td>
                          <td class="text-right"><?php echo $this->business->currency_code.' '. number_format(get_paid_incomes_by_customer($user->customer, $report_type), 2); ?></td>
                      </tr>
                      
                      <?php 
                        $total_income += get_incomes_by_customer($user->customer, $type); 
                        $total_paid += get_paid_incomes_by_customer($user->customer, $report_type); 
                      ?>
                    <?php $i++; endforeach; ?>

                    <thead>
                        <tr>
                            <th class=""><?php echo trans('') ?><?php if($type == 1){echo trans('total').' '.trans('income');}else{echo trans('total').' '.trans('purchase');} ?></th>
                            <th class="text-right bbt-1 fs-20"><?php echo $this->business->currency_code.' '. number_format($total_income, 2); ?></th>
                            <th class="text-right bbt-1 fs-20"><?php echo $this->business->currency_code.' '. number_format($total_paid, 2); ?></th>
                        </tr>
                    </thead>
                  </tbody>

              </table>
            </div>
           
        </div>
    </section>
</div>