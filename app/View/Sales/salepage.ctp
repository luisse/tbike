<?php echo $this->Html->script(array('/js/sales/salepage','jquery.toastmessage','facebox'),
								array('block' => 'scriptUser')); ?>
 <style>
#toolbar {
padding: 4px;
display: inline-block;
}
/* support: IE7 */
*+html #toolbar {
display: inline;
}
</style>
<table cellspacing="1" width='100%'  class="adminlist" id = "salesdetails">
<tfoot>
<tr>
	<td><H3><?php echo __('Importe a Pagar');?></H3></td>
	<td>
		<?php echo $this->Form->input('Sale.totalsalev',array('label'=>false,'class'=>'inputboxl subtotal','size'=>'10','type'=>'text','value'=>$totalSale))?>
	</td>
	</tr>
	<tr>
	<td><H3><?php echo __('Importe Abonado');?></H3></td>
	<td>
		<?php echo $this->Form->input('abonado',array('label'=>false,'class'=>'inputboxl subtotal','size'=>'10','type'=>'text'))?>
	</td>
	</tr>
	<tr>
	<td><H3><?php echo __('Vuelto');?></H3></td>
	<td>
		<?php echo $this->Form->input('vuelto',array('label'=>false,'class'=>'inputboxl subtotal','size'=>'10','type'=>'text'))?>
	</td>
	</tr>
	
	<tr id='deudawtf'>
	<td colspan='4'>
		<div id="radio">
			<input type="radio" id="radio1" name="radio" checked="checked"/><label for="radio1">Guardar Deuda</label>
			<input type="radio" id="radio2" name="radio" /><label for="radio2">Pasar Deuda</label>
		</div>
	</td>
	</tr>
	<tr>
		<td colspan='4'>	
			<button id='aceptar'>Aceptar</button>					
			<button id='cancelar'>Cancelar</button>
		</td>
	</tr>
	<tfoot>
	</table>
