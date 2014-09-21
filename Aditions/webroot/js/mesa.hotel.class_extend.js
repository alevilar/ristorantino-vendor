Date.diffDays = function ( day1, day2 ) {
	var mm = moment(day1);
	var m2 = moment(day2);
	mm.set('hour',00).set('minute',00).set('second',00).set('millisecond',00);
	m2.set('hour',00).set('minute',00).set('second',00).set('millisecond',00);
	return mm.diff(m2, "days");
}

Mesa.prototype.cantDiasEntreCheckinCheckout = function () {
    	var cin = moment( this.checkin() );
    	var cout = moment( this.checkout() );

    	return cin.diff(cout, 'days' );
}




/**	
* @param moment-js day
**/
Mozo.prototype.tieneMesaEl = function ( day ) {		

		var i = 0, 
			cin, 
			rangoMesa,
			firstDay = Risto.Adition.adicionar.calendarGrid.days[0],
			lastDay = Risto.Adition.adicionar.calendarGrid.days[ Risto.Adition.adicionar.calendarGrid.days.length -1 ];


		var rangoGrilla = moment().range(firstDay, lastDay);

		while ( i < this.mesas().length ) {

			cin = moment( this.mesas()[i].checkin() );
			cout = moment( this.mesas()[i].checkout() ).subtract(1, 'day');

			rangoMesa = moment().range(cin, cout);
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
		 	 cout, cin, cmin, cmax,
		 	 rangoGrilla, //rango de la grilla para una reserva particular
		 	 cols = [],
		 	 diffDays = 0,
		 	 i = 0;

		if ( days ) {
			while ( i < days.length ) {
				curDay = days[i];
				mesa = this.tieneMesaEl( curDay );
				
				mesa.grillaExtraClass = 'checkin-checkout';

				diffDays = 0;
				if ( mesa ) {
					cmin = cin =  moment( mesa.checkin() );
					cmax = cout =  moment( mesa.checkout() );

					// check limit de grilla inicial con checkin
					if ( Date.diffDays( cin, days[0] ) < 0 ) {
						cmin = days[0];
						mesa.grillaExtraClass = 'checkin-not-showed';
					}

					// check limit de grilla final con checkout
					if ( Date.diffDays( cout, days[days.length-1] ) > 0 ) {
						cmax = days[days.length-1];
						mesa.grillaExtraClass = 'checkin-not-showed';
					}

					// para el colspan
					mesa.diasEstadia = Math.abs( Date.diffDays( cmin, cmax ) );

					// avanzar dias hasta el dia del checkout para seguir buscando
					if ( mesa.diasEstadia  ) {
						i = i + mesa.diasEstadia ;
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


