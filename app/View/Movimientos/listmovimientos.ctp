<!-- FIN BLOQUE BOTONES -->
<div class="panel-body">
	<ul class="list-group">
		<?php foreach($totalesxmovimiento as $totalesxmovimientos):?>
			<?php
					$class='';
					if($totalesxmovimientos['Tipomovimiento']['descripcion']=='CONTADO EFECTIVO' ||
						$totalesxmovimientos['Tipomovimiento']['descripcion']=='PAGO TARJETA CREDITO' )
						$class='list-group-item-success';?>
			<?php if($totalesxmovimientos['Tipomovimiento']['descripcion']=='CREDITO' )
						$class='list-group-item-warning';?>
		  <li class="list-group-item <?php echo $class?>">
			<span class="badge"><?php echo '$ '.$this->Number->precision($totalesxmovimientos[0]['total'],2)?></span>
			<i class="fa fa-money fa-fw"></i>&nbsp; <?php echo $totalesxmovimientos['Tipomovimiento']['descripcion'] ?>
		  </li>
		<?php endforeach;?>
	</ul>

	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
				<th><?php echo __('Fecha Movimiento');?></th>
				<th><?php echo __('Detalle');?></th>
				<th><?php echo __('Tipo de Movimiento');?></th>
				<th><?php echo __('Cuenta Corriente');?></th>
				<th><?php echo __('Importe');?></th>
				<th><?php echo __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($movimientos as $movimiento):
		?>
		<tr>
			<td><?php echo $this->Time->format('d/m/Y H:m:s',$movimiento['Movimiento']['fechamov']); ?>&nbsp;</td>
			<td><?php echo $movimiento['Movimiento']['detallemov']; ?>&nbsp;</td>
			<td><?php echo $movimiento['Tipomovimiento']['descripcion']; ?>&nbsp;</td>
			<td><?php echo $movimiento['Cuenta']['nrocuenta']; ?>&nbsp;</td>

			<td align='right'><?php
				foreach($movimiento['Movimientodetalle'] as $movimientodetalle):
					if(empty($movimientodetalle['formulaimporte_id']))
						echo $this->Number->precision($movimientodetalle['valor']*$movimientodetalle['signo'],2);
				endforeach;?>&nbsp;</td>
			<td>					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<li>
								<?php
								echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i> Borrar',array('controller'=>'movimientos',
										'action'=>'delete',$movimiento['Movimiento']['id']),
										array('onclick'=>"return confirm('¿Desea Borrar el movimiento seleccionado?')",'escape'=>false),'');?>
						</li>
						<li class="divider"></li>
					  </ul>
					 </div>
</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="6">
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
</div>
