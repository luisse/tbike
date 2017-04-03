<div class="tipomens view">
<h2><?php  __('Tipomen');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomen['Tipomen']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomen['Tipomen']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sintetico'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomen['Tipomen']['sintetico']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipomen', true), array('action' => 'edit', $tipomen['Tipomen']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipomen', true), array('action' => 'delete', $tipomen['Tipomen']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipomen['Tipomen']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipomens', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipomen', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
