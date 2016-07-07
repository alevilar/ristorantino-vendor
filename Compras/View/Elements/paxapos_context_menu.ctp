
<br>
<?php echo $this->Html->link('Nueva Órden de Compra', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'add'), array('class'=>'btn btn-success btn-block')) ?>
<br>

<h4 class="blue center">Opciones de Configuración</h4>
<div class="list-group">

	

    <?php echo $this->Html->link('Mercaderias', array('plugin'=>'compras', 'controller'=>'Mercaderias', 'action'=>'index'), array('class'=>'list-group-item')) ?>

    <?php echo $this->Html->link('Unidades de Medida', array('plugin'=>'compras', 'controller'=>'UnidadDeMedidas', 'action'=>'index'), array('class'=>'list-group-item')) ?>

    <?php echo $this->Html->link('Rubros', array('plugin'=>'compras', 'controller'=>'Rubros', 'action'=>'index'), array('class'=>'list-group-item')) ?>

    <?php echo $this->Html->link('Asignar Rubro', array('plugin'=>'compras', 'controller'=>'mercaderias', 'action'=>'asignar_rubros'), array('class'=>'list-group-item')) ?>

       

    <?php echo $this->Html->link('Estados del Pedido', array('plugin'=>'compras', 'controller'=>'PedidoEstados', 'action'=>'index'), array('class'=>'list-group-item')) ?>


</div>