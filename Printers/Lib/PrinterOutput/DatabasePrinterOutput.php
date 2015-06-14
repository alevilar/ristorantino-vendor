<?php

App::uses('PrinterJob', 'Printers.Model');
App::uses('PrinterOutput', 'Printers.Lib/PrinterOutput');

class DatabasePrinterOutput extends PrinterOutput
{
    
    public  $name = 'Database';


    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Prints files saving into database";
    }
    
    
/**
 * Crea un archivo y lo coloca en la carpeta /tmp
 * 
 * @param string $texto es el texto a imprimir
 * @param string $printer_id Id de la impresora 
 * @param string $hostname nombre o IP del host
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
        public  function send( $printaitorViewObj ) {

            $printJob['PrinterJob'] = array(
            		'text' => $printaitorViewObj->viewTextRender,
            		'printer_id' => $printaitorViewObj->printerId,
                );
            $PrinterJob = ClassRegistry::init("Printers.PrinterJob");
            $save = $PrinterJob->save($printJob);
            if ( !$save ) {
                throw new CakeException("No se pudo guardar en en la DB el PrintJob");                
            }
            return true;
        }
        
}
