<?php

App::uses('Helper','View');

abstract class PrinterHelperSkel extends Helper
{
 
/**
 * Set of base strings to use in formatting the output
 * 
 * you can call functions here, for example doing this:
 * 
 *      $_cmd = array(
 *          'CORTAR_PAPEL' => array('chr', 114);
 *      )
 * 
 * So, the constructor will call chr(114) and will return the 
 * char value of that number
 *
 * @var array 
 */    
    protected $_cmd = array(
        'ESC' => '',
        'CORTAR_PAPEL' => '',
        'CORTAR_PAPEL' => '',
        'ENFATIZADO' => '',
        'SACA_ENFATIZADO' => '',
        'TEXT_STRONG' => '',
        'TEXT_NORMAL' => '',
        'DOBLE_ALTO' => '',
        'SACA_DOBLE_ALTO' => '',
        'RETORNO_DE_CARRO' => '',
        'CR' => '',
        'LF' => '',
    );



/**
 *  Returns the string corresponding to the $_cmd var
 * 
 * @param string $name
 * @return string 
 */        
        public function cm($name = null){
            if (empty($name)) {
                return $this->_cmd;
            }

            $name = strtoupper($name);
            if ( !array_key_exists($name, $this->_cmd) ) {
                CakeLog::write('debug', "CMMMDD :::  ". $this->_cmd[$name]);
                return $this->_cmd[$name];
            }
            return '';
        }
              
}