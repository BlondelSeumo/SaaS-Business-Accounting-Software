
<?php foreach ($products as $product): ?>
    
    <?php if (isset($page) && $page == 'Invoice'): ?>

        <?php if ($this->business->enable_stock == 1): ?>
        	<?php if ($product->quantity <= 0): ?>
            	<div data-id="0" class="row inv-item bg-light">
            <?php else: ?>
            	<div data-id="<?php echo html_escape($product->id) ?>" class="row inv-item" id="inv_item_<?php echo html_escape($product->id) ?>">
            <?php endif ?>
        <?php else: ?>
            <div data-id="<?php echo html_escape($product->id) ?>" class="row inv-item" id="inv_item_<?php echo html_escape($product->id) ?>">
        <?php endif ?>

    <?php else: ?>
        <div data-id="<?php echo html_escape($product->id) ?>" class="row inv-item" id="inv_item_<?php echo html_escape($product->id) ?>">
    <?php endif ?>


        <div class="col-6 text-left">
            <p class="mb-0"><?php echo html_escape($product->name) ?></p>
            <p class="mb-0 text-muted"><?php echo character_limiter($product->details, 50) ?></p>
        </div>
        
        <?php if (isset($page) && $page == 'Invoice'): ?>
            <?php if ($this->business->enable_stock == 1): ?>
            <div class="col-3 text-left">
            	<?php if ($product->quantity <= 0): ?>
            		<span class="badge badge-pill badge-default text-danger"><strong>Out of stock</strong></span>
            	<?php else: ?>
            		<span class="badge badge-pill badge-default text-success"><strong>In stock: <?php echo html_escape($product->quantity) ?> items</strong></span>
            	<?php endif ?>
            </div>
            <?php endif ?>
        <?php endif ?>

        <div class="col-<?php if (isset($page) && $page == 'Invoice' && $this->business->enable_stock == 1){echo 3;}else{echo 6;} ?> text-right">
            <span class="currency_wrapper"></span><?php echo html_escape($product->price) ?>
        </div>
    </div>
<?php endforeach ?>