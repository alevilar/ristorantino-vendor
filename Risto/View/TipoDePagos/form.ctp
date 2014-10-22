<?php    
if ( !empty($this->request->data['TipoDePago']['media_id']) ) {
	echo $this->Html->imageMedia($this->request->data['TipoDePago']['media_id'], array('width'=>100));
}
?>

<div class="tipoDePagos form">
    
<?php echo $this->Form->create('TipoDePago', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
 		<legend><?php echo __('Editar Tipo de Pago');?></legend>
	<?php
        echo $this->Form->input('id');

		echo $this->Form->input('name',array('label'=>__('Nombre')));
        echo $this->Form->input('media_file',array('label'=>'Foto/Imagen ', 'type'=>'file'));
		echo $this->Form->input('description',array('label'=>__('Descripción')));
        echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg'));
        echo $this->Form->end();?>
        </fieldset>

</div>
