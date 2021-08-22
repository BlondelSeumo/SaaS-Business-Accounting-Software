<div class="content-wrapper">
  <?php $settings = get_settings(); ?>
  <!-- Main content -->
  <section class="content">
    <div class="container">
    <div class="col-md-10 m-auto">

        <div class="row mb-10">
            <div class="col-md-12">
                <h2><?php if(isset($page_title) && $page_title == 'Edit Bill'){echo "Edit";}else{echo'Create New Bill';} ?>
                    <?php if (isset($page_title) && $page_title == 'Edit Bill'): ?>
                        <a href="<?php echo base_url('admin/bills/details/'.md5($invoice[0]['id'])) ?>" class="btn btn-default btn-rounded pull-right"><i class="fa fa-long-arrow-left"></i> <?php echo trans('back') ?></a>
                    <?php else: ?>
                        <a href="<?php echo base_url('admin/bills') ?>" class="btn btn-default btn-rounded pull-right"> <?php echo trans('bills') ?></a>
                    <?php endif ?>
                </h2>
            </div>
        </div>

        <form id="order_form" method="post" enctype="multipart/form-data" class="validate-form leave_con" action="<?php echo base_url('admin/bills/add')?>" role="form" novalidate>

            <!-- load preview data -->
            <div class="alert alert-danger mb-20 error_area" style="display: none;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <div id="load_error"></div>
            </div>

            <div id="load_data"></div>

            <div class="invoice_area mt-20">

                <!-- invoice header -->
                <div class="row">
                    <div class="col-12">
                        
                        <div class="panel panel-default inv">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                <div class="panel-heading inv" role="tab" id="heading8">
                                  <h4 class="panel-title inv">
                                     <span class="style_border"><?php echo trans('invoice-heading-title') ?></span>
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
                                        <?php if (isset($page_title) && $page_title == 'Edit Bill'): ?>
                                            <input type="text" id="example-input-large" name="title" class="form-control form-control-lg text-right" value="<?php echo html_escape($invoice[0]['number']) ?>">
                                        <?php else: ?>
                                            <input type="text" class="form-control text-right" name="title" placeholder="<?php echo trans('bill-title') ?>" value="">
                                        <?php endif ?>
                                        <input type="text" id="example-input-large" name="summary" class="form-control form-control-md text-right" placeholder="Summary Example" value="<?php echo html_escape($invoice[0]['summary']) ?>"> <br>

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
                                        <h5><?php echo trans('purchase-from') ?></h5>

                                        <div id="load_customers">
                                            <?php include'include/load_vendors.php'; ?>
                                        </div>

                                        <a data-toggle="modal" href="#customerModal" title="Add a row" class="add-new-item btn btn-block btn-default btn-sm p-10"><i class="icon-plus"></i> <?php echo trans('add-vendor') ?></a>
                                        
                                        <div class="mt-20" id="load_info"></div>
                                    </div>

                                    <div class="col-xs-6 col-md-8 text-right">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label"><?php echo trans('bill').' '.trans('number') ?></label>
                                            <div class="col-sm-4">
                                                <?php if (isset($page_title) && $page_title == 'Edit Bill'): ?>
                                                    <input type="text" class="form-control" name="number" value="<?php echo html_escape($invoice[0]['number']) ?>" placeholder="<?php echo trans('bill').''.trans('number') ?>">
                                                <?php else: ?>
                                                    <input type="text" class="form-control" name="number" value="<?php echo get_auto_invoice_number(3, 0)?>">
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label"><?php echo trans('date') ?></label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <?php if (isset($page_title) && $page_title == 'Edit Bill'): ?>
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


                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="item-row">
                                                <th><?php echo trans('item') ?></th>
                                                <th></th>
                                                <th><?php echo trans('price') ?></th>
                                                <th><?php echo trans('quantity') ?></th>
                                                <th><?php echo trans('total') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        <?php if (isset($page_title) && $page_title == 'Edit Bill'): ?>
                                            <?php $items = helper_get_invoice_items($invoice[0]['id']) ?>
                                            <?php foreach ($items as $product): ?>
                                                <tr class="item-row">
                                                    <td>
                                                        <input type="text" class="form-control item" placeholder="Item" type="text" name="items_val[]" value="<?php echo html_escape($product->item_name) ?>">  
                                                         <input type="hidden" class="form-control item" placeholder="Item" type="text" name="items[]" value="<?php echo html_escape($product->item) ?>">
                                                    </td>
                                                    <td>
                                                        <textarea name="details[]" class="form-control ac-textarea" rows="1" placeholder="Enter item description"><?php echo html_escape($product->details) ?></textarea> 
                                                    </td>
                                                    <td>
                                                        <input class="form-control price invo" placeholder="Price" type="text" name="price[]" value="<?php echo html_escape($product->price) ?>"> 
                                                    </td>
                                                    <td>
                                                        <input class="form-control qty" placeholder="Quantity" type="text" name="quantity[]" value="<?php echo html_escape($product->qty) ?>">
                                                    </td>
                                                    <td width="15%">
                                                        <div class="delete-btn">
                                                            <span class="currency_wrapper"></span>
                                                            <span class="total"><?php echo html_escape($product->price) ?></span>
                                                            <a class="delete" href="javascript:;" title="Remove row">&times;</a>
                                                            <input type="hidden" name="total_price[]" value="<?php echo html_escape($product->price) ?>">
                                                            <input type="hidden" name="product_ids[]" value="<?php echo html_escape($product->item) ?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>


                                        <thead id="add_item">
                                            
                                        </thead>
                                        

                                        <tr>
                                            <td colspan="5" class="p-0 text-center">
                                            <a href="#" class="btn btn-default add_item_btn"><i class="icon-plus"></i> <?php echo trans('add-an-item') ?></a>
                                            </td>
                                        </tr>

                                        <tr id="products_list_inv" style="display: none;">
                                            <td colspan="5" class="p-0">
                                                <div class="inv-product br-10 dshadow">
                                                    <div class="form-group has-search">
                                                        <span class="icon-magnifier form-control-feedback"></span>
                                                        <input data-id="buy" type="text" class="form-control search_product" placeholder="Search product">
                                                    </div>

                                                    <div class="loaderp text-center p-10"></div>

                                                    <!-- load ajax data -->
                                                    <a href="#" class="cancel-inv">&times;</a>
                                                    
                                                    <div id="load_product" class="pro-scroll">
                                                        <?php include'include/invoice_product_list.php'; ?>
                                                    </div>

                                                    <div class="col-md-12 p-0">
                                                        <a id="addRow" href="#" class="add-new-item btn btn-block btn-info p-10"><i class="icon-plus"></i> <?php echo trans('add-new-item') ?></a>
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
                                                <span class="currency_wrapper"></span><span id="subtotal">0.00</span> 
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
                                                            
                                                            <?php $selected = ''; ?>
                                                            <?php foreach ($asign_taxs as $asign_tax): ?>
                                                                <?php if ($asign_tax->tax_id == $tax->id): ?>
                                                                    <?php $selected = 'selected'; break;?>
                                                                <?php else: ?>
                                                                    <?php $selected = ''; ?>
                                                                <?php endif ?>
                                                            <?php endforeach ?>

                                                            <option <?php echo $selected; ?> value="<?php echo html_escape($tax->id) ?>"><?php echo html_escape($tax->name) ?> - <?php echo html_escape($tax->rate) ?>%</option>
                                                            <?php endforeach ?>
                                                        </select>  
                                                        <input type="hidden" class="tax" id="tax_<?php echo $gst->id ?>" value="0">  
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
                                                    <input type="text" id="discount" name="discount" value="0" class="form-control" aria-describedby="basic-addon2">
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
                                            <td class="text-right">
                                                <strong><?php echo trans('grand-total') ?></strong>
                                            </td>
                                            <td>
                                                <span class="currency_wrapper"></span><span id="grandTotal">0</span> 
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
                                        <textarea id="summernote" class="form-control" rows="4" name="footer_note" placeholder=""><?php echo $invoice[0]['footer_note'] ?></textarea>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <input type="hidden" name="id" value="<?php echo html_escape($invoice[0]['id']); ?>">

            <div class="row mb-20">
                <div class="col-md-12 text-center p-20">
                    <button type="submit" class="btn btn-info btn-rounded save_bill_btn"><i class="fa fa-check"></i> <?php if(isset($page_title) && $page_title == 'Edit Bill'){echo trans('update');}else{echo trans('save').' '.trans('bill');} ?></button>
                </div>
            </div>

        </form>

    </div>
    </div>
  </section>
</div>


<!-- product list modal -->
<div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-md">
        <form id="product-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/ajax_add_product/buy')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter"><?php echo trans('add-new-product') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label"><?php echo trans('product-name') ?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label"><?php echo trans('price') ?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label"><?php echo trans('details') ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="details"> </textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info rounded waves-effect pull-right"><?php echo trans('add-product') ?></button>
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
        <form id="customer-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/invoice/ajax_add_vendor')?>" role="form" novalidate>
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter"><?php echo trans('add-new-vendor') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="name">
                    </div>

                    <div class="form-group">
                        <label><?php echo trans('email') ?> </label>
                        <input type="text" class="form-control" name="email">
                    </div>

                    <div class="form-group">
                        <label><?php echo trans('address') ?> </label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-info waves-effect pull-right"><?php echo trans('add-vendor') ?></button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>