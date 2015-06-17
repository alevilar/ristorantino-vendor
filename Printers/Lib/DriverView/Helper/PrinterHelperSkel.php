<?php

App::uses('Helper','View');

abstract class PrinterHelperSkel extends Helper
{
 
/**
 * Set of base strings to use in formatting the output
 * 
 * @var array 
 */    

    protected $_cmd = array(
        'CR' => "\x0D",
        'LF' => "\x0A",
        'FS' => "\x1C",
        'ESC' => "\x1B",
        'DEL' => "\x7F",
        'CORTAR_PAPEL' => "",
        'ENFATIZADO' => "",
        'SACA_ENFATIZADO' => "",
        'TEXT_STRONG' => "",
        'TEXT_NORMAL' => "",
        'DOBLE_ALTO' => "",
        'SACA_DOBLE_ALTO' => "",
        'RETORNO_DE_CARRO' => "",
        'DOBLE_ANCHO_ON' => '',
        'DOBLE_ANCHO_OFF' => '',
        'DOBLE_ALTO_ON' => '',
        'DOBLE_ALTO_OFF' => '',
        'SACA_DOBLE_ALTO' => '',
    );

    


    // extra CM
    protected $_cm = array();

/**
 *  Returns the string corresponding to the $_cmd var
 * 
 * @param string $name
 * @return string 
 */        
        public function cm ($name){
            $name = strtoupper($name);
        
            if (array_key_exists($name, $this->_cm)) {
                return $this->_cm[$name];
            }
            CakeLog::write('debug',"no existe el comando $name para la funcion chr() configurado para esta impresora En los Helpers por modelo");
        
            return '';
        }
              
}