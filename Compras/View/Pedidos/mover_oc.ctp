<h1 class="center">Mover Mercaderias entre Órdenes de Compra</h1>

<div class="row">
	<p class="alert alert-info center col-md-6 col-md-offset-3">Se moverán las mercaderias hacia otra Órden de Compra unificando 2 pedidos en 1 solo.</p>
</div>

<div class="row center">
	<h3>Detalles de la OC #<?php echo $this->request->data['Pedido']['id']?></h3>
<?php foreach($this->request->data['PedidoMercaderia'] as $pm) { ?>

	<?php
	$cantidad = $pm['cantidad'];
	$uMedida = ($cantidad > 1) ? Inflector::pluralize( $pm['UnidadDeMedida']['name']) : $pm['UnidadDeMedida']['name'];
	$merca = $pm['Mercaderia']['name'];
	?>
	<span><?php echo $cantidad?> <?php echo $uMedida?></span> <b><?php echo $merca?></b><br>
	
<?php } ?>

	<div class="col-md-6 col-md-offset-3">
		<h3>Ingresar ID Para mover</h3>
		<?php echo $this->Form->create("Pedido") ?>

		<label>#Id de la Órden de Compra a donde mover</label>
		<?php echo $this->Form->input("nuevo_id", array(
							'label' => false,
							'type' => 'number', 
							'class'=>'input-lg',
							)) ?>

		<?php echo $this->Form->submit("Mover", array("class"=>'btn btn-success btn-lg')); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>