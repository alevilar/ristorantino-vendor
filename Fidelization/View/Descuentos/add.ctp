<div class="descuentos form content-white">
<h2><?php echo __('Crear Descuento');?></h2>
<?php echo $this->Form->create('Descuento');?>
	<?php
		echo $this->Form->input('name',array('label'=>'Nombre', 'placeholder'=>'EJ: "10%"'));
		echo $this->Form->input('description',array('label'=>__('Descripción')));
		echo $this->Form->input('porcentaje',array('placeholder'=>'EJ: "10"', 'after'=>'<span class="text-info">sólo introducir el numero, no poner el signo de porcentaje</span>','label'=>__('Porcentaje')));
	?>
<?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left'));?>
 <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
 <?php echo $this->Form->end();?>
 <div class="clearfix"></div>
</div>
