<div class="users form">
<?= $this->Form->create()?>
    <fieldset>
		<legend><?= __('商品名と購入数を入力してください') ?></legend>
        <?= $this->Form->input('name')?>
        <?= $this->Form->input('quantity')?>
    </fieldset>
<?= $this->Form->button(__('検索')); ?>
<?= $this->Form->end()?>
</div>

<?php if(isset($searchResults) && !empty($searchResults)) :?>
<table>
	<tr>
		<th>No.</th>
		<th>Name</th>
		<th>Description</th>
		<th>Quantity From</th>
		<th>Quantity To</th>
		<th>Price</th>
		<th>Ship Fee</th>
		<th>Actions</th>
	</tr>

    <?php foreach ($searchResults as $searchResult): ?>
    <tr>
		<td><?= $searchResult->id ?></td>
		<td><?= $searchResult->product->name ?></td>
		<td><?= $searchResult->product->description ?></td>
		<td><?= $searchResult->quantity_from ?></td>
		<td><?= $searchResult->quantity_to ?></td>
		<td><?= $searchResult->price ?></td>
		<td><?= $searchResult->ship_fee ?></td>
		<td>
		    <?php if($this->Session->read('Auth')):?>
            <?=$this->Form->postLink('削除', [ 'action' => 'delete',$searchResult->id ], [ 'confirm' => 'Are you sure?' ])?>
            <?= $this->Html->link('変更', ['action' => 'edit', $searchResult->id])?>
            <?php endif; ?>
        </td>
	</tr>
    <?php endforeach; ?>

</table>
<?php endif; ?>