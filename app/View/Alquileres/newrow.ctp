						<td>
							<button type="button" class="btn btn-success btn-xs" onclick="seleccionarbicicleta(<?= $row ?>)" id='buscarproductos' title='<?= __('Buscar Bicicleta')?>'>
								<span class="glyphicon  glyphicon-search"></span>
							</button>
						</td>
						<td><?= $this->Form->input('Alquileredetalle.'.$row.'.bicicletasparaalquilere_id',array('label' => false	,
																'class'=>'form-control input-sm id',
																'type'=>'text',
																'length'=>'5',
																'onchange'=>'recuperarDatosBicicleta('.$row.',"id")',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$row.'.horasalquila',array('label' => false,
																'class'=>'form-control input-sm tiempoalquila',
																'type'=>'text',
																'maxlength'=>'80',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						<td><?= $this->Form->input('Alquileredetalle.'.$row.'.detalle',array('label' => false	,
																'class'=>'form-control input-sm detail',
																'type'=>'text',
																'maxlength'=>'100',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$row.'.precio',array('label' => false	,
																'class'=>'form-control input-sm clprecio',
																'type'=>'text',
																'maxlength'=>'12',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$row.'.cantidad',array('label' => false	,
																'class'=>'form-control input-sm cantidad',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$row.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$row.'.subtotal',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$row.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?= $row ?>)">
								<span class="glyphicon  glyphicon-remove-circle"></span>
							</button>
						</td>
