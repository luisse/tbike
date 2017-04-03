<div class="radiotaxis form">
<?php echo $this->Form->create('Radiotaxi'); ?>
	<fieldset>
		<legend><?php echo __('Add Radiotaxi'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Radiotaxis'), array('action' => 'index')); ?></li>
	</ul>
</div>
