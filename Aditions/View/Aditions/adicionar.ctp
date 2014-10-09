<?php echo $this->element('jq_templates'); ?>
<?php echo $this->element('jq_calendar'); ?>

      
<?php if (Configure::read('Site.type') != SITE_TYPE_HOTEL ) {  ?>

<!--
                        LISTADO MESAS

-->
<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas">

	<div  data-role="header">
 



            <?php $usar_generica =  Configure::read('Mesa.usar_generica');
                if ( !empty($usar_generica) ) {
                    ?>
                    <a href='#mesa-view'  id="mesa-abrir-mesa-generica-btn" class="" data-icon="star"  data-mozo-id="<?php echo Configure::read('Mesa.generica_mozo_id')?>"
                        data-numero="99"
                        data-theme="f"
                        title="<?php echo Configure::read('Mesa.generica_name')?>"
                        data-role="button" >Abrir</a>
                    <!--
                    <a href="#mesa-view" id="mesa-abrir-mesa-generica-btn" class="abrir-mesa" 
                        data-mozo-id="<?php echo Configure::read('Mesa.generica_mozo_id')?>"
                        data-numero="99"
                        data-role="button" 
                        title="<?php echo Configure::read('Mesa.generica_name')?>"
                        data-theme="f"><?php echo $this->Html->image('/aditions/css/img/flash.png')?></a>
                    -->
                    <?php
                }
            ?>   


            <h1><span data-bind="text: adn().mesas().length">0</span> <?php echo Inflector::pluralize( Configure::read('Mesa.tituloMesa') )?></h1>

            <a href='#adicion-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>
            
          
    </div>
                    
    <div  data-role="main" class="ui-content content_mesas">


            <div id="listado-mozos-para-mesas">
                <div class="mozo-row" data-bind="foreach: adn().mozos">
                    <div class="mozo-cell">

                        <a href="#mesa-view" class="mozo ui-btn ui-btn-a" data-bind="text: numero, attr:{'data-mozo-id':id()}, click: crearNuevaMesa"></a>

                        <div class="listado-adicion" data-bind='template: { foreach: mesas }'>
                            
                            <a  data-bind="click: seleccionar, 
                                       attr: {accesskey: numero, id: 'mesa-id-'+id(), mozo: mozo().id()},
                                       css: {'ui-btn-b': estaAbierta, 'ui-btn-d': estaCerrada, 'ui-btn-e': estaCobrada }
                                       "
                                href="#mesa-view" 
                                class="ui-link ui-btn ui-shadow ui-corner-all">
                                <span class="mesa-span ui-btn-inner">
                                    <span class="ui-btn-text">
                                        <span class="mesa-numero" data-bind="text: numero"></span>
                                    </span>
                                </span>
                                <span class="mesa-descuento" data-bind="visible: clienteDescuentoText,text: clienteDescuentoText"></span>
                                <span  class="mesa-tipofactura" data-bind="visible: clienteTipoFacturaText">
                                    <span data-bind="text: clienteTipoFacturaText"></span>
                                </span>
                                <span class="mesa-time" data-bind="text: textoHora"></span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>


            
    </div><!-- /navbar -->

</div>
<!-- Fin Pagina 1 -->

<?php } else { ?>


<!--
                        LISTADO MESAS GRILLA CALENDAR

-->
<div data-role="page" id="listado-mesas" class="calendar">

    <div data-role="header">
        <div class="calendar-grid">
            <div class="controll control-header">
                <div class="col-header btn-controls">
                    <?php
                    if ( Configure::check('Site.logo_path') ) {
                                    $imgLogo = $this->Html->image(Configure::read('Site.logo_path'));
                                    echo $this->Html->link($imgLogo, array('plugin'=>'risto', 'controller' => 'pages', 'action' => 'display', 'dashboard'), array(
                                            'data-ajax' => 'false',
                                            'data-role' => 'none',
                                            'class' => 'navbar-brand navbar-brand-logo', 'escape'=>false)); 
                                }
                    ?>

                    <div class="control-actions">                            
                        <a href="#" class="ui-btn ui-btn-c controll back" onclick='Risto.Adition.adicionar.calendarGrid.prevWeek()'>&lt;&lt;</a>
                        <a href="#" class="ui-btn ui-btn-c controll back" onclick='Risto.Adition.adicionar.calendarGrid.prevDay()'>&lt;</a>
                        <a href="#" class="ui-btn ui-btn-c controll prev" onclick='Risto.Adition.adicionar.calendarGrid.backDay()'>&gt;</a>
                        <a href="#" class="ui-btn ui-btn-c controll prev" onclick='Risto.Adition.adicionar.calendarGrid.backWeek()'>&gt;&gt;</a>
                    </div>
                </div>

                <div class="content day-list">
                    <table class="calendar absolute calendar-header">
                       <thead>
                            <tr data-bind='template: { name: "calendar-header-month", foreach: Risto.Adition.adicionar.calendarGrid.months }'></tr>
                            <tr data-bind='template: { name: "calendar-header-day", foreach: Risto.Adition.adicionar.calendarGrid.days }'></tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
                    
    <div  data-role="main" class="ui-content">           

        <div class="calendar-grid" data-bind='foreach: Risto.Adition.adicionar.mozos, as: "mozo"'>
                
            <div  class="mozo mozo-row" data-bind="attr:{'data-mozo-id': id}">
                <div class="col-header">
                      <div>
                          <span data-bind="attr:{'data-mozo-id': id}, text: numero"></span>
                      </div>
                </div>

                <div class="content">
                      <table class="calendar absolute mozo-days">
                          <tbody>
                              <tr data-bind='foreach: Risto.Adition.adicionar.calendarGrid.days, as: "day"'>
                                  <td class="mozo-col day"  data-bind="attr: {'data-day': format('YYYY-MM-DD')}"></td>
                              </tr>
                          </tbody>
                     </table>

                     <table class="calendar mozo-mesas">
                          <tbody>
                              <tr data-bind='foreach: mesasFromDataRangeByRange'>
                                
                                   <td class="mozo-col" 
                                       data-bind="attr:{ colspan: diasEstadiaRecortado, 'data-day': dayName,  'data-checkin': checkin, 'data-checkout': checkout},
                                                    'css': grillaExtraClass">
                                      <div class="mark" data-bind="if: id">
                                         <a class="ui-link ui-btn ui-shadow"  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}, 'css': getEstadoClassName" 
                                            href="#mesa-view" >                    
                                            <span class="mesa-cliente" data-bind="text: clienteNameData"></span>
                                        </a>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div><!-- /navbar -->

