<?php
/**
*
*   Esta vista debe recibir 2 variables
*   @param array $entradas es un listado de productos que son entrada
*   @param array $productos es un listado de todos los productos, incluyendo las entradas
*
**/
echo $this->PE->cm('ESC');

$cant_entradas = count($entradas);

if ($cant_entradas > 0) {
    echo " -----        ENTRADAS       -----";
    echo "\n";
}
$i = 0;

foreach ($productos as $detalle):
    if (($i == $cant_entradas) && count($productos)-$cant_entradas > 0) {
        echo "\n";
        echo " -----   PLATOS PRINCIPALES   -----";
        echo "\n";
    }


    $prod_cant = $detalle['DetalleComanda']['cant'];
    $prod_name = $detalle['Producto']['name'] . ' - ' . $detalle['DetalleComanda']['observacion'];
    $prod_sabor = '';
    $primero = true;
    foreach ($detalle['DetalleSabor'] as $sabor) {
        if (!$primero) {
            $prod_sabor .= ', ';
        } else {
            $prod_sabor .= ':: [';
            $primero = false;
        }
        $prod_sabor .= $sabor['Sabor']['name'];
    }
    $prod_sabor .= (count($detalle['DetalleSabor']) == 0) ? '' : ']';

    echo "$prod_cant) $prod_name $prod_sabor\n";

    $i++;
endforeach;

