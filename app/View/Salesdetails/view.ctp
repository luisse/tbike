<div class="salesdetails view">
<h2><?php  __('Salesdetail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cantidad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $salesdetail['Salesdetail']['cantidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subtotal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $salesdetail['Salesdetail']['subtotal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $salesdetail['Salesdetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sales'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($salesdetail['Sales']['id'], array('controller' => 'sales', 'action' => 'view', $salesdetail['Sales']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Products'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($salesdetail['Products']['id'], array('controller' => 'products', 'action' => 'view', $salesdetail['Products']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Salesdetail', true), array('action' => 'edit', $salesdetail['Salesdetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Salesdetail', true), array('action' => 'delete', $salesdetail['Salesdetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $salesdetail['Salesdetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Salesdetails', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Salesdetail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Products', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
