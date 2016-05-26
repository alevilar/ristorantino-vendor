

<div class="sabores form content-white">
<?php
     if (empty($this->request->data['Sabor']['id'])):?>
		<h2><?php echo __d('users', 'Agregar Variante'); ?></h2>
<?php else: ?>
		<h2><?php echo __d('users', 'Editar Variante'); ?></h2>
<?php endif; ?>
<?php echo $this->Form->create('Sabor');?>
<fieldset>
	<?php
		echo $this->Form->input('id',__('Id'));
		echo $this->Form->input('name',__('Nombre'));
		echo $this->Form->input('categoria_id', array('after'=>'<span class="text-info">'.__('Todos los productos de esta Categoria tendrán incluida esta variante como opción seleccionable'.'</span>')));
		echo $this->Form->input('precio',__('Precio'));
	?>
<?php
  if (empty($this->request->data['Sabor']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
<?php endif; ?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
     <?php echo $this->Form->end() ?>
 </fieldset>
</div>
