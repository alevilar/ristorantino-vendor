
<h1>Historial de Pedidos</h1>

<div class="row paging paginationxt text-center">
	<br>
	<div class="col-md-12">
		<?php echo $this->element('Users.paging') ?>
		<?php echo $this->element('Users.pagination') ?>
		<br><br>
	</div>

</div>

	<table class="table table-condensed">
	   
	   	<thead  class="hidden-print">
	   		<?php echo $this->Form->create('PedidoMercaderia'); ?>
			<tr>
				<th><?php echo $this->Form->input('pedido_id', array('type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>'Nº Pedido', 'required'=>false)); ?></th>
				<th></th>
				<th></th>
				<th><?php echo $this->Form->input('pedido_estado_id', array('empty'=>'Todos', 'label'=>false, 'div'=>false, 'required'=>false)); ?></th>
				<th></th>
				<th></th>
				<th></th>
				<th><?php echo $this->Form->input('proveedor_id', array('empty'=>'Todos', 'label'=>false, 'div'=>false, 'required'=>false)); ?></th>
				<th></th>
				<th><?php echo $this->Form->submit('Filtrar', array('class'=>'btn btn-success btn-block')) ?></th>
			</tr>
			<?php echo $this->Form->end(null); ?>
		</thead>

		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('pedido_id', "#Pedido")?></th>
				<th><?php echo $this->Paginator->sort('created', "Fecha")?></th>
				<th><?php echo $this->Paginator->sort('created_by', "Usuario")?></th>
				<th><?php echo $this->Paginator->sort('estado_id', "Estado")?></th>
				<th><?php echo $this->Paginator->sort('cantidad', "Cantidad")?></th>
				<th><?php echo $this->Paginator->sort('unidad_de_medida_id', "U/Medida")?></th>
				<th><?php echo $this->Paginator->sort('name', "Mercaderia")?></th>
				<th>Proveedor</th>
				<th>Observación</th>
				<th class="hidden-print">Acciones</th>
			</tr>	
		</thead>
		
		<tbody>
	<?php foreach ($pedidos as $merca ) { ?>
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
			<td><?php echo !empty($merca['Pedido']['User']['username']) ? $merca['Pedido']['User']['username']:'';?></td>
			<td><?php echo $estado;?></td>
			<td><?php echo $cant;?></td>
			<td><?php echo ($cant == 1) ? $uMedida : Inflector::pluralize($uMedida);?></td>
			<td><?php echo $detalle;?></td>
			<td><?php echo !empty($merca['Mercaderia']['Proveedor']['name']) ? $merca['Mercaderia']['Proveedor']['name'] : "";?></td>
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
		</tbody>
	</table>
