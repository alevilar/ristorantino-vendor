<?php



Inflector::rules('singular', array(
    'rules' => array('/([r|d|j|n|l|m|y|z])es$/i' => '\1', '/as$/i' => 'a', '/([ti])a$/i' => '\1a'),
    'irregular' => array(
        'fiscal_printers' => 'fiscal_printer',
        'printers' => 'printer',
        'config_categories' => 'config_category',
    ),
        )
);

Inflector::rules('plural', array(
    'rules' => array('/([r|d|j|n|l|m|y|z])$/i' => '\1es', '/a$/i' => '\1as'),
    'irregular' => array(
        'user' => 'users',
        'group' => 'groups',
        'adicion' => 'adicion',
        'cajero' => 'cajero',
        'fiscal_printer' => 'fiscal_printers',
        'printer' => 'printers',
        'query' => 'queries',
        'action' => 'actions',
        'inventory' => 'inventories',
        'category' => 'categories',
        'config_category' => 'config_categories',
        'pquery_category' => 'pquery_categories',
        'habitación' => 'habitaciones',
        'cierre' => 'cierres',
        'room' => 'rooms',
        'reservation' => 'reservations',
        'driver' => 'drivers',
        'driver_model' => 'driver_models',
        'site_user' => 'sites_users',
    ),
    'uninflected' => array()
        )
);



/* Load Plugins listed in configuration file */
if ( Configure::check('Plugins') ) {
    // load configuration extra plugins
    $plugs = Configure::read('Plugins');
    if ( is_array($plugs)) {

        foreach ($plugs as $pName=>$options ) {
            if ( is_integer($pName) ) {
                $pName = $options;
                $options = array();
            }
            CakePlugin::load($pName,$options );
        }
    }
    unset($plugs);
}





CakePlugin::load('MtSites', array( 'routes' => true, 'bootstrap' => true ));


//CakePlugin::load('Acl', array('bootstrap' => true));
CakePlugin::load('Users');
CakePlugin::load('ExtAuth');


CakePlugin::load('Aditions', array( 'bootstrap' => true, 'routes' => true ));
CakePlugin::load('Account', array( 'bootstrap' => true, 'routes' => true ));
CakePlugin::load('Stats', array( 'routes' => true ));
CakePlugin::load('DebugKit');
CakePlugin::load('Search');
CakePlugin::load('Printers', array( 'bootstrap' => true ));
CakePlugin::load('Mesa', array( 'routes' => true ));
CakePlugin::load('ReservationManager', array( 'bootstrap' => true ));

CakePlugin::load('Bs3Helpers', array('bootstrap'=>true));



define("TIPO_DOCUMENTO_SIN_IDENTIFICAR", 8); // sin identificar
define("IVA_RESPONSABILIDAD_CONSUMIDOR_FINAL", 4); // Consumidor Final
define("IVA_RESPONSABILIDAD_RESPONSABLE_INSCRIPTO", 1); // Responsable Inscripto
define("TIPO_DOCUMENTO_CUIT", 1); // Tipo Documento CUIT



define('SITE_TYPE_RESTAURANTE', 'restaurante');
define('SITE_TYPE_HOTEL', 'hotel');
define('SITE_TYPE_GENERIC', 'generic');


/* TIENEN QUE SER LOS MISMOS ID´s QUE EN LA TABLA !!! */
define('MESA_ABIERTA', 1);
define('MESA_CERRADA', 2);
define('MESA_COBRADA', 3);

define('TIPO_DE_PAGO_EFECTIVO', 1);




define('THUMB_FOLDER', 'thumbs' . DS);
define('IMAGES_THUMB', IMAGES . DS . THUMB_FOLDER . DS);

define('DATETIME_NULL', '0000-00-00 00:00:00');


define('MENU_FOLDER', 'menu');
define('IMG_MENU', WWW_ROOT . 'img/' . MENU_FOLDER . '/');


function jsDate($date)
{
    return date('Y-m-d H:i:s', strtotime($date));
}

/**
 * Mejora segun politicas del negocio para la funcion de redondeo
 *
 * @param double $number
 * @param integer $precision
 * @param const $extra flags de la funcion round() de PHP ver: http://php.net/manual/es/function.round.php
 */
function cqs_round($number, $precision = 0)
{
    if ($precision == 0) {
        $num = ceil($number);
    } else {
        $num = round($number, $precision);
    }
    return $num;
}

function convertir_para_busqueda_avanzada($text)
{
    $text = strtolower($text);
    $text = trim($text);
    $text = "($text)";
    $patron = array(
        // Espacios, puntos y comas por guion
        //'/[\., ]+/' => '-',
        // Vocales
        '/a/' => '(á|a|A|Á)',
        '/e/' => '(é|e|E|É)',
        '/i/' => '(í|i|I|Í)',
        '/o/' => '(ó|o|O|Ó)',
        '/u/' => '(ú|u|Ú|U)',
        '/A/' => '(á|a|A|Á)',
        '/E/' => '(é|e|E|É)',
        '/I/' => '(í|i|I|Í)',
        '/O/' => '(ó|o|O|Ó)',
        '/U/' => '(ú|u|Ú|U)',
        '/Á/' => '(á|a|A|Á)',
        '/É/' => '(é|e|E|É)',
        '/Í/' => '(í|i|I|Í)',
        '/Ó/' => '(ó|o|O|Ó)',
        '/Ú/' => '(ú|u|Ú|U)',
        '/á/' => '(á|a|A|Á)',
        '/é/' => '(é|e|E|É)',
        '/í/' => '(í|i|I|Í)',
        '/ó/' => '(ó|o|O|Ó)',
        '/ú/' => '(ú|u|Ú|U)',
        '/n/' => '(ñ)',
        '/ñ/' => '(n|ñ)',
        '/s/' => '(z|s|c|x)',
        '/c/' => '(z|s|c)',
        '/z/' => '(z|s|c)',
        // Agregar aqui mas caracteres si es necesario
        '/°/' => '',
        '/º/' => '',
        '/n°/' => '%',
        '/nº/' => '%',
        '/ /' => '%',
        '/x/' => '(x|s|X|S)'
    );
    // caracteres especiales de expresiones regulares
//                $text = preg_quote($text);
    $text_aux = '';
    for ($i = 0; $i < strlen($text); $i++) {
        $caracter = $text[$i];
        $text_aux .= preg_replace(array_keys($patron), array_values($patron), $caracter, 1);
    }

    return $text_aux;
}

