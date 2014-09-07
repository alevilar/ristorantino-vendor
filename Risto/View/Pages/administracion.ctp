﻿<div class="col-md-3">

    <h2>Usuarios</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Usuarios', array('plugin' => 'users', 'controller'=>'user', 'action' => 'index'), array('class' => 'list-group-item'));
        //echo $this->Html->link('Roles', '/users/roles/index', array('class' => 'list-group-item'));
        echo $this->Html->link('Mozos', '/mesa/mozos/index', array('class' => 'list-group-item'));
        ?>
    </div>

    <h2><?php echo __( Inflector::pluralize( Configure::read('Mesa.tituloMesa') )) ?></h2>
    <div class="list-group">
        <?php
        echo $this->Html->link( __('Listado de %s', Inflector::pluralize( Configure::read('Mesa.tituloMesa') )) , '/mesa/Mesas', array('class' => 'list-group-item'));
        echo $this->Html->link(__('Pagos de %s', Inflector::pluralize( Configure::read('Mesa.tituloMesa') ) ), '/mesa/pagos', array('class' => 'list-group-item'));
        echo $this->Html->link(__('Nueva %s', Configure::read('Mesa.tituloMesa')), '/mesa/Mesas/add', array('class' => 'list-group-item'));
        ?>
    </div>    
</div>





<div class="col-md-3">
    <h2>Productos</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Categorias', '/product/categorias', array('class' => 'list-group-item'));
        echo $this->Html->link('Productos', '/product/productos', array('class' => 'list-group-item'));
        echo $this->Html->link('Sabores', '/product/sabores', array('class' => 'list-group-item'));
        
        echo $this->Html->link('Observaciones de Productos', '/comanda/observaciones', array('class' => 'list-group-item'));
        echo $this->Html->link('Observaciones de Comandas', '/comanda/observacion_comandas', array('class' => 'list-group-item'));
        echo $this->Html->link('Productos Pedidos', '/comanda/detalle_comandas/', array('class' => 'list-group-item'));
        echo $this->Html->link('Tags', '/product/tags', array('class' => 'list-group-item'));
        ?>
    </div>

<!--    <h2>Inventario</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Listar productos', '/inventory/products', array('class' => 'list-group-item'));
        echo $this->Html->link('Agregar producto', '/inventory/products/add', array('class' => 'list-group-item'));
        echo $this->Html->link('Listar categorias', '/inventory/categories', array('class' => 'list-group-item'));
        echo $this->Html->link('Agregar categorias', '/inventory/categories/add', array('class' => 'list-group-item'));
        echo $this->Html->link('Listar inventario, ver al día', '/inventory/counts', array('class' => 'list-group-item'));
        echo $this->Html->link('Agregar stock a inventario', '/inventory/counts/add', array('class' => 'list-group-item'));
        echo $this->Html->link('Listar para imprimir', '/inventory/counts/listar_faltantes_para_imprimir', array('class' => 'list-group-item'));
        ?>
    </div>-->
</div>




<div class="col-md-3">
    <h2>Clientes</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Clientes', array('plugin'=>'fidelization', 'controller'=>'clientes', 'action', 'index'), array('class' => 'list-group-item'));
        echo $this->Html->link('Descuentos', '/fidelization/descuentos', array('class' => 'list-group-item'));        
        ?>   
    </div>

    
</div>



<div class="col-md-3">

    <h2>Configuración</h2>
    <div class="list-group">
        <?php

        echo $this->Html->link('Tipo de Pagos', '/risto/TipoDePagos', array('class' => 'list-group-item'));

        echo $this->Html->link('Tipo de Facturas', '/risto/tipo_facturas', array('class' => 'list-group-item'));

        
        echo $this->Html->link('Tipos de Documentos', '/risto/tipo_documentos', array('class' => 'list-group-item'));
        echo $this->Html->link('IVA Responsabilidades', '/risto/iva_responsabilidades', array('class' => 'list-group-item'));
       // echo $this->Html->link('Permisos de usuarios', '/admin/acl', array('class' => 'list-group-item'));



        echo $this->Html->link('Printers', array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'index'), array('class' => 'list-group-item'));

        echo $this->Html->link('Configuración General', array('plugin'=>'risto', 'controller'=>'configs', 'action'=>'basic_configuration'), array('class' => 'list-group-item'));
        ?>
    </div>

</div>
