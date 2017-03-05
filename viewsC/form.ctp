<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php
echo "<?php\t\t<?php echo $this->Html->script(array('/js/{$pluralVar}/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>\n";
echo "<?php\t\t<?php echo $this->Html->css('message', null, array('inline' => false))?>\n";			
echo "<?php\t\t<?php echo $this->element('flash_message')?>\n";
echo "<?php\t\t<?php echo $this->Form->create('{$modelClass}',array('action'=>'{$action}',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>\n";
?>
<fieldset>
	<legend><?php echo "<?php\t\t<?php echo __('Nueva {$modelClass}') ?>"?></legend>
		
<?php
		foreach ($fields as $field) {

			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
?>
			<div class="row">
				<div class="col-lg-10">
				<?php echo "<?php echo \$this->Form->input('{$field}',,array('label' => __('{$modelClass}'),
													'placeholder'=>'Ingrese {$modelClass}',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>\n"?>
				</div>
			</div>
		<?php }?>
<?php }?>
<?php
		
		
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				?>
			<div class="row">
				<div class="col-lg-10">
				<?php echo "<?php echo \$this->Form->input('{$field}',,array('label' => __('{$assocName}'),
													'placeholder'=>'Ingrese {$modelClass}',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>\n"?>
				</div>
			</div>
				<?php 
			}
		}

?>
</fieldset>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo "<?php echo __('Guardar') ?>\n"?>
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo "<?php echo __(' Cancelar')?>\n"?>
		</button>	
		</center>
	</div>
</div>
<?php
	echo "<?php echo \$this->Form->end();?>\n";
?>