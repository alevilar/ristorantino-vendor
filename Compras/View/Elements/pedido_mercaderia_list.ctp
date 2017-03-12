<?php
$thPedidoId = $this->Paginator->sort('pedido_id', __("#Orden"));
$thVarCreated = $this->Paginator->sort('created', __("Fecha"));
$thVarName = $this->Paginator->sort('created_by', __("Usuario"));
$thVarCantidad = $this->Paginator->sort('cantidad', __("Cantidad"));
$thVarUnidadMedida = $this->Paginator->sort('unidad_de_medida_id', __("U/Medida"));
$thVarMerca = $this->Paginator->sort('name', __("Mercaderia"));
$thVarPrecio = $this->Paginator->sort('precio', __("Precio"));
$thVarFecha = $this->Paginator->sort('time_recibido', __("Fecha Recepción"));
$thVarProveedor = __('Proveedor');
$thVarRubro = __('Rubro');
$thVarObservacion = __('Observación');
$thVarAcciones = __('Acciones');

$headers = array(
			 'pedido_id' 			=> $thPedidoId, 
             'created' 				=> $thVarCreated,
             'created_by' 			=> $thVarName, 
             'cantidad' 			=> $thVarCantidad,
             'unidad_de_medida_id' 	=> $thVarUnidadMedida,
             'name' 				=> $thVarMerca,
             'precio' 				=> $thVarPrecio,
             'time_recibido' 		=> $thVarFecha,
             'proveedor_name' 		=> $thVarProveedor,
             'rubro_name' 			=> $thVarRubro,
             'observacion' 			=> $thVarObservacion,
             'actions' 				=> $thVarAcciones
             );


 if (!empty($notShow)) {
     foreach ( $notShow as $columNotShow ){
        unset($headers[$columNotShow]);
    }
 }

?>


<div class="paging paginationxt text-center">
		<br>
		<?php echo $this->element('Users.paging'); ?>
		<br>
		<?php echo $this->element('Risto.pagination'); ?>
		<br><br>
	</div>
	
	<table class="table table-condensed">
		<thead>
			<?php echo $this->Html->tableHeaders($headers); ?>
		</thead>
		
		<tbody>
		<tr>
			<?php 
            foreach ($pedidos as $merca ) { 
    
            $cant = (float)$merca['PedidoMercaderia']['cantidad'];
            $uMedida = $merca['UnidadDeMedida']['name'];
            $precio = $merca['PedidoMercaderia']['precio']!=0 ? $this->Number->currency( $merca['PedidoMercaderia']['precio'] ) : "";
            $timeRecibido = empty($merca['PedidoMercaderia']['time_recibido'])? "":$this->Time->nice( $merca['PedidoMercaderia']['time_recibido'] );
            $observacion = $merca['PedidoMercaderia']['observacion'];
            $proveedor = !empty($merca['Pedido']['Proveedor']['name'])? $merca['Pedido']['Proveedor']['name'] : '';

            $mercaderia = $merca['Mercaderia']['name'];
            $rubro = !empty($merca['Mercaderia']['Rubro']['name'])? $merca['Mercaderia']['Rubro']['name'] : '';

            $detalle = $mercaderia;


$tdPedidoId = $this->Html->link("#".$merca['Pedido']['id'], array('plugin' => 'compras','controller'=>'pedidos', 'action'=>'view', $merca['Pedido']['id']), array('target'=>'_blank'));
$tdVarCreated = $this->Time->nice($merca['Pedido']['created']);
$tdVarName = empty($merca['Pedido']['User']['username'])? "":$merca['Pedido']['User']['username'];
$tdVarCantidad = $cant;
$tdVarUnidadMedida = $uMedida;
$tdVarMerca = $detalle;
$tdVarPrecio = $precio;
$tdVarFecha = $timeRecibido;
$tdVarProveedor = $proveedor;
$tdVarRubro = $rubro;
$tdVarObservacion = $observacion;
$tdVarAcciones = $this->Html->link("editar", array('controller'=>'PedidoMercaderias', 
                 'action'=>'form', $merca['PedidoMercaderia']['id'] ),             
                 array('class'=>'btn-edit btn btn-default') 
                      );

$result = array(
                'pedido_id' => $tdPedidoId,
                'created' => $tdVarCreated,
                'created_by' => $tdVarName,
                'cantidad' => $tdVarCantidad,
                'unidad_de_medida_id' => $tdVarUnidadMedida,
                'name' => $tdVarMerca,
                'precio' => $tdVarPrecio,
                'time_recibido' => $tdVarFecha,
                'proveedor_name' => $tdVarProveedor,
                'rubro_name' => $tdVarRubro,
                'observacion' => $tdVarObservacion,
                'actions' => $tdVarAcciones
                 );

     if (!empty($notShow)) {
        foreach ( $notShow as $columNotShow ){
        unset($result[$columNotShow]);
          }
       }

        echo $this->Html->tableCells($result); 
} //end foreach.
            ?>
		</tr>
		</tbody>
	</table>