/*--------------------------------------------------------------------------------------------------- Adition EVENTS
 *
 *
 * Adition Events
 * el el script que capura los eventos de la pagina adition.php[ctp]
 */

// mensaje de confirmacion cuando se esta por salir de la pagina (evitar perdidas de datos no actualizados)
//window.onbeforeunload=confirmacionDeSalida;



/**
 *JQM 
 * renderizado de cosas que se cargan dinamicamente en javascript
 * en cada cambio de pagina, hacemos que se  vuelva a refrescar JQM 
 * para enriquecer los elementos nuevos
 *
 */

      
$(document).on("mobileinit", function(){
    

    var domRegisterForEvents = {

        'mesa-cambiar-mozo':{
            show: function() {
                // Form SUBMITS
                $('#form-cambiar-mozo').bind('submit', function(e){
                    e.preventDefault();
                    $raeh.trigger('cambiarMozo', e, this);
                    return false;
                });
            },

            hide: function () {
                // Form SUBMITS
                $('#form-cambiar-mozo').unbind('submit');
            }
        },



        'comanda-add-product-obss': {

            show: function(event, jqObj) {
                $('#obstext').focus();

                // Guardar cambios
                $('#comanda-add-product-obss-submit').on('click', function(){
                    $('#form-comanda-producto-observacion').submit();
                });


                // completar textarea con Opcion texto seleccionado
                $('.observaciones-list','#comanda-add-product-obss').on('click','.options-val', function() {
                    var text = $(this).html();
                    var currOpsText = $('#obstext').val();
                    if ( currOpsText ) {
                        text = currOpsText + ', ' + text;
                    }
                    $('#obstext').val( text );
                });
            },


            hide: function (event, jqObj) {
                 $('.observaciones-list','#comanda-add-product-obss').off('click','.options-val');
                 $('#comanda-add-product-obss-submit').off('click');
            }
        },


        'comanda-add-menu': {
            
            show: function () {
                //creacion de comandas
                // producto seleccionado
                $(document).on(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event , productoSeleccionado);        

                // boton para mostrar el formulario de observacion
                $('#comanda-obervacion-a').on('click', function(){
                    $('#comanda-add-observacion').toggle('slow');
                    $('textarea','#comanda-add-observacion').focus();
                });
                
             
                $('#ul-productos-seleccionados').on(                        
                        'click',
                        '.ui-options-btn',
                        function(){
                            var $ops = $(this).parent().find('.ui-options'),
                                $opsBtn = $(this).parent().find('.ui-options-btn');
                                
                            if ( $opsBtn.hasClass('ui-options-btn-open') ) {
                                $ops.hide();
                                $opsBtn.removeClass('ui-options-btn-open');
                            } else {
                                $ops.show();
                                $opsBtn.addClass('ui-options-btn-open');
                            }
                        }
                );


                $('#ul-productos-seleccionados').on( 'click', 'a[href="#comanda-add-product-obss"]', function() {
                            jQuery.mobile.changePage(this.href);
                        }
                );

                $('#comanda-add-guardar').on('click', function(){
                    Risto.Adition.adicionar.currentMesa().currentComanda().save();
                    Risto.Adition.menu.reset();
                });

                function seleccionar(){
                    //retrieve the context
                    var context = ko.contextFor(this);
                    $(this).addClass('active');
                    if (context) {
                        // $data es es el objeto producto
                        context.$data.seleccionar();
                    }
                }

                $('#ul-categorias').on("click", "a", seleccionar);
                $('#ul-productos').on("click", "a", seleccionar);
                
                    
                // Eventos para la observacion General de la Comanda ADD
                (function(){
                    var $domObs = $('#comanda-add-observacion');
                    $("#mesa-comanda-add-obs-gen-cancel").on('click', function(){
                        $domObs.toggle('slow'); 
                        Risto.Adition.adicionar.currentMesa().currentComanda().comanda.borrarObservacionGeneral();
                    });

                    $("#mesa-comanda-add-obs-gen-aceptar").on('click', function(){
                        $domObs.toggle('slow');
                    });

                    var domObsList = $('.observaciones-list button', '#comanda-add-menu');
                    domObsList.on('click' , function(e){
                        if ( this.value ) {
                            Risto.Adition.adicionar.currentMesa().currentComanda().comanda.agregarTextoAObservacionGeneral( this.value );
                        }
                    });
                })();


            },

            hide: function () {
                $(document).off(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
                $('#comanda-obervacion-a').off('click');
                $('#ul-productos-seleccionados').off('click', '.ui-options-btn');
                $('#comanda-add-guardar').off('click');
                $('#ul-categorias').off("click", "a");
                $('#ul-productos').off("click", "a");
                $("#mesa-comanda-add-obs-gen-cancel").off('click');
                $("#mesa-comanda-add-obs-gen-aceptar").on('click');
                $('.observaciones-list button', '#comanda-add-menu').off('click');
                $('#ul-productos-seleccionados').off( 'click', 'a[href="#comanda-add-product-obss"]');
            }
        },

        'mesa-cambiar-numero': {

            show: function () {
                 $('input:first', '#form-cambiar-numero').focus().val('');
                // Form SUBMITS
                $('#form-cambiar-numero').bind( 'submit', function(){
                    $raeh.trigger('cambiarNumeroMesa', null, this);
                    return false;
                });
            },

            hide: function () {
                // Form SUBMITS
                $('#form-cambiar-numero').unbind( 'submit');
            }
        },


        'mesa-view': {

            show: function () {

                $('#comanda-detalle-collapsible').trigger('create');

                 // CLICKS
                $('#mesa-action-comanda').bind( 'click', function(){
                    Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
                });

                $('#mesa-action-cobrar').bind('click',function(){
                   

                });
                
                var $hrefEdit = $('a:first-child','#mesa-action-edit');
                


                  $('#mesa-menu').bind( 'click', function(){
                      Risto.Adition.adicionar.agregarMenu();
                  });

                  $('#mesa-cant-comensales').bind('click', function(){
                      Risto.Adition.adicionar.agregarCantCubiertos();
                  });


                $('#mesa-cerrar').bind('click', function(){
                    var mesa = Risto.Adition.adicionar.currentMesa();
                    mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.cerrada );
                });

                $('#mesa-action-reimprimir').bind('click', function(){
                    var mesa = Risto.Adition.adicionar.currentMesa();
                    var url = mesa.urlReimprimirTicket();
                    $.get(url);
                });


                $('#mesa-borrar').bind('click', function(){
                    if (window.confirm('Seguro que desea borrar la mesa '+Risto.Adition.adicionar.currentMesa().numero())){
                        var mesa = Risto.Adition.adicionar.currentMesa();
                        mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.borrada );
                    }
                });


                $('#mesa-reabrir').bind('click',function(){
                    var mesa = Risto.Adition.adicionar.currentMesa();
                    mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
                });

                var observationChanges = '';
                $('#mesa-textarea-observation').bind('focus', function() {
                    observationChanges = Risto.Adition.adicionar.currentMesa().observation();
                    $('#mesa-observacion-submit').show('fade');
                });

                $('#mesa-textarea-observation').bind('focusout', function() {
                    if ( observationChanges == Risto.Adition.adicionar.currentMesa().observation() ){
                        $('#mesa-observacion-submit').hide('fade');
                    }
                });

                $('#mesa-observacion-submit').bind('click', function(){
                     Risto.Adition.adicionar.guardarObservacionMesa();
                     $('#mesa-observacion-submit').hide('fade');
                });
                
                

            },

            hide: function () {
                $('#mesa-action-comanda').unbind('click');
                $('#mesa-action-cobrar').unbind('click');
                $('#mesa-menu').unbind('click');
                $('#mesa-cant-comensales').unbind('click');
                $('#mesa-cerrar').unbind('click');
                $('#mesa-action-reimprimir').unbind('click');
                $('#mesa-borrar').unbind('click');
                $('#mesa-reabrir').unbind('click');
                $('#mesa-textarea-observation').unbind('focus');
                $('#mesa-textarea-observation').unbind('focusout');
                $('#mesa-observacion-submit').unbind('click');

            }
        },


        'listado-mesas': {

            show: function () {
                $('#mesas_container').on('click','a', function() {
                    console.info("apreteee MAN");
                    $.mobile.changePage(this.href);
                });


                var $listadoMozos = $('#listado-mozos-para-mesas');
                $listadoMozos.removeClass('ui-grid-a');


                // al hacer click n un mozo del menu bar
                // se muestran solo lasmesas de ese mozo

                $listadoMozos.delegate('a', 'click', function(e) {
                    $raeh.trigger('mostrarMesasDeMozo', e.currentTarget);
                    return false;        
                });


                $("#mesa-abrir-mesa-generica-btn").bind( 'click', function(e) {
                    var miniMesa = {
                        numero: $(this).data('numero'),
                        mozo_id: $(this).data('mozo-id'),
                        cubiertos: 1
                    };
                    mesa = Risto.Adition.adicionar.crearNuevaMesa( miniMesa );
                    Risto.Adition.EventHandler.mesaSeleccionada( {"mesa": mesa} );
                    Risto.Adition.adicionar.setCurrentMesa( mesa );            
                });

            },

            hide: function () {
                console.info("LLENDO SE del listado");
                $('#listado-mozos-para-mesas').undelegate('a','click');
                $("#mesa-abrir-mesa-generica-btn").unbind( 'click');
                $('#mesas_container').off('click','a');
            }
        },


        'mesa-cobrar':  {

            show: function () {
                $('#mesa-cajero-reabrir').bind('click',function(){
                    var mesa = Risto.Adition.adicionar.currentMesa();
                    mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
                });
                $('.mesa-reimprimir', '#mesa-cobrar').bind('click', function(){
                    var mesa = Risto.Adition.adicionar.currentMesa();
                    var url = mesa.urlReimprimirTicket();
                    $.get(url);
                });


                     $('.tipo-de-pagos-disponibles','#mesa-cobrar').delegate('a', 'click', function() {


                // crear pago
                var json = $(this).data('pago-json');
                var tipoDePago = eval("(function(){return " + json + ";})()");

                var pagoObj = {
                  TipoDePago: tipoDePago
                }

                var nuevoPago = new Risto.Adition.pago( pagoObj );

                Risto.Adition.adicionar.currentMesa().Pago.push( nuevoPago );

                $('.pagos_creados li:last','#mesa-cobrar').find('input').focus();
                
              });
              

                // Al apretar el boton de cobro de pago procesa los pagos correspondientes
                $('#mesa-pagos-procesar').bind('click', function(){
                    Risto.Adition.adicionar.currentMesa().savePagos();            
                });


            },

            hide: function () {
                $('#mesa-cajero-reabrir').unbind('click');
                $('.mesa-reimprimir', '#mesa-cobrar').unbind('click');  

                $('#mesa-pagos-procesar').unbind('click');
                $('.tipo-de-pagos-disponibles','#mesa-cobrar').undelegate('a', 'click');
            }
        },



        'clientes-addfacturaa': {
            show: function () {
                var $fform = $('#form-cliente-add', '#clientes-addfacturaa');
                $fform.bind('submit', function(e){
                  var contenedorForm = $fform.parent();
                   e.preventDefault();
                   $.post(
                       $fform.attr('action'), 
                       $fform.serialize(),
                       function(data){
                           contenedorForm.html(data);
                           contenedorForm.trigger('create');
                           contenedorForm.trigger('refresh');
                       }
                   );
                   return false; 
                });

            },

            hide: function () {
                 $('#form-cliente-add', '#clientes-addfacturaa').unbind('submit');
            }
        },



        'mesas-edit': {
            show: function () {
                $('form', e.target).bind('submit', function ( evt, coso ) {
                    var action = this.action;
                    var data = $(this).serialize();

                    $.ajax({
                      type: "PUT",
                      url: action,
                      data: data,
                      success: function () {
                            history.back();
                      }
                    });
                    return false;
                });
            },

            hide: function () {
                $('form', e.target).unbind('submit');
            }
        },




        'listado_de_clientes': {
            show: function () {
                 $('input', '#contenedor-listado-clientes-factura-a').bind('keypress', function(){
                    $('.factura-a-cliente-add').show();
                 });

                $('#mesa-eliminar-cliente').bind('click',function(){
                    Risto.Adition.adicionar.currentMesa().setCliente( null );
                    return true;
                });
            },

            hide: function () {
                 $('#mesa-eliminar-cliente').unbind('click');
                $('input', '#contenedor-listado-clientes-factura-a').unbind('keypress');
            }
        },





        'page-sabores': {

            show: function() {
                var $closeIcon = $('#page-sabores').find( 'a[data-icon="delete"]' );
                $closeIcon.bind('click',function(){
                            Risto.Adition.adicionar.currentMesa().currentComanda().limpiarSabores();
                            $closeIcon.unbind('click');
                        });
                        
                function seleccionar(e){
                    
                    //retrieve the context
                    var context = ko.contextFor(this);
                    $(this).addClass('active');
                    if (context) {
                        // $data es es el objeto producto
                        context.$data.seleccionar(e);
                    }
                }

                $('#ul-sabores').delegate("a", "click", seleccionar);
            },

            hide: function () {
                 $('#ul-sabores').undelegate("a", "click");
            }

        },



        'mesa-add': {

            show: function(){
                $formMesaAdd = $('#form-mesa-add');
                $p3 = $('#add-mesa-paso3');
                $p2 = $( '#add-mesa-paso2');
                $p1 = $( '#add-mesa-paso1');
                
                
                // init
                $p2.hide();
                $p3.hide();
                $p1.show();
                

                /**
                 *
                 * Luego de apretar el submit del formulario agregar mesa....
                 */
                function agregarNuevaMesa(e){
                    domRegisterForEvents['mesa-add'].unbindAll();
                    e.preventDefault();

                    var rta = $formMesaAdd.serializeArray(), 
                        miniMesa = {}, // json modelo, para crear la mesa
                        mesa, // nueva mesa creada
                        r; // cada atributo del formuario de mesa

                    for (r in rta ) {
                        if (rta[r].name == 'numero' && !rta[r].value){
                            alert("Debe completar numero de mesa");
                            return false;
                        }

                        if (rta[r].name == 'cant_comensales' && !rta[r].value && Risto.Adition.cubiertosObligatorios){
                            alert("Debe indicar la cantidad de "+Risto.TITULO_CUBIERTO);
                            return false;
                        }
                        miniMesa[rta[r].name] = rta[r].value;
                    }

                    mesa = Risto.Adition.adicionar.crearNuevaMesa( miniMesa );
                    Risto.Adition.EventHandler.mesaSeleccionada( {"mesa": mesa} );
                    Risto.Adition.adicionar.setCurrentMesa( mesa );
                    $.mobile.changePage('#mesa-view');
                    document.getElementById('form-mesa-add').reset(); // limpio el formulario

                    return false;
                }
                
                function irPaso1(){
                    $p3.hide();
                    $p2.hide();
                    $p1.show();
                }
                
                function irPaso2(){
                    $p1.hide();
                    $p3.hide();
                    $p2.show();           
                    $('#add-mesa-paso2').find( 'input').focus();
                }
                
                function irPaso3(){
                    $p1.hide();
                    $p2.hide();
                    $p3.show();   
                    $('#add-mesa-paso3').find( 'input').focus();
                }
    
                
                // Ir al paso 1
                $('#add-mesa-paso3-submit').bind('click', irPaso1);
                $('#add-mesa-paso2-volver').bind('click', irPaso1);
                
                // Ir al paso 2
                $('input[type="radio"]', "#add-mesa-paso1").bind("change", irPaso2);
                $('#add-mesa-paso3-volver').bind("click", irPaso2);

                // Ir al paso 3
                $('#add-mesa-paso2-submit').bind('click', irPaso3);
                

                $('#form-mesa-add').bind('submit', agregarNuevaMesa);


            },

            unbindAll: function() {
                $('#add-mesa-paso3-submit').unbind('click');
                 $('#add-mesa-paso2-volver').unbind('click');
                 $('#add-mesa-paso2-submit').unbind('click');
                 $formMesaAdd.unbind('submit');
                 $('#add-mesa-paso3-volver').unbind('click');
                 $('input[type="radio"]', "#add-mesa-paso1").unbind("change");
            },

            hide: function(){
                domRegisterForEvents['mesa-add'].unbindAll();
                document.getElementById('form-mesa-add').reset();


            }
        }





    }



    /**
     *
     *
     *          Mesa View -> Cambiar Mozo
     *
     *
     */

     //pagecontainershow

     $(document).on('pagecontainershow', function(event, ui){
        var fromDomId = $(ui.prevPage).attr('id'),
            toDomId   = $(ui.toPage).attr('id');

        if( toDomId )  {
            if ( domRegisterForEvents.hasOwnProperty(toDomId)
                 && domRegisterForEvents[toDomId].hide
                 && typeof domRegisterForEvents[toDomId].hide == 'function' ) 
            {
                domRegisterForEvents[toDomId].show.apply(this, arguments);
            }
        }

        if( fromDomId )  {
            if ( domRegisterForEvents.hasOwnProperty(fromDomId)
                 && domRegisterForEvents[fromDomId].hide
                 && typeof domRegisterForEvents[fromDomId].hide == 'function' ) 
            {
                domRegisterForEvents[fromDomId].hide.apply(this, arguments);
            }
        }

     });



     Risto.domRegisterForEvents = domRegisterForEvents;

});


