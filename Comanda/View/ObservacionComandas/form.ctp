<div class="sabores form">
<?php echo $this->Form->create('ObservacionComanda');?>
<fieldset>
 		<legend><?php echo __('Editar Adicional');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>__('Nombre')));
	?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg')); ?>
     <?php echo $this->Form->end() ?>
 </fieldset>
</div>
