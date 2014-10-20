        

<div class="mozos form">
<?php echo $this->Form->create('Mozo', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php echo __('Editar %s', Configure::read('Mesa.tituloMozo'));?></legend>
	<?php
		if (!empty( $this->request->data['Mozo']['media_id'] )) {
        	echo $this->Html->imageMedia( $this->request->data['Mozo']['media_id'], array('img-polaroid', 'style'=>'width: 68px')); 
		}
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
        echo $this->Form->input('nombre');
        echo $this->Form->input('apellido');
        echo $this->Form->input('media_file', array('type'=>'file', 'label'=>'Foto'));
        echo $this->Form->input('activo',array('default'=>true));
	?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg'));?>
	</fieldset>

</div>
