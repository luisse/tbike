<div class="table-responsive">
      <table class="table table-bordered table-hover table-striped dataTable" id="listChoferes">
      <thead>
      <tr>
          <th><?= __('Foto'); ?></th>
          <th><div class='sort'><?= $this->Paginator->sort('User.username',__('Usuario Web')); ?></div></th>
          <th><div class='sort'><?= $this->Paginator->sort('people_id',__('Conductor')); ?></div></th>
          <th><div class='sort'><?= $this->Paginator->sort('licencenumber',__('Número de Licencia')); ?></div></th>
          <th><div class='sort'><?= $this->Paginator->sort('state',__('Estado')); ?></div></th>
          <th><div class='sort'><?= $this->Paginator->sort('created',__('Fecha de Alta')); ?></div></th>
          <th></th>
      </tr>
      </thead>
      <tbody>

      <?php
      //print_r($taxownerdrivers);
      foreach ($taxownerdrivers as $taxownerdriver): ?>
      <tr>
        <td>
          <?php if(!empty($taxownerdriver['Taxownerdriver']['picture'])):?>
              <img width='80px' height='80px' class="img-circle" src="<?php echo $taxownerdriver['Taxownerdriver']['picture'];?>?cache=none"/>
          <?php endif;?>
          <?php if(empty($taxownerdriver['Taxownerdriver']['picture'])):?>
            <?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/user_not.jpeg',
              array ( 'title' =>__('Imagen de '.$this->Session->read('nomape')),'class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
          <?php endif;?>
        </td>
        <td>
          <?= $taxownerdriver['User']['username'] ?>
        </td>
        <td>
          <?php echo $this->Html->link($taxownerdriver['People']['document'].' - '.$taxownerdriver['People']['firstname'].', '.$taxownerdriver['People']['secondname'],'#',array('onclick'=>'return viewPeople('.$taxownerdriver['People']['id'].')'))?>
        </td>
        <td align='right'><?php echo h($taxownerdriver['Taxownerdriver']['licencenumber']); ?>&nbsp;</td>
          <td  align='center'><?php if($taxownerdriver['Taxownerdriver']['state'] == 1):?>
            <button type="button" id="statusBtn" class="btn btn-success btn-circle btn-sm" title="Activo" >
                  <i class="fa fa-check"></i>
            </button>
          <?php endif;?>
          <?php if($taxownerdriver['Taxownerdriver']['state'] <> 1):?>
            <button type="button" id="statusBtn" class="btn btn-warning btn-circle btn-sm" title="Inactivo" >
                  <i class="fa fa-check"></i>
            </button>
          <?php endif;?>
        </td>
        <td  align='right'><?php echo $this->Time->format('d/m/Y',$taxownerdriver['Taxownerdriver']['created']); ?>&nbsp;</td>
        <td class="actions">
          <div class="row text-center">
            <div class="col-lg-7">
              <?php
                  echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'taxownerdrivers',
                      'action'=>'edit',$taxownerdriver['Taxownerdriver']['id']),
                      array('onclick'=>'','escape'=>false),'');

              ?>
            </div>
              <?php
              /*echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'taxownerdrivers',
                  'action'=>'delete',$taxownerdriver['Taxownerdriver']['id']),
                  array('onclick'=>"return confirm('".__('¿Desea Borrar el Conductor Seleccionado?')."')",'escape'=>false),'');*/
              ?>

          </div>
        </td>
      </tr>
    <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
        <td colspan="7" class='row1'>
            <center>
                <?php
                  $paginador = $this->paginator->numbers(array(
                        'before' => '',
                        'separator' => '',
                        'currentClass' => 'active',
                        'tag' => 'li',
                       'currentTag' => 'a',
                        'after' => ''));
                ?>
                <div class="pagination">
                  <?php if(!empty($paginador)): ?>
                  <nav>
                    <ul class="pagination">
                        <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
                      <li><?php echo $paginador;?></li>
                      <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
                    </ul>
                  </nav>
                <?php endif;?>
                </div>
            </center>
        </td>
        </tr>
      </tfoot>
      </table>
    </div>
