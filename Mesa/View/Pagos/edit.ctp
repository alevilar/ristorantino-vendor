<div class="pagos form">
<?php echo $this->Form->create('Pago');?>
	<fieldset>
 		<legend>Editando Pago</legend>
                
                <p>
                <h4>
                <?php echo __( '%s Nº %s, %s %s', Configure::read('Mesa.tituloMesa'),  $mesa['Mesa']['numero'], Configure::read('Mesa.tituloMozo'),$mesa['Mozo']['numero'] ); ?>
                </h4>
                    Hora de apertura: <?php echo $this->Time->format($mesa['Mesa']['created'], '%a %e de %B %H:%M' )?><br>
                    Hora de cierre: <?php echo $this->Time->format($mesa['Mesa']['time_cerro'], '%a %e de %B %H:%M')?><br>
                    Hora de cobro: <?php echo $this->Time->format($mesa['Mesa']['time_cobro'], '%a %e de %B %H:%M')?>
                </p>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('mesa_id');
		echo $this->Form->input('tipo_de_pago_id');
		echo $this->Form->input('valor', array('disabled'=>true));
		echo $this->Form->input('created');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $this->Form->value('Pago.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Pago.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pagos', true), array('action'=>'index'));?></li>
	</ul>
</div>
