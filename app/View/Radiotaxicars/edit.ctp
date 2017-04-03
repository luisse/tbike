<div class="radiotaxicars form">
<?php echo $this->Form->create('Radiotaxicar'); ?>
	<fieldset>
		<legend><?php echo __('Edit Radiotaxicar'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('radiotaxi_id');
		echo $this->Form->input('taxownerscar_id');
		echo $this->Form->input('state');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Radiotaxicar.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Radiotaxicar.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Radiotaxicars'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Radiotaxis'), array('controller' => 'radiotaxis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Radiotaxi'), array('controller' => 'radiotaxis', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('controller' => 'taxownerscars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('controller' => 'taxownerscars', 'action' => 'add')); ?> </li>
	</ul>
</div>
