

(function($, moment){



	$('#listado-mesas').live('pageshow',function(event, ui){

		/**
        pintar celdas para marcar
        **/
		var $ancla = null, 
			$anterior = null;

		$('#listado-mesas').delegate('td.libre', 'mousedown', function(e) {
			if ( $ancla === null ) {
				$ancla = $anterior = $(this);
				$(this).addClass('ancla-mark');
			}
        });

		$('#listado-mesas').delegate('td.libre', 'mouseover', function(e) {
			if ( $ancla && $anterior ) {
				if ( $anterior.next()[0] == $(this)[0] ) {
					$(this).addClass('future-mark');
					$anterior = $(this);
				}
				if ( $anterior.prev()[0] == $(this)[0] ) {
					$anterior.removeClass('future-mark');
					$anterior = $(this);
				}
			}
        });

        $('body').bind( 'mouseup', function(e) {
        	if ( $ancla ) {
        		$ancla.removeClass('ancla-mark');
				$ancla.parent().find('.future-mark').removeClass('future-mark');
				$ancla = $anterior = null;
        	}
        });


        /**
        Popsible ancla ON HOVER
        **/        
        $('#listado-mesas').delegate('td.libre', 'mouseover', function(e) {
			if ( $ancla === null ) {
				$(this).addClass('posible-ancla-mark');
			}
        });

		$('#listado-mesas').delegate('td.libre', 'mouseout', function(e) {
			if ( $ancla === null ) {
				$(this).removeClass('posible-ancla-mark');
			}
        });



        /**
        Creacion de mesa nueva con chekin - checkout
        **/
		var dayCin, dayCout, mozo;
		$('#listado-mesas').delegate('td.libre', 'mousedown', function(e) {
			dayCin = $(this).data('day');
			if (!dayCin) {
				// si no hay dia es porque me pare sobre una reserva, entonces tomo su fecha checkout
				dayCin = $(this).data('checkout');
			}
			mozo =  $(this).parents('.mozo-row').data('mozo-id');
        });


        $('#listado-mesas').delegate('td.libre', 'mouseup', function(e) {
			dayCout = moment( $(this).data('day') ).add(1, 'day').format('YYYY-MM-DD');
			if (!dayCout) {
				// si no hay dia es porque me pare sobre una reserva, entonces tomo su fecha checkout
				dayCout = $(this).data('checkin');
			}
			var mozo2 =  $(this).parents('.mozo-row').data('mozo-id');
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
        });

    });

    $('#listado-mesas').live('pagebeforehide',function(event, ui){
         $('#listado-mesas').undelegate('td.mozo-col', 'mousedown');
         $('#listado-mesas').undelegate('td.mozo-col', 'mouseup');
    });

    
    


	var CalendarGrid = function() {
        this.cantDayShown	= ko.observable(35);        
        this.months         = ko.observableArray( [] );
        this.days           = ko.observableArray( [] );
        
        // agrego atributos generales
        Risto.modelizar(this);
        
        return this.initialize();
	}


	CalendarGrid.prototype =  {
		
		initialize: function () {
			var from  = moment().toDate(),
				to    = moment().add( this.cantDayShown(), 'days' ).toDate();

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

			this.days(days);
			this.months(aMonths);

		},

		backDay: function () {
			var first = Risto.Adition.adicionar.calendarGrid.days()[0].subtract(1, 'day');
			var last = Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-2];

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		},

		prevDay: function () {
			var first = Risto.Adition.adicionar.calendarGrid.days()[1],
				last = Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-1].add(1, 'day');

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		},


		backWeek: function () {
			var weekCantDays = 15;
			var first = Risto.Adition.adicionar.calendarGrid.days()[0].subtract(weekCantDays, 'day');
			var last = Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-weekCantDays-1];

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		},

		prevWeek: function () {
			var weekCantDays = 15;
			var first = Risto.Adition.adicionar.calendarGrid.days()[weekCantDays-1],
				last = Risto.Adition.adicionar.calendarGrid.days()[Risto.Adition.adicionar.calendarGrid.days().length-1].add(weekCantDays, 'day');

			Risto.Adition.adicionar.calendarGrid.setFromToDate(first, last);
		},
	}

	Risto.CalendarGrid = CalendarGrid;
	
})(jQuery, moment);