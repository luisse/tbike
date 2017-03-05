<?php 
	$mensaje = $this->Session->flash();
	if(!empty($mensaje)):?>
		<div id='message' class="modal fade">
			<?php echo $mensaje ?>
		</div>	
<?php endif; ?>