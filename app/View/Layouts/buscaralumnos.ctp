<html lang="es"> 
<head>
    <title><?php echo $title_for_layout; ?></title>
        <?php
        	echo $html->charset('utf-8');
        	/*Archivos JS para generar el AJAX necesario*/
        	echo $this->Html->script('/js/users/buscarAlumnos.js');
        	
        	
        	?>
		<script languaje='script/javascript'>
			$(document).ready(function(){
			cargarEventoFilas();
					loadPiece("<?php echo $html->url(array('controller'=>'users','action'=>'listaralumnos')); ?>","#content");
						})
		</script>              	
</head>
<body id="minwidth-body">
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
						<a href="#" onclick="" id='buscar' class="toolbar">
							<?php
							$ls_link = $html->url(array('controller'=>'users','action'=>'listaralumnos'));							
							echo $this->Html->image('buscar.png',array('title'=>__('Buscar Alumnos',true),
							'onclick'=>'fbuscaralumnos("'.$ls_link.'")','id'=>'buscaralumnos'));?>
						</a>
					</td>
					</tr>
					</table>
				</div>
<div class="header icon-48-addedit">
	<table border='0'>
	<tr>
		<td>
			<span><?php echo __('Buscar')?>:</span>
		</td>
		<td>
							<?php
							echo $this->Form->input('nombreapellido',array('label'=>array('class'=>'labelform',
								'text'=>false),	'id'=>'nombreapellido'));
							 ?>
		</td>							 
	</tr>						 
	</table>						 
</div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
</div>
		<div class="clr">
	</div>
</div>
	<div id="content">
	</div>
</body>
</html>