<div class="categorias view">
<h2><?php  __('Categoria');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['imagen']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Padre Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['padre_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Categoria', true), array('action' => 'edit', $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Categoria', true), array('action' => 'delete', $categoria['Categoria']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorias', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Productosacategorias', true), array('controller' => 'productosacategorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Productosacategoria', true), array('controller' => 'productosacategorias', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Productosacategorias');?></h3>
	<?php if (!empty($categoria['Productosacategoria'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Categoria Id'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($categoria['Productosacategoria'] as $productosacategoria):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $productosacategoria['categoria_id'];?></td>
			<td><?php echo $productosacategoria['product_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'productosacategorias', 'action' => 'view', $productosacategoria['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'productosacategorias', 'action' => 'edit', $productosacategoria['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'productosacategorias', 'action' => 'delete', $productosacategoria['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productosacategoria['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Productosacategoria', true), array('controller' => 'productosacategorias', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
