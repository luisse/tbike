<div class="taxturns form">
<?php echo $this->Form->create('Taxturn'); ?>
	<fieldset>
		<legend><?php echo __('Add Taxturn'); ?></legend>
	<?php
		echo $this->Form->input('taxownerscar_id');
		echo $this->Form->input('taxownerdriver_id');
		echo $this->Form->input('turninit');
		echo $this->Form->input('turnend');
		echo $this->Form->input('state');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Taxturns'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('controller' => 'taxownerscars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('controller' => 'taxownerscars', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerdrivers'), array('controller' => 'taxownerdrivers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerdriver'), array('controller' => 'taxownerdrivers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxorders'), array('controller' => 'taxorders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxorder'), array('controller' => 'taxorders', 'action' => 'add')); ?> </li>
	</ul>
</div>
