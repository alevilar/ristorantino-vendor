/*--------------------------------------------------------------------------------------------------- Risto.Adicion.mesa
 *
 *
 * Clase Mesa
 * 
 * para inicializarla es necesario pasarle el objeto Mozo
 * tambien se le puede pasar un jsonData para ser mappeado con knockout
 */
var Mesa = function(mozo, jsonData) {
        if (!mozo) return null;
        this.id             = ko.observable();
        this.created        = ko.observable();
        this.checkin        = ko.observable();
        this.checkout       = ko.observable();
        this.observation    = ko.observable('');


        this.momentRange    = ko.observable( );

        // Observables Dependientes
        this.momentRange = ko.dependentObservable( function(){
            return moment().range( Date.clearHour(this.checkin()), Date.clearHour(this.checkout()).subtract(1, 'day') );
        },this);

        this.diasEstadia = ko.dependentObservable( function(){
            var mm = moment(this.checkin());
            var m2 = moment(this.checkout());
            mm.set('hour',0).set('minute',0).set('second',0).set('millisecond',0);
            m2.set('hour',0).set('minute',0).set('second',0).set('millisecond',0);
            return Math.abs( mm.diff(m2, "days") );
        },this);


        

        this.total          = ko.observable( 0 );
        this.numero         = ko.observable( 0 );
        this.menu           = ko.observable( 0 );
        this.currentComanda = ko.observable( new Risto.Adition.comandaFabrica() );
        this.Comanda        = ko.observableArray( [] );
        this.mozo_id        = mozo.id;
        this.Cliente        = ko.observable( null );
        this.estado         = ko.observable( MESA_ESTADOS_POSIBLES.abierta );
        this.estado_id      = ko.observable();
        this.time_cobro     = ko.observable();
        this.Pago           = ko.observableArray( [] );
        this.cant_comensales= ko.observable(0);
        this.mozo           = ko.observable( mozo );
        



        this.clienteDescuentoText = ko.computed( function(){
            var texto = '';
            if ( this.Cliente() &&  this.Cliente().tieneDescuento && this.Cliente().tieneDescuento() != undefined ) {
                texto = this.Cliente().getDescuentoText();
            }
            return texto;
        }, this);
        



        /**
         *  dependentObservable
         *  
         *  devuelve el nombre del icono (jqm data-icon) que tiene el estado 
         *  en el que la mesa se encuentra actualmente
         *  el nombre del icono sirve para manejar cuestiones esteticas y es definido
         *  en "mesa.estados.class.js"
         *  
         *  @return string
         *
         */
         this.getEstadoIcon= ko.computed( function(){
                if (this.estado()){
                    return this.estado().icon;
                }
                return MESA_ESTADOS_POSIBLES.abierta.icon;
                
            }, this);
            

        /**
         * devuelve el estado actual de la mesa
         * @return MesaEstado
         */
        this.getEstado = ko.computed( function(){
            return this.estado();
        }, this);
        
        


        
         /**
         * dependentObservable
         * 
         * Chequea si la mesa esta con el estado: cerrada. (por lo general, lo que interesa
         * es saber que si no esta cerrada es porque esta abierta :-)
         * @return boolean
         **/
        this.estaCerrada = ko.computed( function(){
            return Boolean(MESA_ESTADOS_POSIBLES.cerrada == this.estado());
        }, this);
        

        /**
         * Me dice si la mesa esta en estado cobrada
         * @return boolean true si ya cerro, false si esta abierta
         */
        this.estaCobrada = ko.computed( function(){
            return Boolean(MESA_ESTADOS_POSIBLES.cobrada == this.getEstado());
        }, this);




        /** jQuery Mobile Class **/
        this.getPageThemeClass = ko.computed( function () {
            var classname = 'ui-page-theme-a';
            if ( this.estaCerrada() ){
                classname = 'ui-page-theme-d';
            } else if ( this.estaCobrada() ) {
                classname = 'ui-page-theme-e';
            }
            return classname;
        }, this);




        /** jquery mobile button class name **/
        this.getEstadoClassName = ko.computed( function () {
            var classname = 'ui-btn-b';
            if ( this.estaCerrada() ){
                classname = 'ui-btn-d';
            } else if ( this.estaCobrada() ) {
                classname = 'ui-btn-e';
            }
            return classname;
        }, this);







        /**
         * es timeCreated o sea la fecha de creacion del mysql timestamp
         * @return string timestamp
         **/
        this.timeAbrio= ko.computed( function(){
            if (!this.timeCreated) {
                Risto.modelizar(this);
            }
            return this.timeCreated();
        }, this);




         /**
         * Devuelve un texto con la hora
         * si la mesa esta cerrada, dice "Cerró: 14:35"
         * si esta aberta dice: "Abrió 13:22"
         */
        this.textoHora = ko.computed( function() {
            var date, txt;
            if ( this.getEstado() == MESA_ESTADOS_POSIBLES.cerrada ) {
                txt = 'Cerró a las ';
                if (typeof this.time_cerro == 'function') {
                    date =  mysqlTimeStampToDate(this.time_cerro());
                }
            } else {
                txt = 'Abrió a las ';
                if (typeof this.created == 'function') {
                    date = mysqlTimeStampToDate(this.created());            
                }
            }
            if ( !date ) {
                date = new Date();
            }
            return txt + date.getHours() + ':' + date.getMinutes() + 'hs';
        }, this);



        /**
         *Devuelve el total neto, sin aplicar descuentos
         *@return float
         */
        this.totalCalculadoNeto= ko.computed( function(){
            var valorPorCubierto =  Risto.VALOR_POR_CUBIERTO || 0,
                total = this.cant_comensales() * valorPorCubierto,
                c = 0;

            for (c in this.Comanda()){
                for (dc in this.Comanda()[c].DetalleComanda() ){
                    total += parseFloat( this.Comanda()[c].DetalleComanda()[dc].precio() * this.Comanda()[c].DetalleComanda()[dc].realCant() );
                }
            }

            return Math.round( total*100)/100;
        }, this);




            
        /**
         *
         *  Depende del cliente.
         *  es un atajo al porcentaje de descuento que tiene el cliente
         */
        this.porcentajeDescuento = ko.computed( function(){
            var porcentaje = 0;
            if (this.Cliente() && !this.Cliente().hasOwnProperty('length') &&  this.Cliente().Descuento()){
                if ( typeof this.Cliente().Descuento().porcentaje == 'function') {
                    porcentaje = this.Cliente().Descuento().porcentaje();
                }
            }
            return parseFloat( porcentaje );
        }, this);
            
        



        /**
         *Devuelve el total aplicandole los descuentos
         *@return float
         */
        this.totalCalculado = ko.computed( function(){
            var total = parseFloat( this.total() );
            if ( total ) {
                return total;
            }
            
            total = this.totalCalculadoNeto();
            
            var dto = 0;
               
            dto = Math.floor(total * this.porcentajeDescuento() / 100);
            total = total - dto;
            
            return total;
        }, this);
        


        
        /**
         *Devuelve el total mostrando un texto
         *@return String
         */
        this.textoTotalCalculado = ko.computed( function(){
            var total = this.totalCalculadoNeto(), 
                dto = 0, 
                totalText = '$'+total ;
            
            
        
            if ( this.porcentajeDescuento() ) {
                dto = Math.round( Math.floor( total * this.porcentajeDescuento()  / 100 ) *100 ) /100;
                totalText = totalText+' - [Dto '+this.porcentajeDescuento()+'%] $'+dto+' = $'+ this.totalCalculado();
            }
            
            return totalText;
        }, this);
        



        /**
         * El vuelto a devolver pero ingresando un texto
         * Ej: Vuelto: $35
         * @return String
         */
        this.vueltoText= ko.computed( function () {
           var pagos = this.Pago(),
               sumPagos = 0,
               totMesa = this.totalCalculado(),
               vuelto = 0,
               retText = 'Total: '+ this.textoTotalCalculado();
           if (pagos && pagos.length) {
               for (var p in pagos) {
                   if ( pagos[p].valor() ) {
                    sumPagos += parseFloat(pagos[p].valor());
                   }
               }
               vuelto = (totMesa - sumPagos);
               if (vuelto <= 0 ){
                   retText = retText+'   -  Vuelto: $  '+Math.abs(vuelto);
               } else {
                   retText = retText+'   -  ¡¡¡¡ Faltan: $  '+vuelto+' !!!';
               }
           }
           return retText;
        }, this);





        /**
         * A diferencia de los otros totales, este no esta bindeado con knocout por lo tanto da el total real en el momento 
         * que se llama a esta funcion
         */
        this.totalStatic = ko.computed( function(){
            var total = 0,
                c, // index de Comandas
                dc; // index del for DetalleComandas
                
            for (c in this.Comanda()){
                for (dc in this.Comanda()[c].DetalleComanda() ){
                    total += parseFloat( this.Comanda()[c].DetalleComanda()[dc].precio() * this.Comanda()[c].DetalleComanda()[dc].realCant() );
                }
            }

            return Math.round( total*100)/100;
        }, this);
        
        
       
       
        
        
        this.clienteTipoFacturaText = ko.computed( function(){
            var texto = Risto.DEFAULT_TIPOFACTURA_NAME;
            if ( this.Cliente() && typeof this.Cliente().getTipoFactura == 'function' ) {
                texto = this.Cliente().getTipoFactura();
            }
            return texto;
        }, this);
        
       
        
        /**
         * dependentObservable
         * 
         * Devuelve el nombre del Cliente si es que hay alguno setteado
         * en caso de no haber cliente, devuelve el string vacio ''
         *
         *@return string
         */
        this.clienteNameData = ko.computed( function() {
            var cliente = this.Cliente();
            if (cliente){
                if (typeof cliente == 'function') {
                    return cliente.nombre();
                } else {
                    return cliente.nombre;
                }
            }
            return '';
        }, this);
        
        
        
       


        this.totalPagos = ko.computed( function () {
            var pagos = this.Pago(),
               sumPagos = 0;

           if (pagos && pagos.length) {
               for (var p in pagos) {
                   if ( pagos[p].valor() ) {
                    sumPagos += parseFloat(pagos[p].valor());
                   }
               }          
           }
           return sumPagos;
        }, this);



        /**
         *  Toma los valores ingresados en los pagos y calcula el vuelto a devolver
         *  @return Float
         */
        this.vuelto = ko.computed( function () {
           var pagos = this.totalPagos(),
               totMesa = this.totalCalculado();
           
            return pagos - totMesa;
        }, this);





        
        /**
         * devuelve el string que identifica como nombre al estado
         * es el atributo del objeto estado llamado msg
         * el objeto de estado de la mesa es el de mesa.estados.class.js
         */
        this.getEstadoName = ko.computed( function(){
            if (this.estado()){
                return this.estado().msg;
            }
            return '';
        }, this);
        

        this.jqmDataTheme = ko.computed( function () {
            if (this.estado()){
                return this.estado().jqmlTheme;
            }
            return '';
        }, this);
        
        

        /**
         * Me dice si la mesa pidio el cierre y esta pendiente de cobro
         * @return boolean true si ya cerro, false si esta abierta
         */
        this.estaAbierta = ko.computed( function(){

            return Boolean(MESA_ESTADOS_POSIBLES.abierta == this.getEstado());
        }, this);



        

        
        // agrego atributos generales
        Risto.modelizar(this);
        
        return this.initialize(mozo, jsonData);
}



