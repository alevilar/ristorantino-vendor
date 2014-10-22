<div class="mesas form">
	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Listar %s', __('Mesa')),array('action'=>'index'), array('class'=>'btn btn-default btn-lg')); ?>
	</div>
	<h1 class="center"><?php echo __('Agregar %s', Configure::read('Mesa.tituloMesa') );?></h1>
<?php echo $this->Form->create('Mesa');?>
	<fieldset>
	<?php
		echo $this->Form->input('numero', array(
            'label'=> __( 'Número de %s', Configure::read('Mesa.tituloMesa'))
            	));
		if (count($mozos) == 1) {
			$mk = array_keys( $mozos );
        	echo $this->Form->hidden('mozo_id', array('value'=> $mk[0]));
		} else {
			echo $this->Form->input('mozo_id', array('label'=>Configure::read('Mesa.tituloMozo')));
		}
		//echo $this->Form->input('descuento_id');
		//echo $this->Form->input('created');
		//echo $this->Form->input('time_paso_pedido');
		//echo $this->Form->input('time_cerro');

		echo $this->Form->input('time_abrio', array(
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));

		echo $this->Form->input('time_cerro', array(
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));

		echo $this->Form->input('total', array(           
            'label'=>'Importe Total'
            ));

		echo $this->Form->input('estado_id');
		?>
		<div id="pago" style="display:none;">
			<?php
	        echo $this->Form->input('Pago.0.tipo_de_pago_id',array('options'=>$tipo_pagos, 'disabled'=>true, 'id'=>'PagoTipoDePagoId'));
	        echo $this->Form->input('Pago.0.valor',array('value'=>0, 'disabled'=>true, 'id'=>'PagoValor', 'label'=>__('Monto a Pagar')));
	        ?>
        </div>
        <?php echo $this->Form->submit('Agregar', array('class' => 'btn btn-success btn-lg pull-left', 'title' => __('Enviar')));
              echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));
              echo $this->Form->end();?>

	</fieldset>
</div>
<!--<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar %s', Configure::read('Mesa.tituloMesa')), array('action'=>'index'));?></li>
	</ul>
</div>-->

<script type="text/javascript">

	enablePago = function () {

		var COBRADA_ID = <?php echo MESA_COBRADA; ?>;
		if ( $('#MesaEstadoId').val() == COBRADA_ID ) {
			$('#MesaTotal').attr('required', 'required');
			$('#pago').show('slide');
			$('#PagoTipoDePagoId').attr('disabled', false);
			$('#PagoValor').attr('disabled', false);
		} else {
			$('#MesaTotal').removeAttr('required');
			$('#pago').hide('slide');
			$('#PagoTipoDePagoId').attr('disabled', true);
			$('#PagoValor').attr('disabled', true);			
		}
	}


	completarTotalDePago = function () {
		$('#PagoValor').val( $('#MesaTotal').val() );
	}

	
	$('#MesaEstadoId').on('change', enablePago);
	$('#MesaTotal').on('keyup', completarTotalDePago); 


	enablePago();
	completarTotalDePago();

</script>
