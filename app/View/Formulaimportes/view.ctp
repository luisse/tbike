<div class="formulaimportes view">
<h2><?php  __('Formulaimporte');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $formulaimporte['Formulaimporte']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tallercito'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($formulaimporte['Tallercito']['id'], array('controller' => 'tallercitos', 'action' => 'view', $formulaimporte['Tallercito']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $formulaimporte['Formulaimporte']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $formulaimporte['Formulaimporte']['valor']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esporcentaje'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $formulaimporte['Formulaimporte']['esporcentaje']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Formulaimporte', true), array('action' => 'edit', $formulaimporte['Formulaimporte']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Formulaimporte', true), array('action' => 'delete', $formulaimporte['Formulaimporte']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $formulaimporte['Formulaimporte']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Formulaimportes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formulaimporte', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tallercitos', true), array('controller' => 'tallercitos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tallercito', true), array('controller' => 'tallercitos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Movimientodetalles', true), array('controller' => 'movimientodetalles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movimientodetalle', true), array('controller' => 'movimientodetalles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Movimientodetalles');?></h3>
	<?php if (!empty($formulaimporte['Movimientodetalle'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th><?php __('Signo'); ?></th>
		<th><?php __('Formulaimporte Id'); ?></th>
		<th><?php __('Movimiento Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($formulaimporte['Movimientodetalle'] as $movimientodetalle):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $movimientodetalle['id'];?></td>
			<td><?php echo $movimientodetalle['valor'];?></td>
			<td><?php echo $movimientodetalle['signo'];?></td>
			<td><?php echo $movimientodetalle['formulaimporte_id'];?></td>
			<td><?php echo $movimientodetalle['movimiento_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'movimientodetalles', 'action' => 'view', $movimientodetalle['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'movimientodetalles', 'action' => 'edit', $movimientodetalle['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'movimientodetalles', 'action' => 'delete', $movimientodetalle['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $movimientodetalle['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Movimientodetalle', true), array('controller' => 'movimientodetalles', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
