<div class="bicicletareparamorepuestos view">
<h2><?php  __('Bicicletareparamorepuesto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamorepuesto['Bicicletareparamorepuesto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Repuestodescr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamorepuesto['Bicicletareparamorepuesto']['repuestodescr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Precio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamorepuesto['Bicicletareparamorepuesto']['precio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cantidad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamorepuesto['Bicicletareparamorepuesto']['cantidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Aceptado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletareparamorepuesto['Bicicletareparamorepuesto']['aceptado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bicicletareparamo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bicicletareparamorepuesto['Bicicletareparamo']['id'], array('controller' => 'bicicletareparamos', 'action' => 'view', $bicicletareparamorepuesto['Bicicletareparamo']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bicicletareparamorepuesto', true), array('action' => 'edit', $bicicletareparamorepuesto['Bicicletareparamorepuesto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Bicicletareparamorepuesto', true), array('action' => 'delete', $bicicletareparamorepuesto['Bicicletareparamorepuesto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bicicletareparamorepuesto['Bicicletareparamorepuesto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletareparamorepuestos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicletareparamorepuesto', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletareparamos', true), array('controller' => 'bicicletareparamos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicletareparamo', true), array('controller' => 'bicicletareparamos', 'action' => 'add')); ?> </li>
	</ul>
</div>
