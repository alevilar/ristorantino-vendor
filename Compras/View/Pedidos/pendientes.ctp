<div class="content-white">
<h2>Solicitudes de Compra Pendientes</h2>


<?php echo $this->Form->create('Pedido', array('id'=>'PedidoForm', 'url'=>array('controller'=>'Pedidos', 'action'=>'create'))); ?>

<!-- Controles de accion para los elementos seleccionados-->
<div class="hidden-print">
		<?php echo $this->Form->button('[OC] Generar Orden de Compra', array(
											'type' => 'submit',
											'class'=>'btn btn-info btn-lg center hidden-print pull-right disabled',
											'id' => 'px-pedidos-acciones',
											)); ?>

		<?php
			echo $this->Html->link("[SC] Generar Solicitud de Compra", array(
				'controller'=> 'pedido_mercaderias','action' => 'add'
			),array(
				'class' => 'btn btn-success btn-lg center hidden-print'
			));
		?>
</div>



<div class="tab-content" style="background-color: white; border-right: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd">


<?php

	foreach ($pedidos as $rub) {

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
					<th>Fecha</th>
					<th>Cantidad</th>
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
				$observacion = $merca['PedidoMercaderia']['observacion'];
				$proveedor = !empty($merca['Mercaderia']['Proveedor']['name'])? $merca['Mercaderia']['Proveedor']['name'] : '';

				$detalle = $mercaderia;

				?>
				<td><?php echo $this->Form->checkbox('mercaderia_id', array('value'=>$merca['PedidoMercaderia']['id'], 'name'=>'data[Pedido][mercaderia_id][]', 'class'=>'checkbox'))?></td>

				<td>
					<?php echo $this->Time->niceShort($merca['Pedido']['created']);?>
				</td>
				<td><?php echo $cant;?> <?php echo ($cant == 1) ? $uMedida : Inflector::pluralize($uMedida);?></td>
				<td><?php echo $detalle;?></td>
				<td><?php echo $observacion;?></td>
								
			</tr>
		<?php }?>
		</table>		
	<?php } ?>
	


</div><!-- tab-content -->

</div><!-- px-tabs -->

<?php echo $this->Form->end() ?>


<?php echo $this->Html->script('/compras/js/pedidos/pendientes'); ?>

</div>