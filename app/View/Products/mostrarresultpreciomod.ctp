<!-- FIN BLOQUE BOTONES -->
<?php echo $this->Form->create('Product',array('action'=>'actualizarprecio',	
				'type'=>'file',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<center>
	<div class="table-responsive">
	<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer table-responsive" aria-describedby="dataTables-example_info">
	<thead>
		<tr>
				<th><div class='sort'><?php echo __('Act');?></div></th>
				<th><div class='sort'><?php echo __('Ult. Act');?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('Product.descripction','Producto Nombre');?></div></th>
				<th><?php echo __('Categoria');?></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('subcategoria','Subcategoria');?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('Productsdetail.precio','Precio Actual');?></div></th>
				<th><div class='sort'><?php echo __('Precio Final');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=0;
		foreach ($products as $product):
		?>
		<tr>
			<td>
				<?php echo $this->Form->hidden('Productsdetail.'.$i.'.id',array('value'=>$product['Productsdetail']['id']));?>
				<?php echo $this->Form->hidden('Productsdetail.'.$i.'.product_id',array(
																'value'=>$product['Product']['id']))?>			
				<?php echo $this->Form->input('Productsdetail.'.$i.'.actualizar',array('label' => false,
																'type'=>'checkbox',
																'checked'=>'true',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>			
			</td>
			<td class='success'><?php echo $this->Time->format('d/m/Y h:m:s',$product['Productsdetail']['modified'])?></td>
			<td><?php echo $product['Product']['descripcion'] ?>&nbsp;</td>
		 	<td><?php echo $product[0]['categoria'] ?>&nbsp;</td>
			<td><?php echo $product[0]['subcategoria'] ?>&nbsp;</td>
			<td align="right"><?php echo '$ '.$this->Number->precision($product['Productsdetail']['precio'],2); ?>&nbsp;</td>
			<td align="right"  class='danger'>
					<?php echo $this->Form->input('Productsdetail.'.$i.'.precio',array('value'=>$this->Number->precision($product[0]['preciofinal'],2),'label'=>false,'class'=>'clprecio','type'=>'text'));?>
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
<?php echo $this->Form->end();?>
