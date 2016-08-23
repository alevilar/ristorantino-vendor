

<h4 class="blue center">Opciones de Configuración</h4>
<div class="list-group">

	

    <?php echo $this->Html->link('Mercaderias', array('plugin'=>'compras', 'controller'=>'Mercaderias', 'action'=>'index'), array('class'=>'list-group-item')) ?>

    <?php echo $this->Html->link('Unidades de Medida', array('plugin'=>'compras', 'controller'=>'UnidadDeMedidas', 'action'=>'index'), array('class'=>'list-group-item')) ?>

    <?php echo $this->Html->link('Rubros', array('plugin'=>'compras', 'controller'=>'Rubros', 'action'=>'index'), array('class'=>'list-group-item')) ?>



    <?php echo $this->Html->link('Asignar Rubro', array('plugin'=>'compras', 'controller'=>'mercaderias', 'action'=>'asignar_rubros'), array('class'=>'list-group-item')) ?>

       

    <?php echo $this->Html->link('Estados del Pedido', array('plugin'=>'compras', 'controller'=>'PedidoEstados', 'action'=>'index'), array('class'=>'list-group-item')) ?>

    <div class="separator"></div>
    <?php echo $this->Html->link('<span class="glyphicon glyphicon-open-file" aria-hidden="true"></span>Proveedores', array('plugin'=>'account', 'controller'=>'proveedores', 'action'=>'index'), array('class'=>'list-group-item', 'escape'=>false, 'target'=> '_blank')) ?>

</div>