<div class="taxjourneys index">
	<h2><?php echo __('Taxjourneys'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('taxturn_id'); ?></th>
			<th><?php echo $this->Paginator->sort('datejourney'); ?></th>
			<th><?php echo $this->Paginator->sort('initjourney'); ?></th>
			<th><?php echo $this->Paginator->sort('endjourney'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($taxjourneys as $taxjourney): ?>
	<tr>
		<td><?php echo h($taxjourney['Taxjourney']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($taxjourney['Taxturn']['id'], array('controller' => 'taxturns', 'action' => 'view', $taxjourney['Taxturn']['id'])); ?>
		</td>
		<td><?php echo h($taxjourney['Taxjourney']['datejourney']); ?>&nbsp;</td>
		<td><?php echo h($taxjourney['Taxjourney']['initjourney']); ?>&nbsp;</td>
		<td><?php echo h($taxjourney['Taxjourney']['endjourney']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $taxjourney['Taxjourney']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $taxjourney['Taxjourney']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $taxjourney['Taxjourney']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $taxjourney['Taxjourney']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Taxjourney'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Taxturns'), array('controller' => 'taxturns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxturn'), array('controller' => 'taxturns', 'action' => 'add')); ?> </li>
	</ul>
</div>
