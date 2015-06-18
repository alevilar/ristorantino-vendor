<?php

App::uses('Helper','View');

abstract class PrinterHelperSkel extends Helper
{
 
/**
 * Set of base strings to use in formatting the output
 * 
 * @var array 
 */    
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