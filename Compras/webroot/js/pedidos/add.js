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
                    // busca un texto y si no encuentra nada muestra el tooltip
                    var obj = {
                        'search': a
                    };
                    var url = this.$element.data('url');
                    var $el = this.$element;
                    $.get(url, obj).done(function(data, state){                        
                        if (!data.length) {        
                            $el.on('focusout', function(){
                                $el.off('focusout');
                                $el.tooltip('hide');
                            });

                            $el.tooltip('show');
                            $el.parents('.form-group').addClass('has-warning');
                            $el.parents('.form-group').removeClass('has-success');
                            $el.parents('.form-group').find('.glyphicon-ok').hide();
                            $el.parents('.form-group').find('.glyphicon-warning-sign').show();
                            
                        } else {
                            $el.tooltip('hide');
                            $el.parents('.form-group').addClass('has-success');
                            $el.parents('.form-group').removeClass('has-warning');
                            $el.parents('.form-group').find('.glyphicon-ok').show();
                            $el.parents('.form-group').find('.glyphicon-warning-sign').hide();
                        }
                        b(data, state);
                    });
                }
            })
            .tooltip({trigger: 'manual'})
            .on('select', function(evt,el){
                // trigger para hacer al seleccionar una mercaderia
                var domIdClass = $(evt.currentTarget).attr('data-dom-id');
                var $hiddenIdInput = $(domIdClass);

                var $uMedidaInput = $( $(evt.currentTarget).attr('data-unidad-medida-id') );

                var id = $(el).attr('data-id');

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
