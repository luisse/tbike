<div class="radiotaxis index">
	<h2><?php echo __('Radiotaxis'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('cuit'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('domicilio'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('telefono'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($radiotaxis as $radiotaxi): ?>
	<tr>
		<td><?php echo h($radiotaxi['Radiotaxi']['id']); ?>&nbsp;</td>
		<td><?php echo h($radiotaxi['Radiotaxi']['name']); ?>&nbsp;</td>
		<td><?php echo h($radiotaxi['Radiotaxi']['cuit']); ?>&nbsp;</td>
		<td><?php echo h($radiotaxi['Radiotaxi']['created']); ?>&nbsp;</td>
		<td><?php echo h($radiotaxi['Radiotaxi']['modified']); ?>&nbsp;</td>
		<td><?php echo h($radiotaxi['Radiotaxi']['domicilio']); ?>&nbsp;</td>
		<td><?php echo h($radiotaxi['Radiotaxi']['state']); ?>&nbsp;</td>
		<td><?php echo h($radiotaxi['Radiotaxi']['telefono']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $radiotaxi['Radiotaxi']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $radiotaxi['Radiotaxi']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $radiotaxi['Radiotaxi']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $radiotaxi['Radiotaxi']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Radiotaxi'), array('action' => 'add')); ?></li>
	</ul>
</div>
