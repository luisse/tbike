<?php echo $this->Html->script('fmensajes.js'); ?>
<?php echo $this->Html->script('fgenerales.js'); ?>
<?php echo $this->Html->script('subtypeproduct/procesarcvs.js'); ?>
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
	<a href="#" onclick="" id='guardar' class="toolbar">
		<span class="icon-32-save" title="<?php echo __('Guardar Subtipos Cargados')?>"></span>
		<?php echo __('Guardar')?>
	</a>
</td>

<td class="button" id="toolbar-cancel">
<?php echo $this->Html->link('<span class="icon-32-cancel" title="Cancelar"></span>Cancelar',array('controller'=>'subtypeproducts',
						'action'=>'index',''),array('escape' => false))?></td>
</tr>
</table>
</div>
<div class="header icon-48-addedit">
<?php echo __('Subtipo de Producto') ?>: <small><small><?php echo __('Carga Masiva de Subtipos')?></small></small></div>

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

<?php if(empty($error)){?>
	<center>
	<?php echo $this->Form->create('Subtypeproduct',array('action'=>'procesarcvs'));?>
	<table cellspacing="1" width='80%'  class="adminlist">
	<thead>
		<tr>
				<th><?php echo __('Descripción');?></th>
				<th><?php echo __('Estado');?></th>
				<th><?php echo __('Existe');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($data as $datas):
			/*para guardar luego los datos desde el form*/
			echo $this->Form->input('Subtypeproduct.'.$i.'.descripction',array('label'=>false,'type'=>'hidden','value'=>$datas['descripction']));
			echo $this->Form->input('Subtypeproduct.'.$i.'.est',array('label'=>false,'type'=>'hidden','value'=>$datas['est']));
			echo $this->Form->input('Subtypeproduct.'.$i.'.existe',array('label'=>false,'type'=>'hidden','value'=>$datas['existe']));
			
			$class = "row0";
			if ($i++ % 2 == 0) {
				$class = ' class="row1"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $datas['descripction']; ?>&nbsp;</td>
			<td>
					<?php if($datas['est'] == 1)
							echo __('Habilitado');
					 else 
					 		echo __('Bloqueado'); 
					 ?>
					 &nbsp;
			</td>
			<td>
				<?php if($datas['existe'] ==1) echo 'Si';
					else echo 'No'?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<?php echo $this->Form->end();?>
	</center>
<?php }else{ ?>
<div id='error_login' style='display:none;'> 
		<?php  echo $this->Session->flash();} ?>
</div>	
	