/**
 *
 *                  Eventos ONLOAD
 *
 *
 */ 
$(document).ready(function() {   
  
   hacerQueNoFuncioneElClickEnPagina();
    
    $(document).keydown(onKeyDown);
    $(document).keypress(onKeyPress);
    
    
     // Los botones que tengan la clase silent-click sirven para los dialogs
    // la idea es que al ser apretados el dialog se cierre, pero que se envie 
    // el href via ajax, Es util para las ocasiones en las que quiero mandar
    // una accion al servidor del cual no espero respuesta.    
    $(document).on('click', '[data-href]', function(e){
        var att = $(this).attr('data-href');
        if (att) {
            $.get( att );
        }
        $('.ui-dialog').dialog('close');
    });   
});



/**
 * Cuando estoy creando una comanda se selecciona un producto y 
 * este debe ser agregado al listado de productos de la currentMesa()
 */
function productoSeleccionado(e) {
    Risto.Adition.adicionar.currentMesa().agregarProducto(e.producto);
}




function confirmacionDeSalida(e) {
	if(!e) e = window.event;
	//e.cancelBubble is supported by IE - this will kill the bubbling process.
	e.cancelBubble = true;
	e.returnValue = 'Seguro que deseas salir de la aplicación?\n si no hay datos guardados, los mismos se perderán'; //This is displayed on the dialog

	//e.stopPropagation works in Firefox.
	if (e.stopPropagation) {
		e.stopPropagation();
		e.preventDefault();
	}
    }
    


