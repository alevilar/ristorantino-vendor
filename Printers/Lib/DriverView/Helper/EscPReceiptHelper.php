<?php

App::uses('PrinterHelperSkel', 'Printers.Lib/DriverView/Helper');

class EscPReceiptHelper extends PrinterHelperSkel
{    
         

     protected $_cmd = array(
        'ESC' => "\e",        
        'RETORNO_DE_CARRO' => array('chr', 13),
        'CORTAR_PAPEL' => "\ei",
        'ENFATIZADO' => "E",
        'SACA_ENFATIZADO' => 'F',
        'TEXT_STRONG' => 'N4',
        'TEXT_NORMAL' => 'N2',
        'DOBLE_ANCHO_ON' => '\eW1',
        'DOBLE_ANCHO_OFF' => '\eW0',
        'DOBLE_ALTO_ON' => '\ew1',
        'DOBLE_ALTO_OFF' => '\ew0',
        'SACA_DOBLE_ALTO' => 'd0',
    );
    
}
