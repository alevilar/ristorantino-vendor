

( function($){
    $(function(){
        var charDeRecambio = /{X}/gi;
        var htmlForm = $('#pedido-skeleton').html();
        var $pedidoAddForm = $('#PedidoAddForm');

        var rowInputClassName = "row-mercaderia";
        var contadorDeInputs = $("."+rowInputClassName).length;



        $pedidoAddForm.on('focus', '.addmore:last' , function () {
                agregarUnaLineaDeInputs();
                return true;
        });


        var agregarUnaLineaDeInputs = function () {

            var htmlNuevosInputs = htmlForm.replace( charDeRecambio, contadorDeInputs);
            var $htmlNuevosInputs = $( "<div></div>")
                                            .html(htmlNuevosInputs);
            

            $pedidoAddForm.append( $htmlNuevosInputs );
            



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
                    //debugger;
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

                contadorDeInputs = $("."+rowInputClassName).length;
        }

        agregarUnaLineaDeInputs();
    });


}(jQuery));
