<div class="ratings view">
<h2><?php echo __('Rating'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rating['Rating']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($rating['Rating']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($rating['Rating']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($rating['Rating']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Typeranking'); ?></dt>
		<dd>
			<?php echo h($rating['Rating']['typeranking']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rating'), array('action' => 'edit', $rating['Rating']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rating'), array('action' => 'delete', $rating['Rating']['id']), array(), __('Are you sure you want to delete # %s?', $rating['Rating']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ratings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rating'), array('action' => 'add')); ?> </li>
	</ul>
</div>
