		<?php echo $this->Html->script(array('/js/buttonusers/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css('message', null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Buttonuser',array('action'=>'add',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend><?php echo __('Activar Botones') ?></legend>
			<div class="row">
	<div class="panel-body">
		<div class="table-responsive">
			<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
			<thead>
				<tr>
							<th><?php echo __('Imagen del Botón');?></th>
							<th><?php __('Activar');?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=0;
			foreach ($buttonusers as $buttonuser):
				?>
			<tr>
				<td>
					<div class="btn-group">
						<a class='btn btn-app'>
							<?php echo $buttonuser['Button']['descripc']; ?>&nbsp;
						</a>
					</div>
					<?php echo $this->Form->hidden('Buttonuser.'.$i.'.button_id',array('value'=>trim($buttonuser['Button']['id'])))?>
					<?php echo $this->Form->hidden('Buttonuser.'.$i.'.user_id',array('value'=>$this->Session->read('user_id')))?>
					
				</td>
				<td class="actions">
					<?php echo $this->Form->input('Buttonuser.'.$i.'.active',array('value'=>false,'type'=>'checkbox','label'=>false));?>
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