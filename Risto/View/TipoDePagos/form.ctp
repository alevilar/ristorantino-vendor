
<div class="tipoDePagos form content-white">
<?php    
if ( !empty($this->request->data['TipoDePago']['media_id']) ) {
	echo $this->Html->imageMedia($this->request->data['TipoDePago']['media_id'], array('width'=>100));
}
?>
    
<?php echo $this->Form->create('TipoDePago', array('type' => 'file'));?>
	<fieldset>
	<?php
         if (empty($this->request->data['TipoDePago']['id'])):?>
    		<legend><?php echo 'Agregar '.Configure::read('Mesa.tituloCliente'); ?></legend>
    <?php else: ?>
    		<legend><?php echo 'Editar '.Configure::read('Mesa.tituloCliente'); ?></legend>
    <?php endif; ?>
	<?php
        echo $this->Form->input('id');

		echo $this->Form->input('name',array('label'=>__('Nombre')));
        echo $this->Form->input('media_file',array('label'=>'Foto/Imagen ', 'type'=>'file'));
		echo $this->Form->input('description',array('label'=>__('Descripción')));?>

     <?php if (empty($this->request->data['TipoDePago']['id']) ){ ?>
        <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php } else { ?>
        <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
    <?php } ?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
        </fieldset>

</div>
