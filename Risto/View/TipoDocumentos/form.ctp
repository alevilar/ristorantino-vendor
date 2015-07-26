<div class="tipoDePagos form">
    
<?php echo $this->Form->create('TipoDocumento', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
<?php
     if (empty($this->request->data['TipoDocumento']['id'])):?>
            <legend><?php echo 'Agregar Tipo de Documento'; ?></legend>
<?php else: ?>
            <legend><?php echo 'Editar Tipo de Documento'; ?></legend>
<?php endif; ?>
	<?php
        echo $this->Form->input('id');

		echo $this->Form->input('codigo_fiscal',array('label'=>__('Código Fiscal')));
        echo $this->Form->input('name',array('label'=>__('Nombre')));
         ?>
     <?php if (empty($this->request->data['TipoDocumento']['id'])):?>
        <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
        <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
    <?php endif; ?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>        </fieldset>

</div>
