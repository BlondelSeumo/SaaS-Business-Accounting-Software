<?php include'invoice_val.php'; ?>

<div class="card-body p-0">
    <div class="flex-parent-between">
        <div class="col-md-6s text-left">
            <?php if (empty($logo)): ?>
                <br><span class="alterlogo" style="padding-top: 80px !important;"><?php echo $business_name ?></span>
            <?php else: ?>
                <img width="130px" src="<?php echo base_url($logo) ?>" alt="Logo" style="padding-top: 50px;">
            <?php endif ?>
        </div>
        <div class="col-md-6s text-right" style="margin-top: -45px">
            <p class="font-weight-bold mb-0"><?php echo html_escape($title) ?></p>
            <p class="text-muted mb-0"><?= strip_tags($summary) ?></p>
            <p class="mb-0"><?= $business_name ?></p>
            <p class="mt-0 mb-0 redup"><?= strip_tags($business_address) ?></p>
            <?php if (!empty($biz_number)): ?>
            <p class="mb-0"><?php echo trans('business').' '.trans('number') ?>: <?php echo html_escape($biz_number) ?></p>
            <?php endif ?>
            <?php if (!empty($biz_vat_code)): ?>
            <p class="mb-0"><?php echo trans('tax').'/vat '.trans('number') ?>: <?php echo html_escape($biz_vat_code) ?></p>
            <?php endif ?>
            <p class="mb-0"><?php echo html_escape($country) ?></p>
        </div>
    </div>



    <div class="row bill_area" style="margin-top:40px; margin-bottom: 30px">
        <div class="col-md-8" style="width: 75%; float: left;">
            
            <?php if (isset($page) && $page == 'Bill'): ?>
                <h5 class="font-weight-bold"><?php echo trans('purchase-from') ?></h5>
            <?php else: ?>
                <h5 class="font-weight-bold"><?php echo trans('bill-to') ?></h5>
            <?php endif ?>

            <?php if (empty($customer_id)): ?>
                <p class="mb-1"><?php echo trans('empty-customer') ?></p>
            <?php else: ?>
                <p class="mb-1">
                    <?php if (isset($page) && $page == 'Bill'): ?>
                        <?php if (!empty(helper_get_vendor($customer_id))): ?>
                            <p class="mb-0"><strong><?php echo helper_get_vendor($customer_id)->name ?></strong></p>
                            <p class="mt-0 mb-0"><?php echo helper_get_vendor($customer_id)->address ?></p>
                            <p class="mt-0 mb-0"><?php echo helper_get_vendor($customer_id)->phone ?></p>
                            <p class="mt-0 mb-0"><?php echo helper_get_vendor($customer_id)->email ?></p>
                        <?php endif ?>
                    <?php else: ?>

                        <?php if (!empty(helper_get_customer($customer_id))): ?>
                            <p class="mb-0"><strong><?php echo helper_get_customer($customer_id)->name ?></strong></p>
                            <p class="mt-0 mb-0"><?php echo helper_get_customer($customer_id)->address ?> <?php echo helper_get_customer($customer_id)->country ?></p>
                            <p class="mt-0 mb-0"><?php echo helper_get_customer($customer_id)->phone ?></p>

                            <?php if (!empty($cus_number)): ?>
                            <p class="mt-0 mb-0"><?php echo trans('business').' '.trans('number') ?>: <?php echo html_escape($cus_number) ?></p>
                            <?php endif ?>

                            <?php if (!empty($cus_vat_code)): ?>
                            <p class="mt-0"><?php echo trans('tax').'/vat '.trans('number') ?>: <?php echo html_escape($cus_vat_code) ?></p>
                            <?php endif ?>

                        <?php endif ?>
                    <?php endif ?>
                </p>
            <?php endif ?>
        </div>

        <div class="col-md-4 text-right" style="width: 35%; float: right;">
            <table class="tables pull-right" style="margin-top: -70px;">
                <tr>
                    <td class="text-right"><b><?php if(isset($page) && $page == 'Invoice'){echo trans('invoice-number');}else if($page == 'Estimate'){echo trans('estimate-number');}else{echo trans('bill-number');} ?>:</b></td>
                    <td class="text-right" colspan="1"><?php echo html_escape($number) ?></td>
                </tr>

                <?php if (!empty($poso_number)): ?>
                    <tr>
                        <td class="text-right"><b class="mr-10"><?php echo trans('p.o.s.o.-number') ?>:</b></td>
                        <td class="text-right" colspan="1"><?php echo html_escape($poso_number) ?></td>
                    </tr>
                <?php endif ?>

                <tr>
                    <td class="text-right"><b><?php if(isset($page) && $page == 'Invoice'){echo trans('invoice-date');}else{echo trans('date');} ?>:</b></td>
                    <td class="text-right" colspan="1"><?php echo my_date_show($date) ?></td>
                </tr>

                <?php if (!empty($payment_due)): ?>
                <tr>
                    <td class="text-right"><b><?php echo trans('due-date') ?>:</b></td>
                    <td class="text-right">
                        <?php echo my_date_show($payment_due) ?>
                    </td>
                </tr>
                <?php endif ?>

                <tr>
                    <td></td>
                    <td class="text-right">
                        <?php if ($due_limit == 1): ?>
                            <p><?php echo trans('on-receipt') ?></p>
                        <?php else: ?>
                            <p><?php echo trans('within') ?> <?php echo html_escape($due_limit) ?> <?php echo trans('days') ?></p>
                        <?php endif ?>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <div class="row p-0 table_area">
        <div class="col-md-12">
            <table class="table">
                <thead class="pre_head">
                    <tr class="pre_head_tr" style="background: #f0f4fa !important">
                        <th class="border-0" style="color: #444 !important; background: #f0f4fa; font-weight: bold;"><?php echo trans('items') ?></th>
                        <th class="border-0" style="color: #444 !important; background: #f0f4fa; font-weight: bold;"><?php echo trans('price') ?></th>
                        <th class="border-0" style="color: #444 !important; background: #f0f4fa; font-weight: bold;"><?php echo trans('quantity') ?></th>
                        <th class="border-0" style="color: #444 !important; background: #f0f4fa; font-weight: bold;"><?php echo trans('amount') ?></th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (isset($page_title) && $page_title == 'Invoice Preview'): ?>
                        <?php if (!empty($this->session->userdata('item'))): ?>
                            <?php $total_items = count($this->session->userdata('item')); ?>
                        <?php else: ?>
                            <?php $total_items = 0; ?>
                        <?php endif ?>
                        
                        <?php if (empty($total_items)): ?>
                            <tr>
                                <td colspan="4" class="text-center"><?php echo trans('empty-items') ?></td>
                            </tr>
                        <?php else: ?>
                            <?php for ($i=0; $i < $total_items; $i++) { ?>
                                <tr>
                                    <td width="50%">
                                    <?php $product_id = $this->session->userdata('item')[$i] ?>
                                    
                                    <?php if (is_numeric($product_id)) {
                                        echo helper_get_product($product_id)->name;
                                    } else {
                                        echo html_escape($product_id);
                                    } ?>
                                    </td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo $this->session->userdata('price')[$i] ?></td>
                                    <td><?php echo $this->session->userdata('quantity')[$i] ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo number_format($this->session->userdata('total_price')[$i], 2) ?></td>
                                </tr>
                            <?php } ?>
                        <?php endif ?>
                    <?php else: ?>
                        <?php $items = helper_get_invoice_items($invoice->id) ?>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="4" class="text-center"><?php echo trans('empty-items') ?></td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td width="50%"><?php echo html_escape($item->item_name) ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($item->price) ?></td>
                                    <td><?php echo html_escape($item->qty) ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo number_format($item->total, 2) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong><?php echo trans('sub-total') ?></strong></td>
                        <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($sub_total) ?></span></td>
                    </tr>
                    <?php if (!empty($tax)): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong><?php echo trans('tax') ?> <?php echo html_escape($tax) ?>%</strong></td>
                            <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($sub_total * ($tax / 100), 2) ?></span></td>
                        </tr>
                    <?php endif ?>
                    <?php if (!empty($discount)): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong><?php echo trans('discount') ?> <?php echo html_escape($discount) ?>%</strong></td>
                            <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($sub_total * ($discount / 100), 2) ?></span></td>
                        </tr>
                    <?php endif ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong><?php echo trans('grand-total') ?></strong></td>
                        <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($grand_total) ?></span></td>
                    </tr>

                    <?php foreach (get_invoice_payments($invoice->id) as $payment): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                                <span class="fs-13"><strong><?php echo trans('payment-on') ?> <?php echo my_date_show($payment->payment_date) ?> <?php echo trans('using') ?> <?php echo get_using_methods($payment->payment_method) ?></strong></span>
                            </td>
                            <td>
                                <span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($payment->convert_amount,2) ?></span>
                            </td>
                        </tr>
                    <?php endforeach ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right" style="background: #f0f4fa; color: #333; font-weight: bold"><strong><?php echo trans('amount-due') ?></strong></td>
                        <td class="" style="background: #f0f4fa; color: #333; font-weight: bold">
                            <span>
                                <?php if ($status == 2): ?>
                                    <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?>0.00 
                                <?php else: ?>
                                    <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($grand_total - get_total_invoice_payments($invoice->id, $invoice->parent_id), 2); ?>
                                <?php endif ?>
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="p-30">
        <p class="text-center"><?= $footer_note; ?></p>
    </div>
</div>