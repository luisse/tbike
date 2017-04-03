											<td>
												<div class="col-lg-11">
												<?php echo $this->Form->hidden('Categoria.'.$row.'.padre_id',array('value'=>$padre_id));?>
												<?php echo $this->Form->input('Categoria.'.$row.'.descripcion',array(
													'class'=>'form-control input-sm',
													'label'=>false,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
												</div>
											</td>
												
											<td>
												<div class="col-lg-5">
													<?php echo $this->Form->input('Categoria.'.$row.'.imagen',array(
													'class'=>'form-control input-sm clcantidad',
													'label'=>false,
													'type'=>'file',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
												</div>
											</td>
											<td class="actions">
													<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $row ?>)">
																	<span class="glyphicon  glyphicon-remove-circle"></span>
													</button>
											</td>