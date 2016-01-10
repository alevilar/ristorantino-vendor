<?php

$np = array();
foreach ( $mercaderias as $p ) {
    
   $np[] = array(
   	'id' 	=> $p['Mercaderia']['id'],
   	'value' => $p['Mercaderia']['name'],
   	'unidad_de_medida_id' => $p['Mercaderia']['unidad_de_medida_id'],
   	);
}

echo json_encode($np);