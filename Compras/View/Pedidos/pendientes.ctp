
<h1>Pedidos Pendientes</h1>
<button value="imprimir" class="btn btn-info btn-lg center hidden-print" onclick="javascript:window.print()">Imprimir</button>

<?php

foreach ($pedidos as $prov) {

	?>
	<table class="table table-condensed">
	    <caption class="center"><h4><?php echo !empty($prov['Proveedor']['name']) ? $prov['Proveedor']['name']: 'Sin Proveedor Definido'?></h4>

	    	<?php echo !empty($prov['Proveedor']['telefono'])? "(Tel: ".$prov['Proveedor']['telefono'].")":"";?>
	    </caption>

		<thead>
			<tr>
				<th>#Pedido</th>
				<th>Fecha</th>
				<th>Usuario</th>
				<th>Estado</th>
				<th>Cantidad</th>
				<th>U/Medida</th>
				<th>Mercaderia</th>
				<th>Observación</th>
				<th class="hidden-print">Acciones</th>
			</tr>	
		</thead>
		
	<?php foreach ($prov['PedidoMercaderia'] as $merca ) { ?>
		<tr>
			<?php 
			$cant = (float)$merca['PedidoMercaderia']['cantidad'];
			$uMedida = $merca['UnidadDeMedida']['name'];
			$mercaderia = $merca['Mercaderia']['name'];
			$estado = $merca['PedidoEstado']['name'];
			$observacion = $merca['PedidoMercaderia']['observacion'];
			$proveedor = !empty($merca['Mercaderia']['Proveedor']['name'])? $merca['Mercaderia']['Proveedor']['name'] : '';

			$detalle = $mercaderia;

			?>

			<td><?php echo $this->Html->link("#".$merca['Pedido']['id'], array('controller'=>'pedidos', 'action'=>'view', $merca['Pedido']['id']));?></td>
			<td class="small"><?php echo $this->Time->nice($merca['Pedido']['created']);?></td>
			<td><?php echo $merca['Pedido']['User']['username'];?></td>
			<td><?php echo $estado;?></td>
			<td><?php echo $cant;?></td>
			<td><?php echo ($cant == 1) ? $uMedida : Inflector::pluralize($uMedida);?></td>
			<td><?php echo $detalle;?></td>
			<td><?php echo $observacion;?></td>
			
			<td class="hidden-print">
				<?php echo $this->Html->link("editar", array('controller'=>'PedidoMercaderias', 'action'=>'form', $merca['PedidoMercaderia']['id'] ) );?>
				
				<div class="btn-group" role="group">

				<?php 
				foreach ($pedidoEstados as $esId => $est) {
					if ( $merca['PedidoEstado']['id'] != $esId ) {
						echo $this->Html->link($est, array('controller'=>'PedidoMercaderias', 'action'=>'cambiarEstado', $merca['PedidoMercaderia']['id'], $esId ), array(
							'class' => 'btn-group btn-default btn-sm',
							 'role' => "group",
							) );
					}

				}
				?>
				</div>
			</td>
		</tr>
	<?php }?>
	</table>
	<?php
}