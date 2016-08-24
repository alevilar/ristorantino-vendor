    PEDIDO DE COMPRA #<?php echo $pedido['Pedido']['id']?>


  - <?php echo $this->Time->format( $pedido['Pedido']['created'], "%A %d/%m/%y %H:%M" )?> -



PROVEEDOR:
<?php
$prv = array();
$proveedor = $pedido['Proveedor']['name'];
echo $proveedor."\n\n";
if ( !empty($pedido['Proveedor']['cuit']) ) {
	echo "CUIT: ".$pedido['Proveedor']['cuit']."\n";
}
if ( !empty($pedido['Proveedor']['domicilio']) ) {
	echo "Dirección: ".$pedido['Proveedor']['domicilio']."\n";
}
if ( !empty($pedido['Proveedor']['telefono']) ) {
	echo "Tel: ".$pedido['Proveedor']['cuit']."\n";
}


echo "- - - - - - - - - - - - -\n\n\n";
echo "NOTA DE PEDIDO:\n\n";
foreach ($pedido['PedidoMercaderia'] as $merca ) {  

		$cant = (float)$merca['cantidad'];
		$uMedida = $merca['UnidadDeMedida']['name'];
		$mercaderia = $merca['Mercaderia']['name'];
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
