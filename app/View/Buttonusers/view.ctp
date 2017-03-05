<div class="userbuttongets view">
<h2><?php  __('Userbuttonget');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userbuttonget['Userbuttonget']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($userbuttonget['User']['id'], array('controller' => 'users', 'action' => 'view', $userbuttonget['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Buttonuser'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($userbuttonget['Buttonuser']['id'], array('controller' => 'buttonusers', 'action' => 'view', $userbuttonget['Buttonuser']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userbuttonget['Userbuttonget']['active']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userbuttonget', true), array('action' => 'edit', $userbuttonget['Userbuttonget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Userbuttonget', true), array('action' => 'delete', $userbuttonget['Userbuttonget']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userbuttonget['Userbuttonget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userbuttongets', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userbuttonget', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buttonusers', true), array('controller' => 'buttonusers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buttonuser', true), array('controller' => 'buttonusers', 'action' => 'add')); ?> </li>
	</ul>
</div>
