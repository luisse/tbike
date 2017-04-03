<div class="panel panel-default">
	<div class="panel-heading">
		Filtros para Clientes
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<div role="grid" class="dataTables_wrapper form-inline" id="dataTables-example_wrapper">
				<div class="row">
					<div class="col-lg-2">
						<?php echo $this->Form->input('Cliente.Documento', array(
							'label' => array('title'=>'Documento ','style'=>''),
							'placeholder' => 'Nro. Documento',
							'class'=>'form-control input-sm',
							'size'=>5
						)); ?>	
					</div>
					<div class="col-lg-4">
					<?php echo $this->Form->input('Cliente.Apellido', array(
						'label' => 'Apellido ',
						'placeholder' => 'Apellido',
						'class'=>'form-control input-sm',
						'size'=>30
					)); ?>			
					</div>
					<div class="col-lg-4">
					<?php echo $this->Form->input('Cliente.Nombre', array(
						'label' => 'Nombre ',
						'placeholder' => 'Nombre',
						'class'=>'form-control input-sm',
						'size'=>30
					)); ?>		
					</div>
					<div class="col-lg-2">
						<button type="button" class="btn btn-info btn-lw" id='guardar'>
							<span class="glyphicon glyphicon-search"></span> Buscar
						</button>
					</div>
				</div>

	<br>		
	<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">
	<thead>
			<tr>
					<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending"><?php echo __('#');?></th>
					<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending"><?php echo $this->paginator->sort('documento',__('Documento'));?></th>
					<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending"><?php echo $this->paginator->sort('fecnac',__('Fec. Nac.'));?></th>
					<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending"><?php echo $this->paginator->sort('nombre',__('Nombre'));?></th>
					<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending"><?php echo $this->paginator->sort('apellido',__('Apellido'));?></th>
					<th><?php echo __('Telefono');?></th>
					<th><?php echo __('Domicilio');?></th>
					<th><?php echo __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0;
			foreach ($clientes as $cliente):
			?>
			<tr>
				<td><?php echo $cliente['Cliente']['id']; ?>&nbsp;</td>
				<td><?php echo $cliente['Cliente']['documento']; ?>&nbsp;</td>
				<td><?php echo $cliente['Cliente']['fechanac']; ?>&nbsp;</td>
				<td><?php echo $cliente['Cliente']['nombre']; ?>&nbsp;</td>
				<td><?php echo $cliente['Cliente']['apellido']; ?>&nbsp;</td>
				<td><?php echo $cliente['Cliente']['telefono']; ?>&nbsp;</td>
				<td><?php echo $cliente['Cliente']['domicilio']; ?>&nbsp;</td>
				<td>
				<?php 
								echo $this->Html->link('<button type="button" class="btn btn-default btn-lw" title="Modificar Datos">
									<span class="glyphicon glyphicon-save"></span></button>',array('controller'=>'clientes',
									'action'=>'edit',$cliente['Cliente']['id']),
									array('onclick'=>'','escape'=>false),
									'');
							?>
							&nbsp;
							<?php
								echo $this->Html->link('<button type="button" class="btn btn-default btn-lw" title="Borrar Cliente">
																	<span class="glyphicon  glyphicon-remove-circle"></span></button>',
																	array('controller'=>'clientes','action'=>'borrar',$cliente['Cliente']['id']),
												array('onclick'=>"return confirm('¿Desea borrar el Cedente seleccionado?')",'escape'=>false),
							'');?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
			<tfoot>
				<tr>
				<td colspan="8">
					<center>
						<ul class="pagination">
						  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
						  <li><?php echo $this->paginator->numbers(array('separator'=>''));?></li>
						  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
						</ul>	
					</center>				
				</td>
				</tr>
			</tfoot>
		</table>
		</div>
	</div>
</div>