<?php

App::uses('PrinterOutput', 'Printers.PrinterOutput');
App::uses('ClassRegistry', 'Cake.Utility');
App::uses('CakeLog', 'Log');


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
                $hostname = Configure::read('Printers.server');
            }            
            
            if ( $hostname == 'auto' ) {
                $hostname = getenv('HTTP_X_FORWARDED_FOR');
                if ( empty($hostname) ){
                    $hostname = $_SERVER['REMOTE_ADDR'];
                }
            }


            $Printer = ClassRegistry::init('Printers.Printer');
            $printer = $Printer->read(null, $idFiscalPrinter);            
            
            // cambiar el encoding del texto si esta configurado
            $encoding = Configure::read('Printers.encoding');
            if (!empty( $encoding )) {
                $texto = mb_convert_encoding($texto, $encoding, mb_detect_encoding($texto));
            }
                  
            // preparar argumentos del proc_open
            $descriptorspec = array(
               0 => array("pipe", "r"), //esto lo uso para mandarle comandos
               1 => array("pipe", "w"),  // el stdout a un archivo tmp
               2 => array("file", "/tmp/lprerrout.txt", "a") // el stderr a un archivo tmp
            );
            $comando = 'lp -h '.$hostname.' -d '.$printer['Printer']['alias'];

            CakeLog::write('debug', "Se envió a imprimir por CUPS ::: $comando");

            $process = proc_open($comando, $descriptorspec, $pipes, '/tmp', null);

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