<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('Afip Factura Electrónica Online') ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css( array(
            '/risto/lib/bootstrap/css/bootstrap.min',
            '/risto/lib/bootstrap/css/bootstrap-theme.min',
            '/risto/lib/bootstrap/css/dataTables.bootstrap',
            '/risto/css/ristorantino/style',
            'Printers.afip_facturas_view',
        )
	);


	echo $this->Html->css( array('Printers.afip_facturas_view_print'), 'stylesheet', array('media' => 'print') );

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>
	<p class="no-print center">
		<button class="btn btn-success" onclick="window.print();"><?php echo __('Imprimir Factura'); ?></button>
		<?php // echo $this->Html->link('Listado de Facturas', array('action'=>'index'), array('class'=>'btn btn-primary'));?>
	</p>

	<div id="content">

		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>

	<style>

		
	</style>



</body>
</html>