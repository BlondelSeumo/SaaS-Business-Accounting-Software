<?php $settings = get_settings(); ?>
<?php $customer_id = $this->session->userdata('customer'); ?>
<?php if (!empty($customer_id)): ?>
	<?php $currency_symbol = helper_get_customer($customer_id)->currency_symbol ?>
<?php else: ?>
	<?php $currency_symbol = $this->business->currency_symbol; ?>
<?php endif ?>

<div class="alert alert-info mb-20">
  <i class="icon-info"></i> <?php echo trans('preview-invoice-info') ?>
</div>

<div id="invoice_preview_area" class="card inv preview_area">
    <?php include"include/invoice_style_".$this->business->template_style.".php"; ?>
</div>