<?php echo $this->Html->script(array('/js/bicicletas/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>


<!--     BLOQUE DE BOTONES -->

<!-- FIN BLOQUE BOTONES -->
<div class="panel  panel-listados">
	<div class="panel-heading">
		<i class="fa fa-user fa-fw"></i> <?php echo __('Bicicletas del Cliente')?>
    </div>
	<br>
<div class="panel-body">
	  	<div class="row">
	  		<div class="col-lg-2">
	  			<?php if(empty($cliente['Cliente']['foto'])): ?>
	  			<?php
	  				echo $this->Html->image('user_not.jpeg',
								array ( 'title' =>__('Imagen de '.$cliente['Cliente']['apellido'].', '.$cliente['Cliente']['nombre']),'class'=>'img-rounded','width'=>'80px','height'=>'80px'));
	  			?>
	  			<?php endif;?>
	  			<?php if(!empty($cliente['Cliente']['foto'])): ?>
							<a href="#" class="thumbnail">
								<?= $this->Html->image($cliente['Cliente']['foto'],
											array ( 'title' =>$cliente['Cliente']['apellido']));
								?></a>
	  			<?php endif;?>
	  		</div>
	  		<div class="col-lg-10">
	  			<div class="row">
	  				<h3><?php echo __('Nombre y Apellido')?></h3>
	  			</div>
	  			<div class="row">
	  				<h4><?php echo $cliente['Cliente']['apellido'].', '.$cliente['Cliente']['nombre']?></h4>
	  			</div>
	  			<?php //print_r($persona)?>
	  		</div>
	    </div>

	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('marca','Marca');?></th>
				<th><?php echo $this->Paginator->sort('modelo','Modelo');?></th>
				<th width='400px'><?php echo $this->Paginator->sort('detalles','Detalles');?></th>
				<th><?php echo $this->Paginator->sort('equipodetalle','Equipamiento');?></th>
				<th><?php echo $this->Paginator->sort('nrocuadro','Nro de Cuadro');?></th>
				<th><?php echo __('Foto')?></th>
				<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($bicicletas as $bicicleta):
		?>
		<tr>
			<td><?php echo $bicicleta['Bicicleta']['marca']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['modelo']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['detalles']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['equipodetalle']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['nrocuadro']; ?>&nbsp;</td>
			<td><a href="#" class="thumbnail">
					<img width='300px' heigth='280px' src="<?php echo $bicicleta['Bicicleta']['imagen']; ?> "/>
				</a>
			</td>
			<td width="100px">
				<div class="btn-group">
						  <?php if($this->Session->read('tipousr')!=2):?>
						  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
						  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
							<span class="fa fa-caret-down"></span></a>
							  <ul class="dropdown-menu">

								<li>
									<?php
										echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'bicicletas',
										'action'=>'edit',$bicicleta['Bicicleta']['id']),
										array('onclick'=>'','escape'=>false),
										'');?>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'bicicletas',
										'action'=>'delete',$bicicleta['Bicicleta']['id']),
										array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
								</li>
							  </ul>
							<?php endif;?>
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
	</center>
<?php if($this->Session->read('tipousr')!=2):	?>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Bicicleta">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'bicicletas',
										'action'=>'add',''),
										array('escape'=>false),
					'');
	?>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" title="Cancelar">
																	<span class="glyphicon  glyphicon-remove-sign"></span>&nbsp;Cancelar</button>',array('controller'=>'users',
										'action'=>'index',''),
										array('escape'=>false),
					'');
		?>
		</center>
	</div>
</div>
<?php endif; ?>
<br>
</div>
<?php echo $this->element('modalbox')?>
