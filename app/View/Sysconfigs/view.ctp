<div class="sysconfigs view">
<h2><?php echo __('Sysconfig'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stockrestrict'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['stockrestrict']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tokenmp'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['tokenmp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usermp'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['usermp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailtransport'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['mailtransport']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailfrom'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['mailfrom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailhost'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['mailhost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailport'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['mailport']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailuser'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['mailuser']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailpassword'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['mailpassword']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Canbuy'); ?></dt>
		<dd>
			<?php echo h($sysconfig['Sysconfig']['canbuy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tallercito'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sysconfig['Tallercito']['id'], array('controller' => 'tallercitos', 'action' => 'view', $sysconfig['Tallercito']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sysconfig'), array('action' => 'edit', $sysconfig['Sysconfig']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sysconfig'), array('action' => 'delete', $sysconfig['Sysconfig']['id']), null, __('Are you sure you want to delete # %s?', $sysconfig['Sysconfig']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sysconfigs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sysconfig'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tallercitos'), array('controller' => 'tallercitos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tallercito'), array('controller' => 'tallercitos', 'action' => 'add')); ?> </li>
	</ul>
</div>
