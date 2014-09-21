<!-- Template: listado de comandas con sus productos-->
<script id="listaComandas" type="text/x-jquery-tmpl">
   <div data-role="collapsible">
       <h3>
           <span class="id-comanda">#<span data-bind="text: id()"></span></span>  <span class="hora-comanda"  data-bind="text: timeCreated()"></span>&nbsp;&nbsp;&nbsp;
           <span class="comanda-listado-productos-string" data-bind="text: productsStringListing()"></span>
           
           <a style="float: right;" href="#" data-bind="click: imprimirComanda" class="btn-comanda-icon">
               imprimir
           </a>
       </h3>

        <ul class="comanda-items" data-role="listview"
           data-bind="template: {name: 'li-productos-detallecomanda', foreach: DetalleComanda}"
           style="margin: 0px;">

        </ul>                                                                           
   </div>
</script>




<!--  TEmplate: Productos seleccionados en el menu. comandas add -->
<script id="categorias-productos-seleccionados" type="text/x-jquery-tmpl">
    <li data-bind="visible: cant(), css:{'es-entrada': esEntrada(), 'tiene-observacion': observacion()}"  class="ui-li ui-li-static ui-body-c listado-productos-seleccionados" >
        
        <div style="display: none" data-type="horizontal" data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal ui-options">
            <a data-bind="click: seleccionar" data-role="button" data-icon="plus" data-iconpos="notext" href="#" title="+" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-left ui-btn-up-c"><span class="ui-btn-inner ui-corner-left"><span class="ui-btn-text" >+</span><span class="ui-icon ui-icon-plus ui-icon-shadow"></span></span></a>
            <a data-bind="click: deseleccionar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c"><span class="ui-btn-inner"><span class="ui-btn-text">-</span><span class="ui-icon ui-icon-minus ui-icon-shadow"></span></span></a>
            <a data-bind="click: addObservacion, style: { background: observacion() ? '#437FBE' : ''}" 
               data-rel="dialog"  
               data-role="button"
               data-iconpos="notext" 
               data-icon="grid" 
               href="#comanda-add-product-obss" 
               title="Observación" 
               data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c">
                <span class="ui-btn-inner">
                    <span class="ui-btn-text">Observación
                    </span>
                    <span class="ui-icon ui-icon-grid ui-icon-shadow"></span>
                </span>
            </a>
            <a data-role="button" data-iconpos="notext" data-icon="entrada" 
               href="#" title="Entrada" data-theme="c" 
               class="ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last ui-btn-up-c"
               data-bind="click: toggleEsEntrada, css: { es_entrada: esEntrada()}"
               >
                <span class="ui-btn-inner ui-corner-right ui-controlgroup-last">
                    <span class="ui-btn-text">Entrada</span>
                    <span class="ui-icon ui-icon-entrada ui-icon-shadow"></span>
                </span>
            </a>
         </div>
        
        
        <span data-bind="text: realCant()" class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
         
        <span data-bind="text: nameConSabores() + ' ' +observacion()"></span>
        
        <span class="ui-options-btn">
            
            Opciones
        
        </span>
     </li>
 </script>
 
 
 
 <!-- Template: Comanda Add menu path-->
 <script id="boton" type="text/x-jquery-tmpl">
        <a data-bind="attr: {
                         'data-icon': esUltimoDelPath()?'':'back', 
                         'css': {'ui-btn-active': esUltimoDelPath()}
                         }, 
                      click: seleccionar" 
            class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-c">
             <span class="ui-btn-inner ui-btn-corner-all">
                 <span class="ui-btn-text" data-bind="text: name" ></span>
                 <span class="ui-icon ui-icon-right ui-icon-shadow"></span>
             </span>
         </a>
</script>


 


<!-- Template: Caomanda add: listado de categorias                                  -->
<script id="listaCategoriasTree" type="text/x-jquery-tmpl">
   <a  href="#" data-theme="b" data-inline="true" 
       data-bind="css: {'sin-imagen': !image_url, 'con-imagen': image_url}"
       class="">
           <image class="menu-img" data-bind="visible: image_url, attr: {src: URL_DOMAIN +'img/menu/'+image_url}"/>           
           <span data-bind="text: name"></span>
   </a>
</script>


<!-- Template: Caomanda add: listado de productos -->
<script id="categorias-productos" type="text/x-jquery-tmpl">
     <a data-bind="attr: { href: tieneSabores() ? '#page-sabores' : '#'}, css: {'producto-con-sabor': tieneSabores()}" 
        data-rel="dialog"
        data-icon="none"
        class="">
             <span class="ui-btn-text" data-bind="text: name" ></span>
     </a>
 </script>
 
 
 
 <!-- Template: Comanda Add, Listado de sabores de categorias       -->
<script id="listaSabores" type="text/x-jquery-tmpl">
   <a href="#" data-theme="c" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-c">
       <span class="ui-btn-inner ui-btn-corner-all">
           <span class="ui-btn-text">
               <span data-bind="text: name"></span>                         
           </span>
       </span>
   </a>
</script>


<!-- listado de pagos seleccionados -->
<script id="li-pagos-creados" type="text/x-jquery-tmpl">
     <li>
         <img src="" data-bind="attr: {src: image(), alt: TipoDePago().name, title: TipoDePago().name}"/>
         <label>Ingresar Valor $: </label>
         <input name="valor" data-bind="value: valor, valueUpdate: 'keyup'" placeholder="Ej: 100.4"/>
     </li>
</script>





