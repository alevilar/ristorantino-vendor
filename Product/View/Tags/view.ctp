<h1><?php echo $tag['Tag']['name']?></h1>

<div class="tag-product-list">
	<?php foreach ($tag['Producto'] as $producto) { ?>
		<li><?php echo $producto['name']?></li>
	<?php } ?>
</div>

<br><br>
<?php echo $this->Html->link('Volver al listado de tags', array('action' =>'index')); ?>

<style>
	.tag-product-list{
		-webkit-column-count: 4; /* Chrome, Safari, Opera */
	    -moz-column-count: 4; /* Firefox */
	    column-count: 4;
	    background-color: #FBFBFB;
	    padding: 2em;
	}
</style>