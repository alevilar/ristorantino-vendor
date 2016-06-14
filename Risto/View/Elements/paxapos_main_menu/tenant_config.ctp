
<div class="list-group">

		

	  	<?php

        $class = $this->request->plugin == 'mesa' ? 'active':'';
        echo $this->Html->link( Inflector::pluralize('<i class="fa fa-user-plus" aria-hidden="true"></i>
&nbsp;'.Configure::read('Mesa.tituloMozo') ) , array('plugin'=>'mesa', 'controller'=>'mozos', 'action'=>'index'), array('class' => 'list-group-item '.$class, 'escape'=>false));

        ?>



        <!-- productos -->
        <?php
        $class = $this->request->plugin == 'product' ? 'active':'';
        echo $this->Html->link('<i class="fa fa-barcode" aria-hidden="true"></i>
&nbsp;'.__('Productos'), array('plugin'=>'product', 'controller'=>'productos', 'action'=>'index'), array('class' => "list-group-item $class", 'escape'=>false));
        ?>


        <?php
        $class = $this->request->plugin == 'fidelization' ? 'active':'';
        echo $this->Html->link('<i class="fa fa-users" aria-hidden="true"></i>
&nbsp;'.Inflector::pluralize( Configure::read('Mesa.tituloCliente')) . " " .__("y Descuentos"), array('plugin'=>'fidelization', 'controller'=>'clientes', 'action', 'index'), array('class' => 'list-group-item '.$class, 'escape'=>false));
         
        ?>

        
        <?php
         echo $this->Html->link('<i class="fa fa-money" aria-hidden="true"></i>
&nbsp;'.__('Tipo de Pagos'), array('plugin'=>'risto', 'controller'=>'TipoDePagos', 'action'=>'index'), array('class' => 'list-group-item', 'escape'=>false));

        ?>


<?php 
$roles = array();
$rol = $this->Session->read('Auth.User.Rol');
if ( empty( $rol ) )  {  
    $roles = null;
} else {
    $roles = Hash::extract($rol, "{n}.id");
}

if ( $roles === null || in_array( ROL_ID_ENCARGADO, $roles ) ) {
?>
        <br>

        <!-- configuracion general -->
        <?php

        echo $this->Html->link('<i class="fa fa-key" aria-hidden="true"></i> '.'Usuarios'
                , array('plugin' => 'users', 'controller'=>'generic_users', 'action' => 'index')
                , array(
                'class' => 'list-group-item',
                'escape' => false,
            ));
       
       



        $class = $this->request->plugin == 'install' ? 'active':'';
        echo $this->Html->link('<i class="fa fa-gears" aria-hidden="true"></i>
&nbsp;'.__('Configuración del Comercio'), array( 'plugin'=>'install', 'controller'=>'configurations','action'=>'edit'), array('class' => 'list-group-item '.$class, 'escape'=>false));
        ?>


        <?php
        $class = $this->request->plugin == 'install' ? 'active':'';
        echo $this->Html->link('<i class="fa fa-plug" aria-hidden="true"></i>
&nbsp;'.__('Instalar Apps'), array( 'plugin'=>'install', 'controller'=>'configurations','action'=>'modulos'), array('class' => 'list-group-item '.$class, 'escape'=>false));
        ?>



        <br>

         <?php


        $fiscalDriver = Classregistry::init('Printers.Printer')->field('driver', array(
                array(
                        'Printer.id' => Configure::read('Printers.fiscal_id')
                )));
        if ( $fiscalDriver == PRINTERS_AFIP ) {
            echo $this->Html->link(__('Afip Facturas'), array('plugin'=>'printers', 'controller'=>'afip_facturas', 'action'=>'index'), array('class' => 'list-group-item', 'escape'=>false));
        }
        unset($fiscalDriver);


        if ( CakeSession::read("Auth.User.is_admin") ) {

            echo "<div class='list-group-item separator text-danger'>A partir de Aquí solo vista ADMIN</div>";

            echo $this->Html->link(__('Tipo de Facturas'), array('plugin'=>'risto', 'controller'=>'TipoFacturas', 'action'=>'index'), array('class' => 'list-group-item'));

            
            echo $this->Html->link(__('Tipos de Documentos'), array('plugin'=>'risto', 'controller'=>'TipoDocumentos', 'action'=>'index'), array('class' => 'list-group-item'));
            echo $this->Html->link(__('IVA Responsabilidades'), array('plugin'=>'risto', 'controller'=>'iva_responsabilidades', 'action'=>'index'), array('class' => 'list-group-item'));
           // echo $this->Html->link('Permisos de usuarios', '/admin/acl', array('class' => 'list-group-item'));



            echo $this->Html->link(__('Impresoras'), array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'index'), array('class' => 'list-group-item'));  


            echo $this->Html->link(__('Usuarios PaxaPos'), array('plugin'=>'site_users', 'controller'=>'site_users', 'action'=>'index'), array('class' => 'list-group-item'));  

        } 

        ?>

    <?php } ?>
</div>