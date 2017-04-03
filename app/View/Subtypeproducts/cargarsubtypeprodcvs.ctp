<?php	echo $this->Html->script('fmensajes.js');
		echo $this->Html->script('AjaxUpload2.0.js');
		echo $this->element('botones_alta_mod',
		array('js_funcionalidad' => 'subtypeproduct/cargarsubtypeprodcvs.js',
			'label_modelo' =>'Subtipo de Productos',
			'label_detalle'=>'Carga Masiva de Subtypos',
			'label_caja'=>'',
			'controlador'=>'subtypeproducts'))?>
<?php echo $this->Form->create('Subtypeproduct',array('action'=>'cargarsubtypeprodcvs','type'=>'file'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
	<tr>
		<td class="key"><label for="name"><?php echo __('Archivo',true)?></label></td>
        <td><?php echo $this->Form->Input('File',array('type'=>'file','label'=>''));?></td>
	</tr>
	<tr>
        <td colspan="2">
	        <?php
        		echo $this->Form->Submit('Subir CVS', array('class'=>'delete'));
			?>
        </td>
	</tr>
</table>
<?php echo $this->Form->end()?>
<label for="name"><?php echo $error;?></label>
<?php echo $this->element('fin_botones_alta_mod');?>
	