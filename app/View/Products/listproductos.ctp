<!-- FIN BLOQUE BOTONES -->
<center>
	<div class="table-responsive">
	<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer table-responsive" aria-describedby="dataTables-example_info">
	<thead>
		<tr>
				<th><div class='sort'><?php echo $this->Paginator->sort('Product.descripction','Producto Nombre');?></div></th>
				<th><?php echo __('Categoria');?></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('subcategoria','Subcategoria');?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('Productsdetail.stock','Stock');?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('Productsdetail.precio','Precio');?></div></th>
				<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($products as $product):
		?>
		<tr>
			<td><?php if($product[0]['imagenes'] > 0):?>
					<i class="fa fa-picture-o fa-fw"></i>&nbsp;
				<?php endif; ?>
					<?php echo $product['Product']['descripcion'] ?>&nbsp;</td>
		 	<td><?php echo $product[0]['categoria'] ?>&nbsp;</td>
			<td><?php echo $product[0]['subcategoria'] ?>&nbsp;</td>
			<td align="right"><?php echo $product['Productsdetail']['stock'] ?>&nbsp;</td>
			<td align="right"><?php echo '$ '.$this->Number->precision($product['Productsdetail']['precio'],2); ?>&nbsp;</td>
			<td class="actions">
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<li>
								<?php
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'products',
								'action'=>'edit',$product['Product']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>


						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'products',
											'action'=>'delete',$product['Product']['id']),
											array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-picture-o fa-fw"></i>&nbsp;'.__('Fotos'),array('controller'=>'productimages',
											'action'=>'index',$product['Product']['id']),
											array('onclick'=>"",'escape'=>false),'');?>
						</li>
					  </ul>
					 </div>

			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="9" class='row1'>
				<center>
						<?php
							$paginador = $this->paginator->numbers(array(
								    'before' => '',
								    'separator' => '',
								    'currentClass' => 'active',
								    'tag' => 'li',
									 'currentTag' => 'a',
								    'after' => ''));
						?>
						<div class="pagination">
							<?php if(!empty($paginador)): ?>
							<nav>
								<ul class="pagination">
  								  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
								  <li><?php echo $paginador;?></li>
								  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
								</ul>
							</nav>
						<?php endif;?>
						</div>
				</center>
			</td>
			</tr>
		</tfoot>
	</table>
	</div>
</center>
