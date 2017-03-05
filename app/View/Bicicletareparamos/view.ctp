<div class="bicicletareparamos view">
<h2><?php  __('Bicicletareparamo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamo['Bicicletareparamo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechaingreso'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamo['Bicicletareparamo']['fechaingreso']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechaegreso'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamo['Bicicletareparamo']['fechaegreso']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detallereparacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamo['Bicicletareparamo']['detallereparacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamo['Bicicletareparamo']['estado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descuento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamo['Bicicletareparamo']['descuento']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Importetotal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamo['Bicicletareparamo']['importetotal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cliente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bicicletareparamo['Cliente']['id'], array('controller' => 'clientes', 'action' => 'view', $bicicletareparamo['Cliente']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bicicleta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bicicletareparamo['Bicicleta']['id'], array('controller' => 'bicicletas', 'action' => 'view', $bicicletareparamo['Bicicleta']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bicicletareparamo', true), array('action' => 'edit', $bicicletareparamo['Bicicletareparamo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Bicicletareparamo', true), array('action' => 'delete', $bicicletareparamo['Bicicletareparamo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bicicletareparamo['Bicicletareparamo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletareparamos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicletareparamo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes', true), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletas', true), array('controller' => 'bicicletas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicleta', true), array('controller' => 'bicicletas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletareparamorepuestos', true), array('controller' => 'bicicletareparamorepuestos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicletareparamorepuesto', true), array('controller' => 'bicicletareparamorepuestos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Bicicletareparamorepuestos');?></h3>
	<?php if (!empty($bicicletareparamo['Bicicletareparamorepuesto'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Repuestodescr'); ?></th>
		<th><?php __('Precio'); ?></th>
		<th><?php __('Cantidad'); ?></th>
		<th><?php __('Aceptado'); ?></th>
		<th><?php __('Bicicletareparamo Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($bicicletareparamo['Bicicletareparamorepuesto'] as $bicicletareparamorepuesto):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $bicicletareparamorepuesto['id'];?></td>
			<td><?php echo $bicicletareparamorepuesto['repuestodescr'];?></td>
			<td><?php echo $bicicletareparamorepuesto['precio'];?></td>
			<td><?php echo $bicicletareparamorepuesto['cantidad'];?></td>
			<td><?php echo $bicicletareparamorepuesto['aceptado'];?></td>
			<td><?php echo $bicicletareparamorepuesto['bicicletareparamo_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'bicicletareparamorepuestos', 'action' => 'view', $bicicletareparamorepuesto['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'bicicletareparamorepuestos', 'action' => 'edit', $bicicletareparamorepuesto['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'bicicletareparamorepuestos', 'action' => 'delete', $bicicletareparamorepuesto['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bicicletareparamorepuesto['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Bicicletareparamorepuesto', true), array('controller' => 'bicicletareparamorepuestos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
