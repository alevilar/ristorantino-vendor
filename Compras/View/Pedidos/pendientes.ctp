<h2>Índice por Estado del Pedido</h2>

<div class="btn-group-vertical">
<?php
foreach ($pedidos as $estId => $pedidosProv) {
	echo $this->Html->link($pedidoEstados[$estId], "#pedido-id-$estId", array('class'=>'btn btn-sm btn-default'));
}
?>
</div>


<button value="imprimir" class="btn btn-info btn-lg center hidden-print pull-right" onclick="javascript:window.print()">Imprimir</button>

<?php

foreach ($pedidos as $estId => $pedidosProv) {

?>
	<h2 id="pedido-id-<?php echo $estId?>" style="border-top: 2px solid #ccc; border-bottom: 1px solid #ccc"><?php echo Inflector::pluralize( $pedidoEstados[$estId]); ?></h2>
<?php
foreach ($pedidosProv as $prov) {

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
		
	<?php 
		$cont = -1;
		foreach ($prov['PedidoMercaderia'] as $merca ) { ?>
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
				<div class="">
				<?php echo $this->Html->link("Editar", array('controller'=>'PedidoMercaderias', 'action'=>'form', $merca['PedidoMercaderia']['id'] ), array('') );?>
				
				<?php echo $this->Html->link(__('Borrar')
                        						, array('controller'=>'PedidoMercaderias', 'action'=>'delete', $merca['PedidoMercaderia']['id'])
                        						, array('class'=>'btn btn-danger btn-sm acl acl-administrador')
                        						, __('Desea borrar el Pedido de Mercaderia: "%s"', $merca['Mercaderia']['name'])
                        						); ?>
				

				<div class="btn-group" role="group">

				<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
    			Cambiar Estado<span class="caret"></span></button>

				<ul class="dropdown-menu" role="menu">
				<?php 
				foreach ($pedidoEstados as $esId => $est) {
					if ( $merca['PedidoEstado']['id'] != $esId ) {
						echo "<li>".$this->Html->link($est, array('controller'=>'PedidoMercaderias', 'action'=>'cambiarEstado', $merca['PedidoMercaderia']['id'], $esId ), array(
							'class' => 'btn-group btn-default btn-sm',
							 'role' => "group",
							) )."</li>";
					}

				}
				?>
				</ul>
				</div>
			</td>
		</tr>
	<?php }?>
	</table>
	<?php
}

}