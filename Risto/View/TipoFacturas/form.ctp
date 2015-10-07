<div class="tipoDePagos form">
    
<?php echo $this->Form->create('TipoFactura', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
	<?php
         if (empty($this->request->data['TipoFactura']['id'])):?>
    		<legend><?php echo 'Agregar Tipo de Factura'; ?></legend>
    <?php else: ?>
    		<legend><?php echo 'Editar Tipo de Factura'; ?></legend>
    <?php endif; ?>

	<?php
        echo $this->Form->input('id');

		echo $this->Form->input('name',array('label'=>__('Nombre')));
        echo $this->Form->input('codename',array('label'=>__('Nombre de Código')));
?>

     <?php if (empty($this->request->data['TipoFactura']['id'])):?>
        <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
        <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
    <?php endif; ?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>        </fieldset>

</div>
