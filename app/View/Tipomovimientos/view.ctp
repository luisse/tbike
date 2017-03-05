<div class="tipomovimientos view">
<h2><?php  __('Tipomovimiento');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomovimiento['Tipomovimiento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomovimiento['Tipomovimiento']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Signo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomovimiento['Tipomovimiento']['signo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomovimiento['Tipomovimiento']['estado']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipomovimiento', true), array('action' => 'edit', $tipomovimiento['Tipomovimiento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipomovimiento', true), array('action' => 'delete', $tipomovimiento['Tipomovimiento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipomovimiento['Tipomovimiento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipomovimientos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipomovimiento', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
