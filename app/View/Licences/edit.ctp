<div class="licences form">
<?php echo $this->Form->create('Licence'); ?>
	<fieldset>
		<legend><?php echo __('Edit Licence'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('licence');
		echo $this->Form->input('fecha');
		echo $this->Form->input('owner');
		echo $this->Form->input('document');
		echo $this->Form->input('dcto');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Licence.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Licence.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Licences'), array('action' => 'index')); ?></li>
	</ul>
</div>
