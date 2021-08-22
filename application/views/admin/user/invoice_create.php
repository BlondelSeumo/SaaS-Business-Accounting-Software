<div class="content-wrapper">
  <?php $settings = get_settings(); ?>
  <!-- Main content -->
  <section class="content">
    <div class="container">
        <div class="col-md-10 m-auto">

            <?php if (empty($this->business->logo)): ?>
                <?php include'include/setup_alert.php'; ?>
            <?php endif ?>
  
            <form id="invoice_form" method="post" enctype="multipart/form-data" class="validate-form leave_con" action="<?php echo base_url('admin/invoice/preview')?>" role="form" novalidate>

                <?php include'include/invoice_header.php'; ?>
                
                <input type="hidden" class="add_val" name="add_val" value="">

                <div class="alert alert-danger mb-20 error_area" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4><?php echo trans('invoice-error-create') ?>.</h4>
                  <div id="load_error"></div>
                </div>
               
                <!-- load preview data -->
                <div id="load_data"> </div>
                
                <div class="invoice_area mt-20">

                    <?php if (isset($page_title) && $page_title == 'Edit Invoice' && $invoice[0]['recurring'] == 1): ?>
                        <div class="row mb-20">
                            <div class="col-md-12">
                                <h4 class="mb-20"><?php echo trans('invoice-schedule') ?></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label><?php echo trans('start-date') ?> <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control datepicker" value="<?php echo html_escape($invoice[0]['recurring_start']) ?>" name="recurring_start" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                  <label><?php echo trans('repeat-this-invoice') ?> <span class="text-danger">*</span></label>
                                  <select class="form-control" name="frequency">
                                      <option value=""><?php echo trans('select') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 7){echo "selected";} ?> value="7"><?php echo trans('weekly') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 14){echo "selected";} ?> value="14">2 <?php echo trans('weeks') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 21){echo "selected";} ?> value="21">3 <?php echo trans('weeks') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 30){echo "selected";} ?> value="30"><?php echo trans('monthly') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 60){echo "selected";} ?> value="60">2 <?php echo trans('months') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 120){echo "selected";} ?> value="120">4 <?php echo trans('months') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 180){echo "selected";} ?> value="180">6 <?php echo trans('months') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 365){echo "selected";} ?> value="365"><?php echo trans('yearly') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 730){echo "selected";} ?> value="730">2 <?php echo trans('years') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 1095){echo "selected";} ?> value="1095">3 <?php echo trans('years') ?></option>
                                      <option <?php if($invoice[0]['frequency'] == 1825){echo "selected";} ?> value="1825">5 <?php echo trans('years') ?></option>
                                  </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                  <label><?php echo trans('end-date') ?> </label>
                                  <input type="text" class="form-control datepicker" value="<?php if($invoice[0]['recurring_end'] != '0000-00-00'){echo html_escape($invoice[0]['recurring_end']);} ?>" name="recurring_end" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <!-- invoice header -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default inv exh">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    <div class="panel-heading inv" role="tab" id="heading8">
                                      <h4 class="panel-title inv">
                                         <span class="style_border"><?php echo trans('invoice-title') ?></span>
                                         <i class="fa fa-angle-down pull-right"></i>
                                      </h4>
                                    </div>
                                </a>
                                <div id="collapse8" class="panel-collapse data_collaps_border collapse" role="tabpanel" aria-labelledby="heading8" aria-expanded="false" style="height: 1px;">
                                  <div class="panel-body inv">                      
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php if (empty($this->business->logo)): ?>
                                                <span class="alterlogo"><i class="flaticon-close"></i></span>
                                            <?php else: ?>
                                                <img width="130px" src="<?php echo base_url($this->business->logo) ?>" alt="Logo">
                                            <?php endif ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                                <input type="text" id="example-input-large" name="title" class="form-control form-control-lg text-right" placeholder="<?php echo trans('invoice-title-placeholder') ?>" value="<?php echo html_escape($invoice[0]['title']) ?>">
                                            <?php else: ?>
                                                <input type="text" class="form-control text-right" name="title" placeholder="<?php echo trans('invoice-titles') ?>" value="">
                                            <?php endif ?>
                                            <input type="text" id="example-input-large" name="summary" class="form-control form-control-md text-right" placeholder="<?php echo trans('invoice-title-placeholder') ?>" value="<?php echo html_escape($invoice[0]['summary']) ?>">

                                            <p class="mb-0 pull-right"><strong><?php echo html_escape($this->business->name) ?></strong></p><br>
                                            <p class="pull-right"><?php echo html_escape($this->business->country) ?></p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- invoice body -->
                    <div class="box shadow-lg">

                      <div class="box-body inv">
                        <div class="container">

                            <div class="row mb-20">
                                
                                <div class="col-xs-12 col-md-12">
                                    
                                    <div class="row inv-info">
                                        <div class="col-xs-6 col-md-4 text-left">
                                            <h5><?php echo trans('bill-to') ?></h5>
                                            
                                            <div id="load_customers">
                                                <?php include'include/invoice_load_customers.php'; ?>
                                            </div>

                                            <a data-toggle="modal" href="#customerModal" title="Add a row" class="add-new-item btn btn-block btn-default btn-sm p-10"><i class="icon-plus"></i> <?php echo trans('add-a-customer') ?></a>

                                            <div class="mt-20" id="load_info"></div>
                                        </div>

                                        <div class="col-xs-6 col-md-8 text-right">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label"><?php echo trans('invoice-number') ?></label>
                                                <div class="col-sm-4">
                                                    <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                                        <input type="text" class="form-control" name="number" value="<?php echo html_escape($invoice[0]['number']) ?>" placeholder="Invoice number">
                                                    <?php else: ?>
                                                        <input type="text" class="form-control" name="number" value="<?php echo get_auto_invoice_number(1, $type)?>" placeholder="Invoice number">
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label"><?php echo trans('p.o.s.o.-number') ?></label>
                                                <div class="col-sm-4">
                                                    <input type="text" value="<?php echo html_escape($invoice[0]['poso_number']) ?>" class="form-control" name="poso_number">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label"><?php echo trans('invoice-date') ?></label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        
                                                        <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                                            <input type="text" class="form-control datepicker"  name="date" value="<?php echo $invoice[0]['date'] ?>">
                                                        <?php else: ?>
                                                            <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="date" value="<?php echo date('Y-m-d') ?>">
                                                        <?php endif ?>
                                                        
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calender"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mt-10">
                                                <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label"><?php echo trans('payment-due-date') ?></label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" id="payment_due" class="form-control datepicker payment_due" name="payment_due" value="<?php if(!empty($invoice[0]['payment_due'])){echo $invoice[0]['payment_due'];}else{echo date('Y-m-d');} ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calender"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <select class="form-control mt-5 due_limit" name="due_limit">
                                                        <option <?php if($invoice[0]['due_limit'] == 1){echo "selected";} ?> value="1"><?php echo trans('on-receipt') ?></option>
                                                        <option <?php if($invoice[0]['due_limit'] == 15){echo "selected";} ?> value="15"><?php echo trans('within') ?> 15 <?php echo trans('days') ?></option>
                                                        <option <?php if($invoice[0]['due_limit'] == 30){echo "selected";} ?> value="30"><?php echo trans('within') ?> 30 <?php echo trans('days') ?></option>
                                                        <option <?php if($invoice[0]['due_limit'] == 45){echo "selected";} ?> value="45"><?php echo trans('within') ?> 45 <?php echo trans('days') ?></option>
                                                        <option <?php if($invoice[0]['due_limit'] == 60){echo "selected";} ?> value="60"><?php echo trans('within') ?> 60 <?php echo trans('days') ?></option>
                                                        <option <?php if($invoice[0]['due_limit'] == 75){echo "selected";} ?> value="75"><?php echo trans('within') ?> 75 <?php echo trans('days') ?></option>
                                                        <option <?php if($invoice[0]['due_limit'] == 90){echo "selected";} ?> value="90"><?php echo trans('within') ?> 90 <?php echo trans('days') ?></option>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 p-0">
                                    <div class="table-responsive invcus-table">
                                        <table class="table">
                                            <thead>
                                                <tr class="item-row">
                                                    <th><?php echo trans('item') ?></th>
                                                    <th><?php echo trans('details') ?></th>
                                                    <th><?php echo trans('price') ?></th>
                                                    <th><?php echo trans('quantity') ?></th>
                                                    <th><?php echo trans('total') ?></th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                            <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                                <?php $items = helper_get_invoice_items($invoice[0]['id']) ?>
                                                <?php foreach ($items as $product): ?>
                                                    <tr class="item-row">
                                                        <td width="30%">
                                                            <input type="text" class="form-control item" placeholder="Item" type="text" name="items_val[]" value="<?php echo html_escape($product->item_name) ?>">  

                                                            <input type="hidden" class="form-control item" placeholder="Item" type="text" name="items[]" value="<?php echo html_escape($product->item) ?>">
                                                        </td>
                                                        <td width="30%">
                                                            <textarea name="details[]" class="form-control ac-textarea" rows="1" placeholder="Enter item description"><?php echo html_escape($product->details) ?></textarea>
                                                        </td>
                                                        <td width="15%">
                                                            <input class="form-control price invo" placeholder="Price" type="text" name="price[]" value="<?php echo html_escape($product->price) ?>"> 
                                                        </td>
                                                        <td width="10%">
                                                            <input class="form-control qty" placeholder="Quantity" type="text" name="quantity[]" value="<?php echo html_escape($product->qty) ?>">
                                                        </td>
                                                        <td width="15%">
                                                            <div class="delete-btn">
                                                                <span class="currency_wrapper"></span>
                                                                <span class="total"><?php echo html_escape($product->price) ?></span>
                                                                <a class="delete" href="javascript:;" title="Remove row">&times;</a>
                                                                <input type="hidden" class="total" name="total_price[]" value="<?php echo html_escape($product->price) ?>">
                                                                <input type="hidden" name="product_ids[]" value="<?php echo html_escape($product->item) ?>">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>


                                            <thead id="add_item">
                                                
                                            </thead>
                                            

                                            <tr>
                                                <td colspan="5" class="p-0">
                                                <a href="#" class="btn btn-default add_item_btn"><i class="icon-plus"></i> <?php echo trans('add-an-item') ?></a>
                                                </td>
                                            </tr>

                                            
                                            <tr id="products_list_inv" style="display: none;">
                                                <td colspan="5" class="p-0">
                                                    <div class="main-inv-product">
                                                        <div class="inv-product br-10 dshadow">
                                                            <div class="form-group has-search">
                                                                <span class="icon-magnifier form-control-feedback"></span>
                                                                <input type="text" class="form-control search_product" placeholder="Type product">
                                                            </div>

                                                            <div class="loaderp text-center p-10"></div>

                                                            <!-- load ajax data -->
                                                            <a href="#" class="cancel-inv">&times;</a>
                                                            
                                                            <div id="load_product" class="pro-scroll">
                                                                <?php include'include/invoice_product_list.php'; ?>
                                                            </div>

                                                            <div class="col-md-12 p-0 text-center">
                                                                <a id="addRow" href="#" class="add-new-item btn btn-block btn-info p-10"><i class="icon-plus"></i> <?php echo trans('add-new-item') ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong><?php echo trans('sub-total') ?></strong></td>
                                                <td>
                                                    <span class="currency_wrapper"></span>
                                                    <span id="subtotal">0.00</span> 
                                                    <input type="hidden" class="subtotal" name="sub_total" value="">
                                                </td>
                                            </tr>


                                            <?php foreach ($gsts as $gst): ?>
                                                
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><strong><?php echo $gst->name ?></strong></td>
                                                    <td class="inv-width">
                                                        <select class="form-control tax_id" data-id="<?php echo $gst->id ?>" id="tax_id_<?php echo $gst->id ?>" name="taxes[]">
                                                            <option value="0"><?php echo trans('select-tax') ?></option>
                                                            <?php foreach ($gst->taxes as $tax): ?>
                                                            
                                                            <?php $selected = ''; $tax_id='';?>
                                                            <?php foreach ($asign_taxs as $asign_tax): ?>
                                                                <?php if ($asign_tax->tax_id == $tax->id): ?>
                                                                    <?php $selected = 'selected'; $tax_id = $tax->id; break;?>
                                                                <?php else: ?>
                                                                    <?php $selected = ''; ?>
                                                                <?php endif ?>
                                                            <?php endforeach ?>

                                                            <option <?php echo $selected; ?> value="<?php echo html_escape($tax->id) ?>"><?php echo html_escape($tax->name) ?> - <?php echo html_escape($tax->rate) ?>%</option>
                                                            <?php endforeach ?>
                                                        </select>  
                                                        <input type="hidden" class="tax" id="tax_<?php echo $gst->id ?>" value="<?php echo get_invoice_tax($tax_id, $invoice[0]['id']); ?>">  
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                            <input type="hidden" class="total_tax" id="total_tax" value="<?php if(isset($total_tax)){echo $total_tax->total;} ?>"> 
                                   

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><strong><?php echo trans('discount') ?></strong></td>
                                                <td width="15%">
                                                    <div class="input-group">
                                                        <input type="text" id="discount" name="discount" value="<?php echo html_escape($invoice[0]['discount']); ?>" class="form-control" aria-describedby="basic-addon2">
                                                        <div class="input-group-append discount">
                                                            <span class="input-group-text" id="basic-addon1">%</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><span class="currency_name mr-10"></span> <strong> <?php echo trans('grand-total') ?></strong></td>
                                                <td>
                                                    <span class="currency_wrapper"></span>
                                                    <span id="grandTotal">0</span>
                                                    <input type="hidden" class="grandtotal" name="grand_total" value="">
                                                    <input type="hidden" class="convert_total" name="convert_total" value="">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="box-footer text-right">
                        <input type="hidden" class="currency_code" name="currency_code" value="">
                        <strong><span class="conversion_currency"> </span></strong>
                      </div>
                    </div> 

                    <!-- invoice footer -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default inv">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <div class="panel-heading inv" role="tab" id="heading8">
                                      <h4 class="panel-title inv">
                                         <span class="style_border"><?php echo trans('footer') ?></span>
                                         <i class="fa fa-angle-down pull-right fa-1x"></i>
                                      </h4>
                                    </div>
                                </a>
                                <div id="collapse2" class="panel-collapse data_collaps_border collapse" role="tabpanel" aria-labelledby="heading2" aria-expanded="false" style="height: 1px;">
                                  <div class="panel-body inv">                      
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                               <textarea id="summernote" class="form-control" rows="8" name="footer_note"><?php echo $invoice[0]['footer_note'] ?></textarea>
                                            <?php else: ?>
                                                <textarea id="summernote" class="form-control" rows="8" name="footer_note" placeholder="<?php echo trans('invoice-footer-placeholder') ?>"><?php echo $this->business->footer_note ?></textarea>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-md-12">
                            <div class="inv-top-btn mb-10">
                                <?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                                    <a href="<?php echo base_url('admin/invoice/details/'.md5($invoice[0]['id'])) ?>" class="btn btn-default btn-rounded pull-right ml-10"><i class="fa fa-long-arrow-left"></i> <?php echo trans('back') ?></a>
                                <?php endif ?>
                    
                              <button type="submit" class="btn btn-info btn-rounded save_invoice_btn pull-right ml-5"><?php if(isset($page_title) && $page_title == 'Edit Invoice'){echo trans('update');}else{echo trans('save-and-continue');} ?></button>
                                
                              <button id="edit_invoice" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info pull-right mr-10 edit_invoice_btn" style="display: none;"><?php echo trans('edit') ?></button>
                              <button type="submit" class="btn waves-effect waves-light btn-outline-info btn-rounded pull-right mr-10 preview_invoice_btn"><?php echo trans('preview') ?></button>
                            </div>
                            <input type="hidden" class="set_value" name="check_value">
                        </div>
                    </div>

                </div>

                <!-- csrf token -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <input type="hidden" name="id" value="<?php echo html_escape($invoice[0]['id']); ?>">
                <input type="hidden" name="is_recurring" value="<?php echo html_escape($type); ?>">

            </form>

        </div>
    </div>
  </section>
