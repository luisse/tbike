<?php echo $this->Html->script(array('/js/tipomovimientos/index.js'),array('block'=>'scriptjs'));?>

<!--     BLOQUE DE BOTONES -->

<!-- FIN BLOQUE BOTONES -->
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-clock-o fa-fw"></i> Transacciones del Sistema
    </div>
	<br>
	<center>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
					<th><?php echo $this->Paginator->sort('descripcion','Descripción');?></th>
					<th><?php echo $this->Paginator->sort('signo','Signo');?></th>
					<th><?php echo $this->Paginator->sort('estado','Estado');?></th>
					<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($tipomovimientos as $tipomovimiento):
			?>
			<tr>
				<td><?php echo $tipomovimiento['Tipomovimiento']['descripcion']; ?>&nbsp;</td>
				<td><?php echo $str_estados[$tipomovimiento['Tipomovimiento']['signo']]; ?>&nbsp;</td>
				<td><?php echo $tipomovimiento['Tipomovimiento']['estado']; ?>&nbsp;</td>
				<td class="actions">
				<center>
				<div>
				<?php 
								echo $this->Html->link('<button type="button" class="btn btn-info btn-lw" title="Modificar Datos">
									<span class="glyphicon glyphicon-save"></span></button>',array('controller'=>'tipomovimientos',
									'action'=>'edit',$tipomovimiento['Tipomovimiento']['id']),
									array('onclick'=>'','escape'=>false),
									'');
							?>
							&nbsp;
							<?php
								echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" title="Eliminar Tipo de Movimientos">
																	<span class="glyphicon  glyphicon-remove-circle"></span></button>',array('controller'=>'tipomovimientos',
												'action'=>'borrar',$tipomovimiento['Tipomovimiento']['id']),
												array('onclick'=>"return confirm('¿Desea borrar el Tipo de Movimiento?')",'escape'=>false),
							'');?>		</div>
				</center>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
			<tfoot>
				<tr>
				<td colspan="7" class='row1'>
				<div class="pagination">
				<?php 
				$paginador = $this->paginator->numbers();
				if(!empty($paginador)): ?>
					<center>
						<ul class="pagination">
						  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
						  <li><?php echo $this->paginator->numbers(array('separator'=>''));?></li>
						  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
						</ul>	
					</center>	
				<?php endif;?>
				</div>
				</td>
				</tr>
			</tfoot>
		</table>
		</center>
	</div>
</div>