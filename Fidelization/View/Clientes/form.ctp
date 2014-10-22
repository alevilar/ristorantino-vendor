<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><?php echo Configure::read('Mesa.tituloCliente'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('tipo_documento_id', array('default'=> TIPO_DOCUMENTO_SIN_IDENTIFICAR, 'empty' => 'Seleccione' ));
		echo $this->Form->input('nrodocumento', array('label'=>__('Número de documento')));
		echo $this->Form->input('iva_responsabilidad_id', array('default'=> IVA_RESPONSABILIDAD_CONSUMIDOR_FINAL, 'empty' => 'Seleccione' ));
		echo $this->Form->input('descuento_id', array('empty'=>'Sin Descuento'));
		echo $this->Form->input('codigo');
		echo $this->Form->input('mail', array('type'=>'email','label'=>'Correo Electrónico'));
		echo $this->Form->input('telefono');
		echo $this->Form->input('domicilio');
	?>
	</fieldset>
   <?php
        echo $this->Form->submit('Buscar', array('class'=>'btn btn-success btn-lg'));
        echo $this->Form->end();?>
</div>
