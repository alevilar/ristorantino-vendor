
var $pedAcciones = $('#px-pedidos-acciones');
var $PedidoForm = $('#PedidoForm');

$('a', $pedAcciones).on('click', function( ev ) {
	ev.preventDefault();
	$PedidoForm.attr('action', this.href );
	$PedidoForm.submit();
	return false;
});

function mostrarAccionesSiHayChequeados( ev ) {
	var cant = $('.checkbox:checked', $PedidoForm).length;
	$('.checkbox').parents('tr').removeClass('active');
	if ( cant ) {
		$pedAcciones.show();
		$('.checkbox:checked').parents('tr').addClass('active');
	} else {
		$pedAcciones.hide();
	}
}

$('.checkbox', $PedidoForm).on('change', mostrarAccionesSiHayChequeados);

/*
$('#PedidoForm').on('submit', function( ev ){	
	ev.preventDefault();
	return false;	
});
*/

mostrarAccionesSiHayChequeados();
