<?php $c1 = '' ?>

		<li class="">
                <?php echo $this->Html->link('Nuevo Pedido', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'add'), array('class'=>'btn btn-success')) ?>
            </li>


        <li class="dropdown">
            <?php echo $this->Html->link('Pedidos<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link('Pendientes', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'pendientes')) ?>
                </li>                
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link('Historial', array('plugin'=>'compras', 'controller'=>'pedido_mercaderias', 'action'=>'historial')) ?>
                </li>
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link('Listar Pedidos', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'index')) ?>
                </li>                
            </ul>
        </li>


        <li class="dropdown">
            <?php echo $this->Html->link('Mercaderias<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link('Listado', array('plugin'=>'compras', 'controller'=>'Mercaderias', 'action'=>'index')) ?>
                </li>  

                 <li class="<?php echo $c1 ?>">
                    <?php echo $this->Html->link('Unidades de Medida', array('plugin'=>'compras', 'controller'=>'UnidadDeMedidas', 'action'=>'index')) ?>
                </li>              
            </ul>
        </li>
       
        

        <li>
            <?php echo $this->Html->link('Proveedores', array('plugin'=>'account', 'controller'=>'proveedores', 'action'=>'index')) ?>
        </li>


        <li>
            <?php echo $this->Html->link('Estados del Pedido', array('plugin'=>'compras', 'controller'=>'PedidoEstados', 'action'=>'index')) ?>
        </li>

        
    </ul>      


</nav>
