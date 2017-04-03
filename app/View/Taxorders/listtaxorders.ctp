
<table class="table table-bordered table-hover table-striped" id="listChoferes">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Taxorder.date',__('Fecha Pedido')); ?></th>
			<th><?php echo __('Destino Viaje'); ?></th>
			<th><?php echo $this->Paginator->sort('Taxownerscar.carcode',__('Patente')); ?></th>
			<th><?php echo $this->Paginator->sort('Taxownerdriver.licencenumber',__('Licencia Número')); ?></th>
			<th><?php echo __('Conductor'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($taxorders as $taxorder): ?>
		<tr>
			<td><?php echo $this->Time->format('d/m/Y H:m',$taxorder['Taxorder']['date'])?></td>
			<td><?php echo $taxorder['Taxorder']['travelto']?></td>
			<td><?php echo $taxorder['Taxownerscar']['carcode']?></td>
			<td><?php echo $taxorder['Taxownerdriver']['licencenumber']?></td>
			<td>
			<?php if(!empty($taxorder['Taxownerdriver']['picture'])):?>
				<img width='80px' height='80px' class="img-circle" src="<?php echo $taxorder['Taxownerdriver']['picture'];?>"/>
			<?php endif;?>
			<?php if(empty($taxorder['Taxownerdriver']['picture'])):?>
				<?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/user_not.jpeg',
						array ( 'title' =>'','class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
				<?php endif;?>
			</td>
		</tr>
	<?php endforeach;?>
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
