<div class="numeradores view">
<h2><?php  __('Numeradore');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $numeradore['Numeradore']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalle'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $numeradore['Numeradore']['detalle']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rangodesde'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $numeradore['Numeradore']['rangodesde']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rangohasta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $numeradore['Numeradore']['rangohasta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Negocio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($numeradore['Negocio']['id'], array('controller' => 'negocios', 'action' => 'view', $numeradore['Negocio']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Numeradore', true), array('action' => 'edit', $numeradore['Numeradore']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Numeradore', true), array('action' => 'delete', $numeradore['Numeradore']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $numeradore['Numeradore']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Numeradores', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numeradore', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Negocios', true), array('controller' => 'negocios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Negocio', true), array('controller' => 'negocios', 'action' => 'add')); ?> </li>
	</ul>
</div>
