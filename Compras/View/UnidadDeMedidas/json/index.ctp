<?php

$np = array();
foreach ( $unidadDeMedidas as $p ) {
    
   $np[] = array(
   	'id' 	=> $p['UnidadDeMedida']['id'],
   	'value' => $p['UnidadDeMedida']['name']
   	);
}

echo json_encode($np);