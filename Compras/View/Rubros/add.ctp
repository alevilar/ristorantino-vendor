<div class="rubros form">
<?php echo $this->Form->create('Rubro'); ?>
	<?php
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('Proveedor');
	?>
<?php echo $this->Form->end(array('class' => 'btn btn-primary', 'label' => 'Guardar')); ?>
</div>
