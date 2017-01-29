<?php $this->element("Risto.layout_modal_edit");?>


<div class="content-white">

<?php 
$textoRecepcionado = "";
$linkRecepcionado = "";
if ( !$pedido['Pedido']['recepcionado'] ) {
		$linkRecepcionado = $this->Html->link("Recepcionar", array('controller'=>'Pedidos', 'action'=>'recepcion', $pedido['Pedido']['id'] ), array('class'=>'btn btn-success') );
} else {
	$textoRecepcionado = ' <span class="text-success">'.__("RECEPCIONADO").'</span>';
}
?>

<div class="pull-left muted"><?php echo $this->Time->format($pedido['Pedido']['created'], '%c')?></div><br>
<h3 class="pull-right" style="margin-right: 30px;">Proveedor: <?php echo $pedido['Proveedor']['name']?></h3>
<h3>Órden de Compra #<?php echo $pedido['Pedido']['id'].$textoRecepcionado?></h3>


<div class="btn-group center" role="group" aria-label="menu" style="margin: 20px auto;">

	<?php 

	echo $this->Html->link('Imprimir Pedido por comandera', array('action'=>'imprimir', $pedido['Pedido']['id']), array('class'=>'btn btn-default'));


	echo $linkRecepcionado;

	if ( empty($pedido['Pedido']['gasto_id']) ) {
		echo $this->Html->link('Generar Gasto', array('action'=>'generar_gasto', $pedido['Pedido']['id']), array('class'=>'btn btn btn-warning'));
	} else {
		echo $this->Html->link('Ver Gasto', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'view', $pedido['Pedido']['gasto_id']), array('class'=>'btn btn btn-warning', 'target'=>'_blank'));
		echo $this->Form->postLink('Desvincular Gasto', array('action'=>'desvincular_gasto', $pedido['Pedido']['id']), array('class'=>'btn btn btn-default'), array("Seguro desea desvincular?"));
	}
?>


<?php echo $this->Html->link('Editar Órden de Compra', array('action'=>'form', $pedido['Pedido']['id']), array('class'=>'btn btn btn-primary')); ?>


<?php echo $this->Form->postLink('Eliminar Órden de Compra', array('action'=>'delete', $pedido['Pedido']['id']), array('class'=>'btn btn btn-danger'), array("Seguro desea eliminar?")); ?>


</div>


<br><br>
<div>
	<table class="table">
		<thead>
			<tr>
				<th>Cantidad</th>
				<th>Mercaderia</th>
				<th>Precio de Compra</th>

				<th>Observación</th>
				<th>Fecha Pedido</th>
				<th>Modificado</th>
				<th>Acciones</th>
			</tr>	
		</thead>
		
	<?php 

	foreach ($pedido['PedidoMercaderia'] as $merca ) {

		$cant = (float)$merca['cantidad'];
		$precio = $this->Number->currency( $merca['precio'] );
		$uMedida = $merca['UnidadDeMedida']['name'];
		$uMedida = ($cant > 1) ? Inflector::pluralize($uMedida) : $uMedida;
		$mercaderia = $merca['Mercaderia']['name'];
		$obs = $merca['observacion'];
		$creado = $merca['created'];
		$modificado = $merca['modified'];


		$mercaderia = $this->Html->link($mercaderia, array(
				'controller' => 'mercaderias',
				'action' => 'edit',
				$merca['Mercaderia']['id']
			), array(
				'class'=> 'btn-edit'
			));

			
		$linkEdit = $this->Html->link("editar", array('controller'=>'PedidoMercaderias', 'action'=>'form', $merca['id'] ), array('class'=>'btn-edit') );

		$linkEnviarComoPendiente = $this->Form->postLink("Enviar a Pendiente", array(
															'controller'=>'PedidoMercaderias', 
															'action'	=>'marcar_como_pendiente', 
															$merca['id'] 
															) 
														);


		echo $this->Html->tableCells(array(
			$cant." ".$uMedida,
			$mercaderia,
			$precio,
			$obs,
			$creado,
			$modificado,
			$linkEdit." | ".$linkEnviarComoPendiente
		));

	}
	?>
	</table>
</div>
</div>