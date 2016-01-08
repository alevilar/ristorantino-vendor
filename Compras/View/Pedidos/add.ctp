<h1>Nuevo Pedido</h1>

<div>
	<?php echo $this->Form->create('Pedido'); ?>

    <?php echo $this->Form->submit('Guardar Pedido', array('class'=>'pull-right btn-lg btn btn-success')); ?>
    <div class="clearfix"></div>
	<?php echo $this->Form->end(''); ?>
</div>



<div id="pedido-skeleton" class="row hide">

    <?php echo $this->Form->hidden('PedidoMercaderia.{X}.pedido_estado_id', array(
                            'value' => COMPRAS_PEDIDO_ESTADO_PENDIENTE,
        )); ?>


	<div class="col-md-2">

        <?php echo $this->Form->input('PedidoMercaderia.{X}.cantidad', array(
                            'required' => false,
                            'class' => 'form-control cantidad',
                            'label' => false,
                            'placeholder' => 'Cantidad'
        )); ?>
    </div>
	<div class="col-md-2">

    <?php echo $this->Form->input('PedidoMercaderia.{X}.unidad_de_medida_id', array(
        'label' => false,
        'class' => 'form-control typeahead',
        'autocomplete' => 'off',
        'placeholder' => 'Unidad de Medida',

    ));
    ?>
    <?php 
/*
    echo $this->Form->input('PedidoMercaderia.{X}.unidad_de_medida', array(
                            'label' => false,
                            'class' => 'form-control typeahead',
                            'data-options' => json_encode( $unidadDeMedidas ),
                            'data-dom-id' => 'pedido_umedida',
                            'type' => 'text',
                            'data-provide'=>"typeahead",
                            'autocomplete' => 'off',
                            'placeholder' => 'Unidad de Medida',
        )); 
        */
        ?>
   
    </div>

	<div class="col-md-4">


	<?php echo $this->Form->input('PedidoMercaderia.{X}.mercaderia_id', array(
                            'label' => false,
                            'class' => 'form-control typeahead',
                            'data-options' => $mercaderias,
                            'placeholder' => 'Mercaderia'
        )); ?>

  
    </div>

	
	<div class="col-md-4"><?php echo $this->Form->input('PedidoMercaderia.{X}.observacion', array('type'=>'text', 'placeholder'=>'Obervación', 'label'=>false)); ?></div>
</div>


<?php 
echo $this->Html->script('/risto/lib/bootstrap/plugins/bootstrap3-typeahead', true);
//echo $this->Html->script('/risto/js/typeahead.bundle', true);
echo $this->Html->script('/compras/js/pedidos/add', true);