function aplanar_mesa($mesa)
{
    if (!empty($mesa['Mesa'])){
        $nm = $mesa['Mesa'];
    } else {
        $nm = $mesa;
    }
    foreach ($mesa as $k=>$att) {
        if ( $k != 'Mesa') {
            $nm[$k] = $att;
        }        
    }    
    if ( !empty($nm['Cliente']['IvaResponsabilidad']['TipoFactura']['codename']) ) {
        $codename = $nm['Cliente']['IvaResponsabilidad']['TipoFactura']['codename'];
        $nm['cliente_tipofactura'] = '"'.$codename.'"';
    } else {
        $nm['cliente_tipofactura'] = '"B"';
    }
    
    $dto = 0;
    if ( !empty($nm['Cliente']['Descuento']['porcentaje']) ) {
        $dto += $nm['Cliente']['Descuento']['porcentaje'];
    }
    if ( !empty($nm['Descuento']['porcentaje']) ) {
        $dto += $nm['Descuento']['porcentaje'];
    }
    
    
    $dtotxt = $dto?"$dto%":"";
    $nm['estado_name'] = $nm['Estado']['name'];
    $nm['cliente_dto'] = $dtotxt;
    $nm['cliente_abr'] = $nm['cliente_tipofactura']." ".$nm['cliente_dto'];
    $nm['time_abrio_abr'] = "Abrió ".date('H:i', strtotime($nm['created']));
    $nm['time_cerro_abr'] = empty($nm['time_cerro'])?"":"Cerró ".date('H:i', strtotime($nm['time_cerro']));
    $nm['time_cobro_abr'] = empty($nm['time_cobro'])?"":"Cobró ".date('H:i', strtotime($nm['time_cobro']));
    if (!empty($nm['_importe_descuento'])) {
        $nm['importe_abr'] = 'Total $'.$nm['subtotal'].' - $'.$nm['importe_descuento'].' ='.$nm['total'];
    } else {
        $nm['importe_abr'] = 'Total $'.$nm['total'];
    }
    
    return $nm;
}

function aplanar_mesas($mesas)
{
    $newMesas = array();
    foreach ($mesas as $m) {
        $newMesas[] = aplanar_mesa($m);
    }
    return $newMesas;
}


/**
 * 
 *  Crea un array de fechas $desde - $hasta
 *  @param string $desde 'YYYY-MM-DD HH:II:SS'
 *  @param string $hasta 'YYYY-MM-DD HH:II:SS'
 *
 */
function crear_fechas($desde, $hasta) {
     $arr = array();
     $td = strtotime($desde);
     $th = strtotime($hasta);
     
     if ($th < $td) {
         $taux = $td;
         $td = $th;
         $th = $taux;
     }
     
     $dcurr = date('Y-m-d', $td);
     $tcurr = $td;
     while ( $tcurr <= $th ) {
         $arr[] = $dcurr;
         $dcurr = date('Y-m-d', strtotime('1 day',$tcurr));
         $tcurr = strtotime($dcurr);
         
     }     
     return $arr;
}



function validate_cuit_cuil($cuit)
{

    $coeficiente[0] = 5;
    $coeficiente[1] = 4;
    $coeficiente[2] = 3;
    $coeficiente[3] = 2;
    $coeficiente[4] = 7;
    $coeficiente[5] = 6;
    $coeficiente[6] = 5;
    $coeficiente[7] = 4;
    $coeficiente[8] = 3;
    $coeficiente[9] = 2;

    $ok = true;
    $resultado = 1;
    $cuit_rearmado = "";

    for ($i = 0; $i < strlen($cuit); $i = $i + 1) {    //separo cualquier caracter que no tenga que ver con numeros
        if ((Ord(substr($cuit, $i, 1)) >= 48) && (Ord(substr($cuit, $i, 1)) <= 57)) {
            $cuit_rearmado = $cuit_rearmado . substr($cuit, $i, 1);
        }
    }

    if (strlen($cuit_rearmado) <> 11) {  // si no estan todos los digitos
        $ok = false;
    } else {
        $sumador = 0;
        $verificador = substr($cuit_rearmado, 10, 1); //tomo el digito verificador

        for ($i = 0; $i <= 9; $i = $i + 1) {
            $sumador = $sumador + (substr($cuit_rearmado, $i, 1)) * $coeficiente[$i]; //separo cada digito y lo multiplico por el coeficiente
        }

        $resultado = $sumador % 11;
        if ($resultado != 0) {
            $resultado = 11 - $resultado;  //saco el digito verificador
        }

        $veri_nro = intval($verificador);

        if ($veri_nro == $resultado) {
            $ok = true;
            $cuit_rearmado = substr($cuit_rearmado, 0, 2) . "-" . substr($cuit_rearmado, 2, 8) . "-" . substr($cuit_rearmado, 10, 1);
        } else {
            $ok = false;
        }
    }

    return $ok;
}