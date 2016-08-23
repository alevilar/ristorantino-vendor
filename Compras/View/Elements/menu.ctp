

<ul class="nav nav-tabs  nav-justified">


    <?php $class = ($this->request->controller == 'pedidos' && $this->request->action == 'pendientes') ? 'active' : '';?>
    <li class="<?php echo $class ?>">
        <?php echo $this->Html->link('[SC] Solicitud de Compra', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'pendientes')) ?>
    </li>                

    <?php $class = ($this->request->controller == 'pedidos' && $this->request->action == 'index') ? 'active' : '';?>
    <li class="<?php echo $class ?>">
        <?php echo $this->Html->link('[OC] Órdenes de Compra', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'index')) ?>
    </li>  
     

    <?php $class = $this->request->controller == 'pedido_mercaderias' ? 'active' : '';?>
    <li class="<?php echo $class ?>">
        <?php echo $this->Html->link('Historial', array('plugin'=>'compras', 'controller'=>'pedido_mercaderias', 'action'=>'historial')) ?>
    </li>


                
</ul>
