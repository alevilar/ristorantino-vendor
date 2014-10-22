
<div class="sabores form">
<?php echo $this->Form->create('Sabor');?>
<fieldset>
<?php
     if (empty($this->request->data['Sabor']['id'])):?>
		<legend><?php echo __d('users', 'Agregar Adicional'); ?></legend>
<?php else: ?>
		<legend><?php echo __d('users', 'Editar Adicional'); ?></legend>
<?php endif; ?>
	<?php
		echo $this->Form->input('id',__('Id'));
		echo $this->Form->input('name',__('Nombre'));
		echo $this->Form->input('categoria_id',__('Categoria'));
		echo $this->Form->input('precio',__('Precio'));
	?>
<?php
  if (empty($this->request->data['Sabor']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg')); ?>
<?php endif; ?>
     <?php echo $this->Form->end() ?>
 </fieldset>
</div>