</div>
<!-- Fin Pagina 1 -->
<?php } ?>


<!-- Opciones del cajero-->
<div data-role="page" id="cajero-opciones" class="dialog-arriba" data-theme="b">
    <div data-role="header">
        <h1>Opciones de Cajero</h1>
    </div>
    <div data-role="main" class="ui-content">
        
            <a href="#listado-mesas" data-role="button">Modo Adicionista</a>
            
            <a href="<?php echo $this->Html->url(array('plugin'=>'aditions', 'controller'=>'adicionar', '#listado-mesas-cerradas'))?>" rel="external" data-role="button" data-icon="refresh">Refrescar Cajero</a>
            
            <h3>Informes Fiscales</h3>
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="#listado-mesas-cerradas" 
                       data-role="button" 
                       data-href="<?php echo $this->Html->url(array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'cierre', 'x'));?>" 
                       data-direction="reverse">
                       Imprimir informe "X"
                   </a>
                </div>
                <div class="ui-block-b">
                    <a href="#listado-mesas-cerradas" 
                       data-role="button" 
                       data-href="<?php echo $this->Html->url(array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'cierre', 'z'));?>" 
                       data-direction="reverse">
                       Imprimir informe "Z"
                   </a>
               </div>
            </div>
            <a href="<?php echo $this->Html->url(array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'nota_credito'));?>" data-role="button">Nota de crédito</a>
            
            <hr />
           
            
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="back" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a data-icon="home" data-role="button" href="<?php echo $this->Html->url(array('plugin'=>'risto', 'controller'=>'pages', 'action'=>'display', 'dashboard'));?>" rel="external" data-theme="b">Ir a Página Principal</a></div>
            </div>
    </div>
</div>


<!-- 
            Opciones ADICIONISTA
