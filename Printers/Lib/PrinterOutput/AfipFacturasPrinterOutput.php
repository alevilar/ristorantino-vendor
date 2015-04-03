<?php

App::uses('PrinterJob', 'Printers.Model');
App::uses('PrinterOutput', 'Printers.Lib/PrinterOutput');

/**
* Crea un archivo y lo guarda en la tabla afip_facturas
**/
class AfipFacturasPrinterOutput extends PrinterOutput
{
    
    public  $name = 'AfipFacturas';


    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Prints files saving into database";
    }
    
    
/**
 * Crea un archivo y lo guarda en la tabla afip_facturas
 * 
 * @param PrintaitorViewObj $printaitorViewObj
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
        public  function send( $printaitorViewObj  ) {        	
            $factura['AfipFactura'] = array(
            		'json_data' => $printaitorViewObj->viewTextRender,
            		'mesa_id' => $printaitorViewObj->dataToView['mesa'],
            		'punto_de_venta' => $printaitorViewObj->puntoDeVenta,
            		'comprobante_nro' => $printaitorViewObj->comprobanteNro,
            		'cae' => $printaitorViewObj->cae,
            	);

            return ClassRegistry::init("Printers.AfipFactura")->save($factura);
        }
        
}
