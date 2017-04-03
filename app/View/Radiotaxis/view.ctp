<div class="radiotaxis view">
<h2><?php echo __('Radiotaxi'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cuit'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['cuit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domicilio'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['domicilio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($radiotaxi['Radiotaxi']['telefono']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Radiotaxi'), array('action' => 'edit', $radiotaxi['Radiotaxi']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Radiotaxi'), array('action' => 'delete', $radiotaxi['Radiotaxi']['id']), array(), __('Are you sure you want to delete # %s?', $radiotaxi['Radiotaxi']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Radiotaxis'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Radiotaxi'), array('action' => 'add')); ?> </li>
	</ul>
</div>
