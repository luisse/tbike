<div class="bicicletasparaalquileres view">
<h2><?php  __('Bicicletasparaalquilere');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletasparaalquilere['Bicicletasparaalquilere']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletasparaalquilere['Bicicletasparaalquilere']['estado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalle'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletasparaalquilere['Bicicletasparaalquilere']['detalle']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletasparaalquilere['Bicicletasparaalquilere']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bicicletasparaalquilere['Bicicletasparaalquilere']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bicicleta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bicicletasparaalquilere['Bicicleta']['id'], array('controller' => 'bicicletas', 'action' => 'view', $bicicletasparaalquilere['Bicicleta']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bicicletasparaalquilere', true), array('action' => 'edit', $bicicletasparaalquilere['Bicicletasparaalquilere']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Bicicletasparaalquilere', true), array('action' => 'delete', $bicicletasparaalquilere['Bicicletasparaalquilere']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bicicletasparaalquilere['Bicicletasparaalquilere']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletasparaalquileres', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicletasparaalquilere', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletas', true), array('controller' => 'bicicletas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicleta', true), array('controller' => 'bicicletas', 'action' => 'add')); ?> </li>
	</ul>
</div>
