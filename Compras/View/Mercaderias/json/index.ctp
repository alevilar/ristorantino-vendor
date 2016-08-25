<?php

$np = array();
$i = 0;
foreach ( $mercaderias as $p ) {
	$ret = array(
		'id' 	=> $p['Mercaderia']['id'],
		'value' => $p['Mercaderia']['name'],
		'unidad_de_medida_id' => $p['Mercaderia']['unidad_de_medida_id'],
		);

	  $ret['description'] = "";
	 if (!empty($p['Pendiente'])) {
		$cant = $p['Pendiente']['cant'];
		$sum = $p['Pendiente']['sum'];

		$ret['pedidos_pendientes'] = $p['Pendiente'];
		$unidadtxt = ( (float)$sum > 1 ) ? 'unidades' : 'unidad';
		$canttxt = ( (float)$cant > 1 ) ? 
						  __("Existen %s pedidos previos sumando %s $unidadtxt", $cant, $sum)
						: __("Hay %s pedido previo de %s $unidadtxt", $cant, $sum);

	 	$ret['description'] = "($canttxt)";
	}
	$np[] = $ret;
}

echo json_encode($np);