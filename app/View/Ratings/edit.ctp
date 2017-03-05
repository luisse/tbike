<div class="ratings form">
<?php echo $this->Form->create('Rating'); ?>
	<fieldset>
		<legend><?php echo __('Edit Rating'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('value');
		echo $this->Form->input('typeranking');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rating.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Rating.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ratings'), array('action' => 'index')); ?></li>
	</ul>
</div>
