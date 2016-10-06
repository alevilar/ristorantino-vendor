
function packeryUpdate() {
	// plugin para acomodar las comandas sin espacios en blanco entre ellas
		$('.comandero', '#comandero-content').packery();
}

function packeryInit() {
		// plugin para acomodar las comandas sin espacios en blanco entre ellas
		$('.comandero', '#comandero-content').packery({
			  // options
			  itemSelector: '.comanda'
		});
	}




function sonarCampana () {
	// hacer sonar aviso
	vid = document.getElementById("sound-alert");		
	vid.play();
}




/**
*
*
*	Maneja las actualizacion de comandas usando ajax
*
***/
function ComandasUpdateHandler() {

	$comandaContainer = $('#comandero-content');

	/**
	*
	* Carga las comandas usando AJAX
	*
	**/
	function loadComandas () {
		$comandaContainer.load(URL_COMANDERO_INDEX, function(){
			$comandaContainer.trigger('comandasActualizadas');
		});
	}


	/**
	*
	*	Actualizar hora
	*
	**/
	function updateTime() {
		var time = new Date();
		var time = time.getHours() + ":" + time.getMinutes();
		$('#comandero-updated-time').html(time);
	}



	function updateComandas () {
		loadComandas();
		updateTime();
	}
	function actualizarVistaConComandasActualizadas ( data ) {
		if ( data.hasOwnProperty('comandasActualizadas') && data["comandasActualizadas"] ) {
			// update view	
			if ( data["comandasActualizadas"] ) {
				updateComandas();
			}
		}
	}


	function handleActualizacion () {
		$.getJSON(URL_HAY_ACTUALIZACION, actualizarVistaConComandasActualizadas);
	}

	/**
	*
	*	maneja el Intervalo de actualizacion de comandas
	**/
	function initIntervalParaActualizarComandas () {

		setInterval(handleActualizacion, 3000);
	}



	// inicializacion
	updateComandas();
	initIntervalParaActualizarComandas();

}





/**
*
*	maneja el click en una comanda determinada para modificarle el estado
*
***/
function ComandasStateManager () {

	// un click pasa al siguiente estado
	$('#comandero-content').on('click', '.comanda', function() {
		var next = $(this).data('href-next');
		var el = $(this);
		if ( next ) {
			$(this).load(next , function(){
				el.trigger('comandaActualizadaNext', ['ComandaActualizadaNext', el]);
				if ( $('.comanda-estado-id-2', el).length ) {
					el.hide("fade", function(){
						packeryUpdate();
						
					});
				}
			});
		}
	});

	// doble click, vuelve al estado anterior
	$('#comandero-content').on('contextmenu dblclick', '.comanda', function(ev) {
		ev.preventDefault();
		var prev = $(this).data('href-prev');
		var el = $(this);
		if ( prev ) {
			$(this).load(prev, function( ){
				el.trigger('comandaActualizadaPrev', ['ComandaActualizadaPrev', el]);
			});
		}
		return false;
	});


}





/**
*
*
*
*
**/
function Relojito () {

	function renderTime() {
		var currentTime = new Date();
		var diem = "AM";
		var h = currentTime.getHours();
		var m = currentTime.getMinutes();
	    var s = currentTime.getSeconds();
		setTimeout(renderTime,1000);
	    if (h == 0) {
			h = 12;
		} else if (h > 12) { 
			h = h - 12;
			diem="PM";
		}
		if (h < 10) {
			h = "0" + h;
		}
		if (m < 10) {
			m = "0" + m;
		}
		if (s < 10) {
			s = "0" + s;
		}
	    var myClock = document.getElementById('clockDisplay');
		myClock.textContent = h + ":" + m + ":" + s;
		myClock.innerText = h + ":" + m + ":" + s;
	}
	renderTime();

	var $flashMessage = $("#flashMessage");
	if ( $flashMessage.length ) {
		var ht = $flashMessage.html() + " ( cerrando en <span class='alert-secs'>10</span>)";
		$flashMessage.html( ht );
		var secs = 10;
		setTimeout(function(){
			$('.alert-secs',"#flashMessage").html( secs-- );
			$flashMessage.fadeTo(2000, 500).slideUp(500, function(){
			    $flashMessage.alert('close');
			});
		}, 10000);
	}
}



