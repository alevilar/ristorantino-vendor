<?php

App::uses('ClassRegistry', 'Utility');
App::uses('Printaitor', 'Printers.Utility');

class ReceiptPrint
{


	private static function __getFiscalPrinterId () {
		return Configure::read('Printers.receipt_id');       
	}


    /**
     * Imprime una comanda en particular
     *
     * @param  id $comanda_id
     * @return null
     */
    public static function comanda ( Comanda $Comanda )
    {
    	$comanda_id = $Comanda->id;
    	
		$productos_x_comanda = array();
		// se supone que en una comanda yo no voy a tener productos que se impriman en comanderas distitas
		// (esto es separado desde el mismo controlador y se manda aimprimir a comandas diferentes)
		// pero , por las dudas que ésto suceda, cuando yo listo los productos de una comanda, me los separa para ser impreso en Comanderas distintas
		// Entonces, por lo genral (SIEMPRE) se imprimiria x 1 sola Comandera en este método del Componente

		$comanderas_involucradas = $Comanda->comanderas_involucradas($comanda_id);	

		// genero el array lindo paraimprimir por cada comanda
		// o sea, genero un renglón de la comanda
		// por ejmeplo me queraria algo asi:
		// "1) Milanesa de pollo\n"
    $comanderasRet = array();
		foreach($comanderas_involucradas as $printer_id):
			if ( !empty($printer_id) ) {
				$ret = Printaitor::send( $Comanda, $printer_id, 'comandas');
        $comanderasRet[$printer_id] = $ret;
			}
		endforeach;

    return $comanderasRet;
   }


   public static function mesa_detail ( $mesa_id ) {
   		$Comanda = ClassRegistry::init('Mesas.Mesa');
   }


   public static function imprimirTicketMesa ( Mesa $Mesa ) {
	   //	$Mesa = ClassRegistry::init('Mesa.Mesa');

   		$send = Printaitor::send( $Mesa, 
   								  self::__getFiscalPrinterId(), 
   								  'ticket' // user vista comandas.ctp
			);
   		
   		return $send;

   }


   public static function imprimirPedidoCompra ( Pedido $Pedido ) {
     // $Mesa = ClassRegistry::init('Mesa.Mesa');
      if ( !Configure::check('Printers.compras_id') ) {
        throw new CakeException("No hay una impresora de compras configurada. Puede seleccionar una impresora en la sección de configuración, si desea imprimir.");
        
      }
      $send = Printaitor::send( $Pedido, 
                    Configure::read('Printers.compras_id'), 
                    'pedidos' // user vista comandas.ctp
      );
      
      return $send;

   }
}