/**
 *
 *@param String to. es una funcion de jQuery que hace ir para adelante o para atras en la dom 
 *se puede poner: 
 *                  'next' (por default) busca el siguiente elemento
 *                  'prev' busca el anterior
 */
function __irMesaTo(to) {
    var toWhat = to || 'next';
    
    var mesaContainer = $('.listado-adicion', $.mobile.activePage );
    
    if ( !mesaContainer ) {
        return;
    }

    if ( Risto.Adition.mesaCurrentContainer && Risto.Adition.mesaCurrentContainer.attr('id') != mesaContainer.attr('id') ){
        Risto.Adition.mesaCurrentIndex = null;
    }
    
    Risto.Adition.mesaCurrentContainer = mesaContainer;
        
    if ( Risto.Adition.mesaCurrentIndex !== null) {
        var aaa = Risto.Adition.mesaCurrentIndex.parent()[toWhat]().find('a');
        if ( aaa.length ) {
            Risto.Adition.mesaCurrentIndex = aaa;
        } else {
            return;
        }
    } else {
        Risto.Adition.mesaCurrentIndex = Risto.Adition.mesaCurrentContainer.find('a').first();
    }
    Risto.Adition.mesaCurrentIndex.focus();
}
  

function irMesaPrev() {
    __irMesaTo('prev');
    
}

