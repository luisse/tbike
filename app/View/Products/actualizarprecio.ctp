<div class="panel panel-ingresos">
	<div class="panel-heading">
		<i class="fa fa-wrench fa-fw"></i>&nbsp;<?= __('Producto Gestion de Precios') ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

	<div class="table-responsive">
	<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer table-responsive" aria-describedby="dataTables-example_info">
	<thead>
		<tr>
				<th><div class='sort'><?= __('Producto Nombre');?></div></th>
				<th><div class='sort'><?= __('Resultado');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($productsdetails['Productsdetail'] as $productsdetail):
		?>
		<tr>
			<td>
				<?= $productsdetail['descripcion']?>
			</td>
			<td><?php
					if(($productsdetail['error']==''))
						echo 'Actualizado';
					else
						echo $productsdetail['error'];
				?></td>
		</tr>
		<?php
		endforeach;
		?>
	</tbody>
	</table>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12" id='regactualizar'>
			<center>
			<?php
				echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" title="Cancelar">
																		<span class="glyphicon  glyphicon-arrow-left"></span>&nbsp;Volver Atras</button>',array('controller'=>'products',
											'action'=>'actualizapreciomasivo',''),
											array('escape'=>false),
						'');
			?>
			</center>
		</div>
	</div>

	</div>
</div>
