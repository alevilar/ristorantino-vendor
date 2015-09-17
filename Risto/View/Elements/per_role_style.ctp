<!-- ESTILOS POR USUARIO -->
<?php

		// CSS by Rol
        if ( $this->Session->check('Auth.User.Rol') ) {
            $roles = $this->Session->read('Auth.User.Rol');

            foreach ($roles as $r ) {
            	$rcss = "acl-" . $r['machin_name'];
    	        $ppath = App::pluginPath('Risto');
    	        if ( file_exists( $ppath . DS . 'webroot' . DS . 'css' . DS . $rcss . '.css') ) {
    	            echo $this->Html->css('/risto/css/'.$rcss, 'stylesheet', array('media' => 'screen'));
    	        } else {
                           CakeLog::write('error','No existe la hoja de estilos para el rol: '. $r['machin_name']. ' en path: '.$ppath . DS . 'webroot' . DS . 'css' . $rcss . '.css');
                    }
            }
        }
?>
<!-- ENDOF: ESTILOS POR USUARIO -->