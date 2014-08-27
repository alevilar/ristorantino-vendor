

<div class="well pull-right">
    <?php
    echo $this->Form->create('Mesa', array('url' => $this->action, 'class' => 'form-inline formufecha'));
    ?>
    <legend>Filtrar por rango de fechas</legend>
    <?php
    echo $this->Form->input('desde', array('type' => 'date', 'label'=>false));
    echo $this->Form->input('hasta', array('type' => 'date', 'label'=>false));
    echo $this->Form->submit('Aceptar', array('class' => 'btn btn-default', 'div' => false));
    echo $this->Form->end();
    ?>

</div>

<h1>Tipos de Pago</h1>


<div class="clearfix"></div>

<div class="row">
    <table class="table table-bordered table-condensed table-responsive table-striped ">
        <thead>
            <tr>
                <th class="text-center">Fecha</th>
                <?php foreach ($tipoPagosList as $mz) { ?>
                <th class="text-center"><?php echo $this->Html->image($mz['image_url'], array(
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

