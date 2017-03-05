<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php echo "<?php echo \$this->Html->script(array('/js/categorias/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>\n";?>
<?php echo "<?php echo \$this->Html->css('message', null, array('inline' => false))?>\n";?>	
<?php echo "<?php echo \$this->element('flash_message')?>\n"; ?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo "<?php echo __('{$pluralHumanName}')?>"?>
    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
		<?php  foreach ($fields as $field):?>
			<th><?php echo "<?php echo \$this->Paginator->sort('{$field}');?>";?></th>
		<?php endforeach;?>
			<th><?php echo "<?php __('Acciones');?>";?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	echo "<?php
	\$i = 0;
	foreach (\${$pluralVar} as \${$singularVar}):
		\$class = \"row0\";
		if (\$i++ % 2 == 0) {
			\$class = ' class=\"row1\"';
		}
	?>\n";
	echo "\t<tr<?php echo \$class;?>>\n";
		foreach ($fields as $field) {
			$isKey = false;
			if ($isKey !== true) {
				echo "\t\t<td><?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>&nbsp;</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
?>
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
					<?php echo "\t\t<?php 
							echo $this->Html->link('<i class=\"fa fa-edit fa-fw\"></i>&nbsp;'.__('Modificar'),array('controller'=>'{$pluralVar}',
								'action'=>'edit',\${$singularVar}['{$singularVar}']['{$primaryKey}']),
								array('onclick'=>'','escape'=>false),
								'');?>"?>
								
				
						</li>
						<li>
								<?php echo "\t\t<?php echo $this->Html->link('<i class=\"fa fa-trash-o fa-fw\"></i>&nbsp;'.__('Borrar'),array('controller'=>'{$pluralVar}',
											'action'=>'delete',\${$singularVar}['{$singularVar}']['{$primaryKey}']),
											array('onclick'=>\"return confirm('¿Desea Borrar el Registro Seleccionado?')\",'escape'=>false),'');?>"?>
						</li>
					  </ul>
			</div>
		
		</td>
	</tr>
<?php 
	echo "<?php endforeach; ?>\n";
?>
</tbody>
	<tfoot>
		<tr>
		<td colspan="7" class='row1'>
			<center>
			<div class="pagination">
					<?php 
					echo "<?php echo \$paginador = $this->paginator->numbers();";
					echo "<?php echo \if(!empty($paginador)): ?>";
					?>
						<center>
							<ul class="pagination">
							  <li><?php echo "<?php echo \$this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?>\n" ?></li>
							  <li><?php echo "<?php echo \$this->paginator->numbers(array('separator'=>''));?>\n"?></li>
							  <li><?php echo "<?php echo \$this->paginator->next('>>', null, null, array('class'=>'paginator'));?>\n"?></li>
							</ul>	
						</center>	
					<?php echo "endif;?>"?>
			</div>
			</center>
		</td>
		</tr>
	</tfoot>
</table>
</center>
</div>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<?php echo "<?php
			echo \$this->Html->link('<button type=\"button\" class=\"btn btn-success btn-lw\" title=\"Agregar Categoria\">
																	<span class=\"glyphicon  glyphicon-plus\"></span>Agregar</button>',array('controller'=>'categorias',
										'action'=>'add',''),
										array('escape'=>false),
					'');		
	?>"?>
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo "<?php echo __('Cancelar')?>\n"?>
		</button>	
		</center>
	</div>
</div>		
</div>
<div id='message' style='hidden'>
	<?php echo "<?php $this->Session->flash() ?>\n"?>
</div>