    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<div class="content-white center">

    <h1>Recepcionar Mercaderia</h1>

    <?php echo $this->Form->create('Pedido', array(
                                        'id'=> "PedidoAddForm",
                                        ));
		echo $this->Form->hidden('Pedido.id');
        echo $this->Form->hidden('Pedido.recepcionado', array('value'=>true));
        echo $this->Form->hidden('Pedido.gen_gasto', array('id'=>'gengasto', 'value'=>false));

     ?>
<div>
    <div class="btn-group  btn-group-lg">
    <?php echo $this->Form->button('Recepcionar', array('class'=>'btn btn-success ', 'id' => 'btn-submit')); ?>

    <?php echo $this->Form->button('Recepcionar y Generar Gasto ❱', array('class'=>'btn btn-warning', 'id' => 'btn-submit-gengasto')); 
    ?>
    </div>
    <div class="clearfix"></div>
    <br>
</div>




<?php
$pedido_id      = $this->request->data['Pedido']['id'];
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
                        'muestraPrecio'         => true,
                        ));
    }
}


echo $this->Form->end(); 
?>

<script type="risto/tmp" id="pedido-skeleton">
    <?php echo $this->element("Compras.pedido-skeleton", array(
                        'pmId'          => '{X}', 
                        'pedido_id'     => $pedido_id,
                        ));?>
</script>

<div class="clearfix"></div>


<script type="text/javascript">
    
    var mercaIndexURL = "<?php echo $this->Html->url(array('controller'=>'mercaderias', 'action'=>'index'));?>";
    var mercaUnidades = <?php echo json_encode($mercaUnidades);?>;
    var urlProveedorPedidoInfo = "<?php echo $this->Html->url(array('controller'=>'pedidos', 'action' => 'proveedor_info'));?>";
</script>

<script type="text/javascript">
    
   $("#btn-submit-gengasto").bind('click', function(e){
        e.preventDefault();

        $("#gengasto").val(true);

        $("#PedidoAddForm").submit();

   });
</script>

</div>
