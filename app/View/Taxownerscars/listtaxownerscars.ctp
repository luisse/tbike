<div class="table-responsive">
      <table class="table table-bordered table-hover table-striped dataTable" id="listChoferes">
      <thead>
      <tr>
          <th><?php echo __('Foto'); ?></th>
          <th><div class='sort'><?php echo $this->Paginator->sort('carcode',__('Código de Auto')); ?></div></th>
          <th><div class='sort'><?php echo $this->Paginator->sort('registerpermision',__('Nro de Permiso')); ?></div></th>
          <th><div class='sort'><?php echo $this->Paginator->sort('decreenro',__('Decreto Nr')); ?></div></th>
          <th><div class='sort'><?php echo $this->Paginator->sort('dateactive',__('Fecha Inicio Actividad')); ?></div></th>
          <th><div class='sort'><?php echo $this->Paginator->sort('dateexpire',__('Fecha Expira')); ?></div></th>
          <th><div class='sort'><?php echo $this->Paginator->sort('state',__('Estado')); ?></div></th>
          <th></th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($taxownerscars as $taxownerscar): ?>
      <tr>
        <td>
          <?php if(!empty($taxownerscar['Taxownerscar']['picture'])):?>
              <img width='100px' height='100px' class="img-circle" src="<?php echo $taxownerscar['Taxownerscar']['picture'];?>"/>
          <?php endif;?>
          <?php if(empty($taxownerscar['Taxownerscar']['picture'])):?>
            <?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/user_not.jpeg',
                  array ( 'title' =>__(''),'class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
          <?php endif;?>
        </td>
        <td><?php echo h($taxownerscar['Taxownerscar']['carcode']); ?>&nbsp;</td>
        <td><?php echo h($taxownerscar['Taxownerscar']['registerpermision']); ?>&nbsp;</td>
        <td><?php echo h($taxownerscar['Taxownerscar']['decreenro']); ?>&nbsp;</td>
        <td align='right'><?php echo $this->Time->format('d/m/Y',$taxownerscar['Taxownerscar']['dateactive']); ?>&nbsp;</td>
        <td align='right'><?php echo $this->Time->format('d/m/Y',$taxownerscar['Taxownerscar']['dateexpire']); ?>&nbsp;</td>
        <td><?php if($taxownerscar['Taxownerscar']['state'] == 1):?>
          <button type="button" id="statusBtn" class="btn btn-success btn-circle btn-sm" title="Activo" >
                <i class="fa fa-check"></i>
          </button>
        <?php endif;?>
        <?php if($taxownerscar['Taxownerscar']['state'] == 0):?>
          <button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="Auto Inactivo" >
                <i class="fa fa-exclamation-triangle"></i>
          </button>
        <?php endif;?>
          &nbsp;&nbsp;</td>
        <td>
          <div class="row text-center">
            <div class="col-lg-5">
              <?php
                  echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'taxownerscars',
                      'action'=>'edit',$taxownerscar['Taxownerscar']['id']),
                      array('onclick'=>'','escape'=>false),'');
              ?>
            </div>
            <!-- <div class="col-lg-5">
              <?php
              echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'taxownerscars',
                  'action'=>'delete',$taxownerscar['Taxownerscar']['id']),
                  array('onclick'=>"return confirm('".__('¿Desea Borrar el Auto Seleccionado?')."')",'escape'=>false),'');?>
            </div>
          </div>-->

        </td>
      </tr>
    <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
        <td colspan="8" class='row1'>
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
