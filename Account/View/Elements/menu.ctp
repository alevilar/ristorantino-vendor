<?php
$c1 = $c2 = $c3 = $c4 = $c5 = $c6 = $c7 = $c8 = '';

if ($this->name == 'Gastos' && $this->action == 'index') {
    $c1 = 'active';
}
if ($this->name == 'Gastos' && $this->action == 'history') {
    $c2 = 'active';
}
if ($this->name == 'Clasificaciones' && $this->action == 'gastos') {
    $c3 = 'active';
}
if ($this->name == 'Egresos' && $this->action == 'history') {
    $c4 = 'active';
}
if ($this->name == 'Cierres' && $this->action == 'index') {
    $c5 = 'active';
}
if ($this->name == 'Proveedores' && $this->action == 'index') {
    $c6 = 'active';
}
if ($this->name == 'TipoImpuestos' && $this->action == 'index') {
    $c7 = 'active';
}
if ($this->name == 'Clasificaciones' && $this->action == 'index') {
    $c8 = 'active';
}
?>
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
    <ul class="nav navbar-nav">
        

        <li class="dropdown">
            <?php echo $this->Html->link('Gastos<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link('Pendientes de Pago', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c2 ?>">
                    <?php echo $this->Html->link('Listado de Gastos', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'history')) ?>
                </li>
                <li class="<?php echo $c3 ?>">
                    <?php echo $this->Html->link('Gastos x Clasificación', array('plugin'=>'account', 'controller'=>'clasificaciones', 'action'=>'gastos')) ?>
                </li>
            </ul>
        </li>



        <li class="<?php echo $c4 ?>">
            <?php echo $this->Html->link('Pagos', array('plugin'=>'account', 'controller'=>'egresos', 'action'=>'history')) ?>
        </li>
        <li class="<?php echo $c5 ?>">
            <?php echo $this->Html->link('Cierres', array('plugin'=>'account', 'controller'=>'cierres', 'action'=>'index')) ?>
        </li>

        <li class="<?php echo $c6 ?>">
            <?php echo $this->Html->link('Proveedores', array('plugin'=>'account', 'controller'=>'proveedores', 'action'=>'index')) ?>
        </li>

        <li class="<?php echo $c7 ?>">
            <?php echo $this->Html->link('Impuestos', array('plugin'=>'account', 'controller'=>'tipo_impuestos', 'action'=>'index')) ?>
        </li>
        
         <li class="<?php echo $c8 ?>">
            <?php echo $this->Html->link('Clasificaciones', array('plugin'=>'account', 'controller'=>'clasificaciones', 'action'=>'index')) ?>
        </li>
    </ul>      


</nav>
