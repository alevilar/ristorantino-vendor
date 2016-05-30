<div class="content-white">
<h1>Viendo el pedido #<?php echo $pedido['Pedido']['id']?></h1>

<?php echo $this->Html->link('Imprimir Pedido por comandera', array('action'=>'imprimir', $pedido['Pedido']['id']), array('class'=>'btn btn-lg btn-default pull-right')); ?>

<?php echo $this->Html->link('Agregar Mercaderias a Este Pedido', array('action'=>'add', $pedido['Pedido']['id']), array('class'=>'btn btn btn-primary')); ?>

<div>
	<table class="table">
		<thead>
			<tr>
				<th>Estado</th>
				<th>Cantidad</th>
				<th>Mercaderia</th>
				<th>Proveedor</th>
				<th>Acciones</th>
			</tr>	
		</thead>
		
	<?php foreach ($pedido['PedidoMercaderia'] as $merca ) { ?>
		<tr>
			<?php 

			$cant = (float)$merca['cantidad'];
			$uMedida = $merca['UnidadDeMedida']['name'];
			$mercaderia = $merca['Mercaderia']['name'];
			$estado = $merca['PedidoEstado']['name'];
			$proveedor = !empty($merca['Proveedor']['name'])? $merca['Proveedor']['name'] : '';

			$detalle =  Inflector::pluralize($uMedida)." de " .$mercaderia;

			?>

			<td><?php echo $estado;?></td>
			<td><?php echo $cant;?></td>
			<td><?php echo $detalle;?></td>
			<td><?php echo $proveedor;?></td>
			
			<td>
				<?php echo $this->Html->link("editar", array('controller'=>'PedidoMercaderias', 'action'=>'form', $merca['id'] ) );?>

					</td>
		</tr>
	<?php }?>
	</table>
</div>
</div>