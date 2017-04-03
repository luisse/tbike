<?php if(!empty($rankresult)){?>
<div class="table-responsive">
	<div class="panel-body">
		<div class="table-responsive">
		<center>
			<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
			<thead>
				<tr>
						<th><div class="sort"><?php echo __('Código de Barra');?></div></th>
						<th><div class="sort"><?php echo __('Categoria');?></div></th>
						<th><div class="sort"><?php echo __('Subcateogira');?></div></th>
						
						<th><div class="sort"><?php echo __('Producto Detalle');?></div></th>
						<th><div class="sort"><?php echo __('Cantidad Vendida');?></div></th>
						<th><div class="sort"><?php echo __('Monto Vendido');?></div></th>
				</tr>
			</thead>
		<tbody>
		<?php
		$i=0;
		foreach ($rankresult as $sale):
		?>
		<tr>
			<td align="left"><?php echo $sale['Product']['codbarra'] ?>&nbsp;</td>
			<td align="left"><?php echo $sale['Categoria']['descripcion']?></td>
			<td align="left"><?php echo $sale['Subcategoria']['descripcion']?></td>
			<td align="left"><?php echo $sale['Product']['descripcion']?></td>
			<td align="right"><?php echo $sale['0']['totalvendido']; ?>&nbsp;</td>
			<td align="right"><?php echo $this->Number->precision($sale['0']['total'],2); ?>&nbsp;</td>
		</tr>
	<?php 
		$i++;
		endforeach; 
	?>
	</tbody>
	</table>
	</center>
<?php }else{?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>	
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php 
} ?>
