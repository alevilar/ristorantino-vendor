<div class="comandas form">
<?php echo $this->Form->create('DetalleComanda');?>
	<fieldset>
 		<legend><?php __('Edit Comanda');?></legend>
	<?php
		echo $this->Form->hidden('Comanda.redirect');
		echo $this->Form->input('Comanda.imprimir', array('type'=>'radio', 'options'=>array('No', 'Si'), 'default'=>0));

		if (!empty($mesa_id)) {
			echo $this->Form->hidden('Comanda.mesa_id', array('default' => $mesa_id ));
		} else {
			echo $this->Form->input('Comanda.mesa_id'
				, array(
					'label'=>Configure::read('Mesa.tituloMesa'), 
					'after'=>'<span class="text-info">Muestra solo las abiertas</span>'
					)
				);	
		}
		
?>
	<legend><?php __('Productos');?></legend>
<?php
		echo $this->Form->input('DetalleComanda.0.id');
		echo $this->Form->input('DetalleComanda.0.producto_id');
		echo $this->Form->input('DetalleComanda.0.cant');
		

	?>
		
		<div id="mas-dc"></div>
	</fieldset>

	<button id="agregar-mas-dc" class="btn btn-primary pull-right btn-lg" type="button">Agregar Otro Producto</button>

<?php echo $this->Form->submit('Submit', array('class'=>'btn btn-success btn-lg'));?>
<?php echo $this->Form->end();?>
</div>

<?php
$domProd = $this->Form->input("producto_id", array('id'=>false, 'label'=>false));
$domCant = $this->Form->input("cant", array('id'=>false, 'label'=>false));

$text = json_encode(array(
	'prod' => $domProd,
	'cant' => $domCant
	));
?>

<script type="text/javascript">
	
	var $dc = $('#mas-dc');
	var $btndc = $('#agregar-mas-dc');
	var cant = 1;

 	var sform = <?php echo $text ?>;

	$btndc.bind('click', function(){
		var $prod = $('<div>').html(sform.prod),
			$cant = $('<div>').html(sform.cant),
			$cont = $('<div>');


		$('select', $prod).attr('name', 'data[DetalleComanda]['+cant+'][producto_id]');
		$('input', $cant).attr('name', 'data[DetalleComanda]['+cant+'][cant]');
		cant++;

		$prod.appendTo($cont);
		$cant.appendTo($cont);
		$cont.appendTo('#mas-dc');

	});
</script>