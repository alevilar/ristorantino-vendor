

<div class="well pull-right">
    <?php echo $this->element('formufecha'); ?>
</div>

<h1>Tipos de Pago</h1>


<div class="clearfix"></div>

<div class="row">
    <table class="table table-bordered table-condensed table-responsive table-striped ">
        <thead>
            <tr>
                <th class="text-center">Fecha</th>
                <?php foreach ($tipoPagosList as $mz) { ?>
                <th class="text-center"><?php echo $this->Html->imageMedia($mz['media_id'], array(
                    'height'=>'50px',
                    'title' => $mz['name'],
                    'alt' => $mz['name'],
                    )) ?></th>
                <?php } ?>
            </tr>
        </thead>
        
        <tfoot class="text-primary">
            <tr>
                <td class="text-center">TOTALES</td>
                <?php foreach($totales as $mt) { ?>
                <td class="text-right"><?php echo $this->Number->currency($mt['total'],'$', array('places'=>0)); ?></td>
                <?php } ?>
            </tr>
        </tfoot>
        
        <tbody>
            <?php foreach ($fechas as $fDate=>$f) { ?>
                <tr>
                    <td class="text-center"><?php echo $fDate;?></td>
                    <?php foreach ($f as $mId=>$mdata) { ?>
                        <td class="text-right"><?php echo $this->Number->currency($mdata[0]['total'],'$', array('places'=>0));?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
        
    </table>
</div>

