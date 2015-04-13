<?php if($this->Session->read('Auth')):?>
<p><?= $this->Html->link('商品登録', ['action' => 'add', $productId])?></p>
<?php endif; ?>
<p><?= $this->Html->link('商品検索', ['action' => 'search'])?></p>
<table>
	<tr>
		<th>No.</th>
		<th>商品名</th>
		<th>商品説明</th>
		<th>最低数</th>
		<th>最大数</th>
		<th>価格</th>
		<th>送料</th>
		<th>アクション</th>
	</tr>

    <?php foreach ($products as $product): ?>
    <tr>
		<td><?= $product->id ?></td>
		<td><?= $product->product->name ?></td>
		<td><?= $product->product->description ?></td>
		<td><?= $product->quantity_from ?></td>
		<td><?= $product->quantity_to ?></td>
		<td><?= $product->price ?></td>
		<td><?= $product->ship_fee ?></td>
		<td>
		    <?php if($this->Session->read('Auth')):?>
            <?=$this->Form->postLink('削除', [ 'action' => 'delete',$productId, $product->id ], [ 'confirm' => '商品を削除しますか' ])?>
            <?= $this->Html->link('変更', ['action' => 'edit', $productId, $product->id])?>
            <?php endif; ?>
        </td>
	</tr>
    <?php endforeach; ?>

</table>