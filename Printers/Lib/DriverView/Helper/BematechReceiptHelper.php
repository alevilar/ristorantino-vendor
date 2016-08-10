<?php

App::uses('PrinterHelperSkel', 'Printers.Lib/DriverView/Helper');

class BematechReceiptHelper extends PrinterHelperSkel
{
    

    protected $_cm = array(
        'ESC'               => "\x1B",
        'INICIAR'           => "\x1B@",
        'RETORNO_DE_CARRO'  => "\r",
        'CORTAR_PAPEL'      => "\x1Bw",
        'CORTAR_PAPEL_PARCIAL' => "\x1Bm",
        'ENFATIZADO'        => "\x1BE",
        'SACA_ENFATIZADO'   => "\x1BF",
        'TEXT_STRONG'       => "\x1BN4",
        'TEXT_NORMAL'       => "\x1BN2",
        'DOBLE_ANCHO_ON'    => "\x1Bd1",
        'DOBLE_ANCHO_OFF'   => "\x1Bd0",
        'DOBLE_ALTO_ON'     => "\x1Bd1",
        'DOBLE_ALTO_OFF'    => "\x1Bd0",
        'BUZZER_ON'         => "\x1B\x28\x41\x04\x001991",
        'BUZZER_OFF'        => "\x1B\x28\x41\x04\x000111",
    );
    
}
