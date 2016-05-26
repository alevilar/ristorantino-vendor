<div class="mozos form">
<?php echo $this->Form->create('Mozo', array('type'=>'file', 'url'=>array('plugin'=>'mesa','controller'=>'mozos', 'action'=>'edit')));?>
	<?php
		if (!empty( $this->request->data['Mozo']['media_id'] )) {
        	echo $this->Html->imageMedia( $this->request->data['Mozo']['media_id'], array('class'=>'img-polaroid', 'width'=>'68px')); 
		}
		echo $this->Form->input('id');
		echo $this->Form->input('numero', array('label'=>'Alias'));
        echo $this->Form->input('nombre');
        echo $this->Form->input('apellido');
        echo $this->Form->input('media_file', array('type'=>'file', 'label'=>'Foto'));
        echo $this->Form->input('activo',array('default'=>true));
	    echo $this->Form->submit('Crear', array('class'=>'btn btn-primary btn-block'));
    ?>
	

<?php echo $this->Form->end();?>

</div>