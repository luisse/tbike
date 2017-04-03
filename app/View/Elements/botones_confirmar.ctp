<?php
	if(!empty($js_funcionalidad))
		echo $this->Html->script($js_funcionalidad,array('block' => 'scriptjs')); 
	$ls_parametro='';
	if(isset($parametro)) $ls_parametro='/'.$parametro
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
<td class="button" id="toolbar-save">
	<a href="#" onclick="" id='guardar' class="toolbar">
		<span class="icon-32-save" title="<?php echo __('Confirmar')?>"></span>
		<?php echo __('Confirmar')?>
	</a>
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
<center>
<div class="col width-70">
	<fieldset class="adminform">
	<legend><?php echo $label_caja ?></legend>
<?php 
	/*Control de errores si queremos mostrar mensajes de error*/
	if(isset($errorval))
		if($errorval!= null && strlen($errorval)){
			echo "<center><div ='flashMessage' class='message'>".$errorval."</div></center>";
		}
?>