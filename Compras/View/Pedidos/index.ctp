<h1>Pedidos</h1>


<table class="table">
	<thead>
		<?php
		echo $this->Html->tableHeaders(array(
			'id',
			));
		?>
	</thead>

	<tbody>
	<?php
		$rows = [];
		foreach ( $pedidos as $p ) {
			$rows[] = array(
				$p['Pedido']['id'],
				);
		}
		echo $this->Html->tableCells($rows);
	?>
	</tbody>
</table>