<?php
$c1 = $c2 = $c3 = '';

if( $this->name == 'Stats' && $this->action == 'mesas_total') {
    $c1 = 'active';
}
if( $this->name == 'Stats' && $this->action == 'mozos_total') {
    $c2 = 'active';
}
if( $this->name == 'Stats' && $this->action == 'tipos_de_pago') {
    $c3 = 'active';
}

?>
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
     <ul class="nav navbar-nav">
        <li class="<?php echo $c1?>"><?php echo $this->Html->link('Ventas totales', array('plugin'=>'stats', 'controller'=>'stats', 'action'=>'mesas_total'),array('class'=>'ventas'));?></li>
        
        <li class="<?php echo $c2?>"><?php echo $this->Html->link(__('Ventas x %s', Configure::read('Mesa.tituloMozo') ),  array('plugin'=>'stats', 'controller'=>'stats', 'action'=>'mozos_total'),array('class'=>'ventas'));?></li>
        
        <li class="<?php echo $c3?>"><?php echo $this->Html->link('Tipos de Pago', array('plugin'=>'stats', 'controller'=>'stats', 'action'=>'tipos_de_pago'),array('class'=>'ventas'));?></li>
        
    </ul>
    
</nav>
