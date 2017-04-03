<div class="mensajeservices view">
<h2><?php  __('Mensajeservice');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajeservice['Mensajeservice']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalleservice'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajeservice['Mensajeservice']['detalleservice']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Enviarcorreo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajeservice['Mensajeservice']['enviarcorreo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cantmensajes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajeservice['Mensajeservice']['cantmensajes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechaaprox'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajeservice['Mensajeservice']['fechaaprox']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bicicleta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mensajeservice['Bicicleta']['id'], array('controller' => 'bicicletas', 'action' => 'view', $mensajeservice['Bicicleta']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Confirmadocliente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajeservice['Mensajeservice']['confirmadocliente']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mensajeservice', true), array('action' => 'edit', $mensajeservice['Mensajeservice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Mensajeservice', true), array('action' => 'delete', $mensajeservice['Mensajeservice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mensajeservice['Mensajeservice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mensajeservices', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mensajeservice', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletas', true), array('controller' => 'bicicletas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicleta', true), array('controller' => 'bicicletas', 'action' => 'add')); ?> </li>
	</ul>
</div>
