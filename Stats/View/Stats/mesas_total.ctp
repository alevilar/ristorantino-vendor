<?php
function toJsXY( $list, $field ) {
    $newarr = array();
    foreach ($list as $dia => $value) {
        if (!empty($value) ) {
            $newarr[$dia] = (float)$value[$field];
        } else {
            $newarr[$dia] = 0;
        }
    }
    return $newarr;
}


$gastosXY  = toJsXY($gastos, 'importe_total');
$egresosXY = toJsXY($egresos, 'total');
$pagosXY   = toJsXY($pagos, 'valor');
$zetasXY   = toJsXY($zetas, 'created');
$mesasXY   = toJsXY($mesas, 'total');

?>

<script language="javascript" type="text/javascript">
    var mesas = [],
            egresos = [];
<?php if (!empty($mesas)) { ?>
        mesas = <?php echo json_encode($mesasXY); ?>;
<?php } ?>

<?php if (!empty($egresos)) { ?>
        egresos = <?php echo json_encode( array( $egresosXY) ); ?>;
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
            Datos entre <b><?php echo $this->Time->format($resumenCuadro['desde'], '%A %d de %B %Y') ?></b> y <b><?php echo $this->Time->format($resumenCuadro['hasta'], '%A %d de %B %Y') ?></b>
            <br />
            <div class="col-md-6">
                <h3>Ingresos/Ventas</h3>
                Ventas Netas (sin descuentos): <b><?php echo $this->Number->currency($resumenCuadro['subtotal']) ?></b><br />
                Total de ventas (con descuentos): <b><?php echo $this->Number->currency($resumenCuadro['total']) ?></b><br />
                Cierre Zeta Total: <b><?php echo $this->Number->currency($zeta_iva_total + $zeta_neto_total) ?></b><br>
                Zeta Neto: <b><?php echo $this->Number->currency($zeta_neto_total) ?></b><br>
                Zeta Iva: <b><?php echo $this->Number->currency($zeta_iva_total) ?></b><br>

                <p>Cantidad de <?php echo Inflector::pluralize( Configure::read('Mesa.tituloCubierto') ) ?>: <b><?php echo $resumenCuadro['cubiertos'] ?></b></p>
            </div>

            <div class="col-md-6">
                <h3>Egresos/Pagos</h3>
                Pagos: <b><?php echo $this->Number->currency($egresos_total) ?></b>
                <br><br>
                Gastos Total: <b><?php echo $this->Number->currency($gastos_total) ?></b><br>
                Gasto Neto: <b><?php echo $this->Number->currency($gastos_neto) ?></b><br>
                Gastos Impuestos: <b><?php echo $this->Number->currency($gastos_total - $gastos_neto) ?></b><br>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="line-chart" ></div>
    </div>
</div>


<div class="row">

    <div class="col-md-2">
        <div class="tabla-info">
            <?php if (Configure::read('Adicion.cantidadCubiertosObligatorio')) { ?>
            <h3><?php echo __('Ocupación'); ?></h3>
            <?php } else { ?>
            <h3><?php echo __('Cronograma'); ?></h3>
            <?php }?>

            <table class="table table-condensed center">
                <thead>
                    <tr>
                        <th style="background: #9B4959; color: white; text-align: center;"><?php echo __('Fecha'); ?></th>

                        <?php if (Configure::read('Adicion.cantidadCubiertosObligatorio')) { ?>
                        <th style="background: #9B4959; color: white; text-align: center;"><?php echo Inflector::pluralize(Configure::read('Mesa.tituloCubierto')); ?></th>
                        <?php } ?>
                    </tr>
                </thead>
             <?php
                foreach ( $cubiertos as $fecha => $cubs ) {
                    ?>
                    <tr>
                        <td><?php echo $this->Time->format($fecha, '%a %d %b') ?></td>
                        <?php if (Configure::read('Adicion.cantidadCubiertosObligatorio')) { ?>
                        <td><?php echo $cubs?></td>
                        <?php } ?>
                    </tr>
                    <?php
                }

            ?>
            </table>
        </div>
    
    </div>

    <div class="col-md-5 alpha">
        <?php
        foreach ($mesas as $i => $mozo) {
            if (!empty($mozo['desde']))
                
                ?>
            <div class="tabla-info">
                <h3>Facturación</h3>
                <table class="table table-condensed center">
                    <thead>
                        <tr>
                            <th <?php
                            if ($i == 0) {
                                echo('class="coloruno"');
                            } else {
                                echo('class="colordos"');
                            }
                            ?>>Fecha</th>
                            <th <?php
                            if ($i == 0) {
                                echo('class="coloruno"');
                            } else {
                                echo('class="colordos"');
                            }
                            ?>>Total</th>   
                            <th <?php
                            if ($i == 0) {
                                echo('class="coloruno"');
                            } else {
                                echo('class="colortres"');
                            }
                            ?>><?php echo "$".Configure::read('Mesa.tituloCubierto') ?></th>

                            <th <?php
                            if ($i == 0) {
                                echo('class="coloruno"');
                            } else {
                                echo('class="colordos"');
                            }
                            ?>><?php echo Inflector::pluralize(Configure::read('Mesa.tituloMesa')) ." ". __('facturadas') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (!empty($mozo)) {

                            foreach ($mozo as $m) {
                                echo('<tr>');
                                echo('<td>');
                                echo($this->Time->format($m['Mesa']['fecha'], '%a %d %b'));
                                echo('</td>');
                                echo('<td>');
                                echo($this->Number->currency($m['Mesa']['total'],'$', array('places'=>0)) );
                                echo('</td>');

                                // prom cubiertos
                                echo('<td>');
                                if ($m['Mesa']['cant_cubiertos']) {
                                    echo $this->Number->currency($m['Mesa']['total'] / $m['Mesa']['cant_cubiertos'],'$', array('places'=>0));
                                } else {
                                    echo $this->Number->currency($m['Mesa']['total'],'$', array('places'=>0));
                                }
                                echo('</td>');

                                echo('<td>');
                                echo($m['Mesa']['cant_mesas']);
                                echo('</td>');

                                echo('</tr>');
                            }
                        } else {
                            echo('<td>');
                            echo __('No se encontraron %s', Inflector::pluralize( Configure::read('Mesa.tituloMesa')) );
                            echo('</td>');
                            echo('<td>');
                            echo('-');
                            echo('</td>');
                        }
                        echo('</tr>');
                        ?>  
                    </tbody>              
                </table>

            </div>  
            <?php
        }
        ?>
    </div>

    <div class="col-md-3">
        <div class="tabla-info">
            <h3>Zetas</h3>
            <table class="table table-condensed center">
                <thead>
                    <tr>
                        <th style="background: #00650e; color: white; text-align: center;">Fecha</th>
                        <th style="background: #00650e; color: white; text-align: center;">Neto</th>
                        <th style="background: #00650e; color: white; text-align: center;">Iva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($zetas as $z) { ?>
                        <tr>
                            <td><?php echo $this->Time->format($z[0]['fecha'], '%a %d %b'); ?></td>
                            <td><?php echo $this->Number->currency($z[0]['neto'],'$', array('places'=>0)) ?></td>
                            <td><?php echo $this->Number->currency($z[0]['iva'],'$', array('places'=>0)) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-2">
        <div class="tabla-info">
            <h3>Pagos</h3>
            <table class="table table-condensed center">
                <thead>
                    <tr>
                        <th style="background: #EAA228; color: white; text-align: center;">Fecha</th>
                        <th style="background: #EAA228; color: white; text-align: center;">Importe pagado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($egresos[0] as $e) { ?>
                        <tr>
                            <td><?php echo $this->Time->format($e['Egreso']['fecha'], '%a %d %b'); ?></td>
                            <td><?php echo $this->Number->currency($e['Egreso']['importe'],'$', array('places'=>0)) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

<?php
echo $this->Html->css('/stats/css/examples', false);
echo $this->Html->css('/stats/css/stats', false);


echo $this->Html->script("https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }", false); //plugin estadisticas

echo $this->Html->script('/stats/js/mesas_total', false); //plugin estadisticas