<!-- Template: Listado de productos del detalle Comanda -->
<script id="li-productos-detallecomanda" type="text/x-jquery-tmpl">
 <li>
     <span data-type="horizontal" data-role="controlgroup">
        <a id="mesa-action-detalle-comanda-sacar-item" data-bind="click: deseleccionarYEnviar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c">
            -</a>
        <a data-bind="css: { es_entrada: esEntrada()}" data-role="button" data-iconpos="notext" data-icon="entrada" href="#" title="Entrada" data-theme="c">
            Entrada
        </a>
     </span>

     <span data-bind="text: realCant()" style="padding-left: 20px;"></span>
     <span data-bind="text: nameConSabores() + ' ' +observacion(), css: {tachada: realCant()==0}" style="padding-left: 20px;"></span>
     <span class="producto-precio">p/u: {{= '$'}}<span data-bind="text: precio()"></span></span>
 </li>
</script>




<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="listaMesas" type="text/x-jquery-tmpl">
    <li data-bind="attr: {mozo: mozo().id(), 'id': 'mesa-li-id-'+id(), 'class': estado().icon}">
        <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
            data-theme="c"
            data-role="button" 
            href="#mesa-view" 
            class="ui-btn ui-btn-up-c">
            <span class="mesa-span ui-btn-inner">
                <span class="ui-btn-text">
                    <span class="mesa-numero" data-bind="text: numero"></span>
                    
                </span>
            </span>
            <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            <span  class="mesa-tipofactura" data-bind="visible: clienteTipoFacturaText()">
                <span data-bind="text: clienteTipoFacturaText()"></span>
            </span>
            <span class="mesa-time" data-bind="text: textoHora()"></span>
        </a>
    </li>
</script>


<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
es igual al de las mesas de la adicion salvo que al hacer click tienen otro comportamiento
-->
<script id="listaMesasCajero" type="text/x-jquery-tmpl">
    <li data-bind="attr: {mozo: mozo().id(), 'class': estado().icon}">
        <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
            data-theme="c"
            data-rel="dialog"
            data-role="button" 
            data-transition="none"
            data-icon="none"
            href="#mesa-cobrar" 
            class="ui-btn ui-btn-up-c">
            <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
            
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            <span  class="mesa-tipofactura" data-bind="visible: clienteTipoFacturaText()">
                "<span data-bind="text: clienteTipoFacturaText()"></span>"
            </span>
            
            <span class="mesa-numero" data-bind="text: numero"></span>
            
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            
            <br />
            <br />
            <span class="mesa-total">$ <span data-bind="text: totalCalculado()"></span></span><br />
            
            
            <span class="mesa-time" data-bind="text: textoHora()"></span>
        </a>
    </li>
</script>






<!-- Template: 
listado de mesas reservadas para la grilla Calendar -->
<script id="mesa-reserva-calendar" type="text/x-jquery-tmpl">

    <td data-bind="attr: {colspan: cantDiasEntreCheckinCheckout(), 'class': estado().icon}">
      <div class="mark">
          <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
              data-theme="c"
              data-role="button" 
              href="#mesa-view" 
              class="ui-btn ui-btn-up-c">
              <span class="mesa-span ui-btn-inner">
                  <span class="ui-btn-text">
                      <span class="mesa-numero" data-bind="text: numero"></span>
                      
                  </span>
              </span>
              <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
              <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
              <span  class="mesa-tipofactura" data-bind="visible: clienteTipoFacturaText()">
                  <span data-bind="text: clienteTipoFacturaText()"></span>
              </span>
              <span class="mesa-time" data-bind="text: textoHora()"></span>
          </a>
        </div>
    </li>
</script>








<script id="calendar-header-month" type="text/x-jquery-tmpl">
  <th class="month" data-bind="attr: {colspan: cant}">
     <span data-bind="text: name"></span>
  </th>

</script>


<script id="calendar-header-day" type="text/x-jquery-tmpl">
  <th class="day">
      <div>
        <span data-bind="text: format('D')"></span><br />
        <span data-bind="text: format('ddd')"></span>
      </div>
  </th>
</script>


<script id="calendar-mozo-mesas-day-grid" type="text/x-jquery-tmpl">
   <td class="mozo-col day"  data-bind="attr: {'data-day': $item.data.format('YYYY-MM-DD')}"></td>
</script>


<!-- listado de mesas para la grilla calendario-->
<script id="calendar-mozo-mesas-data-day-grid" type="text/x-jquery-tmpl">

       {{if this.data.diasEstadia == 0}}
            <td class="mozo-col" data-bind="attr: {'data-day': dayName}"></td>
        {{else}}
           <td class="mozo-col ocupada" data-bind="attr:{colspan:diasEstadia, 'data-checkin': checkin, 'data-checkout': checkout}">                                 
              <div class="mark">
                 <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
                    href="#mesa-view" >
                    &nbsp;
                    <span class="mesa-cliente" data-bind="text: clienteNameData()"></span>
                </a>
              </div>
          </td>
        {{/if}}

</script>



<script id="calendar-mozo-row" type="text/x-jquery-tmpl">
  <div  class="mozo mozo-row">
      <div class="mozos-list-vertical col-header">

          <div class="vertical listado-mozos-para-mesas">
              <a href="#" data-mozo-id="${id}">${numero}</a>
          </div>              

      </div>

      <div class="content mesas-list">
          <table class="mozo-days">
              <tbody>
                  <tr data-bind='template: { name: "calendar-mozo-mesas-day-grid", foreach: Risto.Adition.adicionar.calendarGrid.days }'></tr>
              </tbody>
         </table>

         <table class="mozo-mesas">
              <tbody>
                  <tr data-bind='template: { name: "calendar-mozo-mesas-data-day-grid", foreach: $item.data.mesasFromDataRangeByRange() }'></tr>
              </tbody>
         </table>

      </div>
  </div>

</script>                