<div class="taxjourneys form">
<?php echo $this->Form->create('Taxjourney'); ?>
	<fieldset>
		<legend><?php echo __('Add Taxjourney'); ?></legend>
	<?php
		echo $this->Form->input('taxturn_id');
		echo $this->Form->input('datejourney');
		echo $this->Form->input('initjourney');
		echo $this->Form->input('endjourney');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Taxjourneys'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Taxturns'), array('controller' => 'taxturns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxturn'), array('controller' => 'taxturns', 'action' => 'add')); ?> </li>
	</ul>
</div>
