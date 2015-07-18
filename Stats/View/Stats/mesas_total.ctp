<?php


/**
*
*   @param array $list Array que voy a recoger los campos siguientes
*   @param 1    Inifitos parametros dependiendo lo que yo quiero armar el array final
*   @param 2
*   @param n
*
***/
/*
function toJsXY() {
    $args = func_get_args();
    $list  = array_shift($args);
    $newarr = array();
    foreach ($list as $dia => $value) {
        if (!empty($value) ) {
            $valoresDisplay = array($dia);
            foreach ($args as $f) {
                $valoresDisplay[] = (float) $value[$f];
            }
            $newarr[] = $valoresDisplay;
        } else {
            $newarr[] = array($dia, 0 );;
        }
    }
    return $newarr;
}
*/
/*
$gastosXY  = toJsXY($gastos, 'importe_total');
$egresosXY = toJsXY($egresos, 'total');
$pagosXY   = toJsXY($pagos, 'valor');
$zetasXY   = toJsXY($zetas, 'created');
$mesasXY   = toJsXY($mesas, 'total');
*/
$googleChartData = array();
$tableData = array();
foreach ($pagos as $fecha=>$ingreso) {
    $googleChartData[] = array( $fecha, (float) @$ingreso['valor'], (float) @$egresos[$fecha]['total'], (float) @$zetas[$fecha]['monto_iva'] + @$zetas[$fecha]['monto_neto']);

    $tableData[] = array( $fecha
                        , (float)$mesas[$fecha]['cubiertos']
                        , $this->Number->currency( $mesas[$fecha]['promedio_cubiertos'] )
                        , $this->Number->currency( $mesas[$fecha]['total'] )
                        , $this->Number->currency( @$ingreso['valor'] )
                        , $this->Number->currency( @$egresos[$fecha]['total'] )
                        , $this->Number->currency( @$zetas[$fecha]['monto_iva'] + @$zetas[$fecha]['monto_neto'] )
                        );
}
$tableData = array_reverse($tableData);

echo $this->Html->script("https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }", false);

?>



<script language="javascript" type="text/javascript">
    var mesas = [];

<?php if (!empty($googleChartData)) { ?>
        mesas = <?php echo json_encode($googleChartData); ?>;
<?php } ?>

</script>


<div class="row">
    <?php
    echo $this->Form->create('Stat');
    ?>
    <div class="col-md-4">

        <legend>Rango de Fechas</legend>
        <div class="row">
            <div class="col-md-4">
                <?php echo $this->Form->input('desde', array('type' => 'date'));?>
            </div>

            <div class="col-md-4">
                <?php echo $this->Form->input('hasta', array('type' => 'date')); ?>
            </div>

            <div class="col-md-4"><br><?php echo $this->Form->submit('Aceptar', array('class' => 'btn btn-default btn-md')); ?> </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
   ?>
    <div class="col-md-7 col-md-push-1">
        <div class="row">            
            <div class="col-md-6">
                
                <h3>Sumatorias</h3>
                Ingresos: <b><?php echo $this->Number->currency($pagos_total) ?></b><br />
                Egresos: <b><?php echo $this->Number->currency($egresos_total) ?></b>
               
                <p>Cantidad de <?php echo Inflector::pluralize( Configure::read('Mesa.tituloCubierto') ) ?>: <b><?php echo $mesa_cubiertos ?></b></p>
            </div>

            <div class="col-md-6">
                 <h3>Fiscal</h3>               
                Cierre Zeta Total: <b><?php echo $this->Number->currency($zeta_iva_total + $zeta_neto_total) ?></b><br>
                Zeta Neto: <b><?php echo $this->Number->currency($zeta_neto_total) ?></b><br>
                Zeta Iva: <b><?php echo $this->Number->currency($zeta_iva_total) ?></b><br>

               
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div id="line-chart"  class="col-md-12" style="height: 400px;"></div>
</div>


<div class="row">

    <div class="col-md-12">
        <div class="tabla-info">
            <table class="table table-condensed center">
                <thead>
                     <?php 
                     echo $this->Html->tableHeaders( array(
                            __('Fecha'),
                            Inflector::pluralize(Configure::read('Mesa.tituloCubierto')),
                            __('Promedio de %s', Inflector::pluralize(Configure::read('Mesa.tituloCubierto'))),
                            __('Ventas'),
                            __('Ingresos'),
                            __('Egresos'),
                            __('Zetas')
                        ), null, array('class'=>'center') ); 

                     ?>
                </thead>

                <tbody>
                    <?php echo $this->Html->tableCells( $tableData ); ?>
                </tbody>
            </table>
        </div>
    
    </div>

</div>

<?php
echo $this->Html->css('/stats/css/examples', false);
echo $this->Html->css('/stats/css/stats', false);


echo $this->Html->script('/stats/js/mesas_total', false); //plugin estadisticas

