<div data-role="page" id="listado_de_clientes" data-theme="f">    


       <div data-role="content" >

                    <div class="header-cliente">

                        <a href="#mesa-view" data-direction="reverse" data-role="button" data-inline="true">Volver</a>
                        
                        <?php echo $this->Html->link(__('Crear %s', Configure::read('Mesa.tituloCliente')), array('plugin'=>'fidelization', 'controller'=>'clientes', 'action'=>'simple_add'), array(
                            'data-role' => 'button',
                            'data-inline' => 'true',
                            'data-theme' => 'c',
                        )) ?>

                        <a href="#mesa-view" data-role="button" id="mesa-eliminar-cliente" data-inline="true" data-theme="d" data-direction="reverse" 
                            data-bind="visible: Risto.Adition.adicionar.currentMesa().Cliente() !== null}">
                                Borrar</span>
                        </a>

                    </div>

                    <div id="contenedor-listado-clientes-factura-a">

                        <ul data-role="listview"  data-filter="true" id="listado-clientes-factura-a-ajax">
                            <li style="display: none" class="factura-a-cliente-add" data-theme="b">
                                <a href="<?php echo $this->Html->url(array('plugin'=>'fidelization', 'controller'=>'clientes', 'action'=>'simple_add')) ?>"><?php echo __( 'Agregar Nuevo %s',Configure::read('Mesa.tituloCliente')) ?></a>
                            </li>
                                <?php foreach($clientes as $c): 
                                    $porcentaje  = !empty($c['Descuento']['porcentaje']) ? $c['Descuento']['porcentaje'] : 0;
                                    $tipofactura = !empty($c['Cliente']['tipofactura'])? $c['Cliente']['tipofactura']: '';
                                    $clienteName = !empty($c['Cliente']['nombre']) ? $c['Cliente']['nombre']: '' ;

                                    $cliente = array(
                                            'id' => $c['Cliente']['id'],
                                            'nombre' => $clienteName,
                                            'tipofactura' => $tipofactura,
                                            'porcentaje' => $porcentaje
                                        );


                                    $jsonCliente =  json_encode($cliente);

                                    ?>
                            <li>
                                <a href="#mesa-view" data-direction="reverse" onclick='Risto.Adition.adicionar.currentMesa().setCliente( <?php echo $jsonCliente ?> )'>
                                        <?php
                                        if ($c['Cliente']['tipofactura']) {
                                            echo '<span>'.$c['Cliente']['tipofactura'].'&nbsp;</span>';
                                        }
                                        echo "<span class='cliente-nrodoc'>".$c['Cliente']['nrodocumento'].'</span>';
                                        echo '<span class="cliente-nombre">'.$c['Cliente']['nombre'].'</span>'; 

                                        if ( !empty($c['Descuento']['porcentaje']) ) {
                                            echo '<span class="cliente-dto-porcentaje">%'.$c['Descuento']['porcentaje'].' <cite>('.$c['Descuento']['name'].')</cite><span>';
                                        }
                                        ?>
                                    </a>                   
                                </li>
                                <?php endforeach; ?>
                        </ul>

                    </div>
                    
        </div>
    


</div>