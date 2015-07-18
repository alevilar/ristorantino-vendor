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
*       @var String $tipo_factura
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
if (empty($tipo_factura_id)) {
    throw new CakeException("Ticket: Falta el tipo de factura");
}

if (empty($productos)) {
    throw new CakeException("Ticket: Faltan los productos");
}

if (empty($mozo)) {
    throw new CakeException("Ticket: Falta el Mozo");
}

if (empty($mesa)) {
    throw new CakeException("Ticket: Falta La mesa");
}


//setteo el pie de pagina con el numero de mozo y mesa

echo $this->PE->setTrailer(0, "-  -  -  -  -  -  -  -"); echo "\n";

if ( Configure::check('Mesa.tituloMozo') ) {
    $mozoTitle = Configure::read('Mesa.tituloMozo');
    echo $this->PE->setTrailer(1, "$mozoTitle $mozo ", true); echo "\n";
} else { // no escribir nada
    echo $this->PE->setTrailer(1, " ", true); echo "\n";
}

if ( Configure::check('Mesa.tituloMesa') ) {
    $mesaTitle = Configure::read('Mesa.tituloMesa');
    echo $this->PE->setTrailer(2, "$mesaTitle $mesa", true); echo "\n";
} else { // no escribir nada
    echo $this->PE->setTrailer(2, " ", true); echo "\n";
}

echo $this->PE->setTrailer(3, "-  -  -  -  -  -  -  -"); echo "\n";


echo $this->PE->setTrailer(6, "  ORIENTACION AL CONSUMIDOR PROVINCIA"); echo "\n";
echo $this->PE->setTrailer(7, "     DE BUENOS AIRES 0-800-333-6422"); echo "\n";


//abro el tiquet consumidor final
if (!empty($cliente)) {
   
    $tipoDoc = null;
    if ( !empty($cliente['TipoDocumento']) ) {
        $tipoDoc = $cliente['TipoDocumento']['codigo_fiscal'];
    }

    $respoIva = null;
    if ( !empty($cliente['IvaResponsabilidad']) ) {
        $respoIva = $cliente['IvaResponsabilidad']['codigo_fiscal'];
    }
    echo $this->PE->setCustomerData($cliente['nombre'], 
                                    $cliente['nrodocumento'], 
                                    $respoIva, 
                                    $tipoDoc, 
                                    $cliente['domicilio']
    ); echo "\n";
}

//abro el tiquet poniendo la condicion ante el iva seleccionada
echo $this->PE->openFiscalReceipt($tipo_factura_id); echo "\n";



//inserto los productos en vcomandas y cierro la mesa
if (!empty($productos)) {
    $ivaPorcent = Configure::read('Afip.default_iva_porcentaje');
    foreach ($productos as $p) {

        echo $this->PE->printLineItem(
                $p['nombre'], cqs_round( $p['cantidad'] ), cqs_round( $p['precio'] ), $ivaPorcent ); echo "\n";
    }
}

if (!empty($importe_descuento)) {
    $customer =  trim($this->PE->generalDiscount($importe_descuento));
    if (!empty($customer)) {
        echo $customer."\n";
    }
}

echo $this->PE->closeFiscalReceipt(); echo "\n";

