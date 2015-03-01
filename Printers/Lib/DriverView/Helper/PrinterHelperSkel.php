<?php

App::uses('Helper','View');

abstract class PrinterHelperSkel extends Helper
{
 
/**
 * Set of base strings to use in formatting the output
 * 
 * @var array 
 */    
    public $CR = "\x0D";
    public $LF = "\x0A";
    public $FS = "\x1C";
    public $ESC = "\x1B";
    public $DEL = "\x7F";
    public $CORTAR_PAPEL = "";
    public $ENFATIZADO = "";
    public $SACA_ENFATIZADO = "";
    public $TEXT_STRONG = "";
    public $TEXT_NORMAL = "";
    public $DOBLE_ALTO = "";
    public $SACA_DOBLE_ALTO = "";
    public $RETORNO_DE_CARRO = "";


/**
 *  Returns the string corresponding to the $_cmd var
 * 
 * @param string $name
 * @return string 
 */        
        public function cm ($name){
            $name = strtoupper($name);

            if ( property_exists( $this, $name) ) {
                return $this->{$name};
            } else {
                throw new CakeException("no existe el comando $name para la funcion chr() configurado para esta impresora");
            }
            return '';
        }
              
}