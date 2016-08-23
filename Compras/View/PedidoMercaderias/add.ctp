<div class="content-white">



<div class="center">
	<h1>Agregar Mercaderia Pendiente</h1>
	<?php echo $this->Form->create('PedidoMercaderia', array('id'=> "PedidoAddForm")); ?>

	<br/>
    <?php echo $this->Form->submit('Guardar Solicitud de Compra', array('class'=>' btn-lg btn btn-success')); ?>
    <br/><br/>	
    <div class="clearfix"></div>
	<?php echo $this->Form->end(''); ?>
</div>



<script type="risto/tmp" id="pedido-skeleton">
    <?php echo $this->element("Compras.pedido-skeleton", array('pmId'=>'{X}'));?>
</script>

<div class="clearfix"></div>

<script type="text/javascript">
	
	var mercaUnidades = <?php echo json_encode($mercaUnidades);?>;
</script>
<?php 
echo $this->Html->script('/risto/lib/bootstrap.typehead/bootstrap3-typeahead', true);

?>

</div>