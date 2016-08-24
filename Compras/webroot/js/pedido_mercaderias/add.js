(function($){
	
	$(':submit').on('click', function(){
		// asegura que solo se clické 1 vez
		// estaba ocurriendo que lo apretaban varias veces 
		// y se duplicaban los pedidos
		$(this).addClass('disabled');
	});


}(jQuery));