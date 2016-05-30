<div class="content-white">
<h2>Índice por Estado del Pedido</h2>


<?php echo $this->Form->create('Pedido', array('id'=>'PedidoForm', 'url'=>array('controller'=>'PedidoMercaderias', 'action'=>'cambiarEstado'))); ?>

<!-- Controles de accion para los elementos seleccionados-->
<div class="hidden-print" id="px-pedidos-acciones" style="display:none">
	<div class="btn-group" role="group">

		<button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
		Cambiar Estado<span class="caret"></span></button>

		<ul class="dropdown-menu" role="menu">
			<?php 
			foreach ($pedidoEstados as $esId => $est) {
					echo "<li>".$this->Html->link($est, array('controller'=>'PedidoMercaderias', 'action'=>'cambiarEstado', $esId ), array(
						'class' => 'btn-group btn-default btn-sm',
						 'role' => "group",
						) )."</li>";
			}
			?>
		</ul>
	</div>
</div>

<button value="imprimir" class="btn btn-info btn-lg center hidden-print pull-right" onclick="javascript:window.print()">Imprimir</button>



<div class="px-tabs" id="px-tabs"> <!-- px-tabs -->
<br>
<ul class="nav nav-tabs" role="tablist">
<?php 
	$classActive = 'active';
	$isfirst = true; 
	foreach ($pedidos as $estId => $pedidosProv) { 		
	?>
	 <li role="presentation" class="px-tab <?php echo $classActive?>"><a href="#pedido-estado-id-<?php echo $estId?>" aria-controls="#pedido-estado-id-<?php echo $estId?>" role="tab" data-toggle="tab"><?php echo Inflector::pluralize($pedidoEstados[$estId])?></a></li>

	 <?php
	 	if ($isfirst) {
			$isfirst = false;
			$classActive = '';
		}
	 ?>

<?php } ?>
</ul>



<div class="tab-content" style="background-color: white; border-right: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd">

<?php


$classActive = 'active';
$isfirst = true; 

foreach ($pedidos as $estId => $pedidosRub) {		
?>
	<div id="pedido-estado-id-<?php echo $estId?>" class="tab-pane fade in <?php echo $classActive?>">
<?php
	if ($isfirst) {
		$isfirst = false;
		$classActive = '';
	}

	foreach ($pedidosRub as $rub) {

		?>
		<table class="table table-condensed table-responsive">
		    <caption class="center">

		    <?php 
		    $clasH4 = empty($rub['Rubro']['name']) ? 'text-danger': '';
		    $faIcon = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
		    ?>
		    	<h4 class="<?php echo $clasH4?>"><?php echo !empty($rub['Rubro']['name']) ? $rub['Rubro']['name']: $faIcon.'Sin Rubro Definido'?></h4>

		    	<?php 
		    		if ( !empty($rub['Rubro']['Proveedor']) ) {
		    			foreach ($rub['Rubro']['Proveedor'] as $proveedor) {
		    				$telefono = !empty($proveedor['telefono']) ? " (".$proveedor['telefono'].")" : '';
		    				echo $proveedor['name']. $telefono;
		    				echo "<br>";
		    			}
		    		}

		    	?>
		    </caption>

			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>#Pedido</th>
					<th>Fecha</th>
					<th>Usuario</th>
					<th>Estado</th>
					<th>Cantidad</th>
					<th>U/Medida</th>
					<th>Mercaderia</th>
					<th>Observación</th>					
				</tr>	
			</thead>
			
		<?php 
			$cont = -1;
			foreach ($rub['PedidoMercaderia'] as $merca ) { ?>
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
				<td><?php echo $this->Form->checkbox('id', array('value'=>$merca['PedidoMercaderia']['id'], 'name'=>'data[Pedido][id][]', 'class'=>'checkbox'))?></td>

				<td><?php echo $this->Html->link("#".$merca['Pedido']['id'], array('controller'=>'pedidos', 'action'=>'view', $merca['Pedido']['id']));?></td>
				<td class="small"><?php echo $this->Time->nice($merca['Pedido']['created']);?></td>
				<td><?php echo $merca['Pedido']['User']['username'];?></td>
				<td><?php echo $estado;?></td>
				<td><?php echo $cant;?></td>
				<td><?php echo ($cant == 1) ? $uMedida : Inflector::pluralize($uMedida);?></td>
				<td><?php echo $detalle;?></td>
				<td><?php echo $observacion;?></td>
								
			</tr>
		<?php }?>
		</table>		
	<?php } ?>
	
	</div><!-- tab-pane -->

<?php } ?>

</div><!-- tab-content -->

</div><!-- px-tabs -->

<?php echo $this->Form->end() ?>


<?php echo $this->Html->script('/compras/js/pedidos/pendientes'); ?>

</div>