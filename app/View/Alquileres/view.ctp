<div class="alquileres view">
<h2><?php  __('Alquilere');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $alquilere['Alquilere']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalle'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $alquilere['Alquilere']['detalle']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $alquilere['Alquilere']['fecha']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $alquilere['Alquilere']['total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cliente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $this->Html->link($alquilere['Cliente']['id'], array('controller' => 'clientes', 'action' => 'view', $alquilere['Cliente']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Alquilere', true), array('action' => 'edit', $alquilere['Alquilere']['id'])); ?> </li>
		<li><?= $this->Html->link(__('Delete Alquilere', true), array('action' => 'delete', $alquilere['Alquilere']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $alquilere['Alquilere']['id'])); ?> </li>
		<li><?= $this->Html->link(__('List Alquileres', true), array('action' => 'index')); ?> </li>
		<li><?= $this->Html->link(__('New Alquilere', true), array('action' => 'add')); ?> </li>
		<li><?= $this->Html->link(__('List Clientes', true), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?= $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?= $this->Html->link(__('List Alquileredetalles', true), array('controller' => 'alquileredetalles', 'action' => 'index')); ?> </li>
		<li><?= $this->Html->link(__('New Alquileredetalle', true), array('controller' => 'alquileredetalles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Alquileredetalles');?></h3>
	<?php if (!empty($alquilere['Alquileredetalle'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Alquilere Id'); ?></th>
		<th><?php __('Horasalquila'); ?></th>
		<th><?php __('Detalle'); ?></th>
		<th><?php __('Fechadevol'); ?></th>
		<th><?php __('Cantidad'); ?></th>
		<th><?php __('Subtotal'); ?></th>
		<th><?php __('Bicicletasparaalquilere Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($alquilere['Alquileredetalle'] as $alquileredetalle):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?= $class;?>>
			<td><?= $alquileredetalle['id'];?></td>
			<td><?= $alquileredetalle['alquilere_id'];?></td>
			<td><?= $alquileredetalle['horasalquila'];?></td>
			<td><?= $alquileredetalle['detalle'];?></td>
			<td><?= $alquileredetalle['fechadevol'];?></td>
			<td><?= $alquileredetalle['cantidad'];?></td>
			<td><?= $alquileredetalle['subtotal'];?></td>
			<td><?= $alquileredetalle['bicicletasparaalquilere_id'];?></td>
			<td class="actions">
				<?= $this->Html->link(__('View', true), array('controller' => 'alquileredetalles', 'action' => 'view', $alquileredetalle['id'])); ?>
				<?= $this->Html->link(__('Edit', true), array('controller' => 'alquileredetalles', 'action' => 'edit', $alquileredetalle['id'])); ?>
				<?= $this->Html->link(__('Delete', true), array('controller' => 'alquileredetalles', 'action' => 'delete', $alquileredetalle['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $alquileredetalle['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?= $this->Html->link(__('New Alquileredetalle', true), array('controller' => 'alquileredetalles', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
