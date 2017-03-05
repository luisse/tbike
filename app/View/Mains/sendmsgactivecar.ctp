
<?php echo $this->Html->script(array('/js/mains/sendmsgactivecar.js'),array('block'=>'scriptjs'));?>
<?php echo $this->element('flash_message')?>
<div class="panel panel-default">
  <div class="panel-heading">
  <i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Envio de Mensajes Masivos')?>
  </div>
<br>
<div class="table-responsive">
<div class="panel-body">
<!-- FILTROS -->
<div class="tab-content">
  <?php echo $this->Form->create('Main',array('action'=>'sendmsgactivecar',
      'inputDefaults' => array(
                'div' => 'form-group',
                'wrapInput' => false,
                'class' => 'form-control'
                ),
      'class' => 'well',
      'novalidate' => true
        ));?>

<div id="tabs-1">
  <div class="row">
  <div class="col-lg-8">
  <?php echo $this->Form->input('mensaje',array('label' => __('Mensaje a Enviar'),
            'placeholder' => false,
            'class'=>'form-control input-sm',
            'type'=>'text',
            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
  </div>
  <div class='col-lg-2'>
    <br/>
    <button type="button" class="btn btn-info btn-lw" id="enviar">
  									<span class="glyphicon glyphicon-search"></span><?= __('Enviar')?></button>
  </div>
  </div>
  <div class="row">
    <?php if(!empty($error)): ?>
      <div class="alert alert-danger" role="alert" id='alert'>
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span id="msg"><?= $error ?></span><span class="sr-only"></span>

      </div>
    <?php endif; ?>
    <?php if(!empty($total_msg_send)): ?>
      <span>Total de Mensajes Enviados: </span><?= $total_msg_send ?>
    <?php endif; ?>
  </div>
</div>

 <?php echo $this->Form->end()?>
	</div>
   </div>
   <div class="row">
   </div>
</div>
</div>
</div>
</div>
