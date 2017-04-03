<br>
<?php if(!empty($radiotaxicars)){
  ?>
  <table class="table table-striped table-bordered table-hover dataTable table-responsive table-condensed" id="listChoferes">
	<thead>
	<tr>
			<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending" ><div class="sort"><?= $this->Paginator->sort('Taxownerscar.carcode','Patente'); ?></div></th>
			<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending" ><div class="sort"><?= $this->Paginator->sort('Taxownerscar.registerpermision','Licencia'); ?></div></th>
			<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending" ><div class="sort"><?= $this->Paginator->sort('Taxownerscar.descriptioncar','Detalle'); ?></div></th>
			<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending" ><div class="sort"><?= $this->Paginator->sort('Radiotaxicar.created','Fec. Alta'); ?></div></th>
      <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending" ><div class="sort"><?= $this->Paginator->sort('Radiotaxicar.state','Estado');?></div></th>
			<th class="actions"><?= __(''); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($radiotaxicars as $radiotaxicar): ?>
	<tr>
		<td><?= $radiotaxicar['Taxownerscar']['carcode']; ?></td>
		<td><?= $radiotaxicar['Taxownerscar']['registerpermision']; ?></td>
		<td><?= $radiotaxicar['Taxownerscar']['descriptioncar']; ?></td>
		<td><?= $this->Time->format('d/m/Y h:m:s',$radiotaxicar['Radiotaxicar']['created']); ?></td>
    <td>
      <?php if($radiotaxicar['Radiotaxicar']['state'] == 1):?>
        <button type="button" id="statusBtn"
          class="btn btn-success btn-circle btn-sm"
          title="<?php echo __('Auto Activo')?>"
          onclick="changestate(<?= $radiotaxicar['Radiotaxicar']['id']?>)">
          <i class="fa fa-check"></i>
        </button>
      <?php endif;?>
      <?php if($radiotaxicar['Radiotaxicar']['state'] != 1):?>
        <button type="button" id="statusBtn"
          class="btn btn-danger btn-circle btn-sm"
          title="<?php echo __('Auto Inactivo')?>"
          onclick="changestate(<?= $radiotaxicar['Radiotaxicar']['id']?>)">
          <i class="fa fa-exclamation-triangle"></i>
        </button>
      <?php endif;?>

    </td>
		<td class="actions">
      <?php
        echo $this->Html->link ( '<button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="' . __ ( 'Eliminar registro' ) . '"><i class="fa fa-trash"></i></button>', array (
          'controller' => 'radiotaxicars',
          'action' => 'delete',
          $radiotaxicar ['Radiotaxicar'] ['id']
        ), array (
          'onclick' => "return confirm('" . __ ( '¿Desea Borrar el Registro Seleccionado?' ) . "')",
          'escape' => false,
          'class' => 'see-more small pull-right'
        ), '' );
        ?>
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
<?php }else{?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo "No se recuperaron autos asociados para los filtros seleccionados";?></div>
	</div>
<?php
} ?>
