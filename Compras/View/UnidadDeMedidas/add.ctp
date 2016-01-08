<?php if ( empty($this->request->data['UnidadDeMedida']['id'])) { ?>
	<h1>Crear Unidad de Medida</h1>
<?php } else { ?>
	<h1>Editar Unidad de Medida</h1>
<?php } ?>
	
<?php echo $this->Form->create('UnidadDeMedida'); ?>

<?php echo $this->Form->input('id'); ?>
<?php echo $this->Form->input('name'); ?>

<?php echo $this->Form->end('Guardar'); ?>