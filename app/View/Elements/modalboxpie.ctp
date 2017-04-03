<?php 
//EJEMPLO DE PARAMETROS PARA MODAL BOX
//$buttons['Button']['title']=' Aceptar';
//$buttons['Button']['nameid']='aceptar';
//$buttons['Button']['class'] = 'btn-success';
//$buttons['Button']['icons'] = 'glyphicon-ok';
?>


	</div>
	<div class="modal-footer">
		<?php if(!empty($buttons)):?>
		<?php foreach($buttons as $button):?>
			<button type="button" class="btn <?php echo $button['class']?> btn-lw" id='<?php echo $button['nameid']?>'>
				<span class="glyphicon <?php echo $button['icons']?>"></span><?php echo $button['title']?>
			</button>			
		<?php endforeach?>
		<?php endif;?>
		<button type="button" class="btn btn-info btn-lw" data-dismiss="modal">
			<span class="glyphicon glyphicon glyphicon-off"></span><?php echo ' Cerrar'?>
		</button>
	</div>	
</div>
