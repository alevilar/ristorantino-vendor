<div class="sabores form">
<?php echo $this->Form->create('ObservacionComanda');?>
<fieldset>
<?php
     if (empty($this->request->data['ObservacionComanda']['id'])):?>
		<legend><?php echo __d('users', 'Agregar Observaciones Comandas'); ?></legend>
<?php else: ?>
		<legend><?php echo __d('users', 'Editar Observaciones Comandas'); ?></legend>
<?php endif; ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>__('Nombre')));
	?>
<?php
  if (empty($this->request->data['ObservacionComanda']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg')); ?>
<?php endif; ?>
     <?php echo $this->Form->end() ?>
 </fieldset>
</div>
