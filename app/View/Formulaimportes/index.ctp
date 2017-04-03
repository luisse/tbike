<?php echo $this->Html->script(array('/js/formulaimportes/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-clock-o fa-lg"></i> Compocición de Formula de <?php echo $movimientodescripcion ?>
    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<center>
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('descripcion',__('Descripcion'));?></th>
				<th><?php echo $this->Paginator->sort('valor',__('Valor'));?></th>
				<th><?php echo $this->Paginator->sort('esporcentaje',__('Es Porcentaje'));?></th>
				<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($formulaimportes as $formulaimporte):
		?>
		<tr>
			<td><?php echo $formulaimporte['Formulaimporte']['descripcion']; ?>&nbsp;</td>
			<td><?php echo $formulaimporte['Formulaimporte']['valor']; ?>&nbsp;</td>
			<td><?php echo $str_esporcentaje[$formulaimporte['Formulaimporte']['esporcentaje']]; ?>&nbsp;</td>
			<td class="actions">
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<li>
								<?php
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'formulaimportes',
								'action'=>'edit',$formulaimporte['Formulaimporte']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>


						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'formulaimportes',
											'action'=>'delete',$formulaimporte['Formulaimporte']['id']),
											array('onclick'=>"return confirm('¿Desea Borrar Campo Formula Seleccionado?')",'escape'=>false),'');?>
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
		<div class="col-xs-6 col-sm-6">
			<center>
			<?php
				echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Item Formula">
																		<span class="glyphicon  glyphicon-plus"></span>&nbsp;Agregar Item</button>',array('controller'=>'formulaimportes',
											'action'=>'add',''),
											array('escape'=>false),
						'');
		?>
			</center>
		</div>
		<div class="col-xs-6 col-sm-6">
			<center>
				<?php echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" id="cancelar">
			  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;Cancelar</button>'
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
