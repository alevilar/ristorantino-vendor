<div class="content-white">


<h1>SC - Nueva Solicitud de Compra</h1>

<div>
	<?php echo $this->Form->create('PedidoMercaderia', array('id'=> "PedidoAddForm")); ?>

    <?php echo $this->Form->submit('Guardar Solicitud de Compra', array('class'=>'pull-right btn-lg btn btn-success')); ?>
    <div class="clearfix"></div>
	<?php echo $this->Form->end(''); ?>
</div>


<div id="pedido-skeleton">
    <?php echo $this->element("Compras.pedido-skeleton", array('pmId'=>'{X}'));?>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
	
	var mercaUnidades = <?php echo json_encode($mercaUnidades);?>;
</script>
<?php 
echo $this->Html->script('/risto/lib/bootstrap.typehead/bootstrap3-typeahead', true);

?>

</div>