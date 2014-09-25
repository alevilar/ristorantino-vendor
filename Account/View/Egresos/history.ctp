<h1>Listado de Pagos</h1>

<?php
echo $this->Html->css('/account/css/style');
echo $this->element('form_mini_year_month_search');

$urlTex = '';
foreach ($this->params['url'] as $u => $v) {
    if ($u != 'ext' && $u != 'url' && $u != 'page') {
        if (!empty($v)) {
            $urlTex .= "$u=$v&";
        }
    }
}
$urlTex = trim($urlTex, '&');
$this->Paginator->options(array('url' => array('?' => $urlTex)));

?>


<table class="table table-hover">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Importe</th>
            <th>Fecha</th>
            <th>Listado de Gastos Pagados</th>
            <th>Observacion</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>


    <tbody>
        <?php foreach ($egresos as $g) { ?>

            <tr>
                <td>
                    <?php echo $this->Html->imageMedia($g['TipoDePago']['media_id'], array('class' => 'thumb')); ?>
                </td>
                
                <td><?php echo $this->Number->currency($g['Egreso']['total']); ?></td>

                <td><?php echo strftime('%d %b', strtotime($g['Egreso']['fecha'])); ?></td>

                
                
                <td>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Factura</th>
                                <th>Fecha</th>
                                <th>Neto</th>
                                <th>Total</th>
                                <th>Pago</th>
                                <th>Obs.</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            $proveedor = '';
                            $tipoFactura = '';

                            foreach ( $g['Gasto'] as $gasto ) {
                                if ( !empty($gasto['Proveedor']) ) {
                                    $proveedor = $gasto['Proveedor']['name'] . ', ';
                                }
                                if ( !empty($gasto['TipoFactura']) ) {
                                    $tipoFactura = $gasto['TipoFactura']['name'];
                                }
                                ?>
                                <tr>
                                    <td><?php echo $proveedor ?></td>
                                    <td><?php echo $tipoFactura ?> <?php echo $gasto['factura_nro'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($gasto['fecha'])) ?></td>
                                    <td><?php echo $gasto['importe_neto'] ?></td>
                                    <td><?php echo $gasto['importe_total'] ?></td>
                                    <td class="text text-warning"><?php echo $this->Number->currency($gasto['AccountEgresosGasto']['importe']) ?></td>
                                    <td><?php echo $gasto['observacion'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                <td><?php echo $g['Egreso']['observacion']; ?></td>

                <td>
                    <?php
                    $ext = substr(strrchr($g['Egreso']['file'], '.'), 1);
                    if (in_array(strtolower($ext), array('jpg', 'png', 'gif', 'jpeg'))) {
                        $iii = $this->Html->image(THUMB_FOLDER . $g['Egreso']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                    } else {
                        $iii = "Descargar $ext";
                    }
                    if (!empty($g['Egreso']['file'])) {
                        echo $this->Html->link($iii, "/" . IMAGES_URL . $g['Egreso']['file'], array('target' => '_blank', 'escape' => false));
                    }
                    ?>
                </td>

                <td>
                    <?php
                    echo $this->Html->link('Ver', array('action' => 'view', $g['Egreso']['id']));
                    echo "<br>";
                    echo $this->Html->link('Editar', array('action' => 'edit', $g['Egreso']['id']));
                    echo "<br>";
                    echo $this->Html->link('Eliminar', array('action'=>'delete', $g['Egreso']['id']), null, sprintf(__('¿Está seguro que desea borrar el pago de %s', true), $this->Number->currency($g['Egreso']['total'])));
                    ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
echo $this->Paginator->counter(array(
    'format' => __('Página {:count} de {:pages}, mostrando {:current} elementos de {:count}', true)
));
?>

<div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('anterior'), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next(__('próximo') . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>