</div>


<!-- product list modal -->
<div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="product-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/ajax_add_product')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter"><?php echo trans('add-new-product') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-4 text-right control-label col-form-label"><?php echo trans('product-name') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 text-right control-label col-form-label"><?php echo trans('price') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="price" required>
                        </div>
                    </div>

                    <?php if ($this->business->enable_stock == 1): ?>
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"><?php echo trans('stock-quantity') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="quantity" required>
                            </div>
                        </div>
                    <?php else: ?>
                        <input type="hidden" class="form-control" name="quantity" value="0">
                    <?php endif; ?>
                 
                    <div class="form-group row">
                        <label class="col-sm-4 text-right control-label col-form-label"><?php echo trans('details') ?></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="details"> </textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info waves-effect pull-right"><?php echo trans('add-product') ?></button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- customer modal -->
<div id="customerModal" class="modal fade" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="customer-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/ajax_add_customer')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter"><?php echo trans('add-new-customer') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label><?php echo trans('customer-name') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="name">
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label p-0" for="example-input-normal"><?php echo trans('country') ?> </label>
                        <select class="form-control single_select col-sm-12" id="country" name="country" style="width: 100%">
                          <option value=""><?php echo trans('select') ?></option>
                          <?php foreach ($countries as $country): ?>
                              <?php if (!empty($country->currency_name)): ?>
                                <option value="<?php echo html_escape($country->id); ?>">
                                  <?php echo html_escape($country->name); ?>
                                </option>
                              <?php endif ?>
                          <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label p-0" for="example-input-normal"><?php echo trans('currency') ?> </label>
                        <select class="form-control col-sm-12 wd-100" id="currency" name="currency" disabled>
                          <option value=""><?php echo trans('select') ?></option>
                          <?php foreach ($countries as $currency): ?>>
                                <?php echo html_escape($currency->currency_code.' - '.$currency->currency_name); ?>
                              </option>
                          <?php endforeach ?>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info waves-effect pull-right"><?php echo trans('add-customer') ?></button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
        