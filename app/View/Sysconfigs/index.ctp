<div class="sysconfigs index">
	<h2><?php echo __('Sysconfigs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('stockrestrict'); ?></th>
			<th><?php echo $this->Paginator->sort('tokenmp'); ?></th>
			<th><?php echo $this->Paginator->sort('usermp'); ?></th>
			<th><?php echo $this->Paginator->sort('mailtransport'); ?></th>
			<th><?php echo $this->Paginator->sort('mailfrom'); ?></th>
			<th><?php echo $this->Paginator->sort('mailhost'); ?></th>
			<th><?php echo $this->Paginator->sort('mailport'); ?></th>
			<th><?php echo $this->Paginator->sort('mailuser'); ?></th>
			<th><?php echo $this->Paginator->sort('mailpassword'); ?></th>
			<th><?php echo $this->Paginator->sort('canbuy'); ?></th>
			<th><?php echo $this->Paginator->sort('tallercito_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sysconfigs as $sysconfig): ?>
	<tr>
		<td><?php echo h($sysconfig['Sysconfig']['id']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['stockrestrict']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['tokenmp']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['usermp']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['mailtransport']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['mailfrom']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['mailhost']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['mailport']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['mailuser']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['mailpassword']); ?>&nbsp;</td>
		<td><?php echo h($sysconfig['Sysconfig']['canbuy']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sysconfig['Tallercito']['id'], array('controller' => 'tallercitos', 'action' => 'view', $sysconfig['Tallercito']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sysconfig['Sysconfig']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sysconfig['Sysconfig']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sysconfig['Sysconfig']['id']), null, __('Are you sure you want to delete # %s?', $sysconfig['Sysconfig']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
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
		<li><?php echo $this->Html->link(__('New Sysconfig'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tallercitos'), array('controller' => 'tallercitos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tallercito'), array('controller' => 'tallercitos', 'action' => 'add')); ?> </li>
	</ul>
</div>
