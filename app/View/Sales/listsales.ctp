<br>
<?php if(!empty($sales)){?>
<?php
	$str_estadossino[0]='NO';
	$str_estadossino[1]='SI';
?>

<div class="table-responsive">
	<div class="panel-body">
		<div class="table-responsive">
		<center>
			<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
			<thead>
				<tr>
						<th><div class="sort"><?php echo $this->Paginator->sort('Sale.fecha','Fecha');?></div></th>
						<th><div class="sort"><?php echo $this->Paginator->sort('Sale.nrofactura','Nro Venta');?></div></th>
						<th><div class="sort"><?php echo $this->Paginator->sort('Sale.totalsale','Total Venta');?></div></th>
						<th><div class="sort"><?php echo $this->Paginator->sort('Sale.totaliva','Total Iva');?></div></th>
						<th><div class="sort"><?php echo $this->Paginator->sort('Sale.tipofactura','Tipo de Venta');?></div></th>
						<th><div class="sort"><?php echo $this->Paginator->sort('Sale.cliente_id','Cliente');?></div></th>
						<th><?php echo __('Pagado')?></th>
						<th><?php __('Acciones');?></th>
				</tr>
			</thead>
		<tbody>
		<?php
		$i=0;
		foreach ($sales as $sale):
		?>
		<tr>
			<td align="center">
				<?php echo $this->Form->hidden('Sale.'.$i.'cliente_id',array('value'=>$sale['Cliente']['id']));?>
				<?php echo $this->Form->hidden('Sale.'.$i.'totalsale',array('value'=>$sale['Sale']['totalsale']));?>
				<?php echo $this->Form->hidden('Sale.'.$i.'nrofactura',array('value'=>$sale['Sale']['nrofactura']));?>
				<?php echo $this->Time->Format('d/m/Y', $sale['Sale']['fecha']); ?>&nbsp;</td>
			<td align="right"><?php
			echo $this->Html->link($sale['Sale']['nrofactura'],'#',
							array('onclick'=>'return verFactura('.$sale['Sale']['id'].')'));?>&nbsp;</td>
			<td align="right"><?php echo $sale['Sale']['totalsale']; ?>&nbsp;</td>
			<td align="right"><?php echo $sale['Sale']['totaliva']; ?>&nbsp;</td>
			<td><?php echo $str_tipofactura[$sale['Sale']['tipofactura']]; ?>&nbsp;</td>
			<td><?php if ($sale['Cliente']['apellido']!= ''){
						echo $this->Html->link($sale['Cliente']['apellido'].', '.$sale['Cliente']['nombre'],'#',
							array('onclick'=>'return verCliente('.$sale['Cliente']['id'].')'));
					}
			?>&nbsp;</td>
			<td>
				<?php if($sale['Sale']['tipofactura'] != 'P'):?>
					<?php if($sale['Sale']['state'] == 1): ?>
						<?php echo $this->Form->input('Sale.'.$i.'estadopago',array('options'=>$str_estadossino,'onchange'=>'AgregarPago('.$i.')','label'=>false/*,'value'=>$sale['Bicicletareparamo']['entregada'])*/)) ?>
					<?php endif ?>
					<?php if($sale['Sale']['state'] == 2) echo __('Si')?>
				<?php endif;?>

			</td>
			<td class="actions">
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu   dropdown-menu-right">
						<li>
								<?php
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'sales',
								'action'=>'edit',$sale['Sale']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>


						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'sales',
											'action'=>'delete',$sale['Sale']['id']),
											array('onclick'=>"return confirm('¿Desea Borrar la Venta Seleccionada?')",'escape'=>false),'');?>
						</li>
					  </ul>
					 </div>
			</td>
		</tr>
	<?php
		$i++;
		endforeach;
	?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="7" class='row1'>
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
			<tr>
			<td class='row1'>
				<H2><?php echo __('Total Venta')?></H2>
			</td>
			<td colspan="6" class='row1'>
				<H2><?php echo $totalsales;?></H2>
			</td>
			</tr>
		</tfoot>
	</table>
	</center>
	<div  class="col-lg-1" id='export'>
		<br>
		<button type="button" class="btn btn-info btn-lw" id='exportar'>
				<span class="glyphicon glyphicon-download"></span>&nbsp;<?php echo __('Exportar Datos a CVS') ?>
		</button>
	</div>

<?php }else{?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<strong><?php echo __('Cuidado!')?></strong>&nbsp;<?php echo "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php
} ?>
