<?php




class StatsController extends StatsAppController
{

    public $uses = array('Mesa.Mesa', 'Mesa.Pago', 'Account.Egreso', 'Account.Gasto', 'Cash.Zeta','Risto.TipoDePago');

   // public $helpers = array('GoogleCharts.GoogleCharts');



    /**
     *
     * @param type $groupByRange string posibilidades: day - month -  year. Indica como seran agrupados los datos
     * 
     */
    function mesas_total($groupByRange = 'day')
    {
        $egresos = array();
        $horarioCorte = Configure::read('Horario.corte_del_dia');
        $desdeHasta = '1 = 1';
        $limit = '';
        $lineas = array($desdeHasta);
        // por default buscar 1 semana atras
        if ( empty($this->request->data['Stat']['desde']) )  {
            $this->request->data['Stat']['desde'] = date('Y-m-d', strtotime('-6 day'));
        }

        // por default buscar hasta hoy
        if ( empty($this->request->data['Stat']['hasta']) )  {
            $this->request->data['Stat']['hasta'] = date('Y-m-d', strtotime('now'));
        }

        $desde = $this->request->data['Stat']['desde'];
        $hasta = $this->request->data['Stat']['hasta'];
            

           
        // detalle de egresos por dia
        $egresos = $this->Egreso->delDia($desde, $hasta);
        $this->set('egresos', $egresos );

        $egresos = $this->Egreso->sumaDelDia($desde, $hasta);
        $this->set('egresos_total', $egresos['total']);

        

        // listado de gastos de la fecha
        /*
        $gastos = $this->Gasto->delDia($desde, $hasta);
        $this->set('gastos', $gastos);

        $gastos = $this->Gasto->sumaDelDia($desde, $hasta);
        $this->set('gastos_neto', $gastos['importe_neto']);
        $this->set('gastos_total', $gastos['importe_total']);
        */

        // buscar las zetas
        $zetas = $this->Zeta->delDia($desde, $hasta);
        $this->set('zetas', $zetas);

        $zetas = $this->Zeta->sumaDelDia($desde, $hasta);
        $this->set('zeta_iva_total', $zetas['monto_iva']);
        $this->set('zeta_neto_total', $zetas['monto_neto']);
        $this->set('zeta_nc_iva', $zetas['nota_credito_iva']);
        $this->set('zeta_nc_neto', $zetas['nota_credito_neto']);

       
        // sumatorias de mesas y cubiertos                   
        $mesas = $this->Mesa->delDia($desde, $hasta);
        $this->set('mesas', $mesas);
        $mesaSubTotal = $mesaTotal = $mesaCubiertos = 0;
        foreach ( $mesas as $m ) {            
            $mesaTotal += $m['total'];
            $mesaSubTotal += $m['subtotal'];
            $mesaCubiertos += $m['cubiertos'];
        }
        $this->set('mesa_subtotal', $mesaSubTotal);
        $this->set('mesa_total', $mesaTotal);
        $this->set('mesa_cubiertos', $mesaCubiertos);
        

        // sumatorias de ingresos - pagos
        $pagos = $this->Pago->delDia($desde, $hasta);
        $this->set('pagos', $pagos);
        $pagos = $this->Pago->sumaDelDia($desde, $hasta);
        $this->set('pagos_total', $pagos['valor']);

        // tipos de pagos
        $res = $this->Pago->porTipoDePagoDesdeHasta($desde, $hasta);            
        $this->set('tipo_de_pagos', $res['tipoPagosList']);
        $this->set('tipo_de_pago_totales', $res['totales']);

    }

    function mozos_total()
    {
        $fechas = array();
        // por default buscar hoy
        if (empty($this->request->data['Mesa'])) {
            $this->request->data['Mesa']['hasta'] = date('Y-m-d', strtotime('now'));
            $this->request->data['Mesa']['desde'] = date('Y-m-d', strtotime('-6 day'));
        }
        if (!empty($this->request->data['Mesa']['desde']) && !empty($this->request->data['Mesa']['hasta'])) {
            $desde = $this->request->data['Mesa']['desde'];
            $hasta = $this->request->data['Mesa']['hasta'];

            $mesas = $this->Mesa->totalesDeMesasEntre($desde, $hasta, array(
                'fields' => array(
                    'Mozo.*'
                ),
                'group' => array(
                    'Mozo.id',
                    'Mozo.numero',
                ),
                'order' => array(
                    'fecha DESC',
                    'Mozo.numero ASC',
                ),
                'contain' => array(
                    'Mozo'
                )
            ));

            // traer array de fechas
            $fechas = array_flip(crear_fechas($desde, $hasta));
            $fechas = array_reverse($fechas);

            // aray de los mozos que estan en este intervalo de mesas
            $mozosList = $mozos = $mozosTotales = $mozosCubiertos = array();
            foreach ($mesas as &$m) {
                $mozosList[$m['Mozo']['id']] = null;
                $mozos[$m['Mozo']['id']] = $m['Mozo']['numero'];
                
                if ( empty($mozosTotales[$m['Mozo']['id']]) ) {
                    $mozosTotales[$m['Mozo']['id']] = array(
                        'total' => 0,
                        'cubiertos' => 0,
                    );
                }
                $mozosTotales[$m['Mozo']['id']]['total'] += $m[0]['total'];
                $mozosTotales[$m['Mozo']['id']]['cubiertos'] += $m[0]['cant_cubiertos'];
            }

            // convertir matriz con fechas y mozos
            foreach ($fechas as &$f) {
                $f = $mozosList;
            }
            // colocar el dato en la matriz
            foreach ($mesas as &$m) {
                $fechas[$m[0]['fecha']][$m['Mozo']['id']] = $m;
            }
        }
        $this->set(compact('fechas', 'mozos', 'mozosTotales'));
    }

    
    public function tipos_de_pago()
    {
        $fechas = array();
        // por default buscar hoy
        if (empty($this->request->data['Mesa'])) {
            $this->request->data['Mesa']['hasta'] = date('Y-m-d', strtotime('now'));
            $this->request->data['Mesa']['desde'] = date('Y-m-d', strtotime('-6 day'));
        }

        if (!empty($this->request->data['Mesa']['desde']) && !empty($this->request->data['Mesa']['hasta'])) {
            $desde = $this->request->data['Mesa']['desde'];
            $hasta = $this->request->data['Mesa']['hasta'];

        }
        $res = $this->Pago->porTipoDePagoDesdeHasta($desde, $hasta);            
        
        $fechas = $res['fechas'];
        $tipoPagosList = $res['tipoPagosList'];
        $totales = $res['totales'];
        $this->set(compact('fechas', 'tipoPagosList', 'totales'));
    }

}

