<h1>Mercaderia del Pedido #</h1>

<div>
	<?php echo $this->Form->create('PedidoMercaderia');?>
	<?php echo $this->Form->input('id');?>
	<?php echo $this->Form->hidden('pedido_id');?>
	<?php echo $this->Form->input('cantidad');?>
	<?php echo $this->Form->input('mercaderia_id');?>
	<?php echo $this->Form->input('unidad_de_medida_id');?>
	<?php echo $this->Form->input('pedido_estado_id');?>
	<?php echo $this->Form->input('observacion');?>
	
	<?php echo $this->Form->end(__('Guardar'));?>
</div>