<?php

App::uses('PrinterOutput', 'Printers.PrinterOutput');
App::uses('ClassRegistry', 'Cake.Utility');

class CupsPrinterOutput extends PrinterOutput
{
  public $name = 'Cups';
    
/**
 * Returns name of the printer engine 
 * @return string
 */   
    public  function name(){
        return $this->name;
    }
    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Sends files to print with CUPS server Configured in CONFIG page";
    }
    
    
    
/**
 *  Comando cups de impresion
 * 
 * @param string $texto es el texto a imprimir
 * @param string $idFiscalPrinter nombre CUPS de la impresora 
 * @param string $hostname nombre o IP del host
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
        public  function send( $texto, $idFiscalPrinter, $hostname = '' ) {
            if ( empty($hostname) ) {
                $hostname = Configure::read('ImpresoraFiscal.server');
            }

            $Printer = ClassRegistry::init('Printers.Printer');
            $printer = $Printer->read($idFiscalPrinter);
            
            // cambiar el encoding del texto si esta configurado
            $encoding = Configure::read('ImpresoraFiscal.encoding');
            if (!empty( $encoding )) {
                $texto = mb_convert_encoding($texto, $encoding, mb_detect_encoding($texto));
            }
                  
            // preparar argumentos del proc_open
            $descriptorspec = array(
               0 => array("pipe", "r"), //esto lo uso para mandarle comandos
               1 => array("pipe", "w"),  // el stdout a un archivo tmp
               2 => array("file", "/tmp/lprerrout.txt", "a") // el stderr a un archivo tmp
            );
            $process = proc_open('lp -h '.$hostname.' -d '.$printer['Printer']['name'], $descriptorspec, $pipes, '/tmp', null);

            // escribir en el pipe de escritura
            if (is_resource($process)) 
            {
                    fwrite($pipes[0],$texto);
                    fclose($pipes[0]);
                    fclose($pipes[1]);
                    $ret =  proc_close($process);
                    return true;
            }
            return false;
        }
        
}