		<div class="table-responsive">
		<center>
			<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
			<thead>
				<tr>
						<th><div class='sort'><?php echo $this->Paginator->sort('fechaenv',__('Fecha'));?></div></th>
						<th><div class='sort'><?php echo $this->Paginator->sort('correoe',__('E-Mail'));?></div></th>
						<th><div class='sort'><?php echo __('Asunto');?></div></th>
						<th><div class='sort'><?php echo __('Detalle');?></div></th>
						<th><div class='sort'><?php echo $this->Paginator->sort('resultado',__('Resultado'));?></div></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($senderlogs as $senderlog):
				?>
				<tr>
					<td><?php echo $this->Time->format('d/m/Y H:m:s',$senderlog['Senderlog']['fechaenv']); ?>&nbsp;</td>
					<td><?php echo $senderlog['Senderlog']['correoe']; ?>&nbsp;</td>
					<td><?php echo $senderlog['Mensaje']['asunto'];?></td>
					<td><?php echo $senderlog['Mensaje']['detalle']?></td>
					<td><?php if($senderlog['Senderlog']['resultado'] == 1):?>
								<h4><span class="label label-success"><?php	echo __('Enviado');?></span></h4>
						<?php endif;?>
						<?php if($senderlog['Senderlog']['resultado'] == 0):?>								
								  <h4><span class="label label-danger"><?php	echo __('Error');?></span></h4>
						<?php endif;?>								  
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
		</center>
		</div>