-->
<div data-role="page" id="adicion-opciones" data-theme="b">
    <div data-role="header">
        <h1>Opciones</h1>
    </div>
    <div data-role="main" class="ui-content">
        
            <?php if ( Configure::read('Adicion.usarCajero') ) { ?>
            <a href="#listado-mesas-cerradas" data-role="button">Modo Cajero</a>
            <?php } ?>
            
            
            <a href="#" onclick="window.location.reload(true);" data-ajax="false" data-role="button" data-icon="refresh">
                Refrescar Adición</a>
            
            
             <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="back" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a data-icon="home" data-role="button" href="<?php echo $this->Html->url(array('plugin'=>'risto', 'controller'=>'pages', 'action'=>'display', 'dashboard'));?>" rel="external" data-theme="b">Ir a Página Principal</a></div>
            </div>
            
    </div>
</div>

<!--
                        LISTADO MESAS CERRADAS:::: MODO CAJERO

-->
<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas-cerradas">

	<div  data-role="header">
            <h1><span style="color: #fcf0b5" data-bind="text: adn().mesasCerradas().length">0</span> <?php echo Inflector::pluralize( Configure::read('Mesa.tituloMesa') )?> Cerradas
                y <span data-bind="text: Math.abs(adn().mesasCerradas().length - adn().mesas().length)"></span> abiertas
            </h1>

            <a href='#cajero-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>
        </div>

                    
        <div  data-role="main" class="ui-content content_mesas">
                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <ul id="ul-mesas-cajero" class="listado-adicion" data-bind='template: { name: "listaMesasCajero", foreach: adn().mesasCerradas }'>
                       
                </ul>
        </div><!-- /navbar -->
            
</div>
<!-- Fin Pagina Cajero -->







<!--
                        MESA-ADD

-->
<div  data-role="dialog"  id="mesa-add" data-bind="with: adn().currentMesa">
        <div  data-role="header"  data-position="inline">
            <h1>Nueva <?php echo Configure::read('Mesa.tituloMesa') ?> para <?php echo Configure::read('Mesa.tituloMozo') ?> <span data-bind="text: mozo().numero"></span></h1>
        </div>
    
        <div data-role="main" class="ui-content">
                    
                <div id="mesa-add-numero">
                    <fieldset data-role="fieldcontain">
                        <h3 class="numero-mesa">Número de <?php echo Configure::read('Mesa.tituloMesa') ?></h3>
                        <label for="mesa-add-numero">Ingresar el número</label>
                        <input type="number" min="1" name="numero" data-risto="mesa" data-bind="value: numero"/>
                    </fieldset>
                </div>

                <div id="mesa-add-cubiertos" style="display: none">
                    <fieldset data-role="fieldcontain">
                        <h3 class="cubiertos"><?php echo Inflector::pluralize(Configure::read('Mesa.tituloCubierto')) ?></h3>
                        <label for="mesa-add-cant_comensales"><?php echo __( 'Ingresar la cantidad de %s', Inflector::pluralize(Configure::read('Mesa.tituloCubierto'))) ?></label>
                        <input type="number" name="cant_comensales" id="mesa-add-cant_comensales" data-bind="value: cant_comensales"/>

                    </fieldset>
                </div>

                <button type="button" data-theme="c"  class="next">Siguiente</button>
        </div>
</div> 





<!--
                        OBSERVACIONES DE CADA PRODUCTO

-->
<div  data-role="dialog"  id="comanda-add-product-obss" data-theme="e">
    <div  data-role="header"  data-position="inline">
        <a href="#"  data-rel="back"  data-theme="b">Volver</a>
        <h1>Observacion</h1>
        <a href="#"  data-rel="back" id="comanda-add-product-obss-submit" data-theme="c">Guardar Observación</a>
    </div>
    <div data-role="main" class="ui-content">
        <form name="comanda" id="form-comanda-producto-observacion">
            <textarea name="obs" id="obstext" autofocus="autofocus"></textarea>
        </form>
        
        <div class="observaciones-list">
                <?php foreach($observaciones as $o) { ?>
                <a data-role="button" data-inline="true" href="#" class="options-val"><?php echo $o?></a>
                <?php } ?>
        </div>
    </div>
    
</div> 




<!--
                        MESA_VIEW

