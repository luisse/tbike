<div class="mensajes view">
<h2><?php  __('Mensaje');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usersend Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['usersend_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Userrec Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['userrec_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tallercito'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mensaje['Tallercito']['id'], array('controller' => 'tallercitos', 'action' => 'view', $mensaje['Tallercito']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mailauto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['mailauto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asunto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['asunto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalle'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['detalle']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechasend'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['fechasend']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Enviado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['enviado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechasendauto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['fechasendauto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Confirmadocliente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['confirmadocliente']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bicicleta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mensaje['Bicicleta']['id'], array('controller' => 'bicicletas', 'action' => 'view', $mensaje['Bicicleta']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipomen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mensaje['Tipomen']['id'], array('controller' => 'tipomens', 'action' => 'view', $mensaje['Tipomen']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mensaje', true), array('action' => 'edit', $mensaje['Mensaje']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Mensaje', true), array('action' => 'delete', $mensaje['Mensaje']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mensaje['Mensaje']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mensajes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mensaje', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tallercitos', true), array('controller' => 'tallercitos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tallercito', true), array('controller' => 'tallercitos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bicicletas', true), array('controller' => 'bicicletas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bicicleta', true), array('controller' => 'bicicletas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipomens', true), array('controller' => 'tipomens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipomen', true), array('controller' => 'tipomens', 'action' => 'add')); ?> </li>
	</ul>
</div>
