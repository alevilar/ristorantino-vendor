<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Mercaderia de la Órden de Compra'));?>


<div class="content-white">
<h1>Historial de Órdenes de Compra</h1>


<p class="center">
	<?php echo $this->Form->create('PedidoMercaderia', array('class'=>'form-inline')); ?>
	<?php echo $this->Form->input('pedido_id', array('type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>'Nº Órden de Compra', 'required'=>false)); ?>
	<?php echo $this->Form->input('pedido_estado_id', array('empty'=>'Todos', 'label'=>false, 'div'=>false, 'required'=>false)); ?>
	<?php echo $this->Form->input('proveedor_id', array('empty'=>'Todos', 'label'=>false, 'div'=>false, 'required'=>false)); ?>
	<?php echo $this->Form->submit('Filtrar', array('class'=>'btn btn-success', 'div'=>false)) ?>
	<?php echo $this->Form->end(); ?>
	</p>



<div class="paging paginationxt text-center">
	<br>
		<?php echo $this->element('Users.paging') ?>
		<?php echo $this->element('Users.pagination') ?>
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
				<th>Proveedor</th>
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
			$observacion = $merca['PedidoMercaderia']['observacion'];
			$proveedor = !empty($merca['Mercaderia']['Proveedor']['name'])? $merca['Mercaderia']['Proveedor']['name'] : '';

			$detalle = $mercaderia;

			?>

			<td><?php echo $this->Html->link("#".$merca['Pedido']['id'], array('controller'=>'pedidos', 'action'=>'view', $merca['Pedido']['id']));?></td>
			<td class="small"><?php echo $this->Time->nice($merca['Pedido']['created']);?></td>
			<td><?php echo !empty($merca['Pedido']['User']['username']) ? $merca['Pedido']['User']['username']:'';?></td>
			<td><?php echo $cant;?></td>
			<td><?php echo ($cant == 1) ? $uMedida : Inflector::pluralize($uMedida);?></td>
			<td><?php echo $detalle;?></td>
			<td><?php echo !empty($merca['Mercaderia']['Proveedor']['name']) ? $merca['Mercaderia']['Proveedor']['name'] : "";?></td>
			<td><?php echo $observacion;?></td>
			
			<td class="hidden-print">


				<?php echo $this->Html->link("editar", array('controller'=>'PedidoMercaderias', 'action'=>'form', $merca['PedidoMercaderia']['id'] ), array('class'=>'btn-edit btn btn-default') );?>


			</td>
		</tr>
	<?php }?>
		</tbody>
	</table>

</div>