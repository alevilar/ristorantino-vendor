



/**
*	Ejecutar al inicializar la creacion de un Mozo
*
***/
Mozo.prototype._init.push( function( jsonData ) {


	/**	
	* @param moment-js day
	**/
	this.tieneMesaEl = function ( day ) {		
		if ( !day ) return false;

		var i = 0, 
			cin, 
			rangoMesa,
			firstDay = Risto.Adition.adicionar.calendarGrid.days[0],
			lastDay = Risto.Adition.adicionar.calendarGrid.days[ Risto.Adition.adicionar.calendarGrid.days.length -1 ];


		var rangoGrilla = moment().range(firstDay, lastDay);

		while ( i < this.mesas().length ) {			
			rangoMesa = this.mesas()[i].momentRange();

			if (  day.within( rangoMesa ) ) {				
				return this.mesas()[i];
			}
			i++;
		}
		return false;

	};


	var mesaClass = function ( map ) {

				var obj = {},

					// defaults values
					d = {
						id: ko.observable(),
						numero: ko.observable(),
						dayName: ko.observable( '' ),
						grillaExtraClass: ko.observable( 'libre' ),
						diasEstadia: ko.observable( 1 ),
						checkin: ko.observable( '' ),
						checkout: ko.observable( '' ),
						getEstadoIcon: function(){return ''},
						clienteNameData: function(){return ''},
						seleccionar: function(){}
					}

				if ( map ) {
					obj = map;					
				}

				// combino con lo que vino
				d = $.extend({}, d, obj);

				d.diasEstadiaRecortado = ko.observable( d.diasEstadia() );

				return d;

		}


	this.mesasWithinRange = ko.pureComputed( function () {
	});


	this.mesasFromDataRangeByRange = ko.pureComputed( function () {
		 var days = Risto.Adition.adicionar.calendarGrid.days(),
		 	 gridFirstDay = Risto.Adition.adicionar.calendarGrid.firstDay().toDate(),
		 	 gridLastDay = Risto.Adition.adicionar.calendarGrid.lastDay().toDate(),
		 	 curDay,
		 	 mesa, 
		 	 diasEstadia,
		 	 cout, cin,
		 	 rangoGrilla, //rango de la grilla para una reserva particular
		 	 cols = [],
		 	 diffDays = 0,
		 	 iant,
		 	 diffMin, diffMax,
		 	 i = 0,
		 	 mesaRow = [],
		 	 checkinClass = '', 
		 	 checkoutClass = '',
		 	 mesaCel;

		if (this.numero() == 0) return [];


		if ( days ) {
			while ( i < days.length ) {
				checkinClass = checkoutClass = '';
				diasEstadia = 1;
				
				curDay = days[i];

				mesa = this.tieneMesaEl( curDay );

				if ( mesa ) {
					mesaCel = new mesaClass( mesa );
				} else {
					// celda de mesa libre
					mesaCel = new mesaClass;
				}

				mesaCel.dayName(curDay.format('YYYY-MM-DD'));

				mesaRow.push( mesaCel );
				if ( mesa ) {

					cin =  Date.clearHour( mesaCel.checkin() ).toDate();
					cout =  Date.clearHour( mesaCel.checkout() ).toDate();
					diasEstadia = mesaCel.diasEstadia();

					if ( cin < gridFirstDay ) {
						// checkin fuera de la grilla
						checkinClass = ' checkin-not-showed';

						// restar dias que no se muestran
						diffMin = Math.abs(Date.diffDays( cin, gridFirstDay ));
						diasEstadia -= diffMin 
					}

					if ( cout > gridLastDay ) {
						//checkout fuera de la grilla
						checkoutClass = ' checkout-not-showed';

						// restar dias que no se muestran
						diffMax = Math.abs(Date.diffDays( cout, gridLastDay ));
						diasEstadia -= diffMax ;
					}
					
					mesaCel.diasEstadiaRecortado( diasEstadia );
					
					if ( checkinClass || checkoutClass ) {
						mesaCel.grillaExtraClass( 'ocupada' + checkinClass + checkoutClass );
					}  else {
						mesaCel.grillaExtraClass( 'ocupada checkin-checkout' );
					}
				}

				// avanzar los dias que dura la estadia de la mesa
				i += diasEstadia;

			}
		}
		return mesaRow;
	}, this);


});

