<?php include'invoice_val.php'; ?>

<div class="card-body p-0">
    <div class="row p-35 invtem_top_2">
        <div class="col-6 text-left">
            <h3 class="mb-1"><?php echo html_escape($title) ?></h3>
            <p class="text-muted"><?php echo html_escape($summary) ?></p>
            <p class="mb-0"><strong><?php echo html_escape($business_name) ?></strong></p>
            <span class="mb-0 invbiz"><?php echo $business_address ?></span>
            
            <?php if (!empty($biz_number)): ?>
            <p class="mb-0"><?php echo trans('business').' '.trans('number') ?>: <?php echo html_escape($biz_number) ?></p>
            <?php endif ?>

            <?php if (!empty($biz_vat_code)): ?>
            <p class="mb-0"><?php echo trans('tax').'/vat '.trans('number') ?>: <?php echo html_escape($biz_vat_code) ?></p>
            <?php endif ?>

            <p class=""><?php echo html_escape($country) ?></p>
        </div>

        <div class="col-6 text-right">
            <?php if (empty($logo)): ?>
                <span class="alterlogo"><?php echo $business_name ?></span>
            <?php else: ?>
                <img width="130px" src="<?php echo base_url($logo) ?>" alt="Logo">
            <?php endif ?>
        </div>
    </div>

    <hr class="my-5">

    <div class="flex-parent-between bill_area">
        <div class="py-4 pl-30 pr-30">
            
            <h5 class="font-weight-bold"><?php echo trans('bill-to') ?></h5>
       
            <?php if (empty($customer_id)): ?>
                <p class="mb-1"><?php echo trans('empty-customer') ?></p>
            <?php else: ?>
                <p class="mb-1">
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
                </p>
            <?php endif ?>
        </div>

        <div class=" py-4 pl-30 pr-30 text-right">
            <table class="tables">
                <tr>
                    <td><b class="mr-10"><?php if(isset($page) && $page == 'Invoice'){echo trans('invoice-number');}else{echo trans('estimate-number');} ?>:</b></td>
                    <td class="text-left" colspan="1"><?php echo html_escape($number) ?></td>
                </tr>
                <tr>
                    <td><b class="mr-10"><?php if(isset($page) && $page == 'Invoice'){echo trans('invoice-date');}else{echo trans('estimate-date');} ?>:</b></td>
                    <td class="text-left" colspan="1"><?php echo my_date_show($date) ?></td>
                </tr>
                <?php if (!empty($poso_number)): ?>
                    <tr>
                        <td><b class="mr-10"><?php echo trans('p.o.s.o.-number') ?>:</b></td>
                        <td class="text-left" colspan="1"><?php echo html_escape($poso_number) ?></td>
                    </tr>
                <?php endif ?>
                <?php if(isset($page) && $page == 'Invoice'):?>
                    <tr>
                        <td><b class="mr-10"><?php echo trans('due-date') ?>:</b></td>
                        <td class="text-left">
                            <?php echo my_date_show($payment_due) ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-left">
                            <?php if ($due_limit == 1): ?>
                                <p><?php echo trans('on-receipt') ?></p>
                            <?php else: ?>
                                <p><?php echo trans('within') ?> <?php echo html_escape($due_limit) ?> <?php echo trans('days') ?></p>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><b class="mr-10"><?php echo trans('expires-on') ?>:</b></td>
                        <td class="text-left">
                        <?php echo my_date_show($invoice->expire_on) ?>
                    </td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <div class="row p-0 table_area">
        <div class="col-12 table-responsive">
            <table class="table">
                <thead class="pre_head2">
                    <tr class="pre_head_tr2 inv-pl30">
                        <th class="border-0"><?php echo trans('items') ?></th>
                        <th class="border-0"><?php echo trans('price') ?></th>
                        <th class="border-0"><?php echo trans('quantity') ?></th>
                        <th class="border-0"><?php echo trans('amount') ?></th>
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
                                <td colspan="5" class="text-center"><?php echo trans('empty-items') ?></td>
                            </tr>
                        <?php else: ?>
                            <?php for ($i=0; $i < $total_items; $i++) { ?>
                                <tr class="inv-pl30">
                                    <td width="50%">
                                    <?php $product_id = $this->session->userdata('item')[$i] ?>
                                    
                                    <?php if (is_numeric($product_id)) {
                                         echo helper_get_product($product_id)->name.'<br> <small>'. nl2br(helper_get_product($product_id)->details).'</small>';
                                    } else {
                                        echo html_escape($product_id);
                                    } ?>
                                    </td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo $this->session->userdata('price')[$i] ?></td>
                                    <td><?php echo $this->session->userdata('quantity')[$i] ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($this->session->userdata('total_price')[$i], 2) ?></td>
                                </tr>
                            <?php } ?>
                        <?php endif ?>

                    <?php else: ?>

                        <?php $items = helper_get_invoice_items($invoice->id) ?>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="5" class="text-center"><?php echo trans('empty-items') ?></td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr class="inv-pl30">
                                    <td width="50%"><?php echo html_escape($item->item_name) ?> <br> <small><?php echo nl2br($item->details) ?></small></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($item->price, 2) ?></td>
                                    <td><?php echo html_escape($item->qty) ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($item->total, 2) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>

                    <tr class="inv-pl30">
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong><?php echo trans('sub-total') ?></strong></td>
                        <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($sub_total, 2) ?></span></td>
                    </tr>

                    <?php if (!empty($taxes)): ?>
                        <?php foreach ($taxes as $tax): ?>
                            <?php if ($tax != 0): ?>
                               <tr class="inv-pl30">
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><strong><?php echo get_tax_id($tax)->type_name.' ('.get_tax_id($tax)->name.'-'.get_tax_id($tax)->number.') '.get_tax_id($tax)->rate.'%' ?></strong></td>
                                    <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($sub_total * (get_tax_id($tax)->rate / 100), 2) ?></span></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>

                    <?php if (!empty($discount)): ?>
                        <tr class="inv-pl30">
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong><?php echo trans('discount') ?> <?php echo html_escape($discount) ?>%</strong></td>
                            <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($sub_total * ($discount / 100), 2) ?></span></td>
                        </tr>
                    <?php endif ?>
                    <tr class="inv-pl30">
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong><?php echo trans('grand-total') ?></strong></td>
                        <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($grand_total, 2) ?></span></td>
                    </tr>


                    <?php foreach (get_invoice_payments($invoice->id) as $payment): ?>
                        <tr class="inv-pl30 text-dark">
                            <td></td>
                            <td></td>
                            <td class="text-right" width="60%">
                                <span class="fs-13"><strong><?php echo trans('payment-on') ?> <?php echo my_date_show($payment->payment_date) ?> <?php echo trans('using') ?> <?php echo get_using_methods($payment->payment_method) ?></strong></span>
                            </td>
                            <td>
                                <span class="fs-13"><strong><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($payment->amount,2) ?></strong></span>
                            </td>
                        </tr>
                    <?php endforeach ?>

                    <tr class="inv-pl30">
                        <td></td>
                        <td></td>
                        <td class="text-right bg-mlight"><strong><?php echo trans('amount-due') ?></strong></td>
                        <td class="bg-mlight">
                            <span>
                                <?php if ($status == 2): ?>
                                    <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?>0.00 
                                <?php else: ?>
                                    <?php if (isset($page_title) && $page_title == 'Invoice Preview'): ?>
                                        <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo $grand_total; ?>
                                    <?php else: ?>
                                        <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php echo number_format($grand_total - get_total_invoice_payments($invoice->id, $invoice->parent_id), 2); ?>
                                    <?php endif ?>
                                <?php endif ?>
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="p-30">
        <p class="text-centers"><?php echo $footer_note ?></p>
    </div>
</div>