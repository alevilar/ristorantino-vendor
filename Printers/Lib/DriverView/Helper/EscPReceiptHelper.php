<?php

App::uses('PrinterHelperSkel', 'Printers.Lib/DriverView/Helper');

class EscPReceiptHelper extends PrinterHelperSkel
{    
         

    protected $_cm = array(
        'ESC'               => "\x1B",        
        'INICIAR'           => "\x1B@",
        'RETORNO_DE_CARRO'  => "\r",
        'CORTAR_PAPEL'      => "\x1Bi",
        'ENFATIZADO'        => "\x1BE",
        'SACA_ENFATIZADO'   => "\x1BF",
        'TEXT_STRONG'       => "\x1BN4",
        'TEXT_NORMAL'       => "\x1BN2",
        'DOBLE_ANCHO_ON'    => "\x1BW1",
        'DOBLE_ANCHO_OFF'   => "\x1BW0",
        'DOBLE_ALTO_ON'     => "\x1Bw1",
        'DOBLE_ALTO_OFF'    => "\x1Bw0",
        'SACA_DOBLE_ALTO'   => "\x1Bd0",
    );
    
}
