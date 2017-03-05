<div class="taxownerscars view">
<h2><?php echo __('Taxownerscar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxowner'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxownerscar['Taxowner']['id'], array('controller' => 'taxowners', 'action' => 'view', $taxownerscar['Taxowner']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carcode'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['carcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registerpermision'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['registerpermision']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Decreenro'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['decreenro']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dateexpire'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['dateexpire']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dateactive'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['dateactive']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture'); ?></dt>
		<dd>
			<?php echo h($taxownerscar['Taxownerscar']['picture']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Taxownerscar'), array('action' => 'edit', $taxownerscar['Taxownerscar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Taxownerscar'), array('action' => 'delete', $taxownerscar['Taxownerscar']['id']), array(), __('Are you sure you want to delete # %s?', $taxownerscar['Taxownerscar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxownerscars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxownerscar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxowners'), array('controller' => 'taxowners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxowner'), array('controller' => 'taxowners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxjourneys'), array('controller' => 'taxjourneys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxjourney'), array('controller' => 'taxjourneys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxturns'), array('controller' => 'taxturns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxturn'), array('controller' => 'taxturns', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxubications'), array('controller' => 'taxubications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxubication'), array('controller' => 'taxubications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Taxjourneys'); ?></h3>
	<?php if (!empty($taxownerscar['Taxjourney'])): ?>
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
	<?php foreach ($taxownerscar['Taxjourney'] as $taxjourney): ?>
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
	<h3><?php echo __('Related Taxturns'); ?></h3>
	<?php if (!empty($taxownerscar['Taxturn'])): ?>
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
	<?php foreach ($taxownerscar['Taxturn'] as $taxturn): ?>
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
<div class="related">
	<h3><?php echo __('Related Taxubications'); ?></h3>
	<?php if (!empty($taxownerscar['Taxubication'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Countrie Id'); ?></th>
		<th><?php echo __('Province Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Department Id'); ?></th>
		<th><?php echo __('Taxownerscar Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Gpspoint'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($taxownerscar['Taxubication'] as $taxubication): ?>
		<tr>
			<td><?php echo $taxubication['id']; ?></td>
			<td><?php echo $taxubication['countrie_id']; ?></td>
			<td><?php echo $taxubication['province_id']; ?></td>
			<td><?php echo $taxubication['location_id']; ?></td>
			<td><?php echo $taxubication['department_id']; ?></td>
			<td><?php echo $taxubication['taxownerscar_id']; ?></td>
			<td><?php echo $taxubication['date']; ?></td>
			<td><?php echo $taxubication['state']; ?></td>
			<td><?php echo $taxubication['gpspoint']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'taxubications', 'action' => 'view', $taxubication['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'taxubications', 'action' => 'edit', $taxubication['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'taxubications', 'action' => 'delete', $taxubication['id']), array(), __('Are you sure you want to delete # %s?', $taxubication['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Taxubication'), array('controller' => 'taxubications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
