<div class="taxturns view">
<h2><?php echo __('Taxturn'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($taxturn['Taxturn']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxownerscar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxturn['Taxownerscar']['id'], array('controller' => 'taxownerscars', 'action' => 'view', $taxturn['Taxownerscar']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxownerdriver'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxturn['Taxownerdriver']['id'], array('controller' => 'taxownerdrivers', 'action' => 'view', $taxturn['Taxownerdriver']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Turninit'); ?></dt>
		<dd>
			<?php echo h($taxturn['Taxturn']['turninit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Turnend'); ?></dt>
		<dd>
			<?php echo h($taxturn['Taxturn']['turnend']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($taxturn['Taxturn']['state']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Taxturn'), array('action' => 'edit', $taxturn['Taxturn']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Taxturn'), array('action' => 'delete', $taxturn['Taxturn']['id']), array(), __('Are you sure you want to delete # %s?', $taxturn['Taxturn']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxturns'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxturn'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('controller' => 'taxownerscars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('controller' => 'taxownerscars', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerdrivers'), array('controller' => 'taxownerdrivers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerdriver'), array('controller' => 'taxownerdrivers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxorders'), array('controller' => 'taxorders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxorder'), array('controller' => 'taxorders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Taxorders'); ?></h3>
	<?php if (!empty($taxturn['Taxorder'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Directiodetails'); ?></th>
		<th><?php echo __('Travelto'); ?></th>
		<th><?php echo __('Gpspoint'); ?></th>
		<th><?php echo __('Taxturn Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($taxturn['Taxorder'] as $taxorder): ?>
		<tr>
			<td><?php echo $taxorder['id']; ?></td>
			<td><?php echo $taxorder['date']; ?></td>
			<td><?php echo $taxorder['user_id']; ?></td>
			<td><?php echo $taxorder['state']; ?></td>
			<td><?php echo $taxorder['directiodetails']; ?></td>
			<td><?php echo $taxorder['travelto']; ?></td>
			<td><?php echo $taxorder['gpspoint']; ?></td>
			<td><?php echo $taxorder['taxturn_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'taxorders', 'action' => 'view', $taxorder['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'taxorders', 'action' => 'edit', $taxorder['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'taxorders', 'action' => 'delete', $taxorder['id']), array(), __('Are you sure you want to delete # %s?', $taxorder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Taxorder'), array('controller' => 'taxorders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
