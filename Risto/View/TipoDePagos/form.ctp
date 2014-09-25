<?php    


if ( !empty($this->request->data['TipoDePago']['media_id']) ) {
	echo $this->Html->imageMedia($this->request->data['TipoDePago']['media_id'], array('width'=>100));
}

    
?>


<div class="tipoDePagos form">
    
<?php echo $this->Form->create('TipoDePago', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
 		<legend><?php __('Edit TipoDePago');?></legend>
	<?php
        echo $this->Form->input('id');

		echo $this->Form->input('name');
        echo $this->Form->input('media_file',array('label'=>'Foto/Imagen ', 'type'=>'file'));
		echo $this->Form->input('description');
		
		echo $this->Form->end('Submit');
	?>
        </fieldset>

</div>

<div class="actions">
<?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $this->Form->value('TipoDePago.id')), null, sprintf(__('¿Está seguro que desea borrar el tipo de pago: %s?', true), $this->Form->value('TipoDePago.name'))); ?>
	
</div>