-->
<div data-role="page" id="mesa-view" data-theme="a" data-disabled="true" data-bind="with: adn().currentMesa">
	   <div  data-role="header">
            <a href="#listado-mesas" data-direction="reverse">Volver</a>
            <h1>
                <span class="mesa-id" style="float: left;">
                    #<span data-bind="text: id"></span>
                    <span data-bind="visible: !id()">
                        <?php echo $this->Html->image('loader.gif'); ?>
                    </span>
                </span>
                
                <span data-bind="text: numero"></span>
                <?php 
                echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') ." - " .
                Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png') 
                ?>
                <span data-bind="text: mozo().numero()"></span>
                 
                <span class="hora-abrio">Estado: <span data-bind="text: getEstadoName"></span></span>
            </h1>
        </div>

        <div  data-role="main" class="ui-content" data-scroll="true">
            <div class="mesa-actions">
                <ul data-role="listview"  data-bind="attr: {'estado': estado().icon}" data-theme="b">
                    
                    <li id="mesa-action-comanda" data-bind="attr: {'estado': 'comanda-add-menu_'+estado().icon}">
                        <a href="#comanda-add-menu"><?php echo $this->Html->image('/aditions/css/img/products_64.png')?>Agregar Producto</a>
                    </li>
                    
                    <li id="mesa-action-cliente" data-bind="attr: {'estado': 'mesa-cliente_'+estado().icon}">
                        <a href="<?php echo $this->Html->url(array('plugin'=>'fidelization', 'controller'=>'clientes', 'action'=>'jqm_clientes'))?>" data-rel="dialog">
                                <?php echo $this->Html->image('/aditions/css/img/customers.png')?>
                            <span data-bind="visible: !Cliente()"><?php echo __('Agregar %s', Configure::read('Mesa.tituloCliente')) ?></span>
                            <span data-bind="visible: Cliente()" style="white-space: normal"><span data-bind="text: clienteNameData()"></span></span>
                        </a>
                    </li>
                    
                    <li id="mesa-action-cerrar" data-bind="attr: {'estado': 'mesa-cerrar_'+estado().icon}">
                        <a href="#listado-mesas" id="mesa-cerrar" data-direction="reverse"><?php echo $this->Html->image('/aditions/css/img/cerrarmesa.png')?>Cerrar</a>
                    </li>
                    
                    
                    <li id="mesa-action-cobrar" data-bind="attr: {'estado': 'mesa-cobrar_'+estado().icon}">
                        <a href="#mesa-cobrar" data-rel="dialog"><?php echo $this->Html->image('/aditions/css/img/cobrar.png')?>Cobrar</a>
                    </li>
                    
                    <li id="mesa-action-reimprimir" data-bind="attr: {'estado': 'mesa-re-print_'+estado().icon}">
                        <a href="#listado-mesas" class="mesa-reimprimir"  data-rel="back"><?php echo $this->Html->image('/aditions/css/img/printer.png')?>Imprimir Ticket</a>
                    </li>

                    
                    <li id="mesa-action-cambiar-mozo">
                        <a href="#mesa-cambiar-mozo" data-rel="dialog"><?php echo $this->Html->image('/aditions/css/img/cambiarmozo.png')?>Cambiar <?php echo Configure::read('Mesa.tituloMozo')?></a>
                    </li>
                    
                    <?php if (Configure::read('Site.type') == SITE_TYPE_RESTAURANTE) { ?>
                    <li id="mesa-action-cambiar-numero">
                        <a href="#mesa-cambiar-numero" data-rel="dialog"><?php echo $this->Html->image('/aditions/css/img/cambiarmesa.png')?>Cambiar N°</a>
                    </li>
                    <?php } ?>
                    
                    <li id="mesa-action-reabrir" data-bind="attr: {'estado': 'mesa-reabrir_'+estado().icon}">
                        <a href="#listado-mesas" id="mesa-reabrir"><?php echo $this->Html->image('/aditions/css/img/reabrir.png')?>Re Abrir</a>
                    </li>
                    
                    <?php if (Configure::read('Site.type') == SITE_TYPE_RESTAURANTE) { ?>
                    <li style="" id="mesa-action-menu" data-bind="attr: {'estado': 'mesa-borrar_'+estado().icon}">
                        <a href="#" id="mesa-menu"><?php echo $this->Html->image('/aditions/css/img/write.png')?>Menú <span style="color: red" data-bind="visible: menu() != 0,text: menu"></span></a>
                    </li>
                    <?php } ?>
                    
                    <li>
                        &nbsp;
                    </li>
                    
                    <li style="width: 49%; float: left;" id="mesa-action-borrar" data-bind="attr: {'estado': 'mesa-borrar_'+estado().icon}">
                        <a href="#listado-mesas" id="mesa-borrar" data-rel="back"><?php echo $this->Html->image('/aditions/css/img/borrarmesa.png')?>Borrar</a>
                    </li>
                    
                    <li style="width: 49%; float: right;" id="mesa-action-edit" data-bind="attr: {'estado': 'mesa-borrar_'+estado().icon}">
                        <a href="#" data-external="true" target="_blank"
                            data-bind="attr:{href: urlFullEdit()}">
                         <?php echo $this->Html->image('/aditions/css/img/editarmesa.png')?>Editar</a>
                    </li>
                    
                </ul>
            </div>

            <div class="mesa-view">
                    <div class="observaciones">
                        <textarea id="mesa-textarea-observation"  data-bind="value: observation" placeholder="Agregar una Observación"></textarea>

                        <button id="mesa-observacion-submit" type="button" value="Guardar" style="display: none" data-enhance="false" data-role="none">Guardar</button>
                        <button id="mesa-observacion-cancel" type="button" value="Guardar" style="display: none" data-enhance="false" data-role="none">Cancelar</button>
                    </div>
                    
                <?php if (Configure::read('Site.type') !=  SITE_TYPE_RESTAURANTE) { ?>

                    <div class="date-checkin-checkout" data-bind="visible: checkin() || checkin() ">
                        <div class="date-checkin" data-bind="visible: checkin()">
                            <span class="title">Checkin:</span> <span class="data" data-bind="text: moment(checkin()).format('dddd, DD/MM/YY')"></span>
                        </div>
                        <div class="date-checkout" data-bind="visible: checkout()">
                            <span class="title">Checkout:</span> <span class="data" data-bind="text: moment(checkout()).format('dddd, DD/MM/YY')"></span>
                        </div>                    
                    </div>

                    <hr />
                <?php } ?>
                <h3 class="titulo-comanda">Productos Comandados</h3>

                <!-- template -->
                <div id="comanda-detalle-collapsible" data-role="collapsible-set" 
                     data-bind="template: {name: 'listaComandas', foreach: Comanda}"></div>
            </div>
            
        </div>
    
    <footer data-role="footer">
        <h3>
            <span id="mesa-cant-comensales"  style="float: left">            
                <a data-role="button" data-bind="visible: !parseInt(cant_comensales())">
                    <?php echo __( 'Ingresar %s', Inflector::pluralize(Configure::read('Mesa.tituloCubierto'))) ?>
                </a>
                <span data-bind="visible: parseInt( cant_comensales()) > 0"><span data-bind="text: cant_comensales()"></span> <?php echo Inflector::pluralize(Configure::read('Mesa.tituloCubierto'))  ?></span>
            </span>
            <span class="mesa-total"><span data-bind="text: textoTotalCalculado()"></span></span>
            <?php if (Configure::read('Site.type') != SITE_TYPE_HOTEL) { ?>
            <span class="hora-abrio">Abrió a las <span data-bind="text: timeCreated()"></span></span>
            <?php } ?>
        </h3>
    </footer>
