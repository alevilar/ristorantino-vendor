<div class="paging paginationxt text-center">
		<br>
		<?php echo $this->element('Users.paging'); ?>
		<br>
		<?php echo $this->element('Risto.pagination'); ?>
		<br><br>
	</div>

	
	<table class="table table-condensed">
	   	 

		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('pedido_id', "#Orden")?></th>
				<th><?php echo $this->Paginator->sort('created', "Fecha")?></th>
				<th><?php echo $this->Paginator->sort('created_by', "Usuario")?></th>
				<th><?php echo $this->Paginator->sort('cantidad', "Cantidad")?></th>
				<th><?php echo $this->Paginator->sort('unidad_de_medida_id', "U/Medida")?></th>
				<th><?php echo $this->Paginator->sort('name', "Mercaderia")?></th>
				<th><?php echo $this->Paginator->sort('precio', "Precio")?></th>
				<th><?php echo $this->Paginator->sort('time_recibido', "Fecha Recepción	")?></th>
				<th>Proveedor</th>
				<th>Rubro</th>
				<th>Observación</th>
				<th class="hidden-print" style="width: 234px">Acciones</th>
			</tr>	
		</thead>
		
		<tbody>
	<?php foreach ($pedidos as $merca ) { ?>
		<tr>
			<?php 
			$cant = (float)$merca['PedidoMercaderia']['cantidad'];
			$uMedida = $merca['UnidadDeMedida']['name'];
			$mercaderia = $merca['Mercaderia']['name'];
			$precio = $merca['PedidoMercaderia']['precio']!=0 ? $this->Number->currency( $merca['PedidoMercaderia']['precio'] ) : "";
			$timeRecibido = empty($merca['PedidoMercaderia']['time_recibido'])? "":$this->Time->nice( $merca['PedidoMercaderia']['time_recibido'] );
			$observacion = $merca['PedidoMercaderia']['observacion'];
			$proveedor = !empty($merca['Pedido']['Proveedor']['name'])? $merca['Pedido']['Proveedor']['name'] : '';
			$rubro = !empty($merca['Mercaderia']['Rubro']['name'])? $merca['Mercaderia']['Rubro']['name'] : '';

			$detalle = $mercaderia;

			?>

			<td><?php 
			if ($merca['Pedido']['id']){
				echo $this->Html->link("#".$merca['Pedido']['id'], array('controller'=>'pedidos', 'action'=>'view', $merca['Pedido']['id']));
			}
				?></td>
			<td class="small"><?php echo $this->Time->nice($merca['Pedido']['created']);?></td>
			<td><?php echo !empty($merca['Pedido']['User']['username']) ? $merca['Pedido']['User']['username']:'';?></td>
			<td><?php echo $cant;?></td>
			<td><?php echo ($cant == 1) ? $uMedida : Inflector::pluralize($uMedida);?></td>
			<td><?php echo $detalle;?></td>
			<td><?php echo $precio;?></td>
			<td class="small"><?php echo $timeRecibido;?></td>
			<td><?php echo $proveedor; ?></td>
            <td><?php echo $rubro; ?>
			<td><?php echo $observacion;?></td>

			
			<td class="hidden-print">


				<?php echo $this->Html->link("editar", array('controller'=>'PedidoMercaderias', 'action'=>'form', $merca['PedidoMercaderia']['id'] ), array('class'=>'btn-edit btn btn-default') );?>


			</td>
		</tr>
	<?php }?>
		</tbody>
	</table>