function hablarInit() {
	var timer;

	var manolas = [];
	function hablar(txt) {		
		var voices = speechSynthesis.getVoices();
	    if (voices.length !== 0) {
	    	var manola = new SpeechSynthesisUtterance(txt);
	    	manolas.push(manola);
	    	var lang = localStorage.getItem("Comandero.lang");
	    	if ( lang ) {
				manola.lang = lang;
	    	}
			manola.rate = 1.2;
			
	    	manola.addEventListener('start', function(){
				$(document).trigger('comandero-sound-start');
			});
			manola.addEventListener('end', function(){
				$(document).trigger('comandero-sound-end');
			});
		    speechSynthesis.speak(manola);
	    }
	}


	function speechResumenGeneral() {
		hablar("¡Resúmen del Comandero PaxxaPós!");

		var cantComandasPendiente = $('.comanda-estado-id-'+COMANDA_ESTADO_PENDIENTE,'#comandero-content').length;
		var cantComandas = $('.comanda','#comandero-content').length;
		
		// si no hay comandas.. no hay nada mas que hacer
		if ( !cantComandas ) {			
			hablar("No hay comandas");
			return;
		}


		var textoFinal = '';
		if ( cantComandas > 1 ) {
			cantComandasTxt = cantComandas +  " comandas";
		} else {
			cantComandasTxt = cambiarUNOxUnaoUn( cantComandas, 'comanda' ) + " comanda";
		}
		textoFinal = "Hay "+cantComandasTxt;

		if ( cantComandasPendiente  > 1 ) {
			cantComandasPendienteTxt = cantComandasPendiente + " están Pendientes";
		} else {
			cantComandasPendienteTxt = cambiarUNOxUnaoUn( cantComandasPendiente, 'comanda' ); 
			cantComandasPendienteTxt = cantComandasPendienteTxt + " Pendiente";
		}
	

		if ( cantComandasPendiente  == 0) {
			textoFinal += ", y están todas marchando";
		} else if ( cantComandasPendiente  == 1){
			textoFinal += ", y hay "+cantComandasPendienteTxt;
		} else{
			textoFinal += ", de las cuales "+cantComandasPendienteTxt;
		}
		
		hablar( textoFinal );

	}




	/**
	*
	** Cambia la palabra del numero UNO, 
	*	por UN si es es masculino
	*	por UNA si es femenino
	**/
	function cambiarUNOxUnaoUn(cant, texto) {
		// cuando es 1 hay que cambiar la palabra por "UN o UNA"
		if ( cant == 1 ) {
			// verifica femeninos para cambiar la palabra "UN x UNA"
			if ( texto.slice(-2).indexOf('a') > -1 || texto.slice(-2).indexOf('A') > -1  ) {
				cant = 'una';
			} else {
				cant = 'un';
			}
		}
		return cant;
	}

	function speechDetalleComandaX$Comanda( el, txtAnteponer) {
		if ( !txtAnteponer ) {
			txtAnteponer = '';
		}
		$mesaNumero = $(el).find('.mesa-numero').text();
    	hablar(txtAnteponer + " Mesa " +$mesaNumero);

    	var observacionGeneral = $(el).find('.comanda-observacion .hablar').text();
    	if (observacionGeneral) {
    		hablar(observacionGeneral);
    	}

    	mesaDetalle = sabor = '';

    	var tipoPlatos = $(el).find('.tipo-plato');

    	$(el).find('.listado-detalle-comanda').each(function(j, el){
    		hablar( $(tipoPlatos[j]).text() );
	    	$(el).find('.detalle-comanda').each(function(i, detaComa ){
	    		$detaComa = $(detaComa);
	    		sabor = '';

	    		var txtdet = $detaComa
				    .clone()    //clone the element
				    .children() //select all the children
				    .remove()   //remove all the children
				    .end()  //again go back to selected element
				    .text();

				var cant = $('.detalle-comanda-cant', $detaComa).text();

				cant = cambiarUNOxUnaoUn(cant, txtdet);
	    		mesaDetalle = cant + " " + txtdet;
	    		$detaComa.find('.detalle-sabor').each( function( i, detaSab ) {
	    			$detaSab = $(detaSab);
	    			sabor = sabor + ", "+$detaSab.text();
	    		});
	    		if ( sabor ) {
	    			mesaDetalle = mesaDetalle + ": " +sabor;
	    		}
	    		hablar(mesaDetalle);
	    	});

    	});

	}


	var cantadasVino = [], 
		comandaId=null;
	function speechComanderoDetalleComandaSaliendo() {
	    $('.comanda-estado-id-'+COMANDA_ESTADO_SALIENDO,'#comandero-content').each( function ( index, el ){	    	
	    	speechDetalleComandaX$Comanda( el , "Vamos Saliendo con la");
			    var i = cantadasVino.indexOf( $(el).parent().data("comandaId") );
			    if ( i > -1 ) {
			    	cantadasVino.splice(i, 1);
			    }
	    });

	    	
	}

	function speechComanderoDetalleComandaPendiente() {
		$comandasPendientes = $('.comanda-estado-id-'+COMANDA_ESTADO_PENDIENTE,'#comandero-content');
		if ( $comandasPendientes.length ) {
			sonarCampana();
			setTimeout(function() {
			    $comandasPendientes.each( function ( index, el ){	    	
			    	txt = "Vino la";
			    	comandaId = $(el).parent().data("comandaId");
			    	if ( cantadasVino.indexOf(comandaId) === -1 ) {
						speechDetalleComandaX$Comanda($(el), txt);
						cantadasVino.push($(el).parent().data("comandaId"));
			    	}
			    });
		    }, 500);

		}
	}


	/**
	*
	*	@return promise
	**/
	function voicesLoaded() {
		var defe = jQuery.Deferred();
		
		var voices = speechSynthesis.getVoices();

		window.speechSynthesis.onvoiceschanged = function() {
		    window.speechSynthesis.getVoices();
		  	defe.resolve();
		};

		return defe.promise();

	}



	$('#comandero-content').on('comandaActualizadaNext', function(ev, ev2){
		var $el = $(ev.target);

		var txt = '';
		// cantar cxuando esta marchando
		if ( $('.comanda-content', $el).hasClass('comanda-estado-id-'+COMANDA_ESTADO_MARCHANDO) ) {
			txt = "Marchando la";
			speechDetalleComandaX$Comanda($el, txt);
		}

		// cantar cxuando esta saliendo
		if ( $('.comanda-content', $el).hasClass('comanda-estado-id-'+COMANDA_ESTADO_SALIENDO) ) {
			txt = "Vamos Saliendo con la";
			speechDetalleComandaX$Comanda($el, txt);
		}
	});


	var primeraVez = true;
	var upPromise = $('#comandero-content').on('comandasActualizadas', function(){
		
		packeryInit();

		if ( primeraVez ) {			
			primeraVez = false;
		}
		speechComanderoDetalleComandaPendiente();
	});


	


	function hacerResumenSiEstaCalladoUnRato () {
		var calladoCuanto = localStorage.getItem("ComanderoPaxapos.calladoCuanto");
		if (!calladoCuanto){
			calladoCuanto = 120000;
			localStorage.setItem("ComanderoPaxapos.calladoCuanto", calladoCuanto); // 2 moinutos
		}

		$(document).on('comandero-sound-start', function(){
			clearInterval(timer);
		});

		$(document).on('comandero-sound-end', function(){
			manolas = [];
			timer = setInterval(function(){
				    	speechResumenGeneral();
				    	speechComanderoDetalleComandaSaliendo();
	    	}, calladoCuanto);
		});

	}

	$(function(){
		// inicializacion
		hacerResumenSiEstaCalladoUnRato();

		var vpromise = voicesLoaded();

		$.when( vpromise, upPromise ).done(function () {
		    sonarCampana();
		    setTimeout(function() {
		    	speechResumenGeneral();
		    }, 500);
		});
	});
}


/**
*
*	Funcion de infiializacion de este modulo js
*
**/
function init() {
	var muted = JSON.parse( localStorage.getItem("Comandero.muted") );
	if (typeof muted == 'undefined') {
		muted = false;
		localStorage.setItem("Comandero.muted", muted);
	}
	if ('speechSynthesis' in window && !muted) {
		hablarInit();
	}
	Relojito();
	ComandasStateManager();
	ComandasUpdateHandler();


	// susable right click context menu
	document.oncontextmenu = new Function("return false;");


	$("#comandero-content").on('click', ".comanda-actions a", function(event){
		event.stopPropagation();
	});
	

}


init();

