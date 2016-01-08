jQuery( function($){

    var htmlForm = $('#pedido-skeleton').html();

    var charDeRecambio = /{X}/gi;

    var contadorDeInputs = 0;


    function agregarUnaLineaDeInputs () {

        var htmlNuevosInputs = htmlForm.replace( charDeRecambio, contadorDeInputs);
        var $htmlNuevosInputs = $( "<div>" + htmlNuevosInputs + "</div>");
        contadorDeInputs++;
        $('#PedidoAddForm').append( $htmlNuevosInputs );
        console.debug("este esel coso %o ", $htmlNuevosInputs.find('input:first'));
        $htmlNuevosInputs.find('.cantidad').on('click', function () {
            console.info("clmaso asas a sasasas");
            $(this).off();
            agregarUnaLineaDeInputs();
        });
    }


    agregarUnaLineaDeInputs();



}(jQuery)
);
