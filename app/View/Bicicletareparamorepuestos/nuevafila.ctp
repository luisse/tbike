						<td>
							<button type="button" class="btn btn-success btn-xs" onclick="buscarproductosmodal(<?php echo $fila?>)" id='buscarproductos' title='Buscar Productos'>
							<span class="glyphicon  glyphicon-search"></span>
							</button>	
						</td>
						<td>
							<div class="col-lg-11">
							<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$fila.'.repuestodescr',array(
													'class'=>'form-control input-sm',
													'label'=>false,													
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							</div>
						</td>
						<td>
							<div class="col-lg-5">
							<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$fila.'.cantidad',array(
													'class'=>'form-control input-sm clcantidad',
													'label'=>false,													
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							<?php echo $this->Form->hidden('Bicicletareparamorepuesto.'.$fila.'.aceptado',array('value'=>'1'))?>
							<?php echo $this->Form->hidden('Bicicletareparamorepuesto.'.$fila.'.id')?>
							<?php echo $this->Form->hidden('Bicicletareparamorepuesto.'.$fila.'.bicicletareparamo_id'/*,array('value'=>$this->request->data['Bicicletareparamo']['id'])*/)?>
							</div>
						</td>
						<td>
							<div class="col-lg-5">
								<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$fila.'.precio',array(
													'class'=>'form-control input-sm  clprecio',
													'label'=>false,
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							</div>
						</td>
						<td class="actions">
							<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="BorrarProductosAsoc(<?php echo $fila ?>)">
							<span class="glyphicon  glyphicon-remove-circle"></span>
							</button>										
						</td>
