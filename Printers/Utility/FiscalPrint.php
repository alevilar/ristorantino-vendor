<?php

App::uses('ClassRegistry', 'Utility');
App::uses('Printaitor', 'Printers.Utility');

class FiscalPrint 
{

	private static function __getFiscalPrinterId () {
		return Configure::read('Printers.fiscal_id');       
	}



	/**
	*
	*
	*
	*
	*
	**/
	public static function  cierre( $type = "x"){
		if ( strtolower( $type ) == 'z' ) {
			$viewname = 'cierre_z';
		} else {
			$viewname = 'cierre_x';
		}

		$send = Printaitor::send(array(),
				self::__getFiscalPrinterId(),
				$viewname // user vista comandas.ctp
			);

		return $send;
	}



	/**
	*
	*	@param $numero_ticket
	*	@param @importe
	*	@param @tipo
	*	@param @descripcion
	*
	*
	*
	**/
	public static function imprimirNotaDeCredito ( $numero_ticket, $importe, $tipo, $descripcion, $cliente = array() ) {
        
		$send = Printaitor::send(array(
				'numero_ticket' => $numero_ticket,
				'importe' => $importe,
				'tipo_factura' => $tipo,
				'descripcion' => $descripcion,
				'cliente' => $cliente,
				),
				self::__getFiscalPrinterId(),
				'nota_de_credito' // user vista comandas.ctp
			);

		return $send;
	}



	/**
	*
	*
	*
	*
	*
	**/
	public static function imprimirTicketMesa ( $mesaId ) {
		$Mesa = ClassRegistry::init('Mesa.Mesa');

		$Mesa->id = $mesaId;

        $mesa = $Mesa->find('first',array(
            'contain'=>array(
                'Mozo',
                'Cliente'=>array(
                    'Descuento',
                    'IvaResponsabilidad.TipoFactura',
                    'TipoDocumento',
                    ),
                'Descuento',
                ),
            'condition' => array(
                'Mesa.id' => $mesaId
            ),
        ));
        if (empty($mesa)) {
        	throw new CakeException("No se encontro mesa con el ID $mesaId");
        }

    	$tipo_factura = Configure::read('Printers.default_tipo_factura_codename');
        if( empty($mesa['Cliente']) || empty($mesa['Cliente']['id']) ){
            $mesa['Cliente'] = array();
        } elseif ( !empty($mesa['Cliente']['IvaResponsabilidad']['TipoFactura']['codename']) ) {
    		$tipo_factura = $mesa['Cliente']['IvaResponsabilidad']['TipoFactura']['codename'];
        }
        
        $mesa_numero = $mesa['Mesa']['numero'];
        $mozo_numero = $mesa['Mozo']['numero'];

        $cont  = 0;
        $total = 0;
        $prod = array();
        if ( $mesa['Mesa']['menu'] > 0 ) {
            $prod = $Mesa->getProductosSinDescripcion($mesa['Mesa']['menu']);
        } else {
            $prod = $Mesa->dameProductosParaTicket();
        }
        
        // agregar el valor del cubierto
        $valorCubierto = Configure::read('Restaurante.valorCubierto');
        if ( empty ( $valorCubierto ) ) {
            $valorCubierto = 0;
        }
        if ( $valorCubierto >= 0 && is_numeric($mesa['Mesa']['cant_comensales']) ) {
            $prod[] = array(
                'nombre'   => 'Cubiertos',
                'cantidad' => $mesa['Mesa']['cant_comensales'],
                'precio'   => $valorCubierto,
                        );
        }

        $importe_descuento = 0;
        if(!empty($mesa['Cliente']['Descuento']['porcentaje'])) {
            //$porcentaje_descuento = $mesa['Cliente']['Descuento']['porcentaje'];
            $importe_descuento = cqs_round($mesa['Mesa']['subtotal'] - $mesa['Mesa']['total']);
        }

        $imprimio = false;

        $printer_id = self::__getFiscalPrinterId();
        if ( Configure::read('Mesa.imprimePrimeroRemito') && $Mesa->estaAbierta()){
            $printer_id = Configure::read('Printers.receipt_id');
        }
        $send = Printaitor::send(array(
        		'fullMesa' => $mesa,
				'productos' => $prod,
				'importe_descuento' => $importe_descuento,
				'mozo' => $mozo_numero,
				'mesa' => $mesa_numero,
				'cliente' => $mesa['Cliente'],
				'tipo_factura' => $tipo_factura,
				),
				self::__getFiscalPrinterId(),
				'ticket' // user vista comandas.ctp
			);

        return $send;
	}
}
