<div class="rubros form">
<?php echo $this->Form->create('Rubro'); ?>
	<fieldset>
		<legend><?php echo __('Add Rubro'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('Proveedor');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rubros'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('controller' => 'proveedores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proveedor'), array('controller' => 'proveedores', 'action' => 'add')); ?> </li>
	</ul>
</div>
