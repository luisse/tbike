<?php if(!empty($products)){?>
<center>
<table cellspacing="1" width='100%'  class="table-responsive">
<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('Product.codgen','Codigo Generico');?></th>
			<th><?php echo $this->Paginator->sort('Product.descripction','Producto Nombre');?></th>
			<th><?php echo $this->Paginator->sort('Productsdetail.stock','Stock');?></th>
			<th><?php echo $this->Paginator->sort('Productsdetail.precio','Precio');?></th>
			<th><?php __('Acciones');?></th>
	</tr>
</thead>
<tbody>
	<?php
	$i = 0;
	print_r($products);
	foreach ($products as $product):
		$class = ' class="row0"';
		if ($i++ % 2 == 0) {
			$class = ' class="row1"';
		}
	?>
	<tr <?php echo $class;?>>
		<td>
		<input type='hidden' id="<?php echo 'Product'.$i.'id' ?>" value='<?php echo $product['Product']['id'] ?>'>
		<?php echo $product['Product']['codgen'] ?>&nbsp;
		</td>
		<td><?php echo $product['Product']['descripction'] ?>&nbsp;</td>
		<td align="right"><?php echo $product['Productsdetail']['stock'] ?>&nbsp;</td>
		<td align="right"><?php echo $product['Productsdetail']['precio'] ?>&nbsp;</td>
		<td class="actions">
		<center>
		<div>
			<ul class="ui-widget icon-collection">
				<li class="ui-state-default ui-corner-all" title="Agregar Producto" onclick="recuperarDatosProduct(<?php echo $i ?>,'P')">
					<span class="ui-icon ui-icon-plus" ></span>
				</li>
				<li rel='facebook' class="ui-state-default ui-corner-all" title="Ver Imagenes" onclick="VerImagenes(<?php echo $i ?>)">
					<?php echo $this->Html->link('<span class="ui-icon ui-icon-play">Ver Imagenes</span>',array('controller'=>'Productimages',
                                                'action'=>'viewpictures',$product['Productsdetail']['id']),array('escape' => false,'rel'=>'productfacebox'))?>
				</li>
			</ul>
		</div>
		</center>
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
</center>
<?php }else{
	//echo "<center>NO SE RECUPERADON DATOS PARA LOS FILTOS SELECCIONADOS</CENTER>";
?>
<script type="text/javascript">$().toastmessage('showWarningToast', "No se recuperaron productos para los filtros seleccionados..."); </script>	
<?php 
} ?>
