<?php $this->element("Risto.layout_modal_edit");?>


<div class="content-white">
<?php echo $this->Form->create('Pedido', array('id'=>'PedidoForm', 'url'=>array('controller'=>'Pedidos', 'action'=>'create'))); ?>

<!-- Controles de accion para los elementos seleccionados-->
<div class="hidden-print">
<br>
		<?php echo $this->Form->button('[OC] Generar Orden de Compra', array(
											'type' => 'submit',
											'class'=>'btn btn-info btn-lg center hidden-print pull-right acl acl-adicionista acl-administrador',
											'id' => 'px-pedidos-acciones',
											)); ?>

		<?php
			echo $this->Html->link("Agregar Mercaderia", array(
				'controller'=> 'pedido_mercaderias','action' => 'add'
			),array(
				'class' => 'btn btn-success btn-lg center hidden-print'
			));
		?>
	<br><br>
</div>



<div class="tab-content" style="background-color: white; border-right: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd">

<h4 class="center grey">Listado de Mercadería con Solicitud de Compra Pendiente</h4>
<?php

	foreach ($pedidos as $rub) {

		?>
		<table class="table table-condensed table-responsive">
		    <caption class="center">

		    <?php 
		    $clasH4 = empty($rub['Rubro']['name']) ? 'text-danger': '';
		    $faIcon = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
		    ?>
		    	<h4 class="<?php echo $clasH4?>">
		    		<?php 
		    		$checkbox = $this->Form->checkbox('mercaderia_x_rubro',
		    			array('class'=>'checkbox-x-rubro acl acl-adicionista acl-administrador'));

		    		echo $checkbox;
		    		echo !empty($rub['Rubro']['name']) ? $rub['Rubro']['name']: $faIcon.'Sin Rubro Definido'?>
	    			
		    	</h4>

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
				<?php
				echo $this->Html->tableHeaders(array(
					'&nbsp;',
					'Fecha',
					'Cantidad',
					'Mercaderia',
					'Proveedor',
					'Observación',
					'',
					));
				?>
			</thead>
			
		<?php 
			$cont = -1;
			foreach ($rub['PedidoMercaderia'] as $merca ) { ?>
				<?php 
				$cant = (float)$merca['PedidoMercaderia']['cantidad'];
				$uMedida = $merca['UnidadDeMedida']['name'];
				$mercaderia = $merca['Mercaderia']['name'];
				$observacion = $merca['PedidoMercaderia']['observacion'];
				$deleteLink = $this->Html->link("<span class='glyphicon glyphicon-remove'></span>", array(
					'controller' => 'pedido_mercaderias',
					'action' => 'delete',
					$merca['PedidoMercaderia']['id']
				), array(
					'escape' => false,
					'class' => 'text-danger acl acl-adicionista acl-administrador',
				), 
					__("¿Desea eliminar el pedido de %s?", $merca['Mercaderia']['name'])
				);
				$proveedor = !empty($merca['Mercaderia']['Proveedor']['name'])? $merca['Mercaderia']['Proveedor']['name'] : '';

				$detalle = $this->Html->link($mercaderia, array(
					'controller' => 'mercaderias',
					'action' => 'edit',
					$merca['Mercaderia']['id']
				), array(
					'class'=> 'btn-edit'
				));


				$checkbox = $this->Form->checkbox('mercaderia_id', 	array('value'=>$merca['PedidoMercaderia']['id'], 'name'=>'data[Pedido][mercaderia_id][]', 'class'=>'checkbox acl acl-adicionista acl-administrador'));


				$timeNice = $this->Time->niceShort($merca['Pedido']['created']);

				$uMedida = ($cant == 1) ? $uMedida : Inflector::pluralize($uMedida);
				$canYMedida = $cant." ".$uMedida ;

				$rows = array(
					$checkbox ,
					$timeNice,
					$canYMedida,
					$detalle,
					$proveedor,
					$observacion,
					$deleteLink,
				);

				echo $this->Html->tableCells($rows);
				?>
		<?php }?>
		</table>		
	<?php } ?>
	


</div><!-- tab-content -->

</div><!-- px-tabs -->

<?php echo $this->Form->end() ?>


<?php echo $this->Html->script('/compras/js/pedidos/pendientes'); ?>

</div>