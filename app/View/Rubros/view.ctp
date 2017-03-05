<div class="rubros view">
<h2><?php  __('Rubro');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rubro['Rubro']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rubro['Rubro']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sintetico'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rubro['Rubro']['sintetico']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rubro['Rubro']['estado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Negocios Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rubro['Rubro']['negocios_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rubro', true), array('action' => 'edit', $rubro['Rubro']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Rubro', true), array('action' => 'delete', $rubro['Rubro']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $rubro['Rubro']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
