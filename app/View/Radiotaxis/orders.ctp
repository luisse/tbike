<style>
#map-canvas {
  height: 350px;
  width: 100%;
  margin: 10px;
  z-index:100;
}

div.horizontal {
    width: 100%;
    height: 450px;
    overflow: auto;
}

</style>
<?php echo $this->Html->script(array('https://www.gstatic.com/firebasejs/3.4.0/firebase.js',
				'https://maps.googleapis.com/maps/api/js?v=3.exp&key='.$key_api_maps.'&libraries=places',
				'radiotaxis/orders.js','jquery.toastmessage','class_cronogo.js','dateformat',
				'bootstrap-typeahead.js','fmensajes.js','fgenerales.js','jquery.numeric'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>

<?php
	$str_state[0]=__('En Espera');
	$str_state[1]=__('Aceptada');
	$str_state[2]=__('Cancelada');
	$str_state[3]=__('Todos');
?>


<script>
	var glb_k = "<?= $this->Session->read('key')?>";
  var glb_fbk = "<?= $this->Session->read('fbkey')?>";
</script>

<div class="row">
  <div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-plus fa-fw"></i> <?= __('Nuevo Pedido') ?>
            <div class="pull-right">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                        <?= __('Acciones') ?>
                        <span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu pull-right">
                        <li><a href="#" onclick="return clearform()"><i class="fa fa-refresh fa-fw"></i><?= __('Limpiar Formulario') ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <?php echo $this->Form->create('Takeorder',array('action'=>'#','id'=>'taxorder',
              'inputDefaults' => array(
                        'div' => 'form-group',
                        'wrapInput' => false,
                        'class' => 'form-control'
                        ),
              'class' => 'well'
                ));?>

            <div class='row'>
              <label><?php echo __('Viaje Desde')?></label>
              <div class="input-group">
              <?php echo $this->Form->input('Taxorder.directiodetails',array('label'=>false,
                                  'class'=>'form-control input-lg',
                                  'tabindex'=>'19',
                                  'type'=>'text',
                                  'title'=>__('Debe Ingresar una dirección válida'),
                                  'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
                <span class="input-group-addon" id="basic-addon1">
                  <?= $this->Html->link('<i class="fa fa-map-marker  fa-fw"></i>','#',
                        array('onclick'=>"view_address_on_map()",'escape'=>false,'title'=>__('Ubicar en Mapa')),'');
                ?>
                </span>
              </div>

            </div>
            <div class='row'>
              <label><?php echo __('Nro:')?></label>
              <div class="input-group">
              <?php echo $this->Form->input('Taxorder.number_from',array('label'=>false,
                                  'class'=>'form-control input-lg',
                                  'tabindex'=>'19',
                                  'type'=>'text',
                                  'title'=>__('Debe Ingresar Altura'),
                                  'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
                <span class="input-group-addon" id="basic-addon1">
                  <?= $this->Html->link('<i class="fa fa-map-marker  fa-fw"></i>','#',
                        array('onclick'=>"view_address_on_map()",'escape'=>false,'title'=>__('Ubicar en Mapa')),'');
                ?>
                </span>
            </div>
            </div>
            <div class='row'>
                <label><?= __('Viaje Hasta')?></label>
                <div class = 'input-group'>
              <?php echo $this->Form->input('Taxorder.travelto',array('label'=>false,
                                'class'=>'form-control input-lg',
                                'tabindex'=>'19',
                                'type'=>'text',
                                'autocomplete'=>'off',
                                'title'=>__('Debe Ingresar un Destino'),
                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
                <span class="input-group-addon" id="basic-addon1">
                  <?php
                echo $this->Html->link('<i class="fa fa-map-marker  fa-fw"></i>','#',
                  array('onclick'=>"view_address_on_map()",'escape'=>false,'title'=>__('Ubicar en Mapa')),'');
                ?>
                </span>
            </div>
          </div>
          <div class='row'>
            <label><?php echo __('Nro:')?></label>
            <div class="input-group">
            <?php echo $this->Form->input('Taxorder.number_to',array('label'=>false,
                                'class'=>'form-control input-lg',
                                'tabindex'=>'19',
                                'type'=>'text',
                                'title'=>__('Debe Ingresar Altura Destino'),
                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
              <span class="input-group-addon" id="basic-addon1">
                <?= $this->Html->link('<i class="fa fa-map-marker  fa-fw"></i>','#',
                      array('onclick'=>"view_address_on_map()",'escape'=>false,'title'=>__('Ubicar en Mapa')),'');
              ?>
              </span>
          </div>
          </div>
          <div class='row'>
              <label><?= __('Detalle del Pedido')?></label>
              <div class = 'input-group'>
            <?php echo $this->Form->input('Taxorder.order_details',array('label'=>false,
                              'class'=>'form-control input-lg',
                              'tabindex'=>'20',
                              'type'=>'text',
                              'autocomplete'=>'off',
                              'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
              <span class="input-group-addon" id="basic-addon1">
                <?php
              echo $this->Html->link('<i class="fa fa-info-circle fa-fw"></i>','#',
                array('onclick'=>"#",'escape'=>false,'title'=>__('Agregar a Favoritos')),'');
              ?>
              </span>
          </div>
        </div>
        <div class='row'>
          <br>
        </div>
        <div class='row'>
              <button type="button" class="btn btn-success btn-block btn-lg" id='createorder'>
                  <span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo __('Enviar Pedido')?>
                </button>
        </div>

        <!-- /.panel-body -->
    </div>
  </div>
</div>
  <div class="col-lg-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-list fa-fw"></i> <?= __('Pedidos Realizadas') ?>
            <div class="pull-right">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                        <?= __('Acciones') ?>
                        <span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu pull-right">
                        <li><a href="#" onclick="return getmyorders()"><i class="fa fa-refresh fa-fw"></i><?= __('Refrescar') ?></a>
                        </li>
                        <li><a href="#" onclick="view_filter()"><i class="fa fa-filter fa-fw"></i><?= __('Filtrar') ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
              <div id='filter'>
                <ul class="list-group">
                  <li class="list-group-item clearfix">
                      <div class="row">
                        <div class="col-lg-3">
                          <?php echo $this->Form->input('Taxorder.from', array(
            									'label' => __('Domicilio desde'),
            									'type'=>'text',
            									'class'=>'form-control input-sm',
            									'size'=>10
            								))?>
                          </div>
                          <div class="col-lg-3">
                            <?php echo $this->Form->input('Taxorder.to', array(
              									'label' => __('Domicilio Hasta'),
              									'type'=>'text',
              									'class'=>'form-control input-sm',
              									'size'=>10
              								))?>
                          </div>
                          <div class="col-lg-3">
              							<?php echo $this->Form->input('Taxorder.state', array(
              									'label' => __('Estado'),
              									'options'=>$str_state,
              									'value'=>'3',
              									'class'=>'form-control input-sm'
              								))?>
              						</div>
                          <div  class="col-lg-2">
              							<br>
              							<button type="button" class="btn btn-default btn-lw" id='search'>
              									<span class="glyphicon glyphicon-search"></span> <?php echo __('Buscar');?>
              							</button>
              						</div>
                      </div>
                  </li>
                </ul>
              </div>
          	<ul class="list-group"><div id='listpedidos' class='horizontal'></div></ul>
        </div>
        <!-- /.panel-body -->
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-map-marker fa-fw"></i><?= __('Visualizacion de Flota/Rutas') ?>
            <div class="pull-right">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                        <?= __('Acciones') ?>
                        <span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu pull-right">
                        <li><a href="#" onclick="setMapOnAll()"><i class="fa fa-refresh fa-fw"></i><?= __('Refrescar Mapa') ?></a>
                        </li>
                        <li><a href="#" onclick="get_car_active()"><i class="fa fa-map-marker fa-fw"></i><?= __('Mostrar Flota') ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id='map-canvas'></div>
        </div>
        <!-- /.panel-body -->
    </div>
  </div>
</div>
