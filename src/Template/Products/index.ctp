<?php if($this->Session->read('Auth')):?>
<p><?= $this->Html->link('商品登録', ['action' => 'add'])?></p>
<?php endif; ?>
<p><?= $this->Html->link('商品検索', ['action' => 'search'])?></p>
<table>
	<tr>
		<th>No.</th>
		<th>Name</th>
		<th>Description</th>
		<th>Image</th>
		<th>Actions</th>
	</tr>

    <?php foreach ($products as $product): ?>
    <tr>
		<td><?= $product->id ?></td>
		<td>
            <?= $this->Html->link($product->name, ['action' => 'detail', $product->id])?>
        </td>
		<td><?= $product->description ?></td>
		<td><?= $this->Html->image('products/'.$product->img, array('width' => 70, 'height' => 70)) ?></td>
		<td>
		    <?php if($this->Session->read('Auth')):?>
            <?=$this->Form->postLink('削除', [ 'action' => 'delete',$product->id ], [ 'confirm' => '商品を削除しますか' ])?>
            <?= $this->Html->link('変更', ['action' => 'edit', $product->id])?>
            <?php endif; ?>
        </td>
	</tr>
    <?php endforeach; ?>

</table>