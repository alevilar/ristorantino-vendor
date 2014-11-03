
<script language="javascript" type="text/javascript">
    var mesas = [],
            egresos = [];
<?php if (!empty($mesas)) { ?>
        mesas = <?php echo json_encode($mesas); ?>;
<?php } ?>

<?php if (!empty($egresos)) { ?>
        egresos = <?php echo json_encode($egresos); ?>;
<?php } ?>
</script>

<div class="row">
    <?php
    echo $this->Form->create('Mesa', array('url' => array('controller' => 'stats', 'action' => 'mesas_total')));
    ?>
    <div class="col-md-4">

        <legend>Rango de Fechas</legend>
        <div class="row">
            <div class="col-md-4">
                <?php
                echo $this->Form->input('Linea.0.desde', array('type' => 'date'));
                ?>
            </div>

            <div class="col-md-4">
                <?php
                echo $this->Form->input('Linea.0.hasta', array('type' => 'date'));
                ?>
            </div>

            <div class="col-md-4"><br><?php echo $this->Form->submit('Aceptar', array('class' => 'btn btn-default btn-md')); ?> </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
   ?>
    <div class="col-md-7 col-md-push-1">
        <div class="row">
            Datos entre <b><?php echo strftime('%A %d de %B %Y', strtotime($resumenCuadro['desde'])) ?></b> y <b><?php echo strftime('%A %d de %B %Y', strtotime($resumenCuadro['hasta'])) ?></b>
            <br />
            <div class="col-md-6">
                <h3>Ingresos/Ventas</h3>
                Ventas Netas (sin descuentos): <b><?php echo $this->Number->currency($resumenCuadro['subtotal'],'$', array('places'=>0)) ?></b><br />
                Total de ventas (con descuentos): <b><?php echo $this->Number->currency($resumenCuadro['total'],'$', array('places'=>0)) ?></b><br />
                Cierre Zeta Total: <b><?php echo $this->Number->currency($zeta_iva_total + $zeta_neto_total,'$', array('places'=>0)) ?></b><br>
                Zeta Neto: <b><?php echo $this->Number->currency($zeta_neto_total,'$', array('places'=>0)) ?></b><br>
                Zeta Iva: <b><?php echo $this->Number->currency($zeta_iva_total,'$', array('places'=>0)) ?></b><br>

                <p>Cantidad de <?php echo Inflector::pluralize( Configure::read('Mesa.tituloCubierto') ) ?>: <b><?php echo $resumenCuadro['cubiertos'] ?></b></p>
            </div>

            <div class="col-md-6">
                <h3>Egresos/Pagos</h3>
                Pagos: <b><?php echo $this->Number->currency($egresos_total,'$', array('places'=>0)) ?></b>
                <br><br>
                Gastos Total: <b><?php echo $this->Number->currency($gastos_total,'$', array('places'=>0)) ?></b><br>
                Gasto Neto: <b><?php echo $this->Number->currency($gastos_neto,'$', array('places'=>0)) ?></b><br>
                Gastos Impuestos: <b><?php echo $this->Number->currency($gastos_total - $gastos_neto,'$', array('places'=>0)) ?></b><br>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="chart1" ></div>
    </div>
</div>


<div class="row">

    <div class="col-md-2">
        <div class="tabla-info">
            <h3><?php echo __('Ocupación'); ?></h3>

            <table class="table table-condensed center">
                <thead>
                    <tr>
                        <th style="background: #9B4959; color: white; text-align: center;"><?php echo __('Fecha'); ?></th>
                        <th style="background: #9B4959; color: white; text-align: center;"><?php echo Inflector::pluralize(Configure::read('Mesa.tituloCubierto')); ?></th>
                    </tr>
                </thead>
             <?php
                foreach ( $cubiertos as $fecha => $cubs ) {
                    ?>
                    <tr>
                        <td><?php echo strftime('%a %d %b', strtotime($fecha)) ?></td>
                        <td><?php echo $cubs?></td>
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
                                echo(strftime('%a %d %b', strtotime($m['Mesa']['fecha'])));
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
                            <td><?php echo strftime('%a %d %b', strtotime($z[0]['fecha'])); ?></td>
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
                            <td><?php echo strftime('%a %d %b', strtotime($e['Egreso']['fecha'])); ?></td>
                            <td><?php echo $this->Number->currency($e['Egreso']['importe'],'$', array('places'=>0)) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
echo $this->Html->css('/stats/css/examples', false);
echo $this->Html->css('/stats/css/stats', false);


echo $this->Html->script('/stats/js/jqplot/jquery.jqplot.js', false); //plugin estadisticas
echo $this->Html->script('/stats/js/jqplot/plugins/jqplot.dateAxisRenderer.js', false);
echo $this->Html->script('/stats/js/jqplot/plugins/jqplot.highlighter.js', false);

echo $this->Html->script('/stats/js/mesas_total', false); //plugin estadisticas
?>

