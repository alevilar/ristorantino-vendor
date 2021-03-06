<?php 

App::uses('FiscalPrinterHelper', 'Printers.Lib/DriverView/Helper');


class Hasar1120fFiscalHelper extends FiscalPrinterHelper
{
	

	/**
	*
	* Mapea el ID del ristornatino con el de la Hasar 441
	**/
  	public $arrayMapTipoTicket = array(
			RISTO_TIPO_FACTURA_A_ID => 'A',
			RISTO_TIPO_FACTURA_B_ID => 'B',
			RISTO_TIPO_FACTURA_C_ID => 'C',			
  		);


	/**
	 * Me abre un documento fiscal
	 * 
	 * @param $tipo_ticket el topo de ticket que quiero abrir
	 * las psobilidades son:
	 *		A. Factura A
	 *		B: Factura B o C
	 *		a: Recibo A
	 *		b: Recibo B o C
	 *		D: Nota de Débito A
	 *		E: Nota de Débito B o C
	 */
	public function openFiscalReceipt( $tipo_ticket = RISTO_TIPO_FACTURA_B_ID){
		$tipo_ticket = $this->arrayMapTipoTicket[$tipo_ticket];
        if ($tipo_ticket == 'T') {
            $tipo_ticket = 'B';
        }

		return "@".$this->cm('FS').$tipo_ticket.$this->cm('FS')."T";
	}
	
	/**
	 * Imprime texto fiscal que se muestra por lo general antes de los articulos. 
	 * No puede contener la palabra TOTAL, porque se puede bloquear la impresora
	 */
	public function printFiscalText($texto, $doble_ancho = false ,$display = 0){
		$texto = substr($texto,0,30);
		if($doble_ancho){
			$texto = $this->cm('DOBLE_ANCHO').$texto;
		}
		return "A".$this->cm('FS').$texto.$this->cm('FS').$display;
	}
	
	
	/**
	 *  Imprime un articulo, o sea una linea del articulo con su description y su precio, cantidad, etc
	 *  
	 *  @param string $descripcion_articulo descripcion del articulo EJ: Coca-Cola hasta 23 caracteres
	 *  @param number $cantidad puede ser un entero o un float depende de la impresora
	 *  @param number $monto float o integer depende de laimpresora
	 *  @param number $porcentaje_iva depende de la impresora algunas hay queponerle el porcentaje estilo 21.00, y otras va un 0.21
	 *  @param boolean $suma dice si el item suma o resta
	 *	@param number $impuesto_interno puede ser float o integer dependiendo laimpresora
	 *	@param number $display si la impresora tiene display aca va un digito especial para que sepa que mostrar en el display
	 *	@param boolean $precio_totalsi es precio tital quiere decir que el precio que le pasé como parametro tiene el IVA incluido, caso contrario, el precio es sin IVA y la impresora se lo va a sumar automaticamente de acuerdo al IVA qe se le pasó cmo parametro
	 */
	public function printLineItem($descripcion_articulo, $cantidad, $monto, $porcentaje_iva = 21, $suma = true, $impuesto_interno = 0, $display = 0, $precio_total = true){
		$fs = $this->cm('FS');
		$descripcion_articulo = substr($descripcion_articulo,0,23);
		
		if(!is_numeric($cantidad)) return false;
		if(!is_numeric($monto)) return false;
		$suma_monto = $suma?'M':'m';
		$precio_total = $precio_total?'T':'B';
		
		$comando = "B".$fs.$descripcion_articulo.$fs.$cantidad.$fs.$monto.$fs.$porcentaje_iva.$fs.$suma_monto.$fs.$impuesto_interno.$fs.$display.$fs.$precio_total; 
		return $comando;
	}


