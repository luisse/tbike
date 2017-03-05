<div class="faultcars view">
<h2><?php echo __('Faultcar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($faultcar['Faultcar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxownerscar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($faultcar['Taxownerscar']['id'], array('controller' => 'taxownerscars', 'action' => 'view', $faultcar['Taxownerscar']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($faultcar['User']['id'], array('controller' => 'users', 'action' => 'view', $faultcar['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Details'); ?></dt>
		<dd>
			<?php echo h($faultcar['Faultcar']['details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($faultcar['Faultcar']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($faultcar['Faultcar']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($faultcar['Faultcar']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gpspoint'); ?></dt>
		<dd>
			<?php echo h($faultcar['Faultcar']['gpspoint']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Faultcar'), array('action' => 'edit', $faultcar['Faultcar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Faultcar'), array('action' => 'delete', $faultcar['Faultcar']['id']), array(), __('Are you sure you want to delete # %s?', $faultcar['Faultcar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Faultcars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Faultcar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('controller' => 'taxownerscars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('controller' => 'taxownerscars', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
