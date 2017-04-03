<!-- FIN BLOQUE BOTONES -->
<?php $sysconfig=$this->Session->read('sysconfigs'); ?>
<center>
	<div class="table-responsive">
	<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">
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
		$i=0;
		foreach ($products as $product):
		?>
		<tr>
			<td>
				<?php echo $this->Form->hidden('Product.'.$i.'id',array('value'=>$product['Product']['id']))?>
				<?php echo $this->Form->hidden('Product.'.$i.'descripcion',array('value'=>$product['Product']['descripcion']))?>
				<?php echo $this->Form->hidden('Product.'.$i.'precio',array('value'=>$product['Productsdetail']['precio']))?>
				<?php if($product[0]['imagenes'] > 0):?>
					<i class="fa fa-picture-o fa-fw"></i>&nbsp;
				<?php endif; ?>
				<?php echo $product['Product']['descripcion'] ?>&nbsp;</td>
		 	<td><?php echo $product[0]['categoria'] ?>&nbsp;</td>
			<td><?php echo $product[0]['subcategoria'] ?>&nbsp;</td>
			<td align="right"><?php echo $product['Productsdetail']['stock'] ?>&nbsp;</td>
			<td align="right"><?php echo '$ '.$this->Number->precision($product['Productsdetail']['precio'],2); ?>&nbsp;</td>
			<td class="actions">
				<?php if($product['Productsdetail']['stock'] >= 1 || $sysconfig['Sysconfig']['stockrestrict'] == 0):?>
				<div class="btn-group">
							<button type="button" class="btn btn-success btn-lw" title="<?php echo __('Agregar Producto')?>" onclick="recuperarDatosProduct(<?php echo $i?>,'')">
								<span class="glyphicon  glyphicon glyphicon-ok"></span>
							</button>										
				 </div>		
				 <?php endif;?>
				 <?php if($product['Productsdetail']['stock'] < 1):?>
				 <code><strong><?php echo __('Sin Stock')?></strong></code>
				 <?php endif;?>
			</td>
		</tr>
	<?php 
	$i++;
	endforeach; ?>
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
				endif;?>			
				</center>
			</td>
			</tr>
		</tfoot>
	</table>
	</div>
</center>
