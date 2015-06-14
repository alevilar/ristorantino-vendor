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



        echo $this->PE->cm('ESC').'@'; // pongo el ESC para comenzar ESC/P 
        
        
        /*****
         * 				 ENCABEZADO
         */
        $header = Configure::read('Adicion.preTicketHeader');
        if ($header) {
            echo $header;
            echo "\n\n";
        }

      
        echo 'Fecha: '.date('d/m/y',strtotime('now')).'   Hora: '.date('H:i:s',strtotime('now'));
        echo "\n";
        echo "\n";
        echo "\n";

       



        //inserto los productos en vcomandas y cierro la mesa
        if (!empty($productos)) {
            echo 'Cant. P.Unit.  Item               Total';
            echo "\n";

            foreach ($productos as $p) {
                $cant = str_pad($p['cantidad'], 5, " ", STR_PAD_LEFT);
                $precio = str_pad(cqs_round($p['precio']), 9, " ", STR_PAD_LEFT);
                $itemNombre = str_pad($p['nombre'], 18, " ", STR_PAD_LEFT);
                $impTotal = str_pad(cqs_round($p['cantidad']*$p['precio']),8, " ", STR_PAD_LEFT);
                echo $cant.$precio.$itemNombre.$impTotal."\n";
            }
        }
     

        $subtotal = $fullMesa['Mesa']['subtotal']; // sin descuento
        $total = $fullMesa['Mesa']['total']; // con descuento si lo tiene

        if($importe_descuento){
                $tail = " -     SUBTOTAL                $$subtotal";
                echo $tail;
                echo "\n";

                $tail = " -     DTO.                   -$$importe_descuento";
                echo $tail;
                echo "\n";
        }

                $tail = " -     TOTAL                   $".$total;
        echo $tail;

        echo "\n\n";

        $tail  = " \n - " . strtoupper( Configure::read('Mesa.tituloMozo') ) . ": ".$mozo;
        $tail .= " \n - " . strtoupper( Configure::read('Mesa.tituloMesa') ) . ": ".$mesa."\n";
        echo $tail;

        //  retorno de carro
        echo chr(13);


        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";        



        // probando corte completo ESC/P
        echo $this->PE->cm('ESC').'i';
        echo $this->PE->cm('CORTAR_PAPEL').'i';
