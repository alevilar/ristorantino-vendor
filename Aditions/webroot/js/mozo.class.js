/*--------------------------------------------------------------------------------------------------- Risto.Adicion.mozo
 *
 *
 * Clase Mozo, depende de Productos
 */


/**
 *  Trigger de los siguientes eventos:
 *      - mozoAgregaMesa
 *      - mozoSacaMesa
 *      - mozoSeleccionado
 * @var Static MOZOS_POSIBLES_ESTADOS
 *
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar en su variable privada this.__estado
 *
 **/
var MOZOS_POSIBLES_ESTADOS =  {
    agragaMesa : {
        msg: 'El mozo tiene una nueva mesa',
        event: 'mozoAgregaMesa'
    },
    sacaMesa: {
        msg: 'El mozo tiene una mesa menos',
        event: 'mozoSacaMesa'
    },
    seleccionado: {
        msg: 'El mozo fue seleccionado',
        event: 'mozoSeleccionado'
    }
};



var Mozo = function(jsonData){    
    return this.initialize(jsonData);
}


Mozo.prototype = {
    id      : function( ) {return 0},
    numero  : function( ) {return 0},
    mesas   : function( ) {return []},

    _init:[], // you can add init functions into this array and will be called on initualize


    initialize: function( jsonData ) {
        var mozoNuevo = this,
            jsonData = jsonData || {},
            mapOps  = {};

        if ( jsonData == {} ) return this;
        
        this.id     = ko.observable( 0 );
        this.numero = ko.observable( 0 );
        this.mesas  = ko.observableArray( [] );

        
        if (jsonData) {
            // si aun no fue mappeado
            mapOps = {
                'mesas': {
                    create: function(ops) {
                        return new Mesa(mozoNuevo, ops.data);
                    }
                }
            }
        
        } 
        
        ko.mapping.fromJS(jsonData, mapOps, this);


        var len = 0;
        while ( len < this._init.length ) {
            this._init[len].apply(this, arguments);
            len++;
        }

        return this;
    },

    /**
     * devuelve un Button con el elemento mozo
     * @return jQuery Element button
     */
    getButton: function(){
        var btn = document.createElement('button');
        btn.mozo_id = this.id;
        btn.innerHTML = this.numero;
        btn.mozo = this;
        return btn;
    },


    cloneFromJson: function(json){
        //copio solo lo decclarado en el prototype del objecto Mozo
        for (var i in this){
            if ((typeof this[i] != 'function') && (typeof this[i] != 'object')){
                this[i] = json[i];
            }
        }
        return this;
    },


    /**
    *
    *   Agrega una mesa existente al listado de mesas del mozo
    **/
    agregarMesa: function(nuevaMesa){
        this.mesas.push(nuevaMesa);
        var evento = $.Event(MOZOS_POSIBLES_ESTADOS.agragaMesa.event);
        evento.mozo = this;
        evento.mesa = nuevaMesa;
        $(document).trigger(evento);
    },


    sacarMesa: function ( mesa ) {
        if ( this.mesas.remove(mesa) ) {
            delete mesa;            
            return true
        }
        return false;
    },



    /**
     *  Pasado un JSON con los datos y atributos de una mesa, lo convierte
     *  en un objeto Mesa
     *  @param Mesa mesaJSON
     *  @return Mesa
     */
    crearNuevaMesa: function(){        
        var mesaJSON = {};
        mesaJSON.mozo_id = this.id();
        var mesa = new Mesa(this, mesaJSON);
        mesa.seleccionar();

        this.mesas.push(mesa);

        mesa.create().fail(function(){
            alert("No se ha podido crear la nueva mesa");
        });

        return mesa;
    },



    /**
     * Cuando un mozo es clickeado o elegido, es seleccionado.
     * Se dispara un evento mozoSeleccionado cuando esto ocurre
     */
    seleccionar: function(){
        this.seleccionado = true;
        var eventoMozoSeleccionado = $.Event(MOZOS_POSIBLES_ESTADOS.seleccionado.event);
        eventoMozoSeleccionado.mozo = this;
        $(document).trigger(eventoMozoSeleccionado);
    },

    
    /**
     * Busca una mesa por su id en el listado de mesas que tiene le mozo
     * @param integer idToSearch 
     * @return Mesa si encontro, null en caso de no encontrar nada
     */
    findMesaById: function( idToSearch ){
        for( var m in this.mesas() ) {
            if ( this.mesas()[m].id() === idToSearch ) {
                return this.mesas()[m];
            }
        }
        return null;
    },


    full_image_url: function () {
        return URL_DOMAIN + TENANT + "/risto/medias/media/view/" + this.media_id();
    }
};