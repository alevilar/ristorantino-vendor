<?php

/**
*
*
*       Variables para generar un ticket
*
*			$this->printaitorObj Expone el Objeto PrintaitorViewObj
*
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



//AfipWsv1::FEParamGetTiposTributos();
echo json_encode($this->printaitorObj->dataToView);