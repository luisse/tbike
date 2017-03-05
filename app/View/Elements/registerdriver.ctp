<?php
$taxownerdrivers = !empty($taxownerdrivers) ? $taxownerdrivers : array('taxownerdriver'=>array(''=>''));
$i = 1;
foreach ($taxownerdrivers as $taxownerdriver):
?>
<div id="driver_row<?= $i ?>"  class="row row-eq-height">
  <div class="col-lg-10">
    <div class="row">
      <div class="col-lg-3">
        <?php echo $this->Form->input('Taxownerdriver.'.$i.'.document',array('label' => __('*Nro de Documento'),
                            'placeholder' => __('Número de Documento'),
                            'size'=>'3',
                            'type'=>'number',
                            'title'=>__('Debe Ingresar el Documento'),
                            'class'=>'form-control input-sm numeric',
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
      </div>
      <div class="col-lg-3">
        <label><?php echo __('*Fecha de Nacimiento') ?></label>
        <div class="form-group">
                <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
            <?php echo $this->Form->input('Taxownerdriver.'.$i.'.birthdate',array('label'=>false,
                              'placeholder' => __('Fecha de Nacimiento'),
                              'size'=>'7',
                              'type'=>'text',
                              'title'=>__('Debe Ingresar Fecha de Nacimiento'),
                              'class'=>'form-control input-sm',
                              'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
          </div>
        </div>
      </div>
        <div class="col-lg-3">
          <?php echo $this->Form->input('Taxownerdriver.'.$i.'.secondname',array('label'=>__('*Apellidos'),
                              'placeholder' => __('Ingrese Apellidos'),
                              'size'=>'7',
                              'title'=>__('Debe Ingresar el Apellido'),
                              'class'=>'form-control input-sm',
                              'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
        <div class="col-lg-3">
        <?php echo $this->Form->input('Taxownerdriver.'.$i.'.firstname',array('label'=>__('*Nombres'),
                            'placeholder' => __('Ingrese Nombres'),
                            'size'=>'7',
                            'title'=>__('Debe Ingresar Nombre'),
                            'class'=>'form-control input-sm',
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
      </div>
    </div>
    <div class="row">

      <div class="col-lg-2">
      <?php
      $options = array('0' => __('Femenino'), '1' => 'Masculino');
      echo $this->Form->input('Taxownerdriver.'.$i.'.gender',array('label'=>__('*Sexo'),
                            'options'=>$options,
                            'value'=>1,
                            'class'=>'form-control input-sm',
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
      </div>
      <div class="col-lg-2">
      <?php echo $this->Form->input('Taxownerdriver.'.$i.'.phonenumber',array('label'=>__('* Telefono'),
                            'placeholder' => __('Ingrese Telefono'),
                            'size'=>'2',
                            'type'=>'number',
                            'maxlength'=>11,
                            'class'=>'form-control input-sm numeric',
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
      </div>
      <div class="col-lg-3">
        <?php echo $this->Form->input('Taxownerdriver.'.$i.'.licencenumber',array('label'=>__('* Nro de Licencia'),
                            'placeholder' => __('Nro de Licencia'),
                            'size'=>'10',
                            'type'=>'number',
                            'title'=>__('Nro de Licencia'),
                            'class'=>'form-control input-sm numeric',
                            'maxlength'=>9,
                            'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
      </div>
      <div class="col-lg-3">
        <label><?php echo __('*Fecha de Vencimiento') ?></label>
        <div class="form-group">
                <div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
            <?php echo $this->Form->input('Taxownerdriver.'.$i.'.fecvenclicence',array('label'=>false,
                              'placeholder' => __('Fecha de Vencimiento'),
                              'size'=>'7',
                              'type'=>'text',
                              'title'=>__('Debe Ingresar Fecha de Vencimiento de Licencia'),
                              'class'=>'form-control input-sm',
                              'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
          </div>
        </div>
    </div>
    </div>
    <hr class="mhr">
  </div>
  <div class="col-lg-2 center-block">
        <button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-lg" title="<?= __ ( 'Puedes Eliminar este registro si haces click' ) ?>" onclick="delete_drow(<?= $i ?>)">
        <i class="fa fa-times"></i></button>
  </div>
</div>
<?php
$i++;
endforeach;
?>
