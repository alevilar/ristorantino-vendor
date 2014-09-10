
    
<div data-role="page">

	<div  data-role="header" data-position="inline">
            <a data-rel="back" data-transition="reverse" href="#">Back</a>
            
            <h1>Mesa N°<span data-bind="text: currentMesa().numero"></span>, Mozo <span data-bind="text: currentMesa().mozo().numero"></span>
                <span class="mesa-total" style="color: red;">$<span data-bind="text: currentMesa().total"></span></span>
            </h1>
            <div data-role="navbar">
                    <ul>
                        <li><a href="#mesa-view" class="ui-btn-active">Vista Común</a></li>
                        <li><a href="#mesa-view-ticket">Vista Ticket</a></li>
                    </ul>
            </div>
        </div>

        <div  data-role="content" class="">
            
            <!-- Template: listado de comandas con sus productos-->
            <script id="listaComandas" type="text/x-jquery-tmpl">
                <li>   
                   <span>Comanda ${Comanda.id}</span>
                   Producto: ${Producto.name} Cant: ${DetalleComanda.cant-DetalleComanda.cant_eliminada}
                </li>
            </script>

            <script type="text/javascript">
                if ( !Risto.Adition.koAdicionModel.tieneCurrentMesa() ) {
//                            document.location = URL_DOMAIN + TENANT + '/adition/adicionar';
                }
                    
                (function($){
                    Risto.Adition.koAdicionModel.refreshBinding();
                })(jQuery);
                
            </script>

            <div class="" style="width: 28%; float: left;">
                <ul data-role="listview" style="width: 100%">
                    <li><a href="<?php echo $this->Html->url(array('plugin'=>'comanda', 'controller'=>'comandas', 'action'=>'add'))?>" daxta-bind="attr: {href: currentMesa().urlComandaAdd()}" ><?php echo $this->Html->image('/adition/css/img/chef_64.png')?>Comanda</a></li>
                    <li><a href="<?php echo $this->Html->url(array('plugin'=>'risto', 'controller' =>'pages', 'action'=>'display', 'panel')'/pages/panel')?>" >PAnel</a></li>
                    <li><a href="#sacar-item" >Sacar Item</a></li>
                    <li><a href="#Agregar Cliente" ><?php echo __( 'Agregar %s', Configure::read('Mesa.tituloCliente')) ?></a></li>
                    <li><a href="#Agragar Descuento" >Agregar Descuento</a></li>
                    <li><a href="#Cerrar-mesa" ><?php echo __('Cerrar %s',  Configure::read('Mesa.tituloMesa')) ?></a></li>
                    <li><a href="#cambiar-mozo" ><?php echo __('Cambiar %s',  Configure::read('Mesa.tituloMozo')) ?></a></li>
                    <li><a href="#Cambiar N° Mesa" >Cambiar N°</a></li>
                    <li><a href="#re-print" >Re imprimir Ticket</a></li>
                    <li><a href="#Borrar-mesa" >Borrar Mesa</a></li>
                    <li><a href="#testiesto" >De la pagina de atras</a></li>
                </ul>
            </div>

            <div class="mesas view " style="width: 70%; float:right;" >
                <h1>Detalle de comsumición</h1>
                <div class="">

                    <ul data-bind="template: {name: 'listaComandas', foreach: currentMesa().comandas}"></ul>
              
                </div>

            </div>
            
        </div>
    
    <div data-role="footer">Pie de página</div>
</div>