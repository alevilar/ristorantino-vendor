<?php $this->element("Risto.layout_modal_edit", array('title'=>'Tipo de Pago'));?>

<div class="tipoDePagos index content-white">

	<div class="users index">
		<h2><?php echo __('Tipo de Pagos');?></h2>
		<div class="btn-group pull-right">
		<?php echo $this->Html->link(__('Crear Tipo de pago', true), array('action'=>'edit'), array('class'=>'btn btn-success btn-lg btn-add')); ?>
		</div>

		<table class="table">
		<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th>Imagen</th>
			<th><?php echo $this->Paginator->sort('Nombre');?></th>
			<th class="actions"><?php __('Acciones');?></th>
		</tr>
		<?php


		$i = 0;
		foreach ($tipoDePagos as $tipoDePago):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
			<tr<?php echo $class;?>>
				<td>
					<?php echo $tipoDePago['TipoDePago']['id']; ?>
				</td>
				<td>
					<?php
					if ( $tipoDePago['TipoDePago']['media_id'] ) {
		            	echo $this->Html->imageMedia( $tipoDePago['TipoDePago']['media_id'], array('width'=>40)); 
					}
		            ?>
				</td>
				<td>
					<?php echo $tipoDePago['TipoDePago']['name']; ?>
				</td>
				<td class="actions">
				


					<!-- Split button -->
					<div class="btn-group">


						<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $tipoDePago['TipoDePago']['id']), array('class'=>'btn btn-default btn-sm btn-edit')); ?>


					  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="caret"></span>
					    <span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu">



					    <li class="">
					    	<?php echo $this->Form->postLink( __('Borrar'), array('action'=>'delete', $tipoDePago['TipoDePago']['id']), array('class'=>' btn-sm'), sprintf(__('¿Está seguro que desea borrar el tipo de pago: %s?', true), $tipoDePago['TipoDePago']['name'])); ?>
				    	</li>
					  </ul>
					</div>




				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	</div>

	<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
		));
		?>


<?php echo $this->element('Risto.pagination'); ?>
	</p>
</div>