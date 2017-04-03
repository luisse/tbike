<div class="userfavplaces form">
<?php echo $this->Form->create('Userfavplace'); ?>
	<fieldset>
		<legend><?php echo __('Add Userfavplace'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('detalle');
		echo $this->Form->input('state');
		echo $this->Form->input('gpspoint');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Userfavplaces'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
