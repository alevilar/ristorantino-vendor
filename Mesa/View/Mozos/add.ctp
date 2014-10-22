<div class="mozos form">
<?php echo $this->Form->create('Mozo', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php echo __('Agregar %s', Configure::read('Mesa.tituloMozo'));?></legend>
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
	    echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'));?>
	</fieldset>

</div>
<!--<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $this->Form->value('Mozo.id')), null, __('Are you sure you want to delete %s #id: %s?', Configure::read('Mesa.tituloMozo'), $this->Form->value('Mozo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar %s', Configure::read('Mesa.tituloMozo')), array('action'=>'index'));?></li>
	</ul>
</div>-->