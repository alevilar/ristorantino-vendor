
<div class="sabores form">
<?php echo $this->Form->create('Tag');?>
<fieldset>
<?php
     if (empty($this->request->data['Tag']['id'])):?>
		<legend><?php echo __d('users', 'Agregar Etiqueta'); ?></legend>
<?php else: ?>
		<legend><?php echo __d('users', 'Editar Etiqueta'); ?></legend>
<?php endif; ?>
	<?php
		echo $this->Form->input('id','Id');
		echo $this->Form->input('name',array('label'=>__('Nombre')));
		echo $this->Form->input('producto_id',array('label'=>__('Producto')));
	?>
<?php
  if (empty($this->request->data['Tag']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
<?php endif;?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
    <?php echo $this->Form->end();?>
</fieldset>
</div>
