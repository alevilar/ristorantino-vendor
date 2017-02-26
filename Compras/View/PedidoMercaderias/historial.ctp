<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Mercaderia de la Órden de Compra'));?>

<?php 
echo $this->Html->script('/risto/lib/bootstrap.typehead/bootstrap3-typeahead', true);
?>


<div class="content-white">
	<h1>Historial de Órdenes de Compra</h1>

	<p class="center">
		<?php echo $this->Form->create('PedidoMercaderia', array('class'=>'form-inline')); ?>
		<?php echo $this->Form->input('pedido_id', array('type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>'Nº Órden de Compra', 'required'=>false)); ?>
		<?php 
		echo $this->Form->input('mercaderia_id', array('options'=>$mercaderias, 'label'=>false, 'div'=>false, 'placeholder'=>'Mercaderia', 'required'=>false, 'empty'=>'Seleccione')); ?>
		<?php echo $this->Form->input('proveedor_id', array('empty'=>'Todos', 'label'=>false, 'div'=>false, 'required'=>false)); ?>
		<?php echo $this->Form->submit('Filtrar', array('class'=>'btn btn-success', 'div'=>false)) ?>
		<?php echo $this->Form->end(); ?>
		</p>


	

	<?php echo $this->element("Compras.pedido_mercaderia_list");?>

</div>