        /**
        *    Responde:
        *    a. Imprimiendo una línea donde se muestra: descripción del descuento (o recargo), impuestos y monto del
        *        descuento (o recargo) -con posterioridad a la impresión de la línea con la leyenda “Descuento (o Recargo)
        *           general”-;
        *    b. Restando
		*
        *    EJEMPLO: T∟Pago Efectivo...∟5.0∟m∟0∟T
		*
         * @param float $porcentaje_descuento
         * @return string comando
         */
        public function generalDiscount($porcentaje_descuento = 0){
            $comando =  "T".$this->cm('FS').
                        'Descuento'.$this->cm('FS').
                        $porcentaje_descuento.$this->cm('FS').
                        'm'.$this->cm('FS').
                        '0'.$this->cm('FS').
                        'T';
            return $comando;
        }
	
	
	/**
	 * TotalPago
	 * 
	 * @param string $texto Ejemplo: "Pago en efectivo"
	 * @param number $monto_pagado integer o float dependiendo de la impresora
	 * @param $operacion las piopsibilidades son:
	 * 											'C': Cancela el ticket
	 * 											'T': pago parcial o total 
	 * 											'R': devolucion de pago
	 * @param $display	 para las impresoras que tengan display
	 */
	public function totalTender($texto, $monto_pagado, $operacion = "T", $display = 0){
		$texto = substr($texto,0,28);
		
		$operacion = strtoupper($operacion);
		if( is_numeric($monto_pagado) && 
			($operacion == 'C' || $operacion == 'T' || $operacion == 'R'))
		{
			$comando = "D".$this->cm('FS').$texto.$this->cm('FS').$monto_pagado.$this->cm('FS').$operacion.$this->cm('FS').$display;
		}
		else{
			$comando = false;
		}
		
		return $comando;
	}
	
	
	/**
	 * Cierra el comprobante
	 * @param integer $cant_copias 	pr ahora solo vi que funcione en la Hasar 441. Este parametro dice cuantas copias iprimir del comprobante
	 * 								pr default va cero porque solo funciona en 1 modelo y pr lo general esta funcion no es util
	 */
	public function closeFiscalReceipt($cant_copias = 0){
		$comando =  "E".$this->cm('FS').$cant_copias;
		return $comando;
	}
	
	
	/**
	 * Imprime el comprobante X/Z
	 * 
	 * @param $tipo_cierre puede ser:
	 * 								'X': imprime un cierre X
	 * 								'Z': imprime un cierre Z
	 */
	public function dailyClose($tipo_cierre = 'X'){
		$tipo_cierre = strtoupper($tipo_cierre);
		if($tipo_cierre == 'X' || $tipo_cierre == 'Z'){
			$comando = "9".$this->cm('FS').$tipo_cierre;	
		}
		else{
			$comando = false;
		}
		return $comando;
	}
	
	
	/**
	 * Consulta de estado
	 */
	public function statusRequest(){
		return "*";
	}
	
	/**
	 * Consulta de estado aunque se esta ejecutando un comando
	 * es especial para cuando quiero recuperar ael estado de error actual de la impresora PEJ: Falta papel
	 */
	public function statPRN(){
		return "¡";
	}
	
	
	
