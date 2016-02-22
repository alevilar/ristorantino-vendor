<div class="rubros form">
<?php echo $this->Form->create('Rubro'); ?>
	<fieldset>
		<legend><?php echo __('Edit Rubro'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('Proveedor');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rubro.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Rubro.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('controller' => 'proveedores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proveedor'), array('controller' => 'proveedores', 'action' => 'add')); ?> </li>
	</ul>
</div>
