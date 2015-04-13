<?php if(isset($productPriceId)):?>
<?= $this->Form->create($product)?>
<fieldset>
	<legend><?= __('商品価格変更') ?></legend>
        <?= $this->Form->input('quantity_from')?>
        <?= $this->Form->input('quantity_to')?>
        <?= $this->Form->input('price')?>
        <?= $this->Form->input('ship_fee')?>
   </fieldset>
<?= $this->Form->button(__('変更')); ?>
<?= $this->Form->end()?>
<?php else: ?>
<?= $this->Form->create($product)?>
<fieldset>
	<legend><?= __('商品 {0} 変更', h($product->name)) ?></legend>
        <?=  $this->Form->input('name')?>
        <?= $this->Form->input('description')?>
   </fieldset>
<?= $this->Form->button(__('変更')); ?>
<?= $this->Form->end()?>
<?php endif; ?>