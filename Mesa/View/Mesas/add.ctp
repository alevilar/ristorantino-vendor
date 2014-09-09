
<div class="mesas form">
<?php echo $this->Form->create('Mesa');?>
	<fieldset>
 		<legend><?php __('Agregar %s', Configure::read('Mesa.tituloMesa') );?></legend>
                <p class="well info text text-info">
                    Agregar manualmente es para cuando, por algún motivo, no se pudo utilizar el sistema y queremos cargar el total de una venta sin importarnos el detalle (items) de la factura. 
                    <br>
                    Es para que el monto de venta se compute en la estadística de forma rápida.<br>
                </p>
	<?php
        //debug($mozos);
		echo $this->Form->input('numero', array(
            'label'=> __( 'Número de %s', Configure::read('Mesa.tituloMesa'))
            	));
		//$options = array('mozo_id'.'user.nombre');
        echo $this->Form->input('mozo_id', array('label'=>Configure::read('Mesa.tituloMozo')));
		echo $this->Form->input('total', array(
            'required' => 'required',
            'label'=>'Importe Total'
            ));
		//echo $this->Form->input('descuento_id');
		//echo $this->Form->input('created');
		//echo $this->Form->input('time_paso_pedido');
		//echo $this->Form->input('time_cerro');
		echo $this->Form->input('time_cobro', array(
					//'type' => 'input',
					'class' => 'datetime',
					'label'=>'Indicar Fecha y hora aproximada',
                    ));

        echo $this->Form->input('tipo_de_pago',array('options'=>$tipo_pagos))
	?>
<?php echo $this->Form->end('Enviar');?>                
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar %s', Configure::read('Mesa.tituloMesa')), array('action'=>'index'));?></li>
	</ul>
</div>
