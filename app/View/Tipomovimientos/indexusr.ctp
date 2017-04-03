<?php echo $this->Html->script(array('/js/tipomovimientos/indexusr.js'),array('block'=>'scriptjs'));?>

<!--     BLOQUE DE BOTONES -->

<!-- FIN BLOQUE BOTONES -->
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-bank fa-lg"> </i> Transacciones del Sistema
    </div>
	<br>
	<center>
	<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
					<th><?php echo $this->Paginator->sort('descripcion','Descripción');?></th>
					<th><?php echo $this->Paginator->sort('signo','Signo');?></th>
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
				<td class="actions">
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu">
						<li>
									<?php echo $this->Html->link('<i class="fa fa-dollar fa-fw"></i> Detalle Calculos',array('controller'=>'formulaimportes',
									'action'=>'index',$tipomovimiento['Tipomovimiento']['id']),
									array('onclick'=>'','escape'=>false),
									'');?>
						</li>
					  </ul>
					 </div>
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
</div>