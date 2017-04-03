<div class="radiotaxis form">
<?php echo $this->Form->create('Radiotaxi'); ?>
	<fieldset>
		<legend><?php echo __('Edit Radiotaxi'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('cuit');
		echo $this->Form->input('domicilio');
		echo $this->Form->input('state');
		echo $this->Form->input('telefono');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Radiotaxi.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Radiotaxi.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Radiotaxis'), array('action' => 'index')); ?></li>
	</ul>
</div>
