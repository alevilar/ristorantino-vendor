
var $pedAcciones = $('#px-pedidos-acciones');
var $PedidoForm = $('#PedidoForm');


function mostrarAccionesSiHayChequeados( ev ) {
	var cant = $('.checkbox:checked', $PedidoForm).length;
	$('.checkbox').parents('tr').removeClass('active');
	if ( cant ) {
		$pedAcciones.removeClass("disabled");
		$('.checkbox:checked').parents('tr').addClass('active');
	} else {
		$pedAcciones.addClass("disabled");
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