</div>


<!--
                        COMANDA-ADD

-->
<div data-role="page" id="comanda-add-menu" data-theme="b" data-bind="if: adn().currentMesa">
    <div data-role="header">
            <a href="#listado-mesas" data-direction="reverse">Volver</a>
            
            <div data-role="controlgroup" data-type="horizontal" class="opciones-comanda">

                <a style="min-width: 160px" href="#" data-role="button" title="Haga click para desactivar la impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comanda.imprimir( 0 )}, visible: adn().currentMesa().currentComanda().comanda.imprimir()"><?php echo $this->Html->image('print48.png', array('class'=> 'btn-comanda-icon'))?>Si Imprime</a>

                <a style="min-width: 160px" href="#" data-role="button" title="Haga click para activar impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comanda.imprimir( 1 )}, visible: !adn().currentMesa().currentComanda().comanda.imprimir()" >
                <?php echo $this->Html->image('dontprint48.png', array('class'=> 'btn-comanda-icon'))?>No Imprime</a>

                <a style="min-width: 160px" href="#" id="comanda-obervacion-a"  data-icon="comment"  data-role="button" title="Agregar Observación">Observación</a>


                <a href="#mesa-view" data-role="button" id="comanda-add-guardar"  data-icon="check" data-theme="c">Enviar Comanda</a>

            </div>

            <h1>Cargando Productos para la <?php echo Configure::read('Mesa.tituloMesa') ?> <span data-bind="text: adn().currentMesa().numero()"></span>  <?php echo Configure::read('Mesa.tituloMozo') ?> <span data-bind="text: adn().currentMesa().mozo().numero()"></span></h1>
            
    </div>

    <div data-role="main" class="ui-content" style="min-height: 300px">
        
        <div style="display: none" id="comanda-add-observacion" class="ui-corner-bottom ui-overlay-shadow ui-content">
            <h4 style="color: #fff">Agregar observación general para la comanda</h4>
            <textarea id="obscomandatext" style="width: 97%" data-bind="value: adn().currentMesa().currentComanda().comanda.observacion, valueUpdate: 'keyup'" autofocus="autofocus" name="obs" class="obstext ui-input-text ui-body-null ui-corner-all ui-shadow-inset ui-body-a"></textarea>
            
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" onclick="" id="mesa-comanda-add-obs-gen-cancel" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a href="#" id="mesa-comanda-add-obs-gen-aceptar" data-role="button" data-theme="b">Aceptar</a></div>
            </div>
            
            <div class="observaciones-list">
                <?php foreach($observacionesComanda as $o) { ?>
                <button data-inline="true" value="<?php echo $o?>"><?php echo $o?></>
                <?php } ?>
            </div>
        </div>
        <!--        PRODUCTOS SELECCIONADOS    -->
        <div  style="width: 28%; margin-right: 2%; display: inline; float: left;">
            
           <ul id="ul-productos-seleccionados" class="ui-listview" data-role="listview"
               data-bind="template: {name: 'categorias-productos-seleccionados', foreach: adn().productosSeleccionados()}"
               style="margin-top: 8px;" ></ul>
        </div>    
           
        <div style="width: 70%; display: inline; float: right;">
            <div id="path" data-bind="template: {name: 'boton', foreach: menu().path()}"></div> 
            
            <!--           SELECCION DE CATEGORIAS                           -->
           <div id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', foreach: menu().currentSubCategorias()} ">
           </div>
           
            <!--           SELECCION DE PRODUCTOS                            -->
           <div id="ul-productos" style="clear: both" 
                data-bind="template: {name: 'categorias-productos', foreach: menu().currentProductos()} ">
           </div>
        </div>
    </div>
        
