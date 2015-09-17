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

        <li class="dropdown">
            <?php echo $this->Html->link(__('Usuarios').'<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link(__('Usuarios'), array('plugin' => 'users', 'controller'=>'users', 'action' => 'index')) ?>
                </li>
                <li class="<?php echo $c2 ?>">
                    <?php echo $this->Html->link(Inflector::pluralize( Configure::read('Mesa.tituloMozo')),array('plugin'=>'mesa', 'controller'=>'mozos', 'action'=>'index')) ?>
                </li>
            </ul>
        </li>

        <li class="dropdown">
            <?php echo $this->Html->link(Inflector::pluralize(Configure::read("Mesa.tituloMesa")).'<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link(__('Listados'), array('plugin'=>'mesa', 'controller'=>'mesas', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c2 ?>">
                    <?php echo $this->Html->link(__('Pagos'), array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'history')) ?>
                </li>
                <li class="<?php echo $c3 ?>">
                    <?php echo $this->Html->link(__('Nueva').' '. Configure::read('Mesa.tituloMesa'), array('plugin'=>'account', 'controller'=>'clasificaciones', 'action'=>'gastos')) ?>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <?php echo $this->Html->link(__('Productos').'<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link(__('Categorias'),array('plugin'=>'product', 'controller'=>'categorias', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c2 ?>">
                    <?php echo $this->Html->link(__('Productos'), array('plugin'=>'product', 'controller'=>'productos', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c3 ?>">
                    <?php echo $this->Html->link(__('Adicionales'), array('plugin'=>'product', 'controller'=>'sabores', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c4 ?>">
                    <?php echo $this->Html->link(__('Observaciones de Productos'),array('plugin'=>'comanda', 'controller'=>'observaciones', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c5 ?>">
                    <?php echo $this->Html->link(__('Observaciones de Comandas'), array('plugin'=>'comanda', 'controller'=>'observacion_comandas', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c6 ?>">
                    <?php echo $this->Html->link(__('Tags'), array('plugin'=>'product', 'controller'=>'tags', 'action'=>'index')) ?>
                </li>
            </ul>
           </li>
                <li class="dropdown">
                    <?php echo $this->Html->link(Inflector::pluralize( Configure::read('Mesa.tituloCliente')).'<b class="caret"></b>', '#', array(
                         "class"=>"dropdown-toggle" ,
                         "data-toggle"=> "dropdown",
                         "escape" => false
                    )) ?>
                    <ul class="dropdown-menu">
                        <li class="<?php echo $c1 ?>">
                            <?php echo $this->Html->link(Inflector::pluralize( Configure::read('Mesa.tituloCliente')), array('plugin'=>'fidelization', 'controller'=>'clientes', 'action', 'index')) ?>
                        </li>
                        <li class="<?php echo $c2 ?>">
                            <?php echo $this->Html->link(__('Descuentos'), array('plugin'=>'fidelization', 'controller'=>'descuentos', 'action'=>'index')) ?>
                        </li>
                    </ul>
                </li>
        <li class="dropdown">
            <?php echo $this->Html->link(__('Configuración').'<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link(__('Tipo de Pagos'), array('plugin'=>'risto', 'controller'=>'TipoDePagos', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c2 ?>">
                    <?php echo $this->Html->link(__('Tipo de Facturas'), array('plugin'=>'risto', 'controller'=>'TipoFacturas', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c3 ?>">
                    <?php echo $this->Html->link(__('Tipos de Documentos'), array('plugin'=>'risto', 'controller'=>'TipoDocumentos', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c4 ?>">
                    <?php echo $this->Html->link(__('IVA Responsabilidades'), array('plugin'=>'risto', 'controller'=>'iva_responsabilidades', 'action'=>'index')) ?>
                </li>
                <li class="<?php echo $c5 ?>">
                    <?php echo $this->Html->link(__('Impresoras'),  array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'index')) ?>
                </li>
            </ul>
           </li>
