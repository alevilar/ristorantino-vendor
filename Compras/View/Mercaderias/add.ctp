<h1>Mercaderia</h1>

<?php echo $this->Form->create('Mercaderia'); ?>

<?php echo $this->Form->input('id'); ?>
<?php echo $this->Form->input('name'); ?>
<?php echo $this->Form->input('unidad_de_medida_id'); ?>
<?php echo $this->Form->input('rubro_id');?>
<?php echo $this->Form->input('default_proveedor_id', array('empty'=>'Seleccione')); ?>

<?php echo $this->Form->end('Guardar'); ?>