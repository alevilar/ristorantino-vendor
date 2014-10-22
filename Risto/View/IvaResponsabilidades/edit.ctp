<div class="ivaResponsabilidades form">
<?php echo $this->Form->create('IvaResponsabilidad'); ?>
	<fieldset>
		<legend><?php echo __('Editar Iva Responsabilidad'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo_fiscal',__('Codigo Fiscal'));
		echo $this->Form->input('name',__('Nombre'));
		echo $this->Form->input('tipo_factura_id',__('Tipo de Factura'));
	?>
	</fieldset>
    <?php
        echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left'));
        echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));
        echo $this->Form->end();?>
</div>
