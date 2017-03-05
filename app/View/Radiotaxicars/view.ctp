<div class="radiotaxicars view">
<h2><?php echo __('Radiotaxicar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($radiotaxicar['Radiotaxicar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Radiotaxi'); ?></dt>
		<dd>
			<?php echo $this->Html->link($radiotaxicar['Radiotaxi']['name'], array('controller' => 'radiotaxis', 'action' => 'view', $radiotaxicar['Radiotaxi']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxownerscar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($radiotaxicar['Taxownerscar']['id'], array('controller' => 'taxownerscars', 'action' => 'view', $radiotaxicar['Taxownerscar']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($radiotaxicar['Radiotaxicar']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($radiotaxicar['Radiotaxicar']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($radiotaxicar['Radiotaxicar']['state']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Radiotaxicar'), array('action' => 'edit', $radiotaxicar['Radiotaxicar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Radiotaxicar'), array('action' => 'delete', $radiotaxicar['Radiotaxicar']['id']), array(), __('Are you sure you want to delete # %s?', $radiotaxicar['Radiotaxicar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Radiotaxicars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Radiotaxicar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Radiotaxis'), array('controller' => 'radiotaxis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Radiotaxi'), array('controller' => 'radiotaxis', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('controller' => 'taxownerscars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('controller' => 'taxownerscars', 'action' => 'add')); ?> </li>
	</ul>
</div>
