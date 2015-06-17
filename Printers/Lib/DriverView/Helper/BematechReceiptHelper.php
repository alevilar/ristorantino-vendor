<?php

App::uses('PrinterHelperSkel', 'Printers.Lib/DriverView/Helper');

class BematechReceiptHelper extends PrinterHelperSkel
{
    

    protected $_cmd = array(
        'ESC'               => "\x1B",
        'RETORNO_DE_CARRO'  => "\r",
        'INICIAR'           => "\x1B@",
        'CORTAR_PAPEL'      => "\x1Bw",
        'ENFATIZADO'        => "\x1BE",
        'SACA_ENFATIZADO'   => "\x1BF",
        'TEXT_STRONG'       => "\x1BN4",
        'TEXT_NORMAL'       => "\x1BN2",
        'DOBLE_ANCHO_ON'    => "\x1BW1",
        'DOBLE_ANCHO_OFF'   => "\x1BW0",
        'DOBLE_ALTO_ON'     => "\x1Bd1",
        'DOBLE_ALTO_OFF'    => "\x1Bd0",
    );
    
}
