		<?php echo $this->Html->script(array('/js/buttons/addbuttongrup.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css('message', null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Buttonuser',array('action'=>'addbuttongrup',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Asociar Botones') ?></legend>
			<div class="row">
	<div class="panel-body">
		<div class="table-responsive">
			<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
			<thead>
				<tr>
							<th><?php echo __('Grupo');?></th>
							<th><?php echo __('Modelo Botón');?></th>
							<th><?php echo __('Modelo');?></th>
							<th><?php echo __('Acción');?></th>
							<th><?php __('Activar');?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=0;
			foreach ($buttons as $buttonuser):
				?>
			<tr>
				<td><?php 
				
				echo $this->Form->input('Buttonuser.'.$i.'.group_id',array('label' => false	,
																	'class'=>'form-control input-sm detail documento',
																	'maxlength'=>'13',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));?>&nbsp;</td>
				<td><div class="btn-group"><a class='btn btn-app'>
					<?php echo $buttonuser['Buttonuser']['buttondescr']; ?>&nbsp;</a></div>
					<?php echo $this->Form->hidden('Buttonuser.'.$i.'.buttondescr',array('value'=>trim($buttonuser['Buttonuser']['buttondescr'])))?>
				</td>
				<td><?php echo $buttonuser['Buttonuser']['modelname']; ?>&nbsp;
					<?php echo $this->Form->hidden('Buttonuser.'.$i.'.modelname',array('value'=>trim($buttonuser['Buttonuser']['modelname'])))?>
				</td>
				<td><?php echo $buttonuser['Buttonuser']['actionname']; ?>&nbsp;
					<?php echo $this->Form->hidden('Buttonuser.'.$i.'.actionname',array('value'=>trim($buttonuser['Buttonuser']['actionname'])))?>
				</td>
				<td class="actions">
					<?php echo $this->Form->input('Buttonuser.'.$i.'.active',array('value'=>true,'type'=>'checkbox','value'=>false,'label'=>false));?>
				</td>
			</tr>
		<?php 
			$i++;
			endforeach; 
		?>
		</tbody>
		</table>
	</div>
</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>

<?php echo $this->Form->end()?>