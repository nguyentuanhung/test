<?php if(isset($productId)):?>
<?= $this->Form->create($product)?>
<fieldset>
	<legend><?= __('商品登録') ?></legend>
	    <?= $this->Form->hidden('product_id',['value' => $productId])?>
        <?= $this->Form->input('quantity_from')?>
        <?= $this->Form->input('quantity_to')?>
        <?= $this->Form->input('price')?>
        <?= $this->Form->input('ship_fee')?>
   </fieldset>
<?= $this->Form->button(__('登録')); ?>
<?= $this->Form->end()?>
<?php else: ?>
<?= $this->Form->create($product, array('enctype' => 'multipart/form-data'))?>
<fieldset>
	<legend><?= __('Add product') ?></legend>
        <?=  $this->Form->input('name')?>
        <?= $this->Form->input('description')?>
        <?= $this->Form->input('img', array('type'=>'file', 'accept' => 'image/*'))?>
   </fieldset>
<?= $this->Form->button(__('登録')); ?>
<?= $this->Form->end()?>
<?php endif; ?>