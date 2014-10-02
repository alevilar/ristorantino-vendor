/*--------------------------------------------------------------------------------------------------- KO MODEL
 *
 *
 * Clase Vista de knockout.js depende de Risto.Adition.adicionar y Risto.Adition.menu
 */



/**
 *
 *
 *  KO Model
 *  
 *  Aca van todos los bindings que se realizaran en la vista
 *
 *  tambien el mapeo de datos entre arrays que vienen del servidor
 *
 *
 */
Risto.Adition.koAdicionModel = {
    
    adn     : ko.observable( Risto.Adition.adicionar ),
    menu    : ko.observable( Risto.Adition.menu ),
    
    tieneCurrentMesa: function(){
        if ( typeof this.adn().currentMesa() == 'object')  {
            return true;
        } else {
            return false;
        }
    },
    
    refreshBinding: function(){
        ko.applyBindings( Risto.Adition.koAdicionModel );
    },


    mesaHoteltrDisplay: function( mesa ) {
        // Initially "Kari" uses the "active" template, while the others use "inactive"
         if ( mesa.diasEstadia() > 0 ) 
            return "calendar-mozo-mesas-data-day-grid";
        else 
            return "calendar-mozo-mesas-data-day-grid-libre";
    }
}
