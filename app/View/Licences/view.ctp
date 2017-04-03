<div class="licences view">
<h2><?php echo __('Licence'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($licence['Licence']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Licence'); ?></dt>
		<dd>
			<?php echo h($licence['Licence']['licence']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($licence['Licence']['fecha']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Owner'); ?></dt>
		<dd>
			<?php echo h($licence['Licence']['owner']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document'); ?></dt>
		<dd>
			<?php echo h($licence['Licence']['document']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dcto'); ?></dt>
		<dd>
			<?php echo h($licence['Licence']['dcto']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Licence'), array('action' => 'edit', $licence['Licence']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Licence'), array('action' => 'delete', $licence['Licence']['id']), array(), __('Are you sure you want to delete # %s?', $licence['Licence']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Licences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Licence'), array('action' => 'add')); ?> </li>
	</ul>
</div>
