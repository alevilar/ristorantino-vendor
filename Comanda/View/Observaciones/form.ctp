<div class="sabores form">
<?php echo $this->Form->create('Observacion');?>
<fieldset>
<?php
     if (empty($this->request->data['Observacion']['id'])):?>
		<legend><?php echo __d('users', 'Agregar Observacion'); ?></legend>
<?php else: ?>
		<legend><?php echo __d('users', 'Editar Adicional'); ?></legend>
<?php endif; ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>__('Nombre')));
	?>
<?php
  if (empty($this->request->data['Observacion']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
<?php endif; ?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
     <?php echo $this->Form->end() ?>
 </fieldset>
</div>
