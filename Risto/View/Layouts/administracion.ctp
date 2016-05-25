<?php $this->extend('Risto.default'); ?>

<?php $this->assign('title', 'Configuración');?>

<?php echo $this->Html->css('Risto.administracion');?>


<?php $this->append('post-header');?>
    <nav class="subnavbar navbar navbar-inverse">
        <div class="navbar-left">
            
            <?php
            if ( array_key_exists('tenant', $this->request->params) && !empty( $this->request->params['tenant']) ) {
                ?>


                <div class="btn-group">

                     <?php
                        echo $this->Html->link(Configure::read('Site.name'), array('plugin'=>'risto', 'controller' => 'pages', 'action' => 'display', 'dashboard'), array('class'=>'btn btn-default btn-lg navbar-btn'));
                        ?>



                    <?php 
                    $img = '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>';
                    echo $this->Html->link($img, array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'), array(
                                        'class' => 'btn btn-default btn-lg  navbar-btn',
                                        'escape' => false,
                                        'data-toggle' => "tooltip",
                                        'aria-haspopup' => "true",
                                        'data-placement'=>"bottom",
                                        'title'=>"Estadísticas: Visualizar el histórico de ventas, productos más vendidos y muchas cosas más.",
                                        )); ?>


                    <?php 
                    $img = '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>';
                    echo $this->Html->link($img, array('plugin'=>'install', 'controller'=>'configurations', 'action'=>'edit'), array(
                                        'class' => 'btn btn-default btn-lg  navbar-btn  dropdown-toggle',
                                        'escape' => false,
                                        'data-toggle' => "tooltip",
                                        'aria-haspopup' => "true",
                                        'data-placement'=>"bottom",
                                        'title'=>"Configuración: Igresar aqui para dar de alta a los usuarios, mozos, productos, clientes, descuentos, etc.",
                                        )); ?>

                 
                  </div>


                <?php
            }
            ?>

        </div>

        <div class="center navbar-left" style="margin-left: 30px;"><h1 class="white-8"><?php echo $this->fetch('title')?></h1></div>
    </nav>
<?php $this->end();?>

<?php $this->start('sidebar'); ?>
	<div class="list-group">

		<!-- configuracion general -->
        <?php
        $class = $this->request->plugin == 'install' ? 'active':'';
        echo $this->Html->link(__('Configuración del Sitio'), array( 'plugin'=>'install', 'controller'=>'configurations','action'=>'edit'), array('class' => 'list-group-item '.$class));
        ?>

	  	<?php
	  	/*
        echo $this->Html->link('Usuarios'
                , array('plugin' => 'site_users', 'controller'=>'site_users', 'action' => 'index')
                , array('class' => 'list-group-item'));
        //echo $this->Html->link('Roles',  array('plugin' => 'users', 'controller'=>'roles', 'action' => 'index'), array('class' => 'list-group-item'));
        echo $this->Html->link( Inflector::pluralize( Configure::read('Mesa.tituloMozo') ) , array('plugin'=>'mesa', 'controller'=>'mozos', 'action'=>'index'), array('class' => 'list-group-item'));
        */
        $class = $this->request->plugin == 'mesa' ? 'active':'';
        echo $this->Html->link( Inflector::pluralize( Configure::read('Mesa.tituloMozo') ) , array('plugin'=>'mesa', 'controller'=>'mozos', 'action'=>'index'), array('class' => 'list-group-item '.$class));

        ?>



        <!-- productos -->
        <?php
        $class = $this->request->plugin == 'product' ? 'active':'';
        echo $this->Html->link(__('Productos'), array('plugin'=>'product', 'controller'=>'productos', 'action'=>'index'), array('class' => "list-group-item $class"));
        ?>


        <?php
        $class = $this->request->plugin == 'fidelization' ? 'active':'';
        echo $this->Html->link(Inflector::pluralize( Configure::read('Mesa.tituloCliente')) . " " .__("y Descuentos"), array('plugin'=>'fidelization', 'controller'=>'clientes', 'action', 'index'), array('class' => 'list-group-item '.$class));
         
        ?>



         <?php


        $fiscalDriver = Classregistry::init('Printers.Printer')->field('driver', array(
                array(
                        'Printer.id' => Configure::read('Printers.fiscal_id')
                )));
        if ( $fiscalDriver == PRINTERS_AFIP ) {
            echo $this->Html->link(__('Afip Facturas'), array('plugin'=>'printers', 'controller'=>'afip_facturas', 'action'=>'index'), array('class' => 'list-group-item'));
        }
        unset($fiscalDriver);


        if ( CakeSession::read("Auth.User.is_admin") ) {

            echo "<div class='list-group-item separator text-danger'>A partir de Aquí solo vista ADMIN</div>";
            echo $this->Html->link(__('Tipo de Pagos'), array('plugin'=>'risto', 'controller'=>'TipoDePagos', 'action'=>'index'), array('class' => 'list-group-item'));

            echo $this->Html->link(__('Tipo de Facturas'), array('plugin'=>'risto', 'controller'=>'TipoFacturas', 'action'=>'index'), array('class' => 'list-group-item'));

            
            echo $this->Html->link(__('Tipos de Documentos'), array('plugin'=>'risto', 'controller'=>'TipoDocumentos', 'action'=>'index'), array('class' => 'list-group-item'));
            echo $this->Html->link(__('IVA Responsabilidades'), array('plugin'=>'risto', 'controller'=>'iva_responsabilidades', 'action'=>'index'), array('class' => 'list-group-item'));
           // echo $this->Html->link('Permisos de usuarios', '/admin/acl', array('class' => 'list-group-item'));



            echo $this->Html->link(__('Impresoras'), array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'index'), array('class' => 'list-group-item'));     
        } 

        ?>
	</div>
<?php $this->end(); ?>


<?php echo $this->fetch('content');?>