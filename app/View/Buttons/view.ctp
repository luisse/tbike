<div class="buttonusers view">
<h2><?php  __('Buttonuser');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $buttonuser['Buttonuser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($buttonuser['User']['id'], array('controller' => 'users', 'action' => 'view', $buttonuser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Buttondescr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $buttonuser['Buttonuser']['buttondescr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modelname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $buttonuser['Buttonuser']['modelname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actionname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $buttonuser['Buttonuser']['actionname']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Buttonuser', true), array('action' => 'edit', $buttonuser['Buttonuser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Buttonuser', true), array('action' => 'delete', $buttonuser['Buttonuser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $buttonuser['Buttonuser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Buttonusers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Buttonuser', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
