<?php
/**
*
*   Esta vista debe recibir 2 variables
*   @param array $entradas es un listado de productos que son entrada
*   @param array $productos es un listado de todos los productos, incluyendo las entradas
*   @param array $comanda Comanda con Mesa y Mozo
*
**/

echo $this->PE->cm('INICIAR'); // pongo el ESC para comenzar ESC/P 
echo $this->PE->cm('DOBLE_ANCHO_ON'); // pongo el ESC para comenzar ESC/P 


echo "\n                 Comanda #".$comanda['Comanda']['id'];
echo "\n             ".date('H:i:s d-m-Y', strtotime($comanda['Comanda']['created']));

if (!empty($observacion)) {
    echo "*********************************\n";
    echo $observacion;
    echo "\n";
    echo "*********************************\n";
}


$cant_entradas = 0;
if (!empty($entradas)) {
    $cant_entradas = count($entradas);

    if ($cant_entradas > 0) {
        echo " -----        ENTRADAS       -----";
        echo "\n";
    }
}


$i = 0;

foreach ($productos as $detalle):
    if (($i == $cant_entradas) && count($productos)-$cant_entradas > 0) {
        echo "\n";
        echo " -----   PLATOS PRINCIPALES   -----";
        echo "\n";
    }


    $obstxt = trim($detalle['DetalleComanda']['observacion'],',');
    if ( !empty( $obstxt ) ) {
         $obstxt = ' (OBS: ' . $obstxt .")";
    }
    $prod_cant = $detalle['DetalleComanda']['cant'];
    $prod_name = $detalle['Producto']['name'] . $obstxt ;

    $prod_sabor = '';
    $primero = true;
    foreach ($detalle['DetalleSabor'] as $sabor) {
        if (!$primero) {
            $prod_sabor .= ', ';
        } else {
            $prod_sabor .= '[';
            $primero = false;
        }
        $prod_sabor .= $sabor['Sabor']['name'];
    }
    $prod_sabor .= (count($detalle['DetalleSabor']) == 0) ? '' : ']';

    if ( !empty($detalle['DetalleSabor']) ) {
        echo "$prod_cant) $prod_name\n   ADICIONAL: $prod_sabor";
    } else {
        echo "$prod_cant) $prod_name\n";
    }

    $i++;
endforeach;


echo "\n";
echo " - " . strtoupper( Configure::read('Mesa.tituloMesa') ) . ": ".$comanda['Mesa']['numero']."\n";
echo " - " . strtoupper( Configure::read('Mesa.tituloMozo') ) . ": ".$comanda['Mesa']['Mozo']['numero'];
echo "\n";
echo "\n";
echo "\n";

echo $this->PE->cm('CORTAR_PAPEL');
