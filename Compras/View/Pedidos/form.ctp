
<div class="content-white center">

    <h1>Generar Órden de Compra</h1>

    <?php echo $this->Form->create('Pedido', array(
                                        'id'=> "PedidoAddForm",
                                        'url' => array('action' => 'form')
                                        )); ?>
<div>
    <?php echo $this->Form->submit('Guardar Órden de Compra', array('class'=>'btn-lg btn btn-success')); ?>


    <br>
    <?php echo $this->Form->input('id'); ?>

    <?php echo $this->Form->input('proveedor_id'); ?>

    <div class="clearfix"></div>

    <h4>Modificar Detalles de la OC</h4>
</div>




<?php
if ( !empty($pedidoMercaderias) ) {
    foreach ( $pedidoMercaderias as $i=>$pm ) {
        $id             = $pm['PedidoMercaderia']['id'];
        $mercaderia_id  = $pm['PedidoMercaderia']['mercaderia_id'];
        $mercaderia     = $pm['Mercaderia']['name'];
        $cantidad       = $pm['PedidoMercaderia']['cantidad'];
        $observacion    = $pm['PedidoMercaderia']['observacion'];
        $unidad_de_medida_id =  $pm['PedidoMercaderia']['unidad_de_medida_id'];
        
        echo $this->element("Compras.pedido-skeleton", array(
                        'pmId'=> $i,
                        'id'                    => $id,
                        'mercaderia_id'         => $mercaderia_id,
                        'mercaderia'            => $mercaderia,
                        'cantidad'              => $cantidad,
                        'observacion'           => $observacion,
                        'unidad_de_medida_id'   => $unidad_de_medida_id,
                        ));
    }
}





?>

<?php echo $this->Form->end(''); ?>


<script type="risto/tmp" id="pedido-skeleton">
    <?php echo $this->element("Compras.pedido-skeleton", array('pmId'=>'{X}'));?>
</script>

<div class="clearfix"></div>
<script type="text/javascript">
    
    var mercaUnidades = <?php echo json_encode($mercaUnidades);?>;
</script>
<?php 
echo $this->Html->script('/risto/lib/bootstrap.typehead/bootstrap3-typeahead', true);
// echo $this->Html->script('/risto/lib/bootstrap/plugins/bootstrap3-typeahead', true);
//echo $this->Html->script('/risto/js/typeahead.bundle', true);

?>
</div>