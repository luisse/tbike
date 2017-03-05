		<?php
                echo $this->Form->Create('Product',array('action'=>'index'));
        ?>
        <table class="admintable" cellspacing="1" width='300' border='0'>
        <tr>
                <td class="key">
			<label for="name"><?php echo __('Tipo',true)?></label>
		</td>
                <td><?php echo $this->Form->input('typeproduct_id',array('label'=>array('text'=>false),
						'class'=>'inputboxl','size'=>'1')); 
						?>
		</TD>
        </tr>
	<tr>
		<td class ="key">
        	<label for="name"><?php echo __('Marca',true)?></label>         
		</td>
        <td><?php echo $this->Form->input('subtypeproduct_id',
        			array('label'=>false,'class'=>'inputboxl','size'=>'1'))?>
		</td>

	</tr>
	<tr>
		<td class ="key">
        	<label for="name"><?php echo __('Rubro',true)?></label>         
		</td>
        <td><?php echo $this->Form->input('rubro_id',
        			array('label'=>false,'class'=>'inputboxl','size'=>'1'))?>
		</td>

	</tr>
	<tr>
		<td class="key">
			<label for="name"><?php echo __('Producto Nombre') ?></label>
		</td>
		<td>
			<?php echo $this->Form->input('descripction',array('label'=>array('text'=>false),
                                                'class'=>'inputboxl','size'=>'25')); 
                                                ?>
		</td>
	</tr>
	<tr>
		<td class="key">
			<label for="name"><?php echo __('Precio')?></label>
		</td>
		<td>
			<table>
				<tr>
					<td>
					<?php
						$str_estados = array('1'=>'Menor a','2'=>'Mayor a');
						echo '<td>'.$this->Form->input('preciotipo',array('options'=>$str_estados,'default'=>'2',
									'label'=>array('text'=>false))).'</td>';
					?>
					</td>
					<td>
						<?php echo $this->Form->input('precio',array('label'=>array('text'=>false),
		                                                'class'=>'inputboxl','size'=>'10','maxlength'=>'10')); 
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
        <tr>
                <td colspan=2 align="center">
                        <div class="toolbar" id="toolbar">
                                <table class="toolbar">
                                        <tr>
                                                <td class="button" id="toolbar-apply">
                                                        <a href='#' id ='filtrar'><span class="icon-32-apply" title="Buscar"></span>Buscar</a>
                                                </td>
                                        </tr>
                                </table>
                        </div>
                </td>
        </tr>

	</table>
