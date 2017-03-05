<div class="taxownerdrivers view">
<h2><?php echo __('Taxownerdriver'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($taxownerdriver['Taxownerdriver']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('People'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxownerdriver['People']['id'], array('controller' => 'people', 'action' => 'view', $taxownerdriver['People']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxowner'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxownerdriver['Taxowner']['id'], array('controller' => 'taxowners', 'action' => 'view', $taxownerdriver['Taxowner']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Licencenumber'); ?></dt>
		<dd>
			<?php echo h($taxownerdriver['Taxownerdriver']['licencenumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture'); ?></dt>
		<dd>
			<?php echo h($taxownerdriver['Taxownerdriver']['picture']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($taxownerdriver['Taxownerdriver']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($taxownerdriver['Taxownerdriver']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($taxownerdriver['Taxownerdriver']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Taxownerdriver'), array('action' => 'edit', $taxownerdriver['Taxownerdriver']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Taxownerdriver'), array('action' => 'delete', $taxownerdriver['Taxownerdriver']['id']), array(), __('Are you sure you want to delete # %s?', $taxownerdriver['Taxownerdriver']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerdrivers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerdriver'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List People'), array('controller' => 'people', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New People'), array('controller' => 'people', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxowners'), array('controller' => 'taxowners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxowner'), array('controller' => 'taxowners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxjourneys'), array('controller' => 'taxjourneys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxjourney'), array('controller' => 'taxjourneys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxpanics'), array('controller' => 'taxpanics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxpanic'), array('controller' => 'taxpanics', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxturns'), array('controller' => 'taxturns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxturn'), array('controller' => 'taxturns', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Taxjourneys'); ?></h3>
	<?php if (!empty($taxownerdriver['Taxjourney'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Taxownerdriver Id'); ?></th>
		<th><?php echo __('Taxownerscar Id'); ?></th>
		<th><?php echo __('Countrie Id'); ?></th>
		<th><?php echo __('Province Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Municipio Id'); ?></th>
		<th><?php echo __('Datejourney'); ?></th>
		<th><?php echo __('Initjourney'); ?></th>
		<th><?php echo __('Endjourney'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($taxownerdriver['Taxjourney'] as $taxjourney): ?>
		<tr>
			<td><?php echo $taxjourney['id']; ?></td>
			<td><?php echo $taxjourney['taxownerdriver_id']; ?></td>
			<td><?php echo $taxjourney['taxownerscar_id']; ?></td>
			<td><?php echo $taxjourney['countrie_id']; ?></td>
			<td><?php echo $taxjourney['province_id']; ?></td>
			<td><?php echo $taxjourney['location_id']; ?></td>
			<td><?php echo $taxjourney['municipio_id']; ?></td>
			<td><?php echo $taxjourney['datejourney']; ?></td>
			<td><?php echo $taxjourney['initjourney']; ?></td>
			<td><?php echo $taxjourney['endjourney']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'taxjourneys', 'action' => 'view', $taxjourney['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'taxjourneys', 'action' => 'edit', $taxjourney['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'taxjourneys', 'action' => 'delete', $taxjourney['id']), array(), __('Are you sure you want to delete # %s?', $taxjourney['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Taxjourney'), array('controller' => 'taxjourneys', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Taxpanics'); ?></h3>
	<?php if (!empty($taxownerdriver['Taxpanic'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Taxownerdriver Id'); ?></th>
		<th><?php echo __('Datepanic'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Gpspoint'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($taxownerdriver['Taxpanic'] as $taxpanic): ?>
		<tr>
			<td><?php echo $taxpanic['id']; ?></td>
			<td><?php echo $taxpanic['taxownerdriver_id']; ?></td>
			<td><?php echo $taxpanic['datepanic']; ?></td>
			<td><?php echo $taxpanic['message']; ?></td>
			<td><?php echo $taxpanic['gpspoint']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'taxpanics', 'action' => 'view', $taxpanic['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'taxpanics', 'action' => 'edit', $taxpanic['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'taxpanics', 'action' => 'delete', $taxpanic['id']), array(), __('Are you sure you want to delete # %s?', $taxpanic['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Taxpanic'), array('controller' => 'taxpanics', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Taxturns'); ?></h3>
	<?php if (!empty($taxownerdriver['Taxturn'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Taxownerscar Id'); ?></th>
		<th><?php echo __('Taxownerdriver Id'); ?></th>
		<th><?php echo __('Turninit'); ?></th>
		<th><?php echo __('Turnend'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($taxownerdriver['Taxturn'] as $taxturn): ?>
		<tr>
			<td><?php echo $taxturn['id']; ?></td>
			<td><?php echo $taxturn['taxownerscar_id']; ?></td>
			<td><?php echo $taxturn['taxownerdriver_id']; ?></td>
			<td><?php echo $taxturn['turninit']; ?></td>
			<td><?php echo $taxturn['turnend']; ?></td>
			<td><?php echo $taxturn['state']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'taxturns', 'action' => 'view', $taxturn['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'taxturns', 'action' => 'edit', $taxturn['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'taxturns', 'action' => 'delete', $taxturn['id']), array(), __('Are you sure you want to delete # %s?', $taxturn['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Taxturn'), array('controller' => 'taxturns', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
