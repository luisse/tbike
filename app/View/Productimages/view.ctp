<div class="productimages view">
<h2><?php  __('Productimage');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productimage['Productimage']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pathimg'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productimage['Productimage']['pathimg']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productimage['Productimage']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productimage['Productimage']['estado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Productsdetails'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($productimage['Productsdetails']['id'], array('controller' => 'productsdetails', 'action' => 'view', $productimage['Productsdetails']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Productimage', true), array('action' => 'edit', $productimage['Productimage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Productimage', true), array('action' => 'delete', $productimage['Productimage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productimage['Productimage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Productimages', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Productimage', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Productsdetails', true), array('controller' => 'productsdetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Productsdetails', true), array('controller' => 'productsdetails', 'action' => 'add')); ?> </li>
	</ul>
</div>
