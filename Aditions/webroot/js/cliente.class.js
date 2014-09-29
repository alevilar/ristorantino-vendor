/*--------------------------------------------------------------------------------------------------- Risto.Adicion.cliente
 *
 *
 * Clase Cliente
 */

Risto.Adition.cliente = function(jsonMap){   
    
    return this.initialize(jsonMap);
}

Risto.Adition.cliente.prototype = {
    Descuento: ko.observable(null),
    porcentaje: ko.observable( undefined ),
    
    tieneDescuento: function() {
        var porcentaje = undefined;
        if (this.descuento_id() && this.Descuento() && this.Descuento().porcentaje && this.Descuento().porcentaje()) {
            porcentaje = parseInt( this.Descuento().porcentaje() );
        }
        return porcentaje;
    },
    
    
    getDescuentoText : function(){
        var porcentaje = 0;
        if (this.Descuento() && this.Descuento().porcentaje()) {
            porcentaje = parseInt( this.Descuento().porcentaje() )+ '%';
        }
        return porcentaje;
    },
    
    getTipoFactura: function(){
        var tipo = '';
        if ( this.IvaResponsabilidad && this.IvaResponsabilidad.TipoFactura && typeof this.IvaResponsabilidad.TipoFactura != 'function' ) {
            tipo = this.IvaResponsabilidad.TipoFactura.name();    
        console.debug(this.IvaResponsabilidad);
        }
        return tipo;
    },
    
    initialize: function( jsonMap ){
        if ( !jsonMap ) {
            return null;
        }
        if (jsonMap.hasOwnProperty( 'Cliente' ) ) {
            jsonMap = cliente.Cliente;
        }
        
        this.Descuento  = ko.observable( null );
        this.porcentaje = ko.observable( undefined );
        
        if (jsonMap.Descuento && jsonMap.Descuento.id) {
            this.Descuento( new Risto.Adition.descuento(jsonMap.Descuento) );
        }
        delete jsonMap.Descuento;
        
        ko.mapping.fromJS(jsonMap, {}, this);
        return this;
    }
}