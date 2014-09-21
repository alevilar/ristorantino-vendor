

(function($, moment){



	$('#listado-mesas').live('pageshow',function(event, ui){
		console.info("aca adentro");

		var dayCin, dayCout, mozo;
		$('#listado-mesas').delegate('td.mozo-col', 'mousedown', function(e) {
			dayCin = $(this).data('day');
			if (!dayCin) {
				// si no hay dia es porque me pare sobre una reserva, entonces tomo su fecha checkout
				dayCin = $(this).data('checkout');
			}
			mozo =  $(this).parents('.mozo-row').find('.listado-mozos-para-mesas a').data('mozo-id');
			console.debug(mozo);
        });


        $('#listado-mesas').delegate('td.mozo-col', 'mouseup', function(e) {
			dayCout = $(this).data('day');
			if (!dayCout) {
				// si no hay dia es porque me pare sobre una reserva, entonces tomo su fecha checkout
				dayCout = $(this).data('checkin');
			}
			var mozo2 =  $(this).parents('.mozo-row').find('.listado-mozos-para-mesas a').data('mozo-id');
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
        });

    });


    $('#listado-mesas').live('pagebeforehide',function(event, ui){
         $('#listado-mesas').undelegate('td.mozo-col', 'mousedown');
         $('#listado-mesas').undelegate('td.mozo-col', 'mouseup');
    });
    
    


	var CalendarGrid = function() {
        this.cantDayShown	= ko.observable(40);        
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


	Risto.Adition.adicionar.calendarGrid = new CalendarGrid;
	
})(jQuery, moment);