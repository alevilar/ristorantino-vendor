<div class="clientes form content-white">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
	<?php
         if (empty($this->request->data['Cliente']['id'])):?>
    		<legend><?php echo 'Agregar '.Configure::read('Mesa.tituloCliente'); ?></legend>
    <?php else: ?>
    		<legend><?php echo 'Editar '.Configure::read('Mesa.tituloCliente'); ?></legend>
    <?php endif; ?>
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
		echo $this->Form->input('fecha', array('type'=>'date'));
		echo $this->Form->input('observacion');
	?>
	</fieldset>
<?php
  if (empty($this->request->data['Cliente']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
<?php endif;?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
<?php echo $this->Form->end();?>
</div>
