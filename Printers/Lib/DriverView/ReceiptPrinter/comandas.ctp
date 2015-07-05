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
//echo $this->PE->cm('BUZZER_ON'); // pongo el ESC para comenzar ESC/P 
//echo $this->PE->cm('BUZZER_OFF'); // pongo el ESC para comenzar ESC/P 
echo $this->PE->cm('DOBLE_ANCHO_ON'); // pongo el ESC para comenzar ESC/P 


// cantidad de caracteres que entre a lo ancho
$C_ANCHO = 24;

echo "\n".str_pad( "Comanda #".$comanda['Comanda']['id'], $C_ANCHO, " ",  STR_PAD_RIGHT);
echo "\n".str_pad( date('H:i:s d-m-Y', strtotime($comanda['Comanda']['created'])), $C_ANCHO, " ",  STR_PAD_LEFT);

if (!empty($observacion)) {
    echo str_pad("", $C_ANCHO, "*") ."\n";
    echo $observacion;
    echo "\n";
    echo str_pad("", $C_ANCHO, "*") ."\n";
}


$cant_entradas = 0;
if (!empty($entradas)) {
    $cant_entradas = count($entradas);

    if ($cant_entradas > 0) {
        echo "\n";
        echo "\n";
        echo str_pad("ENTRADA", $C_ANCHO, "-", STR_PAD_RIGHT) ."\n";
        echo "\n";
    }
}


$i = 0;

foreach ($productos as $detalle):
    if (($i == $cant_entradas) && count($productos)-$cant_entradas > 0) {
        echo "\n";
        echo "\n";
        echo str_pad("PPAL", $C_ANCHO, "-", STR_PAD_RIGHT) ."\n";
        echo "\n";
    }

    $prod_cant = $detalle['DetalleComanda']['cant'];
    $prod_name = $detalle['Producto']['name'] ;

    $prod_sabor = '';
    $primero = true;
    foreach ($detalle['DetalleSabor'] as $sabor) {
        if (!$primero) {
            $prod_sabor .= ', ';
        } else {            
            $primero = false;
        }
        $prod_sabor .= $sabor['Sabor']['name'];
    }

    


    if ( !empty($prod_sabor) ) {
        echo "$prod_cant $prod_name: $prod_sabor\n";
    } else {
        echo "$prod_cant $prod_name\n";
    }

    if (!empty( $detalle['DetalleComanda']['observacion'] )) {
        $obstxt = trim($detalle['DetalleComanda']['observacion'],',');
        echo "  OBS: $obstxt\n";
    }
    echo "\n";
    $i++;
endforeach;

echo "\n";
echo "\n";
echo "\n";

echo str_pad(strtoupper( Configure::read('Mesa.tituloMesa') ) . ": ".$comanda['Mesa']['numero'], $C_ANCHO/2-2, " ", STR_PAD_LEFT );
echo "  |  ";
echo str_pad(strtoupper( Configure::read('Mesa.tituloMozo') ) . ": ".$comanda['Mesa']['Mozo']['numero'], $C_ANCHO/2-1, " ", STR_PAD_RIGHT);

echo "\n";
echo "\n";
echo "\n";
echo $this->PE->cm('RETORNO_DE_CARRO');
echo $this->PE->cm('RETORNO_DE_CARRO');
echo $this->PE->cm('RETORNO_DE_CARRO');

echo $this->PE->cm('CORTAR_PAPEL');

