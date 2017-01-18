<div class="configs index">
	<h2><?php echo __('Configs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('config_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('key'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($configs as $config): ?>
	<tr>
		<td><?php echo h($config['Config']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($config['ConfigCategory']['name'], array('controller' => 'config_categories', 'action' => 'view', $config['ConfigCategory']['id'])); ?>
		</td>
		<td><?php echo h($config['Config']['key']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['value']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['description']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['created']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['modified']); ?>&nbsp;</td>
		<td><?php echo h($config['Config']['created_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $config['Config']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $config['Config']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $config['Config']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $config['Config']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Config'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Config Categories'), array('controller' => 'config_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Config Category'), array('controller' => 'config_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
