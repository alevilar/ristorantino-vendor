<?php if ($this->request->data['Pedido']['id']) { ?>
    <h1>Agregando Mercaderias al Pedido <?php echo $this->Html->link("#".$this->request->data['Pedido']['id'], array('action'=>'view', $this->request->data['Pedido']['id']))?></h1>
<?php } else { ?>
    <h1>Nuevo Pedido</h1>
<?php }?>

<div>
	<?php echo $this->Form->create('Pedido'); ?>

    <?php echo $this->Form->input('id'); ?>

    <?php echo $this->Form->submit('Guardar Pedido', array('class'=>'pull-right btn-lg btn btn-success')); ?>
    <div class="clearfix"></div>
	<?php echo $this->Form->end(''); ?>
</div>



<div id="pedido-skeleton" class="row hide">

    <?php echo $this->Form->hidden('PedidoMercaderia.{X}.pedido_estado_id', array(
                            'value' => COMPRAS_PEDIDO_ESTADO_PENDIENTE,
        )); ?>



    <div class="col-md-4 col-xs-4">


	<?php 

	echo $this->Form->hidden('PedidoMercaderia.{X}.mercaderia_id', array(
                            'id' => 'pedido-mercaderia-id-{X}',
        ));


    echo $this->Form->input('PedidoMercaderia.{X}.mercaderia', array(
        'label' => false,
        'type' => 'text',
        'class' => 'form-control typeahead addmore',
        'div' => array('class'=>'form-group has-feedback'),
        'data-options' => json_encode($unidadDeMedidas),
        'data-dom-id' => '#pedido-mercaderia-id-{X}',
        'data-unidad-medida-id' => '#PedidoMercaderia{X}UnidadDeMedidaId',
        'data-url' => Router::url(array('controller'=>'Mercaderias','action'=>'index', 'ext' => 'json')),
        'autocomplete' => 'off',
        'placeholder' => 'Mercadería',
        'data-toggle' => "tooltip",
        'title' => 'Se creará una nueva Mercadería',
        'data-placement' => "bottom",
        'after' => '<span style="display:none" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
              <span style="display:none" class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>

        '

    ));

         ?>

  
    </div>


	<div class="col-md-2 col-xs-2">

        <?php echo $this->Form->input('PedidoMercaderia.{X}.cantidad', array(
                            'required' => false,
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Cantidad'
        )); ?>
    </div>
	<div class="col-md-2 col-xs-3">

    <?php 
    echo $this->Form->input('PedidoMercaderia.{X}.unidad_de_medida_id', array(
        'label' => false,
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



	
	<div class="col-md-4 col-xs-3"><?php echo $this->Form->input('PedidoMercaderia.{X}.observacion', array('type'=>'text', 'placeholder'=>'Obervación', 'label'=>false)); ?></div>
</div>

<script type="text/javascript">
	
	var mercaUnidades = <?php echo json_encode($mercaUnidades);?>;
</script>
<?php 
echo $this->Html->script('/risto/lib/bootstrap.typehead/bootstrap3-typeahead', true);
?>

<?php 
// echo $this->Html->script('/risto/lib/bootstrap/plugins/bootstrap3-typeahead', true);
//echo $this->Html->script('/risto/js/typeahead.bundle', true);
echo $this->Html->script('/compras/js/pedidos/add', true);

