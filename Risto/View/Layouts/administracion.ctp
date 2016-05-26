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



<?php echo $this->fetch('content');?>