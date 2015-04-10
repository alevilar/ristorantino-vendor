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
    public static function comanda ( $Comanda )
    {
    	$comanda_id = $Comanda->id;
    	
		$productos_x_comanda = array();
		// se supone que en una comanda yo no voy a tener productos que se impriman en comanderas distitas
		// (esto es separado desde el mismo controlador y se manda aimprimir a comandas diferentes)
		// pero , por las dudas que ésto suceda, cuando yo listo los productos de una comanda, me los separa para ser impreso en Comanderas distintas
		// Entonces, por lo genral (SIEMPRE) se imprimiria x 1 sola Comandera en este método del Componente

		$comanderas_involucradas = $Comanda->comanderas_involucradas($comanda_id);

		$entradas = $Comanda->listado_de_productos_con_sabores($comanda_id, DETALLE_COMANDA_TRAER_ENTRADAS);
		$platos_principales = $Comanda->listado_de_productos_con_sabores($comanda_id, DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES);

		$productos = array_merge($entradas, $platos_principales);

		// genero el array lindo paraimprimir por cada comanda
		// o sea, genero un renglón de la comanda
		// por ejmeplo me queraria algo asi:
		// "1) Milanesa de pollo\n"
		foreach($comanderas_involucradas as $printer_id):
			if ( !empty($printer_id) ) {
				Printaitor::send(array(
						'productos' => $productos,
						'entradas' => $entradas,
						),
						$printer_id,
						'comandas' // user vista comandas.ctp
				);
			}
		endforeach;
   }


   public static function mesa_detail ( $mesa_id ) {
   		$Comanda = ClassRegistry::init('Mesas.Mesa');
   }


   public static function imprimirTicketMesa ( $Mesa ) {
	   //	$Mesa = ClassRegistry::init('Mesa.Mesa');

   		$send = Printaitor::send( 
   				$Mesa->getFullDataForTicket(),
				self::__getFiscalPrinterId(),
				'ticket' // user vista comandas.ctp
			);
   		
   		return $send;

   }
}