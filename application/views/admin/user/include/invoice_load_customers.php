<select class="form-control single_select" name="customer" id="customer">
    <option value=""><?php echo trans('select-customer') ?></option>
    <?php foreach ($customers as $customer): ?>
      <option value="<?php echo html_escape($customer->id) ?>" <?php echo($invoice[0]['customer'] == $customer->id) ? 'selected' : ''; ?>
      ><?php echo html_escape($customer->name) ?></option>
    <?php endforeach ?>
</select>