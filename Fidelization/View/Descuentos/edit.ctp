<div class="descuentos form">
<?php echo $this->Form->create('Descuento');?>
	<fieldset>
 		<legend><?php __('Editar Descuento');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Nombre'));
		echo $this->Form->input('description',array('label'=>'Descripción'));
		echo $this->Form->input('porcentaje',array('after'=>'Sólo introducir el número, sin el signo de porcentaje.'));
			?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg')); ?>
 <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
 <?php echo $this->Form->end();?>
     </fieldset>

</div>
