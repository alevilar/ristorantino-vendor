<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<div class="content-white center">

    <h1>Recepcionar Mercaderia</h1>

    <?php echo $this->Form->create('Pedido', array(
                                        'id'=> "PedidoAddForm",
                                        ));
		echo $this->Form->hidden('Pedido.id');

                                         ?>
<div>
    <?php echo $this->Form->submit('Recepcionar', array('class'=>'btn-lg btn btn-success', 'id' => 'btn-submit')); ?>
    <br>
</div>




<?php
if ( !empty($pedidoMercaderias) ) {
    foreach ( $pedidoMercaderias as $i=>$pm ) {
        $id             = $pm['PedidoMercaderia']['id'];
        $mercaderia_id  = $pm['PedidoMercaderia']['mercaderia_id'];
        $mercaderia     = $pm['Mercaderia']['name'];
        $cantidad       = $pm['PedidoMercaderia']['cantidad'];
        $observacion    = $pm['PedidoMercaderia']['observacion'];
        $recibido    	= !empty($pm['PedidoMercaderia']['time_recibido']);
        $precio    		= $pm['PedidoMercaderia']['precio'];
        $unidad_de_medida_id =  $pm['PedidoMercaderia']['unidad_de_medida_id'];
        
        echo $this->element("Compras.pedido-skeleton", array(
                        'pmId'					=> $i,
                        'id'                    => $id,
                        'mercaderia_id'         => $mercaderia_id,
                        'mercaderia'            => $mercaderia,
                        'cantidad'              => $cantidad,
                        'observacion'           => $observacion,
                        'recibido'              => $recibido,
                        'precio'              	=> $precio,
                        'unidad_de_medida_id'   => $unidad_de_medida_id,
                        ));
    }
}


echo $this->Form->end(); 
?>



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