<!DOCTYPE HTML>
<html xml:lang="es-ES" lang="es-ES" dir="ltr">    
<head>
        <meta charset="utf-8">
        <script type="text/javascript">
        <!--
            // Inicializacion de variable global de url
            var URL_DOMAIN = "<?php echo $this->Html->url('/' ,true);?>";
            var TENANT = "<?php echo $this->Session->read('MtSites.current');?>";
        -->
        </script>
    
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;"> 
        <meta name="apple-mobile-web-app-capable" content="yes">


    
        <base href="<?php echo $this->Html->url('/')?>" />
            <?php
		echo $this->Html->meta('icon');
		
		// para los modal window
		echo $this->Html->css(array(
//                    'http://code.jquery.com/mobile/latest/jquery.mobile.min.css',
//                    'jquery-mobile/jquery.mobile-1.0',
                    '/aditions/css/jquery-mobile/jquerymobile.coqus',
//                    'jquery-mobile/jquery.mobile-1.0rc1.min',
//                    'jquery-mobile/jquery-mobile-fluid960',
                    '/aditions/css/jquery-mobile/jquery.mobile.actionsheet',
                    '/aditions/css/ristorantino',
                    '/aditions/css/jquery-mobile/jquery.mobile-custom',
                    ));


                echo $this->element('Risto.per_role_style');
                
               
                $debug = Configure::read('debug');

                if ( $debug > 0 || true) {
                    echo $this->Html->script( array(
                        '/aditions/js/jquery-1.6.4',
                        '/aditions/js/jquery.tmpl.min',


                        '/aditions/js/knockout-2.0.0.min.js',
//                        'knockout-1.2.1.debug',
                        '/aditions/js/knockout.mapping-2.0.debug',
                
                        '/aditions/js/moment-with-locales.min',
                        '/aditions/js/moment-range',
                        

                        '/aditions/js/cake_saver',
                        '/aditions/js/risto',

    //                    'knockout.updateData',

                        // OJO !! EL ORDEN IMPORTA !!
                        '/aditions/js/adition.package',
                        '/aditions/js/mozo.class',
                        '/aditions/js/adicion.event_handler',
                        '/aditions/js/mesa.estados.class',
                        '/aditions/js/mesa.class',

                            '/aditions/js/comanda.class',
                        '/aditions/js/comanda_fabrica.class',
                        '/aditions/js/adicion.class', // depende de Mozo, Mesa y Comanda
                        '/aditions/js/producto',
                        '/aditions/js/categoria',
                        '/aditions/js/sabor.class',
                        '/aditions/js/cliente.class',
                        '/aditions/js/descuento.class',
                        '/aditions/js/pago.class',
                        '/aditions/js/detalle_comanda.class',
                        '/aditions/js/adicion.grilla.calendar',
                        '/aditions/js/ko_adicion_model',
                        '/aditions/js/adition.events',
                        '/aditions/js/menu',

    //                    'http://code.jquery.com/mobile/latest/jquery.mobile.min.js',
                        
                        '/aditions/js/jquery.mobile-1.0.1.min',
                        ));


                        // Para todos los HOteles
                        if ( Configure::check('Site.type') && Configure::read('Site.type') == SITE_TYPE_HOTEL) {
                            // add JS
                            echo $this->Html->script(  '/aditions/js/mesa.hotel.class_extend' );

                            // Add CSS
                            echo $this->Html->css('/aditions/css/ristorantino_hotel');
                        }
                
                } else {
                    echo $this->Html->script('todos.min');
                }
            ?>
<?php


    //scripts de Cake
    echo $this->element('js_init');
    
    echo $scripts_for_layout;
    
?>



</head>

<body>
	<?php echo $content_for_layout; ?>
</body>



</html>