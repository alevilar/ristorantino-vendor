<?php
echo $this->Html->css('/risto/css/ristorantino/home/ristorantino.home');
?>


	<div class="col-md-2 hidden-sm hidden-xs">
		<a class="twitter-timeline" 
			href="https://twitter.com/PaxaPos" 
			data-widget-id="636390749106511872"
			 width="100%" height="420"
			 >Tweets @PaxaPos.</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>

	<div class="col-md-8">
		<div class="dashboard">
		   	<ul class="dashboard-buttons row">
				
					<?php 

					if ( Configure::read('Site.type') != SITE_TYPE_HOTEL ) {
						?>
						<li class="col-xs-6 col-sm-3" id="bton-adicion">
							<?php
					  		echo $this->Html->link(__('Ventas'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array(
					  			
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Comenzá a vender tus productos y generar comandas para la cocina.",
					  			)); 
			  			?></li><?php
					} else {
						?>
						<li class="col-xs-6 col-sm-3" id="bton-reservations">
							<?
					  echo $this->Html->link(__('Reservas'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Reservar habitaciones o para facturar.",
					  			)); 
  			  			?></li><?php

					}
					?>
				</li>

				<li id="bton-caja" class="col-xs-6 col-sm-3">
					<?php 
					$mesasTitle = Inflector::pluralize( Configure::read('Mesa.tituloMesa') );
					  echo $this->Html->link(__('Cajero'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar','#listado-mesas-cerradas'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Visualiza las $mesasTitle cerradas. Maneja los cobros e imprime el ticket.",
					  			)); 
					?>
				</li>


				<li id="bton-contabilidad" class="col-xs-6 col-sm-3">
					<?php echo $this->Html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Módulo contable. Desde aquí podrás manejar todo lo que genera un egreso: proveedores, facturas, impuestos, pagos, etc.",
					  			)); ?>
				</li>

				<li id="bton-estadisticas" class="col-xs-6 col-sm-3">  
					<?php echo $this->Html->link('Estadísticas', array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Visualizar el histórico de ventas, productos más vendidos y muchas cosas más.",
					  			)); ?>
				</li>
				
				<?php if ( Configure::read('Site.type') == SITE_TYPE_RESTAURANTE ) {?>
				<li id="bton-comandero" class="col-xs-6 col-sm-3">
				<?php
					echo $this->Html->link('Comandero', array('controller' => 'comandas', 'action' => 'comandero', 'plugin' => 'comanda'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"El comandero sirve para ver, por pantalla, todas las comandas enviadas por el mozo.",
					  			)); 
					?>
				</li>    
				<?php } ?>

				
				<li id="bton-arqueo" class="col-xs-6 col-sm-3">  
					<?php echo $this->Html->link('Arqueo', array('plugin' => 'cash', 'controller' => 'arqueos'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"El arqueo sirve para contabilizar los movimientos de caja generados durante la jornada.",
					  			)); ?>
				</li>  



				<li id="bton-pedidos" class="col-xs-6 col-sm-3">   
					<?php echo $this->Html->link('Compras', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'pendientes'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Ayuda a organizar y controlar todas las compras que se realizan en los distintos sectores del comercio.",
					  			)); ?>
				</li> 

				<li id="bton-admin" class="col-xs-6 col-sm-3">   
					<?php echo $this->Html->link('Configuración', array('plugin'=>'risto', 'controller'=>'pages', 'action'=>'display', 'administracion'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Igresar aqui para dar de alta a los usuarios, productos, clientes, descuentos, etc.",
					  			)); ?>
				</li>
				
			</ul>
		</div><!-- EOF: dashboard -->


	</div><!-- col iz del dashboard col-md-->
		<div class="col-md-2 hidden-sm hidden-xs">
		<br>
			<?php
				$isPremium = Configure::read('Site.is_premium');
				if ( !$isPremium) { ?>
					<p class="center">
						¿Quieres tu PaxaPos sin publicidad? <?php echo $this->Html->link('Hazte Premium', array('plugin'=>'paxapos', 'controller'=>'paxapos', 'action'=>'contact'));?>
					</p>
			<?php }?>


			<?php echo $this->element('Risto.google_ads/columna_vertical', array('width'=> '100%', 'height' => '350px')); ?>
			
		</div>





<script>
	  $('[data-toggle="tooltip"]').tooltip()
</script>