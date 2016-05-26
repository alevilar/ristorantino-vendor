
<div class="productos form content-white">

<?php 

if ( !empty($url) ) {
	echo $this->Form->create('Producto', array('url'=>$url));	
} else {
	echo $this->Form->create('Producto');
}

?>

<?php
if ( !$this->request->is('ajax') ) {
     if (empty($this->request->data['Producto']['id'])):?>
		<h1><?php echo __d('ristorantino', 'Agregar Producto'); ?></h1>
<?php else: ?>
		<h1><?php echo __d('ristorantino', 'Editar Producto %s', $this->request->data['Producto']['name']); ?></h1>
<?php endif; 
}
?>


	<?php echo $this->element('Product.product_form');?>
</div>
