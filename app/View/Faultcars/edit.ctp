<div class="faultcars form">
<?php echo $this->Form->create('Faultcar'); ?>
	<fieldset>
		<legend><?php echo __('Edit Faultcar'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('taxownerscar_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('details');
		echo $this->Form->input('state');
		echo $this->Form->input('gpspoint');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Faultcar.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Faultcar.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Faultcars'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('controller' => 'taxownerscars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('controller' => 'taxownerscars', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
