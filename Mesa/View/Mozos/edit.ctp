<div class="mozos form">
<?php echo $this->Form->create('Mozo', array('type'=>'file', 'url'=>array('plugin'=>'mesa', 'controller'=>'mozos', 'action'=>'edit')));?>
	<fieldset>
<?php
     if (empty($this->request->data['Mozo']['id'])):?>
            <legend><?php echo 'Agregar '.Configure::read('Mesa.tituloMozo'); ?></legend>
<?php else: ?>
            <legend><?php echo 'Editar a '.$this->request->data['Mozo']['numero']; ?></legend>
<?php endif; ?>
	<?php
		if (!empty( $this->request->data['Mozo']['media_id'] )) {
        	echo $this->Html->imageMedia( $this->request->data['Mozo']['media_id'], array('img-polaroid', 'style'=>'width: 68px')); 
		}
		echo $this->Form->input('id');
		echo $this->Form->input('numero', array('label'=>'Alias'));
        echo $this->Form->input('nombre');
        echo $this->Form->input('apellido');
        echo $this->Form->input('media_file', array('type'=>'file', 'label'=>'Foto'));
        echo $this->Form->input('activo',array('default'=>true));?>
     <?php if (empty($this->request->data['Mozo']['id'])):?>
        <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
        <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
    <?php endif; ?>
        <?php echo $this->Html->link(__('Cancelar'), $referer, array('class'=>'btn btn-default btn-lg pull-right'));?>
</fieldset>
</div>
