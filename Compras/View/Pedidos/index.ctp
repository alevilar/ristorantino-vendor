<div class="content-white">


<div class="center">
	<br>
	<?php echo $this->Html->link(__('Crear Nueva Órden de Compra'), array('action'=>'form'), array('class'=>'btn btn-primary btn-lg acl acl-adicionista acl-administrador')); ?>
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
			$links = "";
			if ( !$p['Pedido']['recepcionado'] ) {
				$links .=  $this->Html->link("recepcionar", array('action'=>'recepcion', $p['Pedido']['id'] ), array('class'=>'text-success') );
			} else {
				$links .= '<span class="text-grey">✔ recepcionado</span>';
			}
			
			$links .= " | ";
			if ( $p['Pedido']['gasto_id'] ) {
				$links .= $this->Html->link('ver gasto',array('plugin'=>'account', 'controller'=>'gastos','action'=>'view', $p['Pedido']['gasto_id']), array('class'=>'text-warning', 'target'=>'_blank'));
			} else {
				$links .=  $this->Html->link("generar gasto", array('action'=>'generar_gasto', $p['Pedido']['id'] ));
			}
			
			$links .= " | ";
			$links .= $this->Html->link('ver',array('action'=>'view', $p['Pedido']['id']));

			$links .= " | ";
			$links .= $this->Html->link('editar',array('action'=>'form', $p['Pedido']['id']));





			$links .= " | ";
			$links .= $this->Html->link('mover a',array('action'=>'mover_oc', $p['Pedido']['id']));

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