<?php
$taxownerscars = !empty($taxownerscars) ? $taxownerscars : array('Taxownerscar'=>array(''=>''));
$i = 1;
foreach ($taxownerscars as $taxownerscar):
?>
<div id="row<?= $i ?>"  class="row">
  <div class="col-lg-10">
    <div class="row">
        <?php echo $this->Form->hidden('Taxownerscar.'.$i.'.carmodel',array('value'=> !empty($taxownerscar['carmodel_id']) ? $taxownerscar['carmodel_id'] :'')); ?>
        <div class="col-lg-3">
              <?php echo $this->Form->input('Taxownerscar.'.$i.'.carcode',array('label'=>__('*Patente'),
                              'placeholder' => __('Patente'),
                              'class'=>'form-control input-sm',
                              'title'=>__('Debe Ingresar el Usuario'),
                              'autocomplete'=>'off',
                              'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
        <div class="col-lg-3">
        <?php
        echo $this->Form->input('Taxownerscar.'.$i.'.registerpermisionorigin',array('label'=>__('*Origen de Licencia'),
                              'options'=>$registerpermisionorigin,
                              'class'=>'form-control input-sm',
                              'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
        <div class="col-lg-3">
              <?php echo $this->Form->input('Taxownerscar.'.$i.'.registerpermision',array('label'=>__('*Nro de Licencia'),
                              'placeholder' => __('Nro de Licencia'),
                              'class'=>'form-control input-sm numeric',
                              'title'=>__('Debe Ingresar el Nro de Licencia'),
                              'autocomplete'=>'off',
                              'maxlength'=>10,
                              'onchange'=>'existelicence('.$i.')',
                              'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
      </div>
      <div class='row'>
        <div class="col-lg-3">
              <?php echo $this->Form->input('Taxownerscar.'.$i.'.carbrand_id',array('label'=>__('Marca'),
                                'class'=>'form-control input-lg',
                                'onchange'=>"cargardropdown('Taxownerscar".$i."CarbrandId','/carmodels/getmodels/','Taxownerscar".$i."CarmodelId');",
                                'value'=> !empty($this->request->data['carmodel_id']) ? $this->request->data['carmodel_id'] : '',
                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
        <div class="col-lg-3">
              <?php echo $this->Form->input('Taxownerscar.'.$i.'.carmodel_id',array('label'=>__('Modelo'),
                                'class'=>'form-control input-lg',
                                /*'value'=> !empty($taxownerscar['carmodel_id']) ? $taxownerscar['carmodel_id'] : '',*/
                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
        <div class="col-lg-3">
              <?php echo $this->Form->input('Taxownerscar.'.$i.'.type',array('label'=>__('Tipo'),
                                'class'=>'form-control input-lg',
                                'options'=>['Sedan'=>'Sedan','Coupe'=>'Coupe','Van'=>'Van'],
                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
              <?php echo $this->Form->input('Taxownerscar.'.$i.'.aa',array('label'=>__('Aire Acondicionado'),
                                'class'=>'form-control input-lg',
                                'options'=>['Si'=>'Si','No'=>'No'],
                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
        <div class="col-lg-3">
              <?php echo $this->Form->input('Taxownerscar.'.$i.'.transporta',array('label'=>__('Lleva objetos'),
                                'class'=>'form-control input-lg',
                                'options'=>['Si'=>'Si','No'=>'No'],
                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
        </div>
      </div>
    <hr class="mhr">
  </div> <!-- col -->
  <div class="col-lg-2 center-block">
      <button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-lg" title="<?= __ ( 'Eliminar registro' ) ?>" onclick="delete_row(<?= $i ?>)">
      <i class="fa fa-times"></i></button>
  </div>
</div>
<?php
$i++;
endforeach;
?>
