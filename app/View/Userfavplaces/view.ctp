<div class="userfavplaces view">
<h2><?php echo __('Userfavplace'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userfavplace['Userfavplace']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userfavplace['User']['id'], array('controller' => 'users', 'action' => 'view', $userfavplace['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Detalle'); ?></dt>
		<dd>
			<?php echo h($userfavplace['Userfavplace']['detalle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($userfavplace['Userfavplace']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gpspoint'); ?></dt>
		<dd>
			<?php echo h($userfavplace['Userfavplace']['gpspoint']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userfavplace'), array('action' => 'edit', $userfavplace['Userfavplace']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userfavplace'), array('action' => 'delete', $userfavplace['Userfavplace']['id']), array(), __('Are you sure you want to delete # %s?', $userfavplace['Userfavplace']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userfavplaces'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userfavplace'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
