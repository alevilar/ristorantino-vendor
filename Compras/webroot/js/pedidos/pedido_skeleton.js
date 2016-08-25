

( function($){
    $(function(){
        var charDeRecambio = /{X}/gi;
        var htmlForm = $('#pedido-skeleton').html();
        var $pedidoAddForm = $('#PedidoAddForm');

        var hiddenInputMercaderiaIdClassName = '.hidden-mercaderia-id';


        // constructs the suggestion engine
        var mercaderiasBloodhound = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          // `states` is an array of state names defined in "The Basics"
          prefetch: mercaIndexURL+'.json',
          remote: {
            url: mercaIndexURL+'.json?search=%QUERY',
            wildcard: '%QUERY'
          }
        });



        var rowInputClassName = ".row-mercaderia";


        $pedidoAddForm.on('focus', '.addmore:last' , function () {
                agregarUnaLineaDeInputs();
                return true;
        });


        $pedidoAddForm.on('keypress', 'input.typeahead', function(ev, suggestion) {
            if (ev.which == 13) {
                // al apretar enter no submitear sino que solo seleccionar item
                ev.preventDefault();                
                return false;
            }

            // elimino el ID del input hidden
            $el = $(ev.target);
            $el.parents(rowInputClassName)
                    .find(hiddenInputMercaderiaIdClassName)
                    .val( "" );

            // pongo como que la mercadera no existe y sera creada
            $el.parents('.form-group').addClass('has-warning');
            $el.parents('.form-group').removeClass('has-success');
            $el.parents('.form-group').find('.glyphicon-ok').hide();
            $el.parents('.form-group').find('.glyphicon-warning-sign').show();
        });

        $pedidoAddForm.on('typeahead:select', 'input.typeahead', function(ev, suggestion) {
            $el = $(ev.target);

            $row = $el.parents(rowInputClassName);
            // coloco el ID en el input hidden
            
            $row.find(hiddenInputMercaderiaIdClassName)
                .val( suggestion.id );

    
            // selecciono la unidad de medida    
            var uMedida = suggestion.unidad_de_medida_id;
            $row.find("select.pedido-mercaderia-umedida").val(uMedida);


            // muestro el OK checkbox verde de que la mercaderia existe
            var $fromGroup = $el.parents('.form-group');
            $fromGroup
                    .addClass('has-success')
                    .removeClass('has-warning');

            $fromGroup.find('.glyphicon-ok').show();
            $fromGroup.find('.glyphicon-warning-sign').hide();


            // hacer focus en el proximo input
            var inputs = $(ev.target).closest('form').find(':input');
            inputs.eq( inputs.index(this)+ 1 ).focus();

            
        });



         $pedidoAddForm.on('click', '.remove', function(ev, suggestion) {
            $el = $(ev.target);
            $row = $el.parents(rowInputClassName).parent();
            if ( !$row.is(':last-child')) {
                $row.remove();
            }
         });



        var agregarUnaLineaDeInputs = function () {

            var contadorDeInputs = $(rowInputClassName).length;
            var htmlNuevosInputs = htmlForm.replace( charDeRecambio, contadorDeInputs);
            var $htmlNuevosInputs = $( "<div></div>")
                                            .html(htmlNuevosInputs);
            

            $pedidoAddForm.append( $htmlNuevosInputs );
            
            $('input.typeahead', $htmlNuevosInputs).typeahead({
                  name: 'mercaderias'
              },{
                display: "value",
                templates: {
                    suggestion: function( context ){
                        var domtxt = '';

                        domtxt += '<div class="tt-suggestion tt-selectable">';
                        domtxt += context.value;
                        if ( context.description ) {
                            domtxt += '<p class="tt-description text-danger">';
                            domtxt += context.description;
                            domtxt += '</p>';
                        }
                        domtxt += '</div>';
                        return domtxt;
                    }
                },
                source: mercaderiasBloodhound
            });


                

        }




        agregarUnaLineaDeInputs();
    });


}(jQuery));
