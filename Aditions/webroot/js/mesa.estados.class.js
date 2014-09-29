/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar,
 *  
 *  utiliza el objeto adicion.event_handler: EventHandler 
 *
 **/

var MESA_ESTADOS_POSIBLES =  {
    abierta : {
        msg: 'Abierta',
        event: Risto.Adition.EventHandler.mesaAbierta ,
        id: 1,
        icon: 'mesa-abierta',
        url: URL_DOMAIN + TENANT + '/mesa/mesas/add'
    },
    reabierta : {
        msg: 'Re-Abierta',
        event: Risto.Adition.EventHandler.mesaAbierta ,
        id: 1,
        icon: 'mesa-abierta',
        url: URL_DOMAIN + TENANT  + '/mesa/mesas/reabrir'
    },
    cerrada: {
        msg: 'Cerrada',
        event: Risto.Adition.EventHandler.mesaCerrada,
        id: 2,
        icon: 'mesa-cerrada',
        url: URL_DOMAIN + TENANT + '/mesa/mesas/cerrarMesa'
    },
    cuponPendiente: {
        msg: 'con Cupón Pendiente',
        event: Risto.Adition.EventHandler.mesaCuponPendiente,
        id: 0,
        icon: 'mesa-cobrada'
    },
    cobrada: {
        msg: 'Cobrada',
        event: Risto.Adition.EventHandler.mesaCobrada,
        id: 3,
        icon: 'mesa-cobrada'
    },
    ocultada: {
        msg: 'Ocultada',
        event: Risto.Adition.EventHandler.mesaOcultada,
        id: 3,
        icon: 'mesa-oculta'
    },
    ocultada: {
        msg: 'Inactiva',
        event: Risto.Adition.EventHandler.mesaOcultada,
        id: 4,
        icon: 'mesa-inactiva'
    },
    borrada: {
        msg: 'Borrada',
        event: Risto.Adition.EventHandler.mesaBorrada,
        id: 0,
        icon: '',
        url: URL_DOMAIN + TENANT + '/mesa/mesas/delete'
    },
    seleccionada: {
        msg: 'Seleccionada',
        event: Risto.Adition.EventHandler.mesaSeleccionada,
        id: 0,
        icon: ''
    }
};
