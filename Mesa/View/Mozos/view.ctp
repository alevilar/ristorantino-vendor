<div class="mozos form">
<?php echo $this->Form->create('Mozo', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php echo __('Ver %s', Configure::read('Mesa.tituloMozo'));?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
        echo $this->Form->input('nombre');
        echo $this->Form->input('apellido');
        echo $this->Form->input('activo',array('default'=>true));
		if (!empty( $this->request->data['Mozo']['media_id'] )) {
        	echo $this->Html->imageMedia( $this->request->data['Mozo']['media_id'], array('img-polaroid', 'style'=>'width: 68px'));
		}
	?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg'));?>
	</fieldset>

</div>


