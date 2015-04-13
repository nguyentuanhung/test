<div class="users form">
<?= $this->Form->create($user)?>
    <fieldset>
		<legend><?= __('ユーザ登録') ?></legend>
        <?= $this->Form->input('username')?>
        <?= $this->Form->input('email')?>
        <?= $this->Form->input('password')?>
        <?=$this->Form->input ( 'role', [ 'options' => [ 'admin' => 'Admin','customer' => 'Customer' ] ] )?>
   </fieldset>
<?= $this->Form->button(__('登録')); ?>
<?= $this->Form->end()?>
</div>