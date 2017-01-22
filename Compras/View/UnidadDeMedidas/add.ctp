
	
<?php echo $this->Form->create('UnidadDeMedida'); ?>

<?php echo $this->Form->input('id'); ?>
<?php echo $this->Form->input('name', array('label' => 'Nombre')); ?>

<?php echo $this->Form->end(array('class' => 'btn btn-info', 'label' => 'Guardar')); ?>