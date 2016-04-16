<div class="printers form">
<?php echo $this->Form->create('Printer'); ?>
	<fieldset>
		<legend><?php echo __('Editar Impresora'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>__('Nombre')));
		echo $this->Form->input('alias',array('label'=>__('Alias')));
		echo $this->Form->input('driver',array('label'=>__('Driver')));
		echo $this->Form->input('driver_model', array('label'=>__('Modelo de Driver'), 'empty'=>'Ninguno'));
		echo $this->Form->input('output',array('label'=>__('Output'), 'empty'=>'Ninguno'));
	?>
	</fieldset>
<?php   echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left'));
        echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));
        echo $this->Form->end();?>
