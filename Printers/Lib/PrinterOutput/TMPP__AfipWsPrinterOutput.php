<?php

App::uses('PrinterOutput', 'Printers.PrinterOutput');


class AfipWsPrinterOutput extends PrinterOutput
{
/**
 * Engine Name
 * 
 * @var string
 */    
    public  $name = "AfipWs";
    

    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Sends files to print with Afip WS creating a PDF file";
    }
    
    
/**
 *  Do the print
 * 
 * @param string $texto es el texto a imprimir
 * @param string $nombreImpresoraFiscal nombre de la impresora 
 * @param string $hostname nombre o IP del host
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
    public  function send( $texto, $nombreImpresoraFiscal, $hostname = '' ) {
    	//$this->autenticar();
		
		debug("ingresando");

    	$cliente = new ClienteFacturaElectronica();

    }




}

