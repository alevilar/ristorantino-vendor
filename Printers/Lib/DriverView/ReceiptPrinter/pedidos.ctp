    PEDIDO DE COMPRA Nº<?php echo $pedido['Pedido']['id']?>


  - <?php echo $this->Time->format( $pedido['Pedido']['created'], "%A %d/%m/%y %H:%M" )?> -




<?php
$prv = array();
$proveedor = $pedido['Proveedor']['name'];
echo $proveedor."\n";
if ( !empty($pedido['Proveedor']['telefono']) ) {
	echo "Tel: ".$pedido['Proveedor']['telefono']."\n";
}




foreach ($pedido['PedidoMercaderia'] as $merca ) {  

		$cant = (float)$merca['cantidad'];
		$uMedida = $merca['UnidadDeMedida']['name'];
		$mercaderia = $merca['Mercaderia']['name'];
		$estado = $merca['PedidoEstado']['name'];
		$observacion = $merca['observacion'];

		$umedidaTxt = ($cant>1)? Inflector::pluralize($uMedida) : $uMedida;

		if ( $observacion ) {
			$observacion = ". OBS: " .$observacion;
		}
		$detalle = "$cant $umedidaTxt de $mercaderia$observacion";

    	echo $detalle."\n";
 }


    echo "\n";
    echo "\n";
    echo "\n";        



    // probando corte completo ESC/P
    echo $this->PE->cm('CORTAR_PAPEL');
