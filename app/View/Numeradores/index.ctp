<!--     BLOQUE DE BOTONES -->
<div id="toolbar-box">
   			<div class="t">

				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				<div class="toolbar" id="toolbar">
<table class="toolbar"><tr>
<td class="button" id="toolbar-new">
	<?php echo $this->Html->link('<span class="icon-32-new" title="Nuevo Numerador"></span>Nuevo',array('controller'=>'numeradores',
						'action'=>'add',''),array('escape' => false)) ?>
</td>
<td class="button" id="toolbar-cancel">
<?php echo $this->Html->link('<span class="icon-32-cancel" title="Cancelar"></span>Cancelar',array('controller'=>'numeradores',
						'action'=>'index',''),array('escape' => false))?></td>
</tr>
</table>
</div>
<div class="header icon-48-addedit">
<?php echo __('Numeradores') ?>: <small><small><?php echo __('Administración de Numeradores')?></small></small></div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
</div>
<div class="clr"></div>

<!-- FIN BLOQUE BOTONES -->

<center>
<table cellspacing="1" width='80%'  class="adminlist">
<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('detalle',__('Detalle'));?></th>
			<th><?php echo __('Rango Desde');?></th>
			<th><?php echo __('Rango Hasta');?></th>
			<th><?php echo __('Acciones');?></th>
	</tr>
</thead>
<tbody>
	<?php
	$i = 0;
	foreach ($numeradores as $numeradore):
		$class = " class='row0'";
		if ($i++ % 2 == 0) {
			$class = ' class="row1"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $numeradore['Numeradore']['detalle']; ?>&nbsp;</td>
		<td><?php echo $numeradore['Numeradore']['rangodesde']; ?>&nbsp;</td>
		<td><?php echo $numeradore['Numeradore']['rangohasta']; ?>&nbsp;</td>
		<td class="actions">
		<center>
		<div>
		<?php 
						echo $this->Html->link($this->Html->image('edit.png',array('title'=>__('Editar',true))),array('controller'=>'numeradores',
							'action'=>'edit',$numeradore['Numeradore']['id']),
							array('onclick'=>'','escape'=>false),
							'');
					?>
					&nbsp;
					<?php
						echo $this->Html->link($this->Html->image('delete.gif',array('title'=>__('Borrar Cedente',true))),array('controller'=>'numeradores',
										'action'=>'delete',$numeradore['Numeradore']['id']),
										array('onclick'=>"return confirm('¿Desea borrar el Cedente seleccionado?')",'escape'=>false),
					'');?>		</div>
		</center>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
	<tfoot>
		<tr>
		<td colspan="7" class='row1'>
			<div class="pagination">
			<?php if($this->Paginator->numbers() > 0): ?>
			<?php echo $this->Paginator->prev('<< '.__('Antetior', true), null, null, array('class'=>'disabled'));?>
			<?php echo $this->Paginator->numbers();?>
			<?php echo $this->Paginator->next(__('Siguiente', true).' >>', null, null, array('class'=>'disabled'));?>
			<?php endif; ?>
			</div>
		</td>
		</tr>
	</tfoot>
</table>
</center>