

( function($){
    $(function(){
        var charDeRecambio = /{X}/gi;
        var htmlForm = $('#pedido-skeleton').html();
        var $pedidoAddForm = $('#PedidoAddForm');

        var rowInputClassName = "row-mercaderia";


        $pedidoAddForm.on('focus', '.addmore:last' , function () {
                agregarUnaLineaDeInputs();
                return true;
        });


        var agregarUnaLineaDeInputs = function () {

            var contadorDeInputs = $("."+rowInputClassName).length;
            var htmlNuevosInputs = htmlForm.replace( charDeRecambio, contadorDeInputs);
            var $htmlNuevosInputs = $( "<div></div>")
                                            .html(htmlNuevosInputs);
            

            $pedidoAddForm.append( $htmlNuevosInputs );
            
            $('input.typeahead', $htmlNuevosInputs).typeahead({
                hint: true,
                  highlight: true,
                  minLength: 2,
              },{
                templates: {
                    suggestion: function( context ) {

                        console.info("asasas1; %o", context);
                        return "<div>aps aspoa s</div>";

                    }
                  },


                source: function(text, syn, async ){
                        // busca un texto y si no encuentra nada muestra el tooltip
                        var obj = {
                            'search': text
                        };
                        console.debug("el a %o y el b %o y c %o y this es %o", text, syn, async, this);
                        var url = mercaIndexURL;
                        var $el = this.$element;
                        return $.get(url, obj, async);
                    }
                });
                
                //$('input.typeahead', $htmlNuevosInputs).tooltip({trigger: 'manual'})
                
                $('input.typeahead', $htmlNuevosInputs).on('typeahead:change', function(evt,el){
                    console.info("cambio el cosl this %o args %o", this, arguments);
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

                $('input.typeahead', $htmlNuevosInputs).on('typeahead:asyncreceive', function(evt,el){
                    $el = $(evt.target);
                    console.info("asuyb receiveeeee %o", $el);
                    if (!data.length) {
                        // la mercaderias es nueva, o sea, no estaba en la BD
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
                        // encontro a esa mercaderia, por lo tanto usarla
                        $el.tooltip('hide');
                        $el.parents('.form-group').addClass('has-success');
                        $el.parents('.form-group').removeClass('has-warning');
                        $el.parents('.form-group').find('.glyphicon-ok').show();
                        $el.parents('.form-group').find('.glyphicon-warning-sign').hide();
                    }
                });


                $('input.typeahead', $htmlNuevosInputs).on('typeahead:change', function(evt,valuetext){
                    console.info("cambio el cosl this %o args %o", this, arguments);
                    var el = evt.target;
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

        }

        agregarUnaLineaDeInputs();
    });


}(jQuery));
