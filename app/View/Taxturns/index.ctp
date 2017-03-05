<div class="taxturns index">
	<h2><?php echo __('Taxturns'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('taxownerscar_id'); ?></th>
			<th><?php echo $this->Paginator->sort('taxownerdriver_id'); ?></th>
			<th><?php echo $this->Paginator->sort('turninit'); ?></th>
			<th><?php echo $this->Paginator->sort('turnend'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($taxturns as $taxturn): ?>
	<tr>
		<td><?php echo h($taxturn['Taxturn']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($taxturn['Taxownerscar']['id'], array('controller' => 'taxownerscars', 'action' => 'view', $taxturn['Taxownerscar']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($taxturn['Taxownerdriver']['id'], array('controller' => 'taxownerdrivers', 'action' => 'view', $taxturn['Taxownerdriver']['id'])); ?>
		</td>
		<td><?php echo h($taxturn['Taxturn']['turninit']); ?>&nbsp;</td>
		<td><?php echo h($taxturn['Taxturn']['turnend']); ?>&nbsp;</td>
		<td><?php echo h($taxturn['Taxturn']['state']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $taxturn['Taxturn']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $taxturn['Taxturn']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $taxturn['Taxturn']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $taxturn['Taxturn']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Taxturn'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('controller' => 'taxownerscars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('controller' => 'taxownerscars', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerdrivers'), array('controller' => 'taxownerdrivers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerdriver'), array('controller' => 'taxownerdrivers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxorders'), array('controller' => 'taxorders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxorder'), array('controller' => 'taxorders', 'action' => 'add')); ?> </li>
	</ul>
</div>
