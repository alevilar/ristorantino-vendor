<h1>Mercaderia del Pedido <?php echo $this->Html->link("#".$this->request->data['PedidoMercaderia']['pedido_id'], array('controller'=>'pedidos', 'action'=>'view', $this->request->data['PedidoMercaderia']['pedido_id']));?></h1>


<?php echo $this->Form->create('PedidoMercaderia');?>
<div class="col-md-6">
	<?php echo $this->Form->input('id');?>
	<?php echo $this->Form->hidden('pedido_id');?>
	<?php echo $this->Form->input('cantidad');?>
	<?php echo $this->Form->input('mercaderia_id');?>
	<?php echo $this->Form->input('unidad_de_medida_id');?>
	<?php echo $this->Form->input('pedido_estado_id');?>
	
	
</div>

<div class="col-md-6">
	
	<?php echo $this->Form->input('proveedor_id', array('empty'=>'Seleccione'));?>	
	<?php echo $this->Form->input('observacion');?>
	<?php echo $this->Form->submit('Guardar', array('class'=>'btn btn-block btn-primary'));?>
</div>

	
	<?php echo $this->Form->end();?>