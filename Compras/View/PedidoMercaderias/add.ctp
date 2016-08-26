<div class="content-white">



<div class="center">
	<h1>Agregar Mercaderia Pendiente</h1>
	<?php echo $this->Form->create('PedidoMercaderia', array('id'=> "PedidoAddForm")); ?>

	<br/>
    <?php echo $this->Form->submit('Guardar Solicitud de Compra', array('class'=>' btn-lg btn btn-success')); ?>
    <br/><br/>	
    <div class="clearfix"></div>
	<?php echo $this->Form->end(); ?>
</div>



<script type="risto/tmp" id="pedido-skeleton">
    <?php echo $this->element("Compras.pedido-skeleton", array('pmId'=>'{X}'));?>
</script>

<div class="clearfix"></div>

<script type="text/javascript">
    var mercaIndexURL = "<?php echo $this->Html->url(array('controller'=>'mercaderias', 'action'=>'index'));?>";
    var mercaUnidades = <?php echo json_encode($mercaUnidades);?>;
</script>


<?php 
echo $this->Html->script('/compras/js/pedido_mercaderias/add');

?>

</div>