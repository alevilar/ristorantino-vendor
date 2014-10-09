<!-- Template: listado de comandas con sus productos-->
<script id="listaComandas" type="text/html">
   <div data-role="collapsible" data-theme="b">
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
<script id="categorias-productos-seleccionados" type="text/html">
    <li data-bind="visible: cant(), css:{'es-entrada': esEntrada(), 'tiene-observacion': observacion()}"  class="ui-li ui-li-static ui-body-b listado-productos-seleccionados" >
        
        <div style="display: none" 
            data-type="horizontal" 
            data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal ui-options">
            
            <a data-bind="click: seleccionar" data-role="button" data-icon="plus" data-iconpos="notext" href="#" title="+" 
                class="ui-btn ui-btn-inline ui-icon-plus ui-btn-icon-notext ui-corner-all">+</a>

            <a data-bind="click: deseleccionar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" 
                class="ui-btn ui-btn-inline ui-icon-minus ui-btn-icon-notext ui-corner-all">-</a>
            
            <a data-bind="click: addObservacion, css: { marcado: observacion() ? '#437FBE' : ''}" 
               data-rel="dialog"  
               data-role="button"
               data-iconpos="notext" 
               data-icon="comment" 
               data-rel="dialog"
               href="#comanda-add-product-obss" 
               title="Observación" 
               class="ui-btn ui-btn-inline ui-icon-comment ui-btn-icon-notext ui-corner-all">
                Observación
                </span>
            </a>
            <a data-role="button" data-iconpos="notext" data-icon="entrada" 
               href="#" title="Entrada" 
               data-icon="alert" 
               class="ui-btn ui-btn-inline ui-icon-alert  ui-btn-icon-notext ui-corner-all"
               data-bind="click: toggleEsEntrada, css: { marcado: esEntrada()}"
               >
                Entrada
                </span>
            </a>

             <a data-role="button" data-iconpos="notext" data-icon="fraccionar" 
               href="#" title="Fraccionar" 
               class="ui-btn ui-btn-inline ui-icon-recycle ui-btn-icon-notext ui-corner-all"
               data-bind="click: fraccionar"
               >Fraccionar
            </a>


         </div>
        
        
        <span data-bind="text: realCant()" class="real-cant ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
         
        <span data-bind="text: nameConSabores() + ' ' +observacion()"></span>
        
        <button class="ui-btn ui-btn-inline ui-icon-gear   ui-btn-e ui-btn-icon-notext ui-corner-all ui--no-text ui-options-btn">Opciones</span>
     </li>
 </script>
 
 
 
 <!-- Template: Comanda Add menu path-->
 <script id="boton" type="text/html">
        <a data-bind="attr: {
                         'css': {'ui-btn-active': esUltimoDelPath() === true}
                         }, 
                      click: seleccionar" 
            class="ui-btn ui-btn-inline ui-btn ui-icon-carat-r ui-btn-icon-left">
                 <span data-bind="text: name" ></span>
             </span>
         </a>
</script>


 


<!-- Template: Caomanda add: listado de categorias                                  -->
<script id="listaCategoriasTree" type="text/html">
   <a  href="#" data-theme="b" data-inline="true" 
       data-bind="css: {'sin-imagen': !media_id, 'con-imagen': media_id}"
       class="">
           <?php $urlForCategory = $this->Html->url(array('plugin'=>'risto', 'controller'=>'medias', 'action'=>'view')); ?>
           <image class="menu-img" data-bind="visible: media_id, attr: {src: '<?php echo $urlForCategory ?>/'+media_id}"/>           
           <span data-bind="text: name"></span>
   </a>
</script>


<!-- Template: Caomanda add: listado de productos -->
<script id="categorias-productos" type="text/html">
     <a data-bind="attr: { href: tieneSabores() ? '#page-sabores' : '#'}, css: {'producto-con-sabor': tieneSabores()}" 
        data-rel="dialog"
        data-icon="none"
        class="">
             <span class="ui-btn-text" data-bind="text: name" ></span>
     </a>
 </script>
 
 
 
 <!-- Template: Comanda Add, Listado de sabores de categorias       -->
<script id="listaSabores" type="text/html">
   <a href="#" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-c">
       <span class="ui-btn-inner ui-btn-corner-all">
           <span class="ui-btn-text">
               <span data-bind="text: name"></span>                         
           </span>
       </span>
   </a>
</script>


<!-- listado de pagos seleccionados -->
<script id="li-pagos-creados" type="text/html">
     <li>
         <img src="" data-bind="attr: {src: image(), alt: TipoDePago().name, title: TipoDePago().name}"/>
         <input name="valor" data-bind="value: valor, valueUpdate: 'keyup'" placeholder="Ej: 100.4" class="ui-input-text ui-body-e ui-corner-all ui-shadow-inset"/>
     </li>
</script>





<!-- Template: Listado de productos del detalle Comanda -->
<script id="li-productos-detallecomanda" type="text/html">
 <li>
     <span data-type="horizontal" data-role="controlgroup" data-theme="b">
        <a id="mesa-action-detalle-comanda-sacar-item" data-bind="click: deseleccionarYEnviar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-">
            -</a>
        <a data-bind="css: { es_entrada: esEntrada}" data-role="button" data-iconpos="notext" data-icon="alert" href="#" title="Entrada">
            Entrada
        </a>
     </span>

     <span data-bind="text: realCant()" style="padding-left: 20px;"></span>
     <span data-bind="text: nameConSabores() + ' ' +observacion(), css: {tachada: realCant()==0}" style="padding-left: 20px;"></span>
     <span class="producto-precio">p/u: $<span data-bind="text: precio()"></span></span>
 </li>
</script>




<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
es igual al de las mesas de la adicion salvo que al hacer click tienen otro comportamiento
-->
<script id="listaMesasCajero" type="text/html">
    <li data-bind="attr: {mozo: mozo().id(), 'class': estado().icon}">
        <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}"           
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

