<?php
$c1 = $c2 = $c3 = $c4 = $c5 = '';

if( $this->name == 'Stats' && $this->action == 'mesas_total') {
    $c1 = 'active';
}
if( $this->name == 'Stats' && $this->action == 'mozos_total') {
    $c2 = 'active';
}
if( $this->name == 'Stats' && $this->action == 'tipos_de_pago') {
    $c3 = 'active';
}

if( $this->name == 'DetalleComandas' && $this->action == 'index') {
    $c4 = 'active';
}

if( $this->name == 'Mesas' && $this->action == 'index') {
    $c5 = 'active';
}


?>
<ul class="nav nav-tabs  nav-justified">

        <li class="<?php echo $c1?>"><?php echo $this->Html->link('Ventas totales', array('plugin'=>'stats', 'controller'=>'stats', 'action'=>'mesas_total'),array('class'=>'ventas'));?></li>
        
        <li class="<?php echo $c2?>"><?php echo $this->Html->link(__('Ventas x %s', Configure::read('Mesa.tituloMozo') ),  array('plugin'=>'stats', 'controller'=>'stats', 'action'=>'mozos_total'),array('class'=>'ventas'));?></li>
        
        <li class="<?php echo $c3?>"><?php echo $this->Html->link('Tipos de Pago', array('plugin'=>'stats', 'controller'=>'stats', 'action'=>'tipos_de_pago'),array('class'=>'ventas'));?></li>

        <li class="<?php echo $c4?>"><?php echo $this->Html->link('Productos Pedidos', array('plugin'=>'comanda', 'controller'=>'detalle_comandas', 'action'=>'index'),array('class'=>'ventas'));?></li>


        <li class="<?php echo $c5?>"><?php echo $this->Html->link('Listado de '.Inflector::pluralize( Configure::read('Mesa.tituloMesa') ), array('plugin'=>'mesa', 'controller'=>'mesas', 'action'=>'index'),array('class'=>'ventas'));?></li>

</ul>