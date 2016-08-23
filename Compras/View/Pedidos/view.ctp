<?php $this->element("Risto.layout_modal_edit");?>


<div class="content-white">
<div class="btn-group-vertical pull-right" role="group" aria-label="...">

<?php echo $this->Html->link('Imprimir Pedido por comandera', array('action'=>'imprimir', $pedido['Pedido']['id']), array('class'=>'btn btn-default')); ?>

<?php echo $this->Html->link('Editar Órden de Compra', array('action'=>'form', $pedido['Pedido']['id']), array('class'=>'btn btn btn-primary')); ?>
</div>


<h1>Órden de Compra #<?php echo $pedido['Pedido']['id']?></h1>




<h3 class="center">Proveedor: <?php echo $pedido['Proveedor']['name']?></h3>
<br>
<div>
	<table class="table">
		<thead>
			<tr>
				<th>Cantidad</th>
				<th>Mercaderia</th>
				<th>Observación</th>
				<th>Acciones</th>
			</tr>	
		</thead>
		
	<?php 

	foreach ($pedido['PedidoMercaderia'] as $merca ) {

		$cant = (float)$merca['cantidad'];
		$uMedida = $merca['UnidadDeMedida']['name'];
		$uMedida = ($cant > 1) ? Inflector::pluralize($uMedida) : $uMedida;
		$mercaderia = $merca['Mercaderia']['name'];
		$obs = $merca['observacion'];


		$mercaderia = $this->Html->link($mercaderia, array(
				'controller' => 'mercaderias',
				'action' => 'edit',
				$merca['Mercaderia']['id']
			), array(
				'class'=> 'btn-edit'
			));

			
		$linkEdit = $this->Html->link("editar", array('controller'=>'PedidoMercaderias', 'action'=>'form', $merca['id'] ), array('class'=>'btn-edit') );



		echo $this->Html->tableCells(array(
			$cant." ".$uMedida,
			$mercaderia,
			$obs,
			$linkEdit
		));

	}
	?>
	</table>
</div>
</div>