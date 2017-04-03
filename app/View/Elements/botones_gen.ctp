<?php
	echo $this->Html->script($js_funcionalidad); 
	echo $this->Html->script('jquery.maskedinput.js');
?>

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
	<a href="#" onclick="" id='nuevo' class="toolbar">
		<span class="icon-32-new" title="<?php echo __('Nuevo')?>"></span>
		<?php echo __('Nuevo')?>
	</a>
</td>
<td class="button" id="toolbar-cancel">
<?php echo $this->Html->link('<span class="icon-32-cancel" title="Cancelar"></span>Cancelar',array('controller'=>$controlador,
						'action'=>'index',''),array('escape' => false))?>
</td>
</tr>
</table>
</div>
<div class="header icon-48-addedit">
<?php echo $label_modelo ?>: <small><small><?php echo $label_detalle?></small></small>
</div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
</div>
<div class="clr"></div>