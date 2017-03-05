<div class="mensajesmantenimientos view">
<h2><?php  __('Mensajesmantenimiento');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajesmantenimiento['Mensajesmantenimiento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechacontrol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajesmantenimiento['Mensajesmantenimiento']['fechacontrol']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Enviarcorreo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajesmantenimiento['Mensajesmantenimiento']['enviarcorreo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Objetorevisar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajesmantenimiento['Mensajesmantenimiento']['objetorevisar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Observaciones'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajesmantenimiento['Mensajesmantenimiento']['observaciones']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bicicleta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mensajesmantenimiento['Bicicleta']['id'], array('controller' => 'bicicletas', 'action' => 'view', $mensajesmantenimiento['Bicicleta']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensajesmantenimiento['Mensajesmantenimiento']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mensajesmantenimiento', true), array('action' => 'edit', $mensajesmantenimiento['Mensajesmantenimiento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Mensajesmantenimiento', true), array('action' => 'delete', $mensajesmantenimiento['Mensajesmantenimiento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mensajesmantenimiento['Mensajesmantenimiento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mensajesmantenimientos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mensajesmantenimiento', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletas', true), array('controller' => 'bicicletas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicleta', true), array('controller' => 'bicicletas', 'action' => 'add')); ?> </li>
	</ul>
</div>
