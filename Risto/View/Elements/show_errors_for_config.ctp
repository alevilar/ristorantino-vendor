<?php
$factura = Configure::read('Afip.tipo_factura_id');
if ( MtSites::isTenant() && empty($factura) ) {
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
unset($factura);
}