<div class="tipoDePagos form">
    
<?php echo $this->Form->create('TipoFactura', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
 		<legend><?php echo __('Editar Tipo de Factura');?></legend>
	<?php
        echo $this->Form->input('id');

		echo $this->Form->input('name',array('label'=>__('Nombre')));
        echo $this->Form->input('codename',array('label'=>__('Nombre de Código')));
        echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg'));
        echo $this->Form->end();?>
        </fieldset>

</div>