	/**
	 * Setea fecha y hora
	 */
	public function setDateTime($fecha = 'now', $hora = 'now'){
		$ymd = date("ymd",strtotime($fecha)) ;
		$his = date("His",strtotime($hora)) ;
		return "X".$this->cm('FS').$ymd.$this->cm('FS').$his;
	}
	
	
	/**
	 * Setea el encabezado y el pie de pagina
	 * 
	 * @param integer $numero_de_linea
	 * 						ENCABEZADO: linea 1  - 10
	 * 						COLA: 		linea 11 - 20
	 * 						BORRA ENCABEZADO Y COLA: linea =  0
	 * 						BORRA ENCABEZADO: numero linea = -1
	 * 						BORRA COLA: 	  numero linea = -2 
	 * @param $texto 45 caracteres maximo
	 */
	public function setHeaderTrailer($numero_de_linea,$texto = "-",$doble_ancho = false){
		$texto = substr($texto,0,45);
		if ($numero_de_linea > -3 && $numero_de_linea <= 0){
			$comando = "]".$this->cm('FS').$numero_de_linea;
		}
		if ($numero_de_linea > 0 && $numero_de_linea < 21){
			if($doble_ancho){
				$texto = $this->cm('DOBLE_ANCHO').$texto;
			}
			$comando = "]".$this->cm('FS').$numero_de_linea.$this->cm('FS').$texto;
		}
		else{
			$comando = false;
		}
		return $comando;
	}
	
	
	/**
	 * Elimina dememoria el encabezado y el pie de pagina
	 * @return string $comando
	 */
	public function delHeaderTrailer(){
		// $comando = "]".$this->cm('FS')."0".$this->cm('FS').$this->cm('DEL');
		$comando = '';
		return $comando;
	}
	
	
	/**
	 * Elimina dememoria el encabezado
	 * @return string $comando
	 */
	public function delHeader(){
		$comando = "]".$this->cm('FS')."-1".$this->cm('FS').$this->cm('DEL');
		return $comando;
	}
	
	
	/**
	 * Elimina dememoria el pie de pagina
	 * @return string $comando
	 */
	public function delTrailer(){
		$comando = "]".$this->cm('FS')."-2/".$this->cm('FS').$this->cm('DEL');
		return $comando;
	}
	
	
	/**
	 * Setea el encabezado
	 * 
	 * @param integer $linea de 0 a 9
	 * @param string $texto 45 caracteres maximo
	 */
	public function setHeader($linea ,$texto,$doble_ancho = false){
		//COLA: 		linea 11 - 20
		$texto = substr($texto,0,45);
		if ($linea > -1 && $linea < 10){
			$numero_de_linea = 1+$linea;
			if($doble_ancho){
				$texto = $this->cm('DOBLE_ANCHO').$texto;
			}
			$comando = "]".$this->cm('FS').$numero_de_linea.$this->cm('FS').$texto;
		}
		else{
			$comando = false;
		}
		return $comando;
	}
	
	
	/**
	 * Setea el pie de pagina
	 * 
	 * @param integer $linea de 0 a 9
	 * @param string $texto 45 caracteres maximo
	 */
	public function setTrailer($linea ,$texto,$doble_ancho = false){
		//COLA: 		linea 11 - 20
		$texto = substr($texto,0,45);
		if ($linea > -1 && $linea < 10){
			if($doble_ancho){
				$texto = $this->cm('DOBLE_ANCHO').$texto;
			}
			$numero_de_linea = 11+$linea;
			$comando = "]".$this->cm('FS').$numero_de_linea.$this->cm('FS').$texto;
		}
		else{
			$comando = false;
		}
		return $comando;
	}
	
	
	/**
	 * Setea los datos del Cliente, por lo general se usa para hacer factura A
	 * 
	 * @param string $nombre_cliente nombre o razon social
	 * @param integer $documento valor del DNI, CIUT, CUIL, etc
	 * @param CHAR $respo_iva
	 * 					'I' responsable inscripto
	 * 					'E' Excento
	 * 					'A' No responsable
	 * 					'C' Consumidor final
	 * 					'T' No categorizado
	 * @param CHAR $tipo_documento
	 * 					'C' CUIT
	 * 					'L' CUIL
	 * 					'0' Lbreta enrolamiento
	 * 					'1' Libreta civica
	 * 					'2' DNI
	 * 					'3' Pasaporte
	 * 					'4' Cedula de Identidad
	 * @param string $domicilio
	 */
	public function setCustomerData($nombre_cliente = " ",$documento = " ",$respo_iva = 'C', $tipo_documento = " ", $domicilio = '-') {
		$nombre_cliente = substr($nombre_cliente,0,45);
		$respo_iva = strtoupper($respo_iva);
		$tipo_documento = strtoupper($tipo_documento);
        $domicilio = empty(trim($domicilio))?'.':$domicilio;

		
		if($respo_iva == 'I' || $respo_iva == 'E' || $respo_iva == 'A' || $respo_iva == 'C' || $respo_iva == 'T'){
			if( $tipo_documento == 'C' || $tipo_documento == 'L' || $tipo_documento == '0' || $tipo_documento == '1' || $tipo_documento == '2' || $tipo_documento == '3' || $tipo_documento == '4')
			{	
				$comando = "b".$this->cm('FS').$nombre_cliente.$this->cm('FS').$documento.$this->cm('FS').$respo_iva.$this->cm('FS').$tipo_documento.$this->cm('FS').$domicilio;
                $comando .= $this->cm('FS').$domicilio;
			}
			else{ 	
				throw new CakeException("Tipo de documento no válido: \"$tipo_documento\"");
			}	
		} else{
			throw new CakeException("Responsabilidad ante el IVA inválido: \"$respo_iva\"");
		}
		return $comando;
	}



        /**
         * Longitud
         *   ô (93H - ASCII 147)
         *   FS
         *   No de línea de comprobante original (1-2)
         *   0: borra ambas líneas (sólo modelos SMH/P-PR5F -versión 2.01-, SMH/P-715F
         *   -versiones 3.02 y posteriores-, y SMH/P-441F)
         *   FS
         *   Texto de hasta 20 caracteres
         *   Ejemplo: ô∟1∟00000118
		 *
         */
        public function setEmbarkNumber( $numeroTicket, $nlinea = 1){
            return "\x93".$this->cm('FS').$nlinea.$this->cm('FS').$numeroTicket;
        }




        /**
         * Tipo de documento
         *   R: Nota de crédito ‘A’
         *   S: Nota de crédito ‘B/C’
         *   x: Tique recibo ‘X’
         *   <: Tique pagaré
         *   ,: Tique presupuesto
         *   -: Comp. de entrega
         *   .: Talón Estacionamiento
         *   /: Cobro de Servicios
         *   0: Ingreso de Dinero
         *   1: Retiro de Dinero
         *   2: Talón de Cambio
         *   3: Talón de reparto
         *   4: Talón de regalo
         *   5: Cuenta Corriente
         *   6: Avisode Operación de Crédito
         *   7: Cupón de Promoción
         *   8: Uso Interno Farmacia
         *
         *   Ejemplo: Ç∟R∟T∟1211241
         *
         */
        public function openDNFH($tipoDocumento, $identificacion = ''){
            return  "Ç"             . $this->cm('FS') .
                    $tipoDocumento  . $this->cm('FS') .
                    "T"             . $this->cm('FS') .
                    $identificacion
                    ;
        }



        /**
         *
         *  ASCII 81Hexa, 129 decimal   ü
		 *
         * Ejemplo: ü∟3
		 *
         */
        public function closeDNFH($numCopias = 0){
            return "\x81" . $this->cm('FS') . $numCopias;
        }
        
}

