<div class="descuentos form">
<?php echo $this->Form->create('Descuento');?>
	<fieldset>
 		<legend><?php echo __('Crear Descuento');?></legend>
	<?php
		echo $this->Form->input('name',array('label'=>__('Nombre')));
		echo $this->Form->input('description',array('label'=>__('Descripción')));
		echo $this->Form->input('porcentaje',array('after'=>'Ej:15 (solo introducir el numero, no poner el signo de porcentaje)','label'=>__('Porcentaje')));
	?>
<?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left'));?>
 <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?><?php echo $this->Form->end();?>
</fieldset>
</div>
