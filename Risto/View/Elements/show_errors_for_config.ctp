<?php

if ( empty(Configure::read('Afip.tipo_factura_id')) ) {
?>
    <div class="alert alert-danger alert-error">
    	Se debe configurar el Tipo de Factura
    	<?php 

    	echo $this->Html->link('ir a la página de configuración', array(
    								'plugin' => 'install',
    								'controller' => 'configurations',
    								'action' => 'edit'
    								)); 

    	?>
    </div>  
<?php
}