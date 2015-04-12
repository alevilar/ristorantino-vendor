<?php

App::uses('PrinterOutput', 'Printers.PrinterOutput');

class TestPrinterOutput extends PrinterOutput
{
    
    public  $name = 'Test';
    
    
 
    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Prints empty files";
    }
    
    
/**
 * Crea un archivo y lo coloca en la carpeta /tmp
 * 
 * @param string $texto es el texto a imprimir
 * @param string $nombreImpresoraFiscal nombre de la impresora 
 * @param string $hostname nombre o IP del host
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
        public  function send( $printaitorViewObj ) {
            return true;
        }
        
}
?>
