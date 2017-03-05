<div class="table-responsive">
<center>
	<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable table-responsive" >
	<thead>
		<tr>
				<th></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('documento',__('Documento'));?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('apellido',__('Apellido'));?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('nombre',__('Nombre'));?></div></th>
				<th><div class='sort'><?php echo __('Deuda');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($clientes as $cliente):
		?>
		<tr>
			<td width='30px'><i class="glyphicon glyphicon-user"></i></td>
			<td><?php 
					echo $this->Html->link( $cliente['Cliente']['documento'],'#',
							array('onclick'=>'return verCliente('.$cliente['Cliente']['id'].')'));
					echo $this->Form->hidden('Cliente.id'.$i,array('value'=>$cliente['Cliente']['id']));
					echo $this->Form->hidden('Cliente.Documento'.$i,array('value'=>$cliente['Cliente']['documento']));
					echo $this->Form->hidden('Cliente.NomApe'.$i,array('value'=>$cliente['Cliente']['apellido'].', '.$cliente['Cliente']['nombre']));
					echo $this->Form->hidden('Cuenta.id'.$i,array('value'=>$cliente['Cuenta']['id']));
			?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['apellido']; ?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['nombre']; ?>&nbsp;</td>			
			<td align='right'>
				<?php if(!empty($cliente['Cliente']['saldo'])):?>
					<h4><span class="label label-danger"><?php echo $this->Number->precision($cliente['Cliente']['saldo'],2); ?>&nbsp;<i class="fa fa-thumbs-o-down fa-fw"></i></span></h4>&nbsp;
				<?php endif;?>
				<?php if(empty($cliente['Cliente']['saldo'])):?>
					<h4><span class="label label-success">&nbsp;<i class="fa fa-thumbs-o-up fa-fw"></i></span></h4>&nbsp;
				<?php endif;?>
			</td>
			
		</tr>
	<?php $i++;
			endforeach; ?>
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