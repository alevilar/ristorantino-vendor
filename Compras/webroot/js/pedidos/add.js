


$('#pedido-skeleton');


        // Autocomplete
        $('input.auto-complete').bind('change',function(){
            // borrar cuando se elimina el texto del proveedor
            if ( !this.value ) {
                $("#PedidoMercaderiaId").attr('value','');
            }
        });
        $('input.auto-complete').bind('focusout', function(){
            $('input.auto-complete').popover('hide');
        });
        // popover con informacion para crear nuevos proveedores
        $('input.auto-complete').popover({
                        html: true,
                        trigger: 'manual',
                        title: '<span class="text-danger">No Existe<span>',
                        container: 'body',
                        content: 'Se va a guardar como nuevo Proveedor automáticamente. \n\
                                    <br><br><p>Puede agregar el CUIT al final, si lo desea<br><cite>Ej: "LA SERENISIMA 33-34343434-2 (funciona con y sin guiones)"'
                    });
        $('input.auto-complete').typeahead({
            source: function(a,b ){
                var obj = {
                    'data[Proveedor][buscar_proveedor]': a
                };
                var url = this.$element.data('url');
                $.post(url, obj).done(function(data, state){
                    if (!data.length) {                        
                        $('input.auto-complete').popover('show');                        
                        $('#nuevo-proveedor').show('fade');
                    } else {
                        $('#nuevo-proveedor').hide('fade');
                    }
                    
                    b(data, state);
                });
            }
        }).bind('select', function(a,b,c){
            var id = $(b).attr('data-id');
            if (id) {
                $("#GastoProveedorId").val(id);
            }
        });