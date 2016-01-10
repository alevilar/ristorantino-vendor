jQuery( function($){

    var htmlForm = $('#pedido-skeleton').html();

    var charDeRecambio = /{X}/gi;

    var contadorDeInputs = 0;


    function agregarUnaLineaDeInputs () {

        var htmlNuevosInputs = htmlForm.replace( charDeRecambio, contadorDeInputs);
        var $htmlNuevosInputs = $( "<div>" + htmlNuevosInputs + "</div>");
        
        $('#PedidoAddForm').append( $htmlNuevosInputs );
        $htmlNuevosInputs.find('.addmore').on('focus', function () {
            agregarUnaLineaDeInputs();
            $(this).off('focus');
            return true;
        });



      $('input.typeahead', $htmlNuevosInputs).typeahead({
            source: function(a,b ){
                    var obj = {
                        'search': a
                    };
                    var url = this.$element.data('url');
                    var $el = this.$element;
                    $.get(url, obj).done(function(data, state){                        
                        if (!data.length) {                        
                            $el.tooltip('show');
                        } else {
                            $el.tooltip('hide');
                        }
                        b(data, state);
                    });
                }
            })
            .tooltip({trigger: 'manual'})
            .on('select', function(evt,el){
                var domIdClass = $(evt.currentTarget).attr('data-dom-id');
                var $hiddenIdInput = $(domIdClass);

                var $uMedidaInput = $( $(evt.currentTarget).attr('data-unidad-medida-id') );

                var id = $(el).attr('data-id');

                console.debug("este es el dom actualizado %o con el ID %o y el elemento seleccionado es %o", $hiddenIdInput, id, $(el));
                if (id) {
                    $hiddenIdInput.val(id);
                    var unidadDeMedidaId = mercaUnidades[id];
                    $uMedidaInput.val(unidadDeMedidaId);
                }
                
            });

            contadorDeInputs++;
    }


    agregarUnaLineaDeInputs();


  


}(jQuery)
);
