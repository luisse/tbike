<div class="sales view">
<h2><?php  __('Sale');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Saledate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['saledate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Totalsale'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['totalsale']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Totaliva'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['totaliva']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipofactura'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['tipofactura']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nrofactura'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['nrofactura']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Negocio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($sale['Negocio']['id'], array('controller' => 'negocios', 'action' => 'view', $sale['Negocio']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['fecha']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cliente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($sale['Cliente']['id'], array('controller' => 'clientes', 'action' => 'view', $sale['Cliente']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sale', true), array('action' => 'edit', $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sale', true), array('action' => 'delete', $sale['Sale']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Negocios', true), array('controller' => 'negocios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Negocio', true), array('controller' => 'negocios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes', true), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente', true), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
