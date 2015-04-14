<div class="col-md-3">

    <h2>Usuarios</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link('Usuarios'
                , array('plugin' => 'users', 'controller'=>'users', 'action' => 'index')
                , array('class' => 'list-group-item'));
        //echo $this->Html->link('Roles',  array('plugin' => 'users', 'controller'=>'roles', 'action' => 'index'), array('class' => 'list-group-item'));
        echo $this->Html->link( Inflector::pluralize( Configure::read('Mesa.tituloMozo') ) , array('plugin'=>'mesa', 'controller'=>'mozos', 'action'=>'index'), array('class' => 'list-group-item'));
        ?>
    </div>


    <h2><?php echo Inflector::pluralize( Configure::read('Mesa.tituloCliente')) ?></h2>
    <div class="list-group">
        <?php
        echo $this->Html->link(Inflector::pluralize( Configure::read('Mesa.tituloCliente')), array('plugin'=>'fidelization', 'controller'=>'clientes', 'action', 'index'), array('class' => 'list-group-item'));
        echo $this->Html->link('Descuentos', array('plugin'=>'fidelization', 'controller'=>'descuentos', 'action'=>'index'), array('class' => 'list-group-item'));        
        ?>   
    </div>
</div>

<div class="col-md-3">
    
    <h2><?php echo __( Inflector::pluralize( Configure::read('Mesa.tituloMesa') )) ?></h2>
    <div class="list-group">
        <?php
        echo $this->Html->link( __('Listado de %s', Inflector::pluralize( Configure::read('Mesa.tituloMesa') )) , array('plugin'=>'mesa', 'controller'=>'mesas', 'action'=>'index'), array('class' => 'list-group-item'));
        echo $this->Html->link(__('Pagos de %s', Inflector::pluralize( Configure::read('Mesa.tituloMesa') ) ), array('plugin'=>'mesa', 'controller'=>'pagos', 'action'=>'index'), array('class' => 'list-group-item'));
        echo $this->Html->link(__('Nueva %s', Configure::read('Mesa.tituloMesa')), array('plugin'=>'mesa', 'controller'=>'mesas', 'action'=>'add'), array('class' => 'list-group-item'));

        
        ?>
    </div>    
    <?php
    echo $this->Html->link(__('Afip Facturas'), array('plugin'=>'printers', 'controller'=>'afip_facturas', 'action'=>'index'), array('class' => 'list-group-item'));
    ?>
</div>
<div class="col-md-3">
    <h2>Productos</h2>
    <div class="list-group">
        <?php
        echo $this->Html->link(__('Categorias'), array('plugin'=>'product', 'controller'=>'categorias', 'action'=>'index'), array('class' => 'list-group-item'));
        echo $this->Html->link(__('Productos'), array('plugin'=>'product', 'controller'=>'productos', 'action'=>'index'), array('class' => 'list-group-item'));
        echo $this->Html->link(__('Adicionales'), array('plugin'=>'product', 'controller'=>'sabores', 'action'=>'index'), array('class' => 'list-group-item'));
        
        echo $this->Html->link(__('Observaciones de Productos'), array('plugin'=>'comanda', 'controller'=>'observaciones', 'action'=>'index'), array('class' => 'list-group-item'));
        echo $this->Html->link(__('Observaciones de Comandas'), array('plugin'=>'comanda', 'controller'=>'observacion_comandas', 'action'=>'index'), array('class' => 'list-group-item'));       
        echo $this->Html->link(__('Tags'), array('plugin'=>'product', 'controller'=>'tags', 'action'=>'index'), array('class' => 'list-group-item'));
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

    <h2>Configuración</h2>
    <div class="list-group">

        <?php
        echo $this->Html->link(__('Configuración del Sitio'), array( 'plugin'=>'install', 'controller'=>'configurations','action'=>'edit'), array('class' => 'list-group-item'));


        echo $this->Html->link(__('Tipo de Pagos'), array('plugin'=>'risto', 'controller'=>'TipoDePagos', 'action'=>'index'), array('class' => 'list-group-item'));

        echo $this->Html->link(__('Tipo de Facturas'), array('plugin'=>'risto', 'controller'=>'TipoFacturas', 'action'=>'index'), array('class' => 'list-group-item'));

        
        echo $this->Html->link(__('Tipos de Documentos'), array('plugin'=>'risto', 'controller'=>'TipoDocumentos', 'action'=>'index'), array('class' => 'list-group-item'));
        echo $this->Html->link(__('IVA Responsabilidades'), array('plugin'=>'risto', 'controller'=>'iva_responsabilidades', 'action'=>'index'), array('class' => 'list-group-item'));
       // echo $this->Html->link('Permisos de usuarios', '/admin/acl', array('class' => 'list-group-item'));



        echo $this->Html->link(__('Impresoras'), array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'index'), array('class' => 'list-group-item'));     

        ?>
    </div>

</div>