</div>  





<!--
                        SABORES-ADD

-->
<div data-role="page" id="page-sabores" data-theme="b" class="dialog-ancho dialog-arriba" data-bind="if: adn().currentMesa">
    <div data-role="header">
        <h1>Adicional</h1>
               
	<a href="#" data-icon="check" data-theme="b" data-rel="back" data-bind="click: function(){adn().currentMesa().currentComanda().saveSabores()}">Guardar</a>        
    </div>

    <div data-role="main" class="ui-content">                  
           <div id="ul-sabores" 
                data-bind="template: {name: 'listaSabores', foreach: adn().currentSabores()} ">
           </div>
    </div>
            
</div>  






<!--
                    MESA CAMBIAR MOZO

-->
<div data-role="page" id="mesa-cambiar-mozo" data-theme="e" class="dialog-ancho" data-bind="if: adn().currentMesa">
    <div data-role="header">
        <h1>Seleccionar nuevo <?php echo Configure::read('Mesa.tituloMozo')?> para la <?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero()"></span></h1>
    </div>

    <div data-role="main" class="ui-content">           
        
        <div>
            El <?php echo Configure::read('Mesa.tituloMozo')?> actual es el <span data-bind="text: adn().currentMesa().mozo().numero"></span>
        </div>
        
        
        <form name="cambiar-mozo" id="form-cambiar-mozo" action="#" data-ajax="false"  data-direction="reverse">
            <input type="hidden" name="mesa_id" data-bind="value: adn().currentMesa().id"/>
            
            <fieldset data-role="controlgroup" data-type="horizontal">
                        <legend>Seleccionar <?php echo Configure::read('Mesa.tituloMozo')?></legend>
                        <?php
                            foreach ($mozos as $m) {
                                $k = $m['Mozo']['id'];
                                $n = $m['Mozo']['numero'];
                                echo "<input type='radio' name='mozo_id' id='radio-mozo-cambiar-id-$k' value='$k'/>";
                                echo "<label for='radio-mozo-cambiar-id-$k'>$n</label>";
                            }
                        ?>
                    </fieldset>
            
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Cambiar de <?php echo Configure::read('Mesa.tituloMozo') ?></button></div>
	    </fieldset>
        </form>
    </div>
            
