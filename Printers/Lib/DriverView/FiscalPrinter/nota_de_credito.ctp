<?php

/**
*
*		@var Char $tipo_factura Tipo de Factura (A o C si es consumidor final)
*
*       @var Array $cliente (opcional) 
*           nombre            
*           nrodocumento
*           responsabiliad_iva
*           tipodocumento
*           domicilio
*       
*           
*       @var String|Int $numero_ticket El numero del ticket original
*
*       @var String $descripcion escripcion de la nota
*
*       @var Float $importe
*
*
*
**/
if (empty($tipo_factura)) {
    throw new CakeException("Ticket: Falta el tipo de factura");
}

if (empty($numero_ticket)) {
    throw new CakeException("Ticket: Se debe ingresar el numero de Ticket");
}

if (empty($descripcion)) {
    throw new CakeException("Ticket: Debe ingresar una descripción");
}

if (empty($importe)) {
    throw new CakeException("Ticket: El importe no puede quedar vacío");
}




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
} else {
    //condumidor Final
    echo $this->PE->setCustomerData();
    echo "\n";
}


echo $this->PE->setEmbarkNumber( $numero_ticket );
echo "\n";
echo $this->PE->openDNFH( $this->PE->arrayMapNCTipoTicket[$tipo_factura] );
echo "\n";
echo $this->PE->printLineItem( $descripcion, 1, $importe);
echo "\n";
echo $this->PE->closeDNFH();