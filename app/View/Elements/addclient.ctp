<div class = "row" id='btnuevo'>
  <div class='col-lg-2'>
  <button type="button" class="btn btn-primary btn-lw" title="Nuevo Cliente" id='agregarcliente'>
    <span class="glyphicon  glyphicon-plus"></span>&nbsp;<?= __('Nuevo Cliente') ?>
  </button>
  </div>
</div>
<div id='clientadd' style="display:none;">
  <div class="row">
    <div class="col-lg-2">
      <?php echo $this->Form->input('nrodocumento',array('label' => __('Documento'),
                          'placeholder' => __('Ingrese Documento'),
                          'class'=>'form-control input-sm',
                          'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    </div>
      <div class="col-lg-2">
        <?php echo $this->Form->input('nombre',array('label' => __('Nombre'),
                            'class'=>'form-control input-sm',
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
      </div>
      <div class="col-lg-2">
        <?php echo $this->Form->input('apellido',array('label' => __('Apellido'),
                            'class'=>'form-control input-sm',
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
      </div>
  </div>
  <div class='row'>
    <div class="col-lg-2">
      <?php echo $this->Form->input('telefono',array('label' => __('Telefono'),
                          'class'=>'form-control input-sm',
                          'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    </div>
    <div class="col-lg-3">
      <?php echo $this->Form->input('direccion',array('label' => __('Domicilio'),
                          'class'=>'form-control input-sm',
                          'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    </div>
  </div>
  <div class="row"  id='btsave' style="display:none;">
    <div class="col-lg-3">
        <?php echo $this->Form->input('email',array('label' => __('Email'),
                            'class'=>'form-control input-sm',
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    </div>
    <div class='col-lg-2'>
            <br>
      <button type="button" class="btn btn-success btn-lw" title="<?= __('Guardar Cliente')?>" id='guardarcliente'>
        <span class="glyphicon  glyphicon-floppy-save"></span>&nbsp;<?= __('Guardar Cliente') ?>
      </button>
    </div>
  </div>
</div>
