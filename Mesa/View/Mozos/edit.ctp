        

<div class="mozos form">
<?php echo $this->Form->create('Mozo', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php echo __('Editar %s', Configure::read('Mesa.tituloMozo'));?></legend>
	<?php
        if (!empty($this->request->data['Mozo']['image_url']) ) {
            echo $this->Html->image(THUMB_FOLDER . DS .$this->request->data['Mozo']['image_url'], array('img-polaroid', 'style'=>'width: 68px')); 
        }
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
                echo $this->Form->input('nombre');
                echo $this->Form->input('apellido');
                echo $this->Form->input('image_url_upload', array('type'=>'file'));
                echo $this->Form->input('activo',array());
	?>
     <?php echo $this->Form->end('Submit');?>           
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $this->Form->value('Mozo.id')), null, __('Are you sure you want to delete %s #id: %s?', Configure::read('Mesa.tituloMozo'), $this->Form->value('Mozo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar %s', Configure::read('Mesa.tituloMozo')), array('action'=>'index'));?></li>
	</ul>
</div>