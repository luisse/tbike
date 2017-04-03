<div id='stylemensaje'>
<table>
<tr>
	<td>
	<?php	
		echo $this->Html->link($this->Html->image('advertencia.png',array('title'=>__('Mensaje',true))),array('controller'=>'users',
				'action'=>'login',null),
				array('onclick'=>'','escape'=>false),
				'');
	?>
	</td>
	<td>
		<h1>
			<?php
				echo $mensaje;
			?>
		</h1>
	</td>
	</table>
</div>