


<h1>Pedidos</h1>


<?php echo $this->Html->link(__('Crear Nuevo Pedido'), array('action'=>'add'), array('class'=>'btn btn-success btn-lg pull-right')); ?>

<div class="clearfix"></div>
<table class="table">
	<thead>
		<?php
		echo $this->Html->tableHeaders(array(
			'id',
			'creado',
			));
		?>
	</thead>

	<tbody>
	<?php
		$rows = [];
		foreach ( $pedidos as $p ) {
			$rows[] = array(
				$p['Pedido']['id'],
				$this->Time->nice($p['Pedido']['created']),
				$this->Html->link('ver',array('action'=>'view', $p['Pedido']['id'])),
				);
		}
		echo $this->Html->tableCells($rows);
	?>
	</tbody>
</table>