<h1>Nuevo Pedido</h1>

<div>
	<?php echo $this->Form->create('Pedido'); ?>
	<?php echo $this->Form->end('Guardar'); ?>
</div>



<?php echo $this->Form->create('PedidoTemporal'); ?>
<div class="pedido-skeleton row hide">
	<div class="col-md-2"><?php echo $this->Form->input('PedidoMercaderia.0.cantidad'); ?></div>
	<div class="col-md-2"><?php echo $this->Form->input('PedidoMercaderia.0.unidad_de_medida_id'); ?></div>

	<div class="col-md-4">


	<?php echo $this->Form->hidden('mercaderia_id'); ?>

    <?php echo $this->Form->input('mercaderia_list', array(
                'autocomplete'=>'off',
                'label' => 'Mercaderia', 
                'type' => 'text', 
                'id' => 'pedido-mercaderia-list', 
                'required' => false,
                'class' => 'form-control auto-complete',
                'data-url' => $this->html->url(array('plugin' => 'compras', 'controller' => 'mercaderias', 'action' => 'index', 'ext' => 'json')),
                'data-toggle' => 'popover',
                'after' => '<div style="display:none" class="text-warning" id="nuevo-proveedor">Se va a creear una nueva mercaderia</div>',
                )
                    );
                    ?>
    </div>


	
	<div class="col-md-4"><?php echo $this->Form->input('PedidoMercaderia.0.observacion', array('type'=>'text')); ?></div>
</div>
<?php echo $this->Form->end(''); ?>


<?php 
echo $this->Html->script('/risto/lib/bootstrap/plugins/bootstrap3-typeahead');
echo $this->Html->script('/account/js/gastos_add'); 

?>
