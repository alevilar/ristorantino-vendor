/*--------------------------------------------------------------------------------------------------- Risto.Adicion.comanda
 *
 *
 * Clase Comanda
 */

Risto.Adition.comanda = function(jsonData){
    return this.initialize( jsonData );
}


Risto.Adition.comanda.prototype = {
    // Array de DetalleComanda, cada detalleComanda es 1 producto
    DetalleComanda  : function( ) {return []},
    created         : function( ) { },
    model           : 'Comanda',
    imprimir        : function( ) {return true},
    id              : ko.observable(),
    observacion     : function( ) { return '' },
    
    initialize: function(jsonData) {
        this.id = ko.observable();
        this.imprimir = ko.observable( true );
        this.observacion = ko.observable( '' );
        this.created = ko.observable();
        this.DetalleComanda = ko.observableArray( [] );
        
        if ( jsonData ) {
            // si aun no fue mappeado
            var mapOps = {
                'DetalleComanda': {
                    create: function(ops) {
                        return new Risto.Adition.detalleComanda(ops.data);
                    }
                }
            }
        } else {
            jsonData = {};
            mapOps = {};
        }
        ko.mapping.fromJS(jsonData, mapOps, this);
        Risto.modelizar(this);
        return this;
    },
    
    productsStringListing: function(){
        var name = '';        
        for (var dc in this.DetalleComanda() ){
            if ( this.DetalleComanda()[dc].realCant() ) {
                if ( name ){
                    name += ', ';
                }        
                name += this.DetalleComanda()[dc].realCant()+' '+this.DetalleComanda()[dc].Producto().name;
            }
        }
        return name;
    },
    
    imprimirComanda: function() {
        if (window.confirm("¿Seguro desea reimprimir comanda?")) {
            $.get(urlDomain + '/comanda/comandas/imprimir/' +this.id());
        }
    },
    
    
    handleAjaxSuccess: function(data){
        this.id( data.Comanda.Comanda.id );
        this.created( data.Comanda.Comanda.created );
        return this;
    },
    
     timeCreated: function(){
         if (!this.timeCreated) {
            Risto.modelizar(this);
    }
        return this.timeCreated();
     },
     
     
     borrarObservacionGeneral: function(){
        this.observacion('');
    },
    
    
    agregarTextoAObservacionGeneral: function( textToAdd ){ 
        var txt = this.observacion();
        if ( txt ) {
            txt += ', ';
        }
        txt += textToAdd;
        this.observacion( txt );
        return txt;
    }
    
}