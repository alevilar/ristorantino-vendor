<?php 

/**
*
*       Variables para generar un ticket
*
*       @var Array $cliente (opcional) 
*           nombre            
*           nrodocumento
*           responsabiliad_iva
*           tipodocumento
*           domicilio
*       
*       @var String $tipo_factura (opcional)
*           
*       @var Array $productos
*           nombre
*           cantidad
*           precio
*
*       @var array fullMesa Todo el Objeto Mesa Completo
*
*       @var Float $importe_descuento  (opcional)
*
*       @var String|Int $mozo
*
*       @var String|Int $mesa
*
**/


if (empty($productos)) {
    throw new CakeException("Ticket: Faltan los productos");
}

if (empty($mozo)) {
    throw new CakeException("Ticket: Falta el Mozo");
}

if (empty($mesa)) {
    throw new CakeException("Ticket: Falta La mesa");
}



        echo $this->PE->cm('INICIAR'); // pongo el ESC para comenzar ESC/P 
        echo $this->PE->cm('DOBLE_ANCHO_OFF'); // pongo el ESC para comenzar ESC/P 
        
        
        /*****
         * 				 ENCABEZADO
         */
        $header = Configure::read('Adicion.preTicketHeader');
        if ( $header) {
            echo "\n";
            echo $header;
            echo "\n\n";
        }

      
        echo 'Fecha: '.date('d/m/y',strtotime('now')).'   Hora: '.date('H:i:s',strtotime('now'));
        echo "\n";
        echo "\n";
        echo "\n";

       



        //inserto los productos en vcomandas y cierro la mesa
        if (!empty($productos)) {

            echo str_pad('Cant.', 5, " ", STR_PAD_LEFT);
            echo str_pad('P.Unit.', 9, " ", STR_PAD_LEFT);
            echo str_pad('Item', 18, " ", STR_PAD_LEFT);
            echo str_pad('Total',8, " ", STR_PAD_LEFT);
            echo "\n";

            foreach ($productos as $p) {
                $cant = str_pad(cqs_round($p['cantidad']), 5, " ", STR_PAD_LEFT);
                $precio = str_pad(cqs_round($p['precio']), 9, " ", STR_PAD_LEFT);
                $itemNombre = str_pad($p['nombre'], 18, " ", STR_PAD_LEFT);
                $impTotal = str_pad("$".cqs_round($p['cantidad']*$p['precio']),8, " ", STR_PAD_LEFT);
                echo $cant.$precio.$itemNombre.$impTotal."\n";
            }
        }
     

        $subtotal = $fullMesa['Mesa']['subtotal']; // sin descuento
        $total = $fullMesa['Mesa']['total']; // con descuento si lo tiene
        $importe_descuento = abs($total - $subtotal);

        echo "----------------------------------------\n";
        
        if( $importe_descuento ){
                $subtotal = "$".cqs_round($subtotal);
                echo str_pad('SUBTOTAL', 25, " ", STR_PAD_RIGHT );
                echo str_pad( $subtotal, 15, " ", STR_PAD_LEFT);
                echo "\n";


                $importe_descuento = "-$".cqs_round($importe_descuento);
                echo str_pad('DTO.', 25, " ", STR_PAD_RIGHT );
                echo str_pad( $importe_descuento, 15, " ", STR_PAD_LEFT);
                echo "\n";
        }

        $total = "$".cqs_round($total);
        echo $this->PE->cm('DOBLE_ANCHO_ON');
        echo 'TOTAL';
        echo str_pad( $total, 19, " ", STR_PAD_LEFT);
        
        echo "\n\n";


        echo str_pad(strtoupper( Configure::read('Mesa.tituloMesa') ) . ": ".$mesa, 10, " ", STR_PAD_LEFT );
        echo "  |  ";
        echo str_pad(strtoupper( Configure::read('Mesa.tituloMozo') ) . ": ".$mozo, 11, " ", STR_PAD_RIGHT);


        echo $this->PE->cm('DOBLE_ANCHO_OFF');

        //  retorno de carro
        echo $this->PE->cm('RETORNO_DE_CARRO');


        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";  
        echo "\n";
        echo "\n";        



        // probando corte completo ESC/P
        echo $this->PE->cm('CORTAR_PAPEL');
