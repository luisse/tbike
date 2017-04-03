<!-- FIN BLOQUE BOTONES -->
<center>
	<div class="table-responsive">
	<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">
	<thead>
		<tr>
				<th><div class='sort'><?php echo $this->Paginator->sort('Product.descripction','Producto Nombre');?></div></th>
				<th><?php echo __('Categoria');?></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('Categoria.categoria','Subcategoria');?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('Productsdetail.stock','Stock');?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('Productsdetail.precio','Precio');?></div></th>
				<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=0;
		foreach ($products as $product):
		?>
		<tr>
			<?php echo $this->Form->hidden('Product.id'.$i,array('value'=>$product['Product']['id']))?>
			<?php echo $this->Form->hidden('Product.descripcion'.$i,array('value'=>$product['Product']['descripcion']))?>			
			<?php echo $this->Form->hidden('Product.precio'.$i,array('value'=>$this->Number->precision($product['Productsdetail']['precio'],2)))?>			
			<td><?php echo $product['Product']['descripcion'] ?>&nbsp;</td>
		 	<td><?php echo $product[0]['categoria'] ?>&nbsp;</td>
			<td><?php echo $product['0']['subcategoria'] ?>&nbsp;</td>
			<td align="right"><?php echo $product['Productsdetail']['stock'] ?>&nbsp;</td>
			<td align="right"><?php echo '$ '.$this->Number->precision($product['Productsdetail']['precio'],2); ?>&nbsp;</td>
			<td class="actions">
				<center>
						<button type="button" class="btn btn-primary btn-lw" title="Agregar Producto" onclick='agregarproducto(<?php echo $i?>)'>
							<span class="glyphicon  glyphicon-plus"></span>
						</button>	
				</center>		
			</td>
		</tr>
	<?php 
		$i++;
		endforeach;
	?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="9" class='row1'>
				<center>
				<?php 
				$paginador = $this->paginator->numbers();
				if(!empty($paginador)): ?>
					<ul class="pagination">
					  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
					  <li><?php echo $this->paginator->numbers(array('separator'=>''));?></li>
					  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
					</ul>	
				<?php 
				$i++;
				endif;?>			
				</center>
			</td>
			</tr>
		</tfoot>
	</table>
	</div>
</center>
