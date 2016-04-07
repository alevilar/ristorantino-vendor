
<div class="productos form">

<?php echo $this->Form->create('Producto');?>

<?php
     if (empty($this->request->data['Producto']['id'])):?>
		<h1><?php echo __d('ristorantino', 'Agregar Producto'); ?></h1>
<?php else: ?>
		<h1><?php echo __d('ristorantino', 'Editar Producto %s', $this->request->data['Producto']['name']); ?></h1>
<?php endif; ?>


	<div class="col-sm-6">
		<?php
			echo $this->Form->input('id');

			echo $this->Form->input('name',array(
				'label'=>__('Nombre'),
				'placeholder' => __('Ej: "Bebida Cola Light"')
				));
			echo $this->Form->input('abrev', array(
				'label'=>'Abreviatura (Con este nombre será impreso en el ticket)',
				'placeholder' => __('Ej: "gaseosa"')
				));

			echo $this->Form->input('categoria_id',array('label'=>'Categoria a la que pertenece este producto'));


			echo $this->Form->input('Tag', array(
				'multiple' => 'checkbox',
				));
	?>
	</div>

	<div class="col-sm-6">
	<?php

			echo $this->Form->input('precio',array(
					'label'=>'Precio $',
					'placeholder'=>'Ej: "10.5" (notar que los decimales van separados de un punto)'
					));
		

			if ( !empty( $this->request->data['Producto']['id']) ) {
		        echo $this->Form->input('ProductosPreciosFuturo.producto_id', array('type'=>'hidden'));
	        	echo $this->Form->input('ProductosPreciosFuturo.precio',array('placeholder'=>'$','label'=>'Precio Futuro $'));
			}


			echo $this->Form->input('printer_id',array('empty'=>'Seleccionar','after'=>'Impresora donde saldrá el pedido de este producto'));

	        echo $this->Form->input('order', array(
	        	'label'=>__('Orden'),
	        	'after'=>__('Orden en el que saldrá impreso en el ticket. Se ordenan de menor a mayor.'),
	        	'placeholder' => 'Ej: "1"'
	        	));
		?>
	<?php
	  if (empty($this->request->data['Producto']['id'])):?>
	     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
	     <?php else: ?>
	     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
	<?php endif; ?>
	        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
	    <?php echo $this->Form->end() ?>
	</div>
</div>
