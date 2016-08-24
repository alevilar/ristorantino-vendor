<?php

$np = array();
$i = 0;
foreach ( $mercaderias as $p ) {
  $ret = array(
   	'id' 	=> $p['Mercaderia']['id'],
   	'value' => $p['Mercaderia']['name'],
   	'unidad_de_medida_id' => $p['Mercaderia']['unidad_de_medida_id'],
   	);

   if (!empty($p['Pendiente'])) {
    $cant = $p['Pendiente']['cant'];
    $sum = $p['Pendiente']['sum'];

	$ret['pedidos_pendientes'] = $p['Pendiente'];
	if ( $cant > 1) {
		$canttxt = ( (float)$cant > 1 ) ? 'Existen %s pedidos previos' : 'Hay %s pedido previo';
		$unidadtxt = ( (float)$sum > 1 ) ? '%s unidad' : '%s unidades';

		$txt = __("$canttxt. Sumando $unidadtxt", $cant, $sum);
	}
	$ret['value'] .= " ($txt)";
   }
   $np[] = $ret;
}

echo json_encode($np);