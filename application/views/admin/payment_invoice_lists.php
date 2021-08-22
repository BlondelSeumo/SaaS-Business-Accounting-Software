<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="list_area container">
      <h3 class="box-title"><?php echo trans('payment').' '.trans('invoices') ?> </h3>
    
     
      <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0">
          <table class="table table-hover <?php if(count($payments) > 10){echo "datatable";} ?> cushover" id="dg_table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th><?php echo trans('plan') ?></th>
                      <th><?php echo trans('billing-frequency') ?></th>
                      <th><?php echo trans('amount') ?></th>
                      <th><?php echo trans('date') ?></th>
                      <th class="text-right"><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($payments as $payment): ?>

                  <?php if ($payment->amount != '0.00'): ?>
                    <tr id="row_<?php echo html_escape($payment->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo html_escape($payment->package_name); ?></td>
                        <td><?php echo html_escape($payment->billing_type); ?></td>
                        <td><?php echo html_escape($settings->currency) ?> <?php echo html_escape($payment->amount); ?></td>
                        <td><span class="label label-light-success brd-30"> <?php echo my_date_show($payment->created_at); ?> </span></td>
                        
                        <td class="actions" width="30%">
                          <a target="_blank" href="<?php echo base_url('admin/payment/receipt/'.$payment->puid) ?>" class="pull-right btn btn-default btn-sm"><i class="fa fa-eye"></i> <?php echo trans('view') ?></a>

                          <!-- <a target="_blank" href="<?php //echo base_url('readonly/export_invoice/'.$payment->puid) ?>" class="pull-right btn btn-default btn-sm mr-10"><i class="fa fa-cloud-download"></i> <?php //echo trans('download-pdf') ?></a> -->
                        </td>
                    </tr>
                  <?php endif ?>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>
      </div>

     
    </div>
    

  </section>
</div>
