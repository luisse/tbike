<?php echo $this->Html->script(array('/js/bicicletasparaalquileres/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>

<?php echo $this->element('flash_message')?>
<div class="panel panel-listados">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Bicicletas para Alquiler')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th></th>
					<th><?php echo $this->Paginator->sort('detalle','Detalle');?></th>
					<th><?php echo $this->Paginator->sort('estado','Estado');?></th>
					<th><?php echo $this->Paginator->sort('nrocuadro','Nro de Cuadro');?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($bicicletasparaalquileres as $bicicletasparaalquilere):
		?>
	<tr>
		<td><a href="#" class="thumbnail">
				<img width='300px' heigth='280px' src="<?php echo $bicicletasparaalquilere['Bicicleta']['imagen']; ?> "/>
			</a>
		</td>
		<td><?php echo $bicicletasparaalquilere['Bicicletasparaalquilere']['detalle']; ?>&nbsp;</td>
		<td>
			<?php if($bicicletasparaalquilere['Bicicletasparaalquilere']['estado']==0): ?>&nbsp;
				<h4><span class="label label-success">&nbsp;<i class="fa fa-thumbs-o-up fa-fw"></i></span></h4>
			<?php endif;?>
			<?php if($bicicletasparaalquilere['Bicicletasparaalquilere']['estado']==1): ?>&nbsp;
				<h4><span class="label label-danger">&nbsp;<i class="fa fa-thumbs-o-down fa-fw"></i></span></h4>
			<?php endif;?>
			<?php if($bicicletasparaalquilere['Bicicletasparaalquilere']['estado']==2/*Alquilada*/): ?>&nbsp;
				<h4><span class="label label-danger">&nbsp;<i class="fa fa-lock fa-fw"></i></span></h4>
			<?php endif;?>

		</td>
		<td>
			<?php echo $this->Html->link($bicicletasparaalquilere['Bicicleta']['marca'].'-'.$bicicletasparaalquilere['Bicicleta']['nrocuadro'],'#',
							array('onclick'=>'return verDetalle('.$bicicletasparaalquilere['Bicicleta']['id'].')','rel'=>'facebox'))?>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu  dropdown-menu-right">
					<li>
					<?php
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'bicicletasparaalquileres',
								'action'=>'edit',$bicicletasparaalquilere['Bicicletasparaalquilere']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'bicicletasparaalquileres',
								'action'=>'delete',$bicicletasparaalquilere['Bicicletasparaalquilere']['id']),
								array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
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
			<center>
			<div class="pagination">
					<?php echo $paginador = $this->paginator->numbers();?>
<?php if(!empty($paginador)): ?>
						<center>
							<ul class="pagination">
							  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?>
</li>
							  <li><?php echo $this->paginator->numbers(array('separator'=>''));?>
</li>
							  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?>
</li>
							</ul>
						</center>
					<?php endif;?>			</div>
			</center>
		</td>
		</tr>
	</tfoot>
</table>
</center>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'bicicletasparaalquileres',
										'action'=>'add',''),
										array('escape'=>false),
					'');
	?>		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Cancelar')?>
		</button>
		</center>
	</div>
</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
<?php echo $this->element('modalbox')?>
