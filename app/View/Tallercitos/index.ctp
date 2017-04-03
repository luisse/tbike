

<div class="panel panel-default">
	<div class="panel-heading">
		Datos del Taller
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

	<center>
		<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">
		<thead>
			<tr>
					<th><?php echo __('CUIT');?></th>
					<th><?php echo __('Razon Social');?></th>
					<th><?php echo __('Dirección');?></th>
					<th><?php echo __('Email');?></th>
					<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0;
			foreach ($tallercitos as $tallercito):
			?>
			<tr>
				<td><?php echo $tallercito['Tallercito']['CUIT']; ?>&nbsp;</td>
				<td><?php echo $tallercito['Tallercito']['razonsocial']; ?>&nbsp;</td>
				<td><?php echo $tallercito['Tallercito']['direccion']; ?>&nbsp;</td>
				<td><?php echo $tallercito['Tallercito']['email']; ?>&nbsp;</td>
				<td class="actions">
				<center>
				<?php 
					echo $this->Html->link('<button type="button" class="btn btn-default btn-lw" title="Modificar Datos">
									<span class="glyphicon glyphicon-save"></span></button>',array('controller'=>'tallercitos',
						'action'=>'edit',$tallercito['Tallercito']['id']),
						array('onclick'=>'','escape'=>false),
						'');
				?>
				</center>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
			<tfoot>
				<tr>
				<td colspan="7">
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
				</td>
				</tr>
			</tfoot>
		</table>
		</center>
	
		<div class="row">	
			<div class="col-lg-6">
			<?php if(empty($tallercitos)):?>
						
							<?php
								echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Taller">
																						<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'tallercitos',
															'action'=>'add',''),
															array('escape'=>false),
										'');		
							?>
			<?php endif;?>				
				</div>
		</div>
	</div>	
</div>