</div>  





<!--
                    MESA CAMBIAR NUMERO

-->
<div data-role="page" id="mesa-cambiar-numero" data-theme="e" data-bind="if: adn().currentMesa">
    <div data-role="header">
        <h1>Cambiar número de la <?php echo Configure::read('Mesa.tituloMesa') ?> <span data-bind="text: adn().currentMesa().numero"></span></h1>
    </div>

    <div data-role="main" class="ui-content">    
        <p>
        El número actual es <span data-bind="text: adn().currentMesa().numero"></span>
        </p>
        <form name="cambiar-mozo" id="form-cambiar-numero" action="#mesa-view" data-ajax="false"  data-transition="reverse">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label for="numeroacambiar">Ingresar nuevo número</label>
                <input type="number" name="numero" id="numeroacambiar" />
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Modificar</button></div>
	    </fieldset>
            
        </form>
    </div>
            
</div>  




<!--
                    MESA COBRAR

-->
<div data-role="page" id="mesa-cobrar" data-theme="e" class="dialog-reancho dialog-arriba" data-bind="if: adn().currentMesa">
    <div data-role="header">
        <h1><?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero()"></span> | <span data-bind="text: adn().currentMesa().vueltoText()"></span></h1>
    </div>

    <div data-role="main" class="ui-content">                  
        <h2>Cobrar la <?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero"></span> <span class="mesa-total" style="float: right; color: red;">Total $<span data-bind="text: adn().currentMesa().totalCalculado()"></span></span></h2>
        
        <ul class="tipo_de_pagos tipo-de-pagos-disponibles">
        <?php 
        foreach ( $tipo_de_pagos as $tp ){
            $pago = $tp['TipoDePago'];
            // para que el json no tenga proglemas con el DOM "
            $pagoJson =  str_replace('"',"'", json_encode( $pago , JSON_NUMERIC_CHECK) );
            ?>
            <li>
                <a href="#" data-pago-json="<?php echo $pagoJson; ?>">
                    <?php
                    echo $this->Html->imageMedia($tp['TipoDePago']['media_id']);
                    echo '<br />';
                    echo $pago['name'];
                    ?>
                </a>
            </li>
            <?php
        }
        ?>
        </ul>
        
        <div class="pagos-seleccionados">
            <div class="vuelto">
                <span class="vuelto-title text-success" data-bind="visible: adn().currentMesa().vuelto() >= 0"
                >Vuelto: $</span>
                <span class="vuelto-title text-danger" data-bind="visible: adn().currentMesa().vuelto() < 0"
                >Falta Pagar: $</span>
                <span class="vuelto-value"  data-bind="text: Math.abs(adn().currentMesa().vuelto())"></span>
            </div>

            <h4>Pagos Seleccionados</h4>

            

            <ul class="pagos_creados"
                data-bind='template: { name: "li-pagos-creados", foreach: adn().currentMesa().Pago }'>
            </ul>
            
            <div class="ui-grid-c">
                    <div class="ui-block-a"><a href="#" data-role="button" data-rel="back">Cancelar</a></div>
                    <div class="ui-block-b"><a href="#" data-role="button" data-rel="back" id="mesa-cajero-reabrir">Re Abrir</a></div>
                    <div class="ui-block-c"><a href="#" data-role="button" data-rel="back" class="mesa-reimprimir">Imprimir Ticket</a></div>
                    <div class="ui-block-d"><a href="#" data-role="button" data-rel="back" data-theme="b" id="mesa-pagos-procesar">Cobrar</a></div>
    	    </div>
        </div>
    </div>
    
            
</div>  


<?php 
// $jsonMesas =  json_encode( $mesas );  
?>
