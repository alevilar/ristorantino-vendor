

Mozo.prototype._initFn.push( function(){
	
});


/**	
* @param moment-js day
**/
Mozo.prototype.tieneMesaEl = function ( day ) {		
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



Mozo.prototype.mesasFromDataRangeByRange = function () {
		 var days = Risto.Adition.adicionar.calendarGrid.days(),
		 	 curDay,
		 	 mesa, 
		 	 diasEstadia,
		 	 cout, cin,
		 	 rangoGrilla, //rango de la grilla para una reserva particular
		 	 cols = [],
		 	 diffDays = 0,
		 	 iant,
		 	 diffMin, diffMax,
		 	 className = '',
		 	 i = 0;
		if ( days ) {			
			while ( i < days.length ) {
				curDay = days[i];
				mesa = this.tieneMesaEl( curDay );

				if ( !mesa.hasOwnProperty('grillaExtraClass')) {
					mesa.grillaExtraClass = ko.observable('checkin-checkout');
				}

				if ( !mesa.hasOwnProperty('diasEstadiaRecortado')) {
					mesa.diasEstadiaRecortado = ko.observable( 0 );
				}

				
				if ( mesa ) {
					cin =  Date.clearHour( mesa.checkin() );
					cout =  Date.clearHour( mesa.checkout() );
						
					diasEstadia = mesa.diasEstadia();
				
					diffMin = Date.diffDays( cin, days[0] );
					diffMax = Date.diffDays( cout, days[days.length-1] );

					// check limit de grilla inicial con checkin
					if ( diffMin < 0 || diffMax  > 0 ) {
						className = '';

						if ( diffMin < 0 && diffMax > 0) {
							// recortado
							diasEstadia = days.length;
							className = 'checkin-not-showed  checkout-not-showed';
						} else if ( diffMin < 0 ) {
							// recortado
							diasEstadia = Math.abs( diasEstadia - Math.abs(Date.diffDays( cin, days[0] )) );											
							className = 'checkin-not-showed';
						} else if ( diffMax > 0 ) {
							// check limit de grilla final con checkout
							diasEstadia =  Math.abs( diasEstadia - Math.abs(Date.diffDays( cout, days[days.length-1] )) )+1;						
							className = 'checkout-not-showed';
						}
						mesa.grillaExtraClass(className);
					} else {
						if ( mesa.grillaExtraClass() == 'checkin-not-showed' ) {
							// si estaba recortado y luego se movio la grilla, resetear clase
							mesa.grillaExtraClass('checkin-checkout');
						}
					}


					mesa.diasEstadiaRecortado( diasEstadia );

					// avanzar dias hasta el dia del checkout para seguir buscando
					if ( mesa.diasEstadiaRecortado()  ) {
						i = i + mesa.diasEstadiaRecortado() ;
					} else {
						i++;
						// tambien devuelve la mesa en el dia del checkout, pero no me interesa ese dia
						mesa = {
							diasEstadia:0,
							dayName: curDay.format('YYYY-MM-DD')
						};
					}
				} else {
					// avanzar 1 dia
					i++;
					mesa = {
							diasEstadia:0,
							dayName: curDay.format('YYYY-MM-DD')
						};
				}
				cols.push(mesa);
			}
			return cols;
		}
		return [];
	};


Mozo.prototype.mesasFromDataRange = function () {
		var i, 
			cin, 
			cout,
			mesas = [],
			firstDay = Risto.Adition.adicionar.calendarGrid.days[0],
			lastDay = Risto.Adition.adicionar.calendarGrid.days[ Risto.Adition.adicionar.calendarGrid.days.length -1 ];


		for ( i in this.mesas() ) {
			cin = this.mesas()[i]().checkin;
			cout = this.mesas()[i]().checkout;
			
			if ( lastDay >= cin || firstDay <= cout ) {
				// agregar mesa
				mesas.push(this.mesas()[i]);
			}
		}

		return mesas;
	}