function irMesaNext() {
    __irMesaTo('next');
}


function onKeyDown(e) {
    var code = e.which;
    
    // al apretar la tecla back, volver atras, menos cuando estoy en un INPUT o TEXTAREA
    if (code == 8 ) { // tecla backspace
        if (document.activeElement.tagName.toLowerCase() != 'input' && document.activeElement.tagName.toLowerCase() != 'textarea') {
            history.back();
        }
    }
    
    
    // Ctrol DERECHO + M ir a modo Cajero
    if( (code == 'l'.charCodeAt() || code == 'L'.charCodeAt()) && e.ctrlKey) {
        var pageId = $.mobile.activePage.attr('id');
        
        if ( pageId == 'listado-mesas-cerradas' ) {
            $.mobile.changePage('#listado-mesas');
        }
        
        if ( pageId == 'listado-mesas' ) {
            $.mobile.changePage('#listado-mesas-cerradas');
        }
        return false;
    }        
    
    
    if(code == 23 && e.ctrlKey) {
        $.mobile.changePage('#mesa-view')
    }
        
    
    // mesa siguiente a la seleccionada (focus) del listado de mesas
    if (code == 39 ) { //btn flecha derecha
        irMesaNext();
    }
    
    // mesa anterior a la seleccionada del listado de mesas
    if (code == 37 ) { // boton flecha izq
        irMesaPrev();
    }
}

var oldTimeOut;
function onKeyPress(e) {
    var code = e.which;
    if ( code > 47){ // desde el numero 0 hasta la ultima letra con simbolos
        
        // buscar la mesa con ese numero, busca por accesskey
        Risto.Adition.mesaBuscarAccessKey += String.fromCharCode( code );
        var domFinded = $("[accesskey^='"+Risto.Adition.mesaBuscarAccessKey+"']", $.mobile.activePage);
        if ( domFinded.length ) {
            Risto.Adition.mesaCurrentIndex = $(domFinded[0]);
            domFinded[0].focus();
        }
        
        if(oldTimeOut){
            clearTimeout(oldTimeOut);
        }
        oldTimeOut = setTimeout(function(){
            Risto.Adition.mesaBuscarAccessKey = '';
        },1000);
    }
}



/**
 *  para que no titile el cursor. Que no se pueda hacer click
 */
function hacerQueNoFuncioneElClickEnPagina() {
    return 1;
   if(document.all){
      document.onselectstart = function(e) {return false;} // ie
   } else {
      document.onmousedown = function(e)
      {
         if(e.target.type!='text' && e.target.type!='button' && e.target.type!='textarea') return false;
         else return true;
      } // mozilla
   }
}