/**
*
*	Cambio de impresora es un href que rrefresca la pagina
*
**/
function cambioDeImpresoraHandler() {

	$("#printer-id-select").on('change', function(e){
		location.href = $(this).data('href') + "/" + $(this).val();
	});
}


cambioDeImpresoraHandler();