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
    );

/**
 * Constructor
 * 
 * Builds the _cmd var calling function when is an array
 */        
    public function __construct(View $View, $settings = array()) {
        $parent_vars = get_class_vars(__CLASS__);
        $this->_cmd = $this->_cmd + $parent_vars['_cmd'];

        foreach ($this->_cmd as $c => $val) {
            if (is_array($val)){
                $functionName = array_shift($val);
                $this->_cmd[$c] = call_user_func($functionName, $c);
            }
        }
        return parent::__construct($View, $settings);
    }

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
            if ( !empty($this->_cmd[$name]) ) {
                return $this->_cmd[$name];
            } else {
                throw new InternalErrorException('Error, no existe el nombre del comando pasado: '.$name);
            }
            return '';
        }
              
}