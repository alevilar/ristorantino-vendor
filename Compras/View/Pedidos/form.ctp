<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<div class="content-white center">

<?php if ( empty($this->request->data['Pedido']['id'] )) {?>
    <h1>Generar Órden de Compra</h1>
<?php } else { ?>
    <h1>Editar Órden de Compra #<?php echo $this->request->data['Pedido']['id'] ?></h1>
<?php } ?>
    <?php echo $this->Form->create('Pedido', array(
                                        'id'=> "PedidoAddForm",
                                        'url' => array('action' => 'form')
                                        )); ?>
<div>
    <?php echo $this->Form->submit('Guardar Órden de Compra', array('class'=>'btn-lg btn btn-primary', 'id' => 'btn-submit')); ?>


    <br>
    <?php echo $this->Form->input('id'); ?>

    <div class="col-xs-5">
        <?php echo $this->Form->input('proveedor_id'); ?>
        <?php echo $this->Form->input('recepcionado'); ?>
    </div>
    <div class="col-xs-7">
        <div id="proveedor-data"></div>
    </div>

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


echo $this->Form->end(); 
?>


<script type="risto/tmp" id="pedido-skeleton">
    <?php echo $this->element("Compras.pedido-skeleton", array('pmId'=>'{X}'));?>
</script>

<div class="clearfix"></div>



<script type="text/javascript">
    
    var mercaIndexURL = "<?php echo $this->Html->url(array('controller'=>'mercaderias', 'action'=>'index'));?>";
    var mercaUnidades = <?php echo json_encode($mercaUnidades);?>;
    var urlProveedorPedidoInfo = "<?php echo $this->Html->url(array('controller'=>'pedidos', 'action' => 'proveedor_info'));?>";
</script>
<?php 


echo $this->Html->script('/compras/js/pedidos/form_proveedor');
?>
</div>