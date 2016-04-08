<div class="rubros index">
	<h2><?php echo __('Rubros'); ?></h2>
<?php echo $this->Html->link(__('Nuevo Rubro'), array('action' => 'add'), array('class'=>'btn btn-lg btn-primary pull-right')); ?></li>
	<table class="table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($rubros as $rubro): ?>
	<tr>
		<td><?php echo h($rubro['Rubro']['id']); ?>&nbsp;</td>
		<td><?php echo h($rubro['Rubro']['name']); ?>&nbsp;</td>
		<td><?php echo h($rubro['Rubro']['created']); ?>&nbsp;</td>
		<td><?php echo h($rubro['Rubro']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rubro['Rubro']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rubro['Rubro']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rubro['Rubro']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $rubro['Rubro']['id']))); ?>
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
