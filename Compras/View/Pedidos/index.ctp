<div class="content-white">


<div class="center">
	<br>
	<?php echo $this->Html->link(__('Crear Nueva Órden de Compra'), array('action'=>'add'), array('class'=>'btn btn-primary btn-lg acl acl-adicionista acl-administrador')); ?>
	<br>
	<br>
</div>



<div class="clearfix"></div>
<table class="table">
	<caption class="center">Listado de Órdenes de Compra</caption>
	<thead>
		<?php
		echo $this->Html->tableHeaders(array(
			'id',
			'proveedor',
			'creado',
			'acciones'
			));
		?>
	</thead>

	<tbody>
	<?php
		$rows = [];
		foreach ( $pedidos as $p ) {

			$links = $this->Html->link('ver',array('action'=>'view', $p['Pedido']['id']));
			$links .= " | ";
			$links .=  $this->Html->link("imprimir", array('action'=>'imprimir', $p['Pedido']['id'] ) );
			$links .= " | ";
			$links .= $this->Html->link('Borrar',array('action'=>'delete', $p['Pedido']['id']), array('class'=>'text-danger acl acl-adicionista acl-administrador'), __('Desea eliminar la OC #%s', $p['Pedido']['id']) );

			$rows[] = array(
				$p['Pedido']['id'],
				$p['Proveedor']['name'],
				$this->Time->nice($p['Pedido']['created']),
				$links,
				);
		}
		echo $this->Html->tableCells($rows);
	?>
	</tbody>
</table>

	<div class="pagination center">
		<?php echo $this->element("Risto.pagination");?>
	</div>
</div>