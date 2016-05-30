<div class="content-white">

<?php 
if ( empty($this->request->data['Mercaderia'])) {
?>
	<h1 class="alert alert-info center">No hay Mercaderias para Asignar Rubro</h1>
<?php
} else {

	echo $this->Paginator->counter(
	    '<h3 class="alert alert-info center">Quedan <b>{:count}</b></h3>'
	);
	?>

	<h1>Editando a <?php echo $this->request->data['Mercaderia']['name']?></h1>


	<div class="clearfix"></div>
	<?php echo $this->Form->create('Mercaderia'); ?>

	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Form->input('name'); ?>
	<?php echo $this->Form->input('unidad_de_medida_id'); ?>
	<?php echo $this->Form->input('rubro_id');?>
	<?php echo $this->Form->input('default_proveedor_id', array('empty'=>'Seleccione')); ?>

	<?php echo $this->Form->end('Guardar'); ?>

	<?php echo $this->element('Users.pagination') ?>

<?php } ?>

</div>