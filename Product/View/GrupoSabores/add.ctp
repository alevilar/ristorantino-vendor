<div class="grupoSabores form content-white">
<?php echo $this->Form->create('GrupoSabor');?>
	<fieldset>
		<legend><?php echo __('Grupo de Adicionales'); ?></legend>
	<?php
		echo $this->Form->input('seleccion_de_sabor_obligatorio');
		echo $this->Form->input('tipo_de_seleccion');
		echo $this->Form->input('name');
		echo $this->Form->input('Producto');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Grupo de Adicionales'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Productos'), array('controller' => 'productos', 'action' => 'index')); ?> </li>
	</ul>
</div>
