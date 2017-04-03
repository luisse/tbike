						<td><?php echo $this->Form->input('Salesdetail.'.$row.'.product_id',array('label' => false	,
																'class'=>'form-control input-sm',
																'type'=>'text',
																'length'=>'5',
																'onchange'=>'recuperarDatosProduct('.$row.',"id")',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$row.'.productdetail',array('label' => false	,
																'class'=>'form-control input-sm detail',
																'type'=>'text',
																'maxlength'=>'5',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$row.'.price',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$row.'.cantidad',array('label' => false	,
																'class'=>'form-control input-sm cantidad',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$row.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$row.'.subtotal',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$row.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $row ?>)">
								<span class="glyphicon  glyphicon-remove-circle"></span>
							</button>						
						</td>			
