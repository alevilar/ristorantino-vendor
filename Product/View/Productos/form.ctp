
<div class="productos form">
<?php echo $this->Form->create('Producto');?>
	<fieldset>
 		<legend><?php __('Editar Producto');?></legend>
	<?php
		echo $this->Form->input('id');

		echo $this->Form->input('name',array(
			'label'=>__('Nombre'),
			'after'=>__('Nombre interno para identificar el producto'),
			'placeholder' => __('Ej: "Bebida Cola Light"')
			));
		echo $this->Form->input('abrev', array(
			'label'=>'Abreviatura',
			'after'=>__('Asi es como se verá en el ticket'),
			'placeholder' => __('Ej: "gaseosa"')
			));

		echo $this->Form->input('Tag', array(
			'after'=>__('Agrupar Productos para fines estadísticos'),
			));


		//echo $this->Form->input('description', array('label'=>'Descripción'));
		echo $this->Form->input('categoria_id',array('label'=>'Categoria a la que pertenece este producto'));
		echo $this->Form->input('printer_id',array('empty'=>'Seleccionar','after'=>'Impresora donde saldrá el pedido de este producto'));

		echo $this->Form->input('precio',array(
				'label'=>'Precio $',
				'placeholder'=>'Ej: "10.5" (notar que los decimales van separados de un punto)'
				));
	

		if ( !empty( $this->request->data['Producto']['id']) ) {
	        echo $this->Form->input('ProductosPreciosFuturo.producto_id', array('type'=>'hidden'));
        	echo $this->Form->input('ProductosPreciosFuturo.precio',array('placeholder'=>'$','label'=>'Precio Futuro $'));
		}


        echo $this->Form->input('order', array(
        	'label'=>__('Orden'),
        	'after'=>__('Orden en el que saldrá impreso en el ticket. Se ordenan de menor a mayor.'),
        	'placeholder' => 'Ej: "1"'
        	));
	?>
<?php echo $this->Form->end('Submit');?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('Producto.id')), null, sprintf(__('¿Esta seguro que desea borrar el producto: %s?', true), $this->Form->value('Producto.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Productos', true), array('action'=>'index'));?></li>
	</ul>
</div>
