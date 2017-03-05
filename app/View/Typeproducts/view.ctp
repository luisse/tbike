<div class="typeproducts view">
<h2><?php  __('Typeproduct');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeproduct['Typeproduct']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripction'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeproduct['Typeproduct']['descripction']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Est'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeproduct['Typeproduct']['est']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiponegocio Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeproduct['Typeproduct']['tiponegocio_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Typeproduct', true), array('action' => 'edit', $typeproduct['Typeproduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Typeproduct', true), array('action' => 'delete', $typeproduct['Typeproduct']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $typeproduct['Typeproduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Typeproducts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Typeproduct', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
