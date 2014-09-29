




	$('#listado-mesas').live('pageshow',function(event, ui){

		/**
        pintar celdas para marcar
        **/
		var $ancla = null, 
			$anterior = null;


		function agregarAncla ( $el ) {
			if ( $ancla === null ) {
				$ancla = $anterior = $el;
				$el.addClass('ancla-mark');
			}
		}

		function mostrarSiguienteAncla ( $el ) {
			if ( $ancla && $anterior ) {
				if ( $anterior.next()[0] == $el[0] ) {
					$el.addClass('future-mark');
					$anterior = $el;
				}
				if ( $anterior.prev()[0] == $el[0] ) {
					$anterior.removeClass('future-mark');
					$anterior = $el;
				}
			}
		}


		function cortarAncla( $el ) {
			if ( $ancla ) {
        		$ancla.removeClass('ancla-mark');
				$ancla.parent().find('.future-mark').removeClass('future-mark');
				$ancla = $anterior = null;
        	}
		}


		function mostrarPosibleAncla( $el ) {
			if ( $ancla === null ) {
				$el.addClass('posible-ancla-mark');
			}
		}

		function ocultarPosibleAncla( $el ) {
			if ( $ancla === null ) {
				$el.removeClass('posible-ancla-mark');
			}
		}


		/**
        Creacion de mesa nueva con chekin - checkout
        **/
		var dayCin, dayCout, mozo;

		function iniciarCheckin( $el ) {
			dayCin = $el.data('day');
			if (!dayCin) {
				// si no hay dia es porque me pare sobre una reserva, entonces tomo su fecha checkout
				dayCin = $el.data('checkout');
			}
			mozo =  $el.parents('.mozo-row').data('mozo-id');
		}

		function iniciarCheckout( $el ) {
			dayCout = moment( $el.data('day') ).add(1, 'day').format('YYYY-MM-DD');
			if (!dayCout) {
				// si no hay dia es porque me pare sobre una reserva, entonces tomo su fecha checkout
				dayCout = $el.data('checkin');
			}
			var mozo2 =  $el.parents('.mozo-row').data('mozo-id');
			if ( dayCin && dayCout && mozo2 == mozo && dayCout != dayCin )  {
				var miniMesa = {
					mozo_id: mozo,
					numero: 1,
					checkin: dayCin,
					checkout: dayCout
				}
				var mesa = Risto.Adition.adicionar.crearNuevaMesa( miniMesa );
                Risto.Adition.EventHandler.mesaSeleccionada( {"mesa": mesa} );
                Risto.Adition.adicionar.setCurrentMesa( mesa );
                $.mobile.changePage('#mesa-view');
			}
            dayCin = dayCout = mozo = null;
		}


		function resaltarThDay( $el ) {
			$('.calendar-header th.highlight').removeClass('highlight');
			var day = $el.data('day');
			if ( day ) {
				$('.calendar-header th[data-day="'+ day +'"]').addClass('highlight');
				$el.parents('.mozo-row').find('.mozos-list-vertical').addClass('highlight');
			}			
		}

		function quitarResaltadoThDay( $el ) {
			var day = $el.data('day');
			if ( day ) {
				$('.calendar-header th[data-day="'+ day +'"]').removeClass('highlight');
				$el.parents('.mozo-row').find('.mozos-list-vertical').removeClass('highlight');
			}			
		}

		$(this).delegate('td.libre', 'mousedown', function(e) {
			agregarAncla( $(this) );
			iniciarCheckin( $(this) );
        });

		$(this).delegate('.mozo-mesas td.libre', 'mouseenter', function(e) {
			mostrarPosibleAncla( $(this) );
			mostrarSiguienteAncla( $(this) );
			resaltarThDay( $(this) );
        });

        $('body').bind( 'mouseup', function(e) {
        	cortarAncla( $(this) );
        });


		$(this).delegate('.mozo-mesas td.libre', 'mouseleave', function(e) {
			ocultarPosibleAncla( $(this) );
			quitarResaltadoThDay( $(this) );
        });


        $(this).delegate('.mozo-mesas td.libre', 'mouseup', function(e) {
			iniciarCheckout( $(this) );
        });


        $(this).delegate('.mozo-mesas td.libre', 'mouseup', function(e) {
			iniciarCheckout( $(this) );
        });

        $(this).delegate('.control-header', 'mousewheel DOMMouseScroll', function(e) {
        	e.preventDefault();
        	if (e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
		        // scroll up
				Risto.Adition.adicionar.calendarGrid.prevDay()
		    }
		    else {
		        // scroll down
		        Risto.Adition.adicionar.calendarGrid.backDay()
		    }

        });
        

    });

    $('#listado-mesas').live('pagebeforehide',function(event, ui){
         $(this).undelegate('td.libre', 'mousedown');
         $(this).undelegate('.mozo-mesas td.libre', 'mouseenter');
         $('body').unbind( 'mouseup');
         $(this).undelegate('.mozo-mesas td.libre', 'mouseleave');
         $(this).undelegate('.mozo-mesas td.libre', 'mouseup');
         $(this).undelegate('.control-header', 'mousewheel DOMMouseScroll');
    });

    
    


	var CalendarGrid = function() {
        this.cantDayShown	= ko.observable(24);        
        this.months         = ko.observableArray( [] );
        this.days           = ko.observableArray( [] );
        
        // agrego atributos generales
        Risto.modelizar(this);
        
        return this.initialize();
	}


	CalendarGrid.prototype =  {
		
		initialize: function () {
			var from  = Date.clearHour(), //devuelve el dia actual con las horas min y segs en 00
				to    = moment(from).add( this.cantDayShown(), 'days' );
				
			this.setFromToDate(from, to);				
		},

		setFromToDate: function ( from, to) {
			var days = [],
				months = {};

			moment().range( from , to ).by('days', function(moment) {
			  	days.push( moment );
			  	// armar meses array
			  	monthKey = "__" + moment.month();
			  	if ( months.hasOwnProperty(monthKey) ) {
			  		months[monthKey].cant++;
			  	} else {
			  		months[monthKey] = {
			  			cant: 1,
			  			name: moment.format("MMMM")
			  		}
			  	}
			});
			// armar array (convertir de object a array)
		  	var aMonths = [];
		  	for (var i in months) {
		  		aMonths.push( months[i] );
		  	}
			this.months(aMonths);
			this.days(days);
		},

		backDay: function () {
			var first = moment(Risto.Adition.adicionar.calendarGrid.days()[0]).subtract(1, 'day');
			var last = Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-2];

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		},

		prevDay: function () {
			var first = Risto.Adition.adicionar.calendarGrid.days()[1],
				last = moment(Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-1]).add(1, 'day');

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		},


		backWeek: function () {
			var weekCantDays = 15;
			var first = moment(Risto.Adition.adicionar.calendarGrid.days()[0]).subtract(weekCantDays, 'day');
			var last = Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-weekCantDays-1];

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		},

		prevWeek: function () {
			var weekCantDays = 15;
			var first = Risto.Adition.adicionar.calendarGrid.days()[weekCantDays],
				last = moment(Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-1]).add(weekCantDays, 'day');

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		}
	}

	Risto.CalendarGrid = CalendarGrid;
	
