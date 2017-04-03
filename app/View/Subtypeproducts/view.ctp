<div class="subtypeproducts view">
<h2><?php  __('Subtypeproduct');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subtypeproduct['Subtypeproduct']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripction'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subtypeproduct['Subtypeproduct']['descripction']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Est'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subtypeproduct['Subtypeproduct']['est']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiponegocio Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subtypeproduct['Subtypeproduct']['tiponegocio_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subtypeproduct', true), array('action' => 'edit', $subtypeproduct['Subtypeproduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Subtypeproduct', true), array('action' => 'delete', $subtypeproduct['Subtypeproduct']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subtypeproduct['Subtypeproduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Subtypeproducts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subtypeproduct', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
