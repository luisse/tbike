<?php echo $this->Html->script(array('/js/categorias/addsub.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>			
<?php echo $this->element('flash_message')?>

<?php echo $this->Form->create('Categoria',array('action'=>'addsub',	
				'type'=>'file',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<fieldset>
	<legend><?php echo __('Nueva Subcategoria').':'.$categoria['Categoria']['descripcion']?></legend>
				<div class="panel panel-default">
					<button type="button" class="btn btn-primary btn-lw" title="Agregar Fila" id='agregarfila'>
							<span class="glyphicon  glyphicon-plus"></span>
						</button>						
						<table id="categorias" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">		
							<thead>
								<tr>
									<th><?php echo __('Detalle de Sub-Categoria');?></th>
									<th><?php echo __('Imagen');?></th>
									<th><?php __('Acciones');?></th>
								</tr>
							</thead>
							<tbody>
										<?php
										for($i=0;$i<=5;$i++):
										?>
										<tr id='categorias_<?php echo $i?>'>
											<td>
												<div class="col-lg-11">
												<?php echo $this->Form->hidden('Categoria.'.$i.'.padre_id',array('value'=>$padre_id));?>
												<?php echo $this->Form->hidden('Categoria.'.$i.'.tallercito_id',array('value'=>$this->Session->read('tallercito_id')));?>
												<?php echo $this->Form->input('Categoria.'.$i.'.descripcion',array(
													'class'=>'form-control input-sm',
													'label'=>false,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
												</div>
											</td>
												
											<td>
												<div class="col-lg-5">
													<?php echo $this->Form->input('Categoria.'.$i.'.imagen',array(
													'class'=>'form-control input-sm clcantidad',
													'label'=>false,													
													'type'=>'file',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
												</div>
											</td>
											<td class="actions">
													<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $i ?>)">
																	<span class="glyphicon  glyphicon-remove-circle"></span>
													</button>
											</td>
										</tr>
									<?php endfor; ?>
									</tbody>
									</table>						
				</div>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>			
</fieldset>
<?php echo $this->Form->end();?>
