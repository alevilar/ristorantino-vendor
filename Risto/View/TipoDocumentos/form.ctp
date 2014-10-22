<div class="tipoDePagos form">
    
<?php echo $this->Form->create('TipoDocumento', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
 		<legend><?php echo __('Editar Tipo de Documentos');?></legend>
	<?php
        echo $this->Form->input('id');

		echo $this->Form->input('codigo_fiscal',array('label'=>__('Código Fiscal')));
        echo $this->Form->input('name',array('label'=>__('Nombre')));
        echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg'));
        echo $this->Form->end();?>
        </fieldset>

</div>
