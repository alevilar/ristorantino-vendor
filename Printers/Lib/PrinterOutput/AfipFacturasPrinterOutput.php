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
            		'mesa_id' => $printaitorViewObj->dataToView['fullMesa']['Mesa']['id'],
                    'importe_total' => $printaitorViewObj->dataToView['fullMesa']['Mesa']['total'],
                    'importe_neto' => $printaitorViewObj->dataToView['AfipFactura']['subtotal'],
                    'importe_iva' => $printaitorViewObj->dataToView['fullMesa']['Mesa']['total'] - $printaitorViewObj->dataToView['AfipFactura']['subtotal'],
            		'punto_de_venta' => $printaitorViewObj->puntoDeVenta,
            		'comprobante_nro' => $printaitorViewObj->comprobanteNro,
            		'cae' => $printaitorViewObj->cae,
            	);

            $AfipFactura = ClassRegistry::init("Printers.AfipFactura");
            $factura = $AfipFactura->save($factura);
            if ( !$factura ) {
                foreach ( $AfipFactura->validationErrors as $field => $msg) {
                    $msgErr = implode(',', $msg);
                    throw new CakeException( __("No se pudo guardar la factura. Campo: %s, Error: %s", $field, $msgErr), 1);
                }
            }
            return $factura;
        }
        
}
