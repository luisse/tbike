<?php echo $this->Html->script(array('/js/proveedores/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-clock-o fa-lg"></i>&nbsp;<?php echo __('Proveedores')?>
    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<center>
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('CUIT',__('CUIT'));?></th>
			<th><?php echo $this->Paginator->sort('denominacion',__('Denominación'));?></th>
			<th><?php echo $this->Paginator->sort('mail',__('Email'));?></th>
			<th><?php echo $this->Paginator->sort('url',__('Pagina Web'));?></th>
			<th><?php __('Acciones');?></th>
	</tr>
</thead>
<tbody>
	<?php
	$i = 0;
	foreach ($proveedores as $proveedore):
	?>
	<tr>
		<td><?php echo $proveedore['Proveedore']['CUIT']; ?>&nbsp;</td>
		<td><?php echo $proveedore['Proveedore']['denominacion']; ?>&nbsp;</td>
		<td><?php echo $proveedore['Proveedore']['mail']; ?>&nbsp;</td>
		<td><?php echo $proveedore['Proveedore']['url']; ?>&nbsp;</td>
		<td class="actions">
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<li>
								<?php
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'proveedores',
								'action'=>'edit',$proveedore['Proveedore']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>


						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'proveedores',
											'action'=>'delete',$proveedore['Proveedore']['id']),
											array('onclick'=>"return confirm('¿Desea Borrar el Proveedor Seleccionado?')",'escape'=>false),'');?>
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
	<div class="row">
		<div class="col-lg-6">
			<center>
			<?php
				echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Proveedor">
																		<span class="glyphicon  glyphicon-plus"></span>Agregar Item</button>',array('controller'=>'proveedores',
											'action'=>'add',''),
											array('escape'=>false),
						'');
		?>
			</center>
		</div>
		<div class="col-lg-6">
			<center>
				<?php echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" id="cancelar">
			  <span class="glyphicon glyphicon glyphicon-off"></span>Cancelar</button>'
						,array('controller'=>'tipomovimientos',
											'action'=>'indexusr',''),
											array('escape'=>false),
						''); ?>

			</center>
		</div>
	</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
