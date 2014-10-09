/*--------------------------------------------------------------------------------------------------- Risto.Adicion.pago
 *
 *
 * Clase Pago
 */
Risto.Adition.pago = function(jsonOb){
    
    return this.initialize(jsonOb);
}


Risto.Adition.pago.prototype = {
    model       : 'Pago',
    TipoDePago  : function( ) {},
    valor       : function( ) {},
    mesa_id     : function( ) {},
    tipo_de_pago_id: undefined,
    
    initialize: function( jsonOb ){        
        this.id = ko.observable();        
        this.valor = ko.observable(); 
        this.TipoDePago = ko.observable( null );

        if ( jsonOb && jsonOb.TipoDePago && jsonOb.TipoDePago.id ) {
            this.tipo_de_pago_id = ko.observable( jsonOb.TipoDePago.id );
        }
        this.mesa_id = ko.observable( null );    

        ko.mapping.fromJS(jsonOb, {}, this);
        Risto.modelizar(this);
        return this;
    },
    
    image: function(){
        if (this.TipoDePago() && typeof this.TipoDePago().media_id == 'function' ) {
            return URL_DOMAIN + TENANT + '/risto/medias/view/' + this.TipoDePago().media_id();
        } else {
            return URL_DOMAIN + TENANT + '/risto/medias/view/' + this.TipoDePago().media_id;
        }

        return '';
    }
}