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
	var mercaIndexURL = "<?php echo $this->Html->url(array('controller'=>'mercaderias', 'action'=>'index'));?>";
</script>

<style>
.twitter-typeahead{
	width: 100%;
}
.twitter-typeahead .tt-query,
.twitter-typeahead .tt-hint {
}

.tt-menu{
   min-width: 160px;
	margin-top: 2px;
	padding: 5px 0;
	background-color: #ffffff;
	border: 1px solid #cccccc;
	border: 1px solid rgba(0, 0, 0, 0.15);
	border-radius: 4px;
	-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  	box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
	background-clip: padding-box;
}



.tt-suggestion {
	display: block;
	padding: 6px 20px;
	font-size: 20px;
	border-bottom: 1px solid #ccc;
}

.tt-suggestion:last-child {
	border-bottom: none;
}

.tt-description{
	font-size: 11px;
}
.tt-cursor , .tt-suggestion:hover {
	background-color: #0599B0;
	color: white;
	cursor: hand;
	cursor: cursor;
}
.tt-suggestion.tt-is-under-cursor {
	color: #fff;
	background-color: #428bca;
}
.tt-suggestion.tt-is-under-cursor a {
	color: #fff;
}
.tt-suggestion p {
	margin: 0;
}
</style>
<?php 
//echo $this->Html->script('/risto/lib/bootstrap.typehead/bootstrap3-typeahead', true);

echo $this->Html->script('/risto/js/typeahead.js/dist/typeahead.jquery');
echo $this->Html->script('/risto/js/typeahead.js/dist/bloodhound.js');
echo $this->Html->script('/compras/js/pedido_mercaderias/add');

?>

</div>