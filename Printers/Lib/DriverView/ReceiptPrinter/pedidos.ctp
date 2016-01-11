    PEDIDO DE COMPRA Nº<?php echo $pedido['Pedido']['id']?>




<?php
$prv = array();
foreach ($pedido['PedidoMercaderia'] as $merca ) {  

		$cant = (float)$merca['cantidad'];
		$uMedida = $merca['UnidadDeMedida']['name'];
		$mercaderia = $merca['Mercaderia']['name'];
		$estado = $merca['PedidoEstado']['name'];
		$observacion = $merca['observacion'];
		$proveedor = !empty($merca['Mercaderia']['Proveedor']['name'])? $merca['Mercaderia']['Proveedor']['name'] : '';

		$umedidaTxt = ($cant>1)? Inflector::pluralize($uMedida) : $uMedida;

		if ( $observacion ) {
			$observacion = ". OBS: " .$observacion;
		}
		$detalle = "$cant $umedidaTxt de $mercaderia$observacion";

    	$descoProve = array(    		
    			'id' => 0,
    			'name' => '',
    		);

    	if ( empty($merca['Mercaderia']['Proveedor']) ) {
    		$merca['Mercaderia']['Proveedor'] = $descoProve;
    	}
    	
    	$prv[ $merca['Mercaderia']['Proveedor']['id'] ]['Proveedor'] = $merca['Mercaderia']['Proveedor'];
    	$prv[ $merca['Mercaderia']['Proveedor']['id'] ]['Merca'][] = $detalle;
 }


foreach ($prv as $p) {
	echo $p['Proveedor']['name']."\n";
	if ( !empty(trim($p['Proveedor']['telefono'])) ) {
		echo "Tel: ".$p['Proveedor']['telefono']."\n";
	}
	echo "\n";
	foreach ($p['Merca'] as $m) {
		echo $m."\n";
	}

	echo "- - - - - - - - - - - - - - - -";
	echo "\n\n";
}


    echo "\n";
    echo "\n";
    echo "\n";        



    // probando corte completo ESC/P
    echo $this->PE->cm('CORTAR_PAPEL');
