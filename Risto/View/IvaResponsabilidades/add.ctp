<div class="ivaResponsabilidades form">
<?php echo $this->Form->create('IvaResponsabilidad'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Iva Responsabilidad'); ?></legend>
	<?php
		echo $this->Form->input(__('Codigo Fiscal'),'codigo_fiscal');
		echo $this->Form->input(__('Nombre'),'name');
		echo $this->Form->input('tipo_factura_id',__('Tipo de Factura'));?>
	</fieldset>
    <?php
        echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg'));
        echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));
        echo $this->Form->end();?>
</div>
