<div class="taxjourneys view">
<h2><?php echo __('Taxjourney'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($taxjourney['Taxjourney']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxturn'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxjourney['Taxturn']['id'], array('controller' => 'taxturns', 'action' => 'view', $taxjourney['Taxturn']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datejourney'); ?></dt>
		<dd>
			<?php echo h($taxjourney['Taxjourney']['datejourney']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Initjourney'); ?></dt>
		<dd>
			<?php echo h($taxjourney['Taxjourney']['initjourney']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endjourney'); ?></dt>
		<dd>
			<?php echo h($taxjourney['Taxjourney']['endjourney']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Taxjourney'), array('action' => 'edit', $taxjourney['Taxjourney']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Taxjourney'), array('action' => 'delete', $taxjourney['Taxjourney']['id']), array(), __('Are you sure you want to delete # %s?', $taxjourney['Taxjourney']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxjourneys'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxjourney'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxturns'), array('controller' => 'taxturns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxturn'), array('controller' => 'taxturns', 'action' => 'add')); ?> </li>
	</ul>
</div>
