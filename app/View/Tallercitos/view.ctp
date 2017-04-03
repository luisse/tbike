<div class="tallercitos view">
<h2><?php  __('Tallercito');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tallercito['Tallercito']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('CUIT'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tallercito['Tallercito']['CUIT']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Razonsocial'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tallercito['Tallercito']['razonsocial']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Direccion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tallercito['Tallercito']['direccion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Telefono'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tallercito['Tallercito']['telefono']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tallercito['Tallercito']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Webpage'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tallercito['Tallercito']['webpage']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($tallercito['User']['id'], array('controller' => 'users', 'action' => 'view', $tallercito['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Provincia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($tallercito['Provincia']['id'], array('controller' => 'provincias', 'action' => 'view', $tallercito['Provincia']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Departamento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($tallercito['Departamento']['id'], array('controller' => 'departamentos', 'action' => 'view', $tallercito['Departamento']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Localidade'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($tallercito['Localidade']['id'], array('controller' => 'localidades', 'action' => 'view', $tallercito['Localidade']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tallercito', true), array('action' => 'edit', $tallercito['Tallercito']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tallercito', true), array('action' => 'delete', $tallercito['Tallercito']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tallercito['Tallercito']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tallercitos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tallercito', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Provincias', true), array('controller' => 'provincias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provincia', true), array('controller' => 'provincias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departamentos', true), array('controller' => 'departamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Departamento', true), array('controller' => 'departamentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localidades', true), array('controller' => 'localidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Localidade', true), array('controller' => 'localidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
