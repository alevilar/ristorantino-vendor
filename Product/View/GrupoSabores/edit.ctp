<div class="grupoSabores form">
<?php echo $this->Form->create('GrupoSabor');?>
	<fieldset>
		<legend><?php echo __('Editar Grupo de Adicionales'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('seleccion_de_sabor_obligatorio', array('label'=>'Seleccion Obligatoria'));
		echo $this->Form->input('tipo_de_seleccion');
		echo $this->Form->input('name');
		echo $this->Form->input('Producto');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GrupoSabor.id')), null, __('Seguro desea eliminar Adicional id# %s?', $this->Form->value('GrupoSabor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Grupo de Adicionales'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Productos'), array('controller' => 'productos', 'action' => 'index')); ?> </li>
	</ul>
</div>