Mesa.prototype = {
    model       : 'Mesa',
    
    

    /**
     *@constructor
     */
    initialize: function( mozo, jsonData ) {
        
        if ( typeof jsonData == 'undefined' ) return this;

        // mapea el objeto this usando ko.mapping
        this.__koMapp( jsonData, mozo);
        
        return this;
    },
    
    /**
     *  Actualiza el estado de la mesa con el json pasado
     */
    update: function( mozo, jsonData ) {
        
        // mapea el objeto this usando ko.mapping
        return this.__koMapp( jsonData, mozo );
//        this.setEstadoById();  
    },


    create: function () {
         return $cakeSaver.send({url: this.urlAdd(), obj: this});
    },
    
    
    __koMapp: function( jsonData, mozo ) {
        var jsonData = jsonData || {},
            mapOps          = {};
            mozo = mozo || null;
        // si vino jsonData mapeo con koMapp
        if ( jsonData != {} ) {
            if (jsonData.Cliente && jsonData.Cliente.id){
                this.Cliente( new Risto.Adition.cliente( jsonData.Cliente ) );
            } else {               
                this.Cliente( null );
            }
            delete jsonData.Cliente;
            
            // si aun no fue mappeado
            mapOps = {
              	'Pago': {
                    create: function(ops) {
                        return new Risto.Adition.pago(ops.data);
                    },
                    key: function(data) {
                        return ko.utils.unwrapObservable( data.id );
                    }
                },
                'Comanda': {
                    create: function(ops) {
                        return new Risto.Adition.comanda(ops.data);
                    },
                    key: function(data) {
                        return ko.utils.unwrapObservable( data.id );
                    }
                }
            }
        }
        
        if ( mozo ) {
            // meto al mozo sin agregarle la mesa al listado porque seguramente vino en el json
            this.setMozo(mozo, false);
        }
        
        ko.mapping.fromJS(jsonData, mapOps, this);
        
        // meto el estado como Objeto Observable Estado
        this.__inicializar_estado( jsonData );

        
        
        return this;
    },
    
    /**
     * Inicializa el estado de la mesa en base al json pasada como parametro
     * o sea, convierte el id del estado que viene de la bbdd, a un objeto
     * "estado" que son los que estan en mesa.estados.class.js
     * @return MesaEstado
     */
    __inicializar_estado: function( jsonData ){
        var estado = MESA_ESTADOS_POSIBLES.abierta,
            ee = 0; // countador de estados posibles
         if (jsonData.estado_id) {
            for(ee in MESA_ESTADOS_POSIBLES){
                if ( MESA_ESTADOS_POSIBLES[ee].id && MESA_ESTADOS_POSIBLES[ee].id == jsonData.estado_id ){
                    estado = MESA_ESTADOS_POSIBLES[ee];
                    break;
                }
            }
         }
        this.setEstado( estado );
        return estado;
    },
    
    
    /**
     * agregar un producto a la comanda que actualmente se esta haciendo
     * no implica que se haya agregado un producto a la mesa.
     * es un estado intermedio de generacion de la comanda
     * @param prod Producto  
     **/
    agregarProducto: function(prod){
        this.currentComanda().agregarProducto(prod);
    },
    
    /**
     * Inicializa currentComanda para poder hacer una nueva comanda con
     * el objeto comandaFabrica
     * @constructor
     */
    nuevaComanda: function(){
        this.currentComanda( new Risto.Adition.comandaFabrica( this ) );
    },
    
    
    getData: function(){
        $.get(this.urlGetData());
    },
   

    /* listado de URLS de accion con la mesa */
    urlGetData: function() { return URL_DOMAIN + TENANT + '/mesa/mesas/ticket_view/'+this.id() },
    urlAdd: function() { return URL_DOMAIN + TENANT + '/mesa/mesas/add.json' },
    urlView: function() { return URL_DOMAIN + TENANT + '/mesa/mesas/view/'+this.id() },
    urlEdit: function() { return URL_DOMAIN + TENANT + '/mesas/ajax_edit/'+this.id() },
    urlFullEdit: function() { return URL_DOMAIN + TENANT + '/mesas/edit/'+this.id() },
    urlDelete: function() { return URL_DOMAIN + TENANT +'/mesa/mesas/delete/'+this.id() },
    urlComandaAdd: function() { return URL_DOMAIN + TENANT +'/mesa/comandas/add/'+this.id() },
    urlReimprimirTicket: function() { return URL_DOMAIN + TENANT +'/mesa/mesas/imprimirTicket/'+this.id() },
    urlCerrarMesa: function() { return URL_DOMAIN + TENANT +'/mesa/mesas/cerrarMesa/'+this.id() },
    urlReabrir: function() { return URL_DOMAIN + TENANT +'/mesa/mesas/reabrir/'+this.id() },
    urlAddCliente: function( clienteId ){
        var url = URL_DOMAIN + TENANT + '/mesa/mesas/addClienteToMesa/'+this.id();
        if (clienteId){
            url += '/'+clienteId;
        }
        url += '.json';
        return url;
    },        
    

    /**
     * Disparador de triggers para el evento
     *
     **/
    __triggerEventCambioDeEstado: function(){
        
        var event =  {};
        event.mesa = this;
        this.estado().event( event );
    },

    /**
     * dispara un evento de mesa seleccionada
     */
    seleccionar: function() {
        var event =  {};
        event.mesa = this;
        MESA_ESTADOS_POSIBLES.seleccionada.event( event );
    },
    
    
    /**
     * cambia el estado de la mesa y lo envia vía ajax. Para ser modificado 
     * en bbdd.
     * En caso de error en el ajax la mesa vuelve a su estado anterior.
     * 
     * dispara el evento de cambio de estado. en caso de error lo dispararia 2 veces
     */
    cambioDeEstadoAjax: function(estado){
        var estadoAnt = this.getEstado(),
            mesa = this,
            $ajax; // jQuery Ajax object
            
        this.setEstado( estado );
        $ajax = $.get( estado.url+'/'+this.id() );
        $ajax.error = function(){
            mesa.setEstado( estadoAnt );
        }
    },

    /**
     * dispara un evento de mesa Abierta
     */
    setEstadoAbierta : function(){
        this.setEstado( MESA_ESTADOS_POSIBLES.abierta );
        return this;
    },
    
    /**
     * dispara un evento de mesa cobrada
     */
    setEstadoCobrada : function(){
        this.time_cobro( jsToMySqlTimestamp() );
        this.setEstado(MESA_ESTADOS_POSIBLES.cobrada);
        return this;
    },


    /**
     * dispara un evento de mesa cerrada
     */
    setEstadoCerrada : function(){
        this.time_cerro = jsToMySqlTimestamp();
        this.setEstado(MESA_ESTADOS_POSIBLES.cerrada);
        return this;
    },

    /**
     * dispara un evento de mesa borrada
     */
    setEstadoBorrada: function() {
        this.setEstado(MESA_ESTADOS_POSIBLES.borrada);
        return this;
    },

    /**
     * dispara un evento de mesa con cupon pendiente
     */
    setEstadoCuponPendiente : function(){        
        this.setEstado(MESA_ESTADOS_POSIBLES.cuponPendiente);
        return this;
    },
    
    /**
     * Cambia el estado de la mesa y genera un disparador del evento
     */
    setEstado: function(nuevoestado){
        this.estado( nuevoestado );
        this.__triggerEventCambioDeEstado();
    },
    
    /**
     * Cambia el estado de la mesa y genera un disparador del evento
     */
    setEstadoById: function(nuevoestado_id){
        var estado_id = nuevoestado_id || this.estado_id();
        
        for (var est in MESA_ESTADOS_POSIBLES) {
            if ( MESA_ESTADOS_POSIBLES[est].id == estado_id ) {
                this.setEstado(MESA_ESTADOS_POSIBLES[est]);
                return this.getEstado();
            }
        }
        return false;
    },



    /**
     * @deprecated deberia usar estaCerrada
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    pidioCierre : function(){
        return this.estaCerrada();
    },

    
    /**
     * modifica el ID del la mesa
     */
    setId : function(id){
        this.id = id;
    },


    /**
     *devuelve la cantidad de comensales o cubiertos seteado en la mesa
     *@return integer
     */        
    getCantComensales : function(){
        return this.cant_comensales();
    },

    /**
     * Envia un ajax con la peticion de imprimir el ticket para esta mesa
     */
    reimprimir : function(){
        var url = window.URL_DOMAIN + TENANT + '/mesa/mesas/imprimirTicket';
        $.get( url+"/"+this.id);
    },



    /**
     * re-abre una mesa
     *
     */
    reabrir : function(url){
        var data = {
                'data[Mesa][estado_id]': MESA_ESTADOS_POSIBLES.abierta.id,
                'data[Mesa][id]': this.id
        };

        $.post(url, data);
        this.setEstadoAbierta();
    },

    /**
     * Envia un ajax con la peticion de cerrar esta mesa
     */
    cerrar: function(){
        var url = window.URL_DOMAIN + TENANT + '/mesa/mesas/cerrarMesa' + '/' + this.currentMesa.id + '/0',
            self = this;
            
        $.get(url, {}, function(){
            self.setEstadoCerrada();
        });
        return this;
    },

    /**
     * Envia un ajax con la peticion de borrar esta mesa
     */
    borrar : function(){
        var url = window.URL_DOMAIN + TENANT + '/mesa/mesas/delete/' +this.id,
            self = this;
        $.get(url, {}, function(){
            self.setEstadoBorrada()
        });
        return this;
    },

    
    
    /**
     * Si tiene un mozo setteado retorna true, caso contrario false
     * Verifica con el id del mozo (si es CERO es que no tiene mozo)
     * @return Boolean
     */
    tieneMozo: function(){
        var tiene = false;
        if ( this.mozo() !== {} || this.mozo() !== null ) {
            tiene = this.mozo().id() ? true: false;
        }
        return tiene;
    },


    /**
     * Setea el mozo a la mesa.
     * si agregarMesa es true, se agrega la mesa al listado de mesas del mozo
     * @param nuevoMozo Mozo es el mozo que voy a setear
     * @param agregarMesa Boolean indica si agrego la mesa al listado de mesas que tiene el mozo, por default es true
     */
    setMozo: function(nuevoMozo, agregarMesa){
        var laAgrego = agregarMesa || true; // por default sera true
        
        // si la mesa que le quiero agregar, tenia otro mozo
        // lo debo sacar, eliminandole la mesa de su listado de mesas
        if ( this.tieneMozo() ){
            var mozoViejo = this.mozo();
            // si era el mismo mozo no hacer nada
            if (mozoViejo.id() == nuevoMozo.id()) {
                return 0;
            }
            mozoViejo.sacarMesa(this);
        }
        
        this.mozo_id( nuevoMozo.id() );
        this.mozo(nuevoMozo);
        if (laAgrego) {
            this.mozo().agregarMesa(this);
        }
        return this;
    },


    /**
     * Realiza una edicion rapida via Ajax del Model Mesa de Cakephp
     * o sea, desde aca se puede tcoar facilmente cualquier campo de la bbdd
     * siempre y cuando el parametro data respete la forma de los inputs de cake.
     * 
     * @param data Array los keys del array deben ser de la forma cake:
     *                      Ej: data['data[Mesa][cant_comensales]'] o data['data[Mesa][cliente_id]']
     *                      
     */
    editar: function(data) {
        if (!data['data[Mesa][id]']) {
            data['data[Mesa][id]'] = this.id();
        }
        $.post( window.URL_DOMAIN + TENANT + '/mesa/mesas/ajax_edit', data);
        return this;
    },
    
    
    /**
     * Es el callback que recibe la actualizacion de las mesas via json desde 
     * cakeSaver
     */
    handleAjaxSuccess: function(data, action, method) {
        if (data[this.model]) {
            ko.mapping.fromJS( data[this.model], {}, this );
        }
    },
    
    
    /**
     * Dado un objeto cliente se setea el mismo a la mesa
     * @param objCliente Object que debe tener como atributos al menos un id
     */
    setCliente: function( objCliente ){
        var ctx = this, 
            clienteId = null;
        
        if ( objCliente ) {
            clienteId = objCliente.id;
        }
        $.get( this.urlAddCliente( clienteId ), function(data) {
            if ( data.Cliente ){
                ctx.Cliente( new Risto.Adition.cliente(data.Cliente) );
            } else{
                ctx.Cliente(null);
            }
        });
        
        return this;
    },
    
    
    



    savePagos: function () {
    	var m = this;
    	var mes = {
            Mesa: {
                id: m.id(),
                estado_id: m.estado_id(),
                time_cobro: m.time_cobro(),
                model: 'Mesa'
            },
            Pago: m.Pago()
        };
        
        // guardo los pagos
        $cakeSaver.send({
            url: URL_DOMAIN + TENANT + '/mesa/pagos/add',
            obj: mes
        }, function(d){
            
        });

        if ( this.totalPagos() && this.vuelto() >= 0) {
        	// es porque la mesa esta cobrada
        	this.setEstadoCobrada();
        }
    }

};
