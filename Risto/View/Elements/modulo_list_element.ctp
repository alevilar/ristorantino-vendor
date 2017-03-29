<h1 class="blue center"><?php echo Configure::read('Site.name')?></h1>
	<div class="col-md-12">
		<div class="dashboard">
			<h5 class="white-5">APP's Instaladas</h5>
		   	<ul class="dashboard-buttons row">

					<?php 

					if ( Configure::read('Site.type') != SITE_TYPE_HOTEL ) {
						?>
						<li class="" id="bton-adicion">
							<?php
							$img = $this->Html->image('/risto/css/ristorantino/home/adicion.png');
					  		echo $this->Html->link($img.__('Salón'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array(
					  			'escape' => false,
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Comenzá a vender tus productos y generar comandas para la cocina.",
					  			)); 
			  			?></li><?php
					} else {
						?>
						<li class="" id="bton-reservations">
							<?php
						$img = $this->Html->image('/risto/css/ristorantino/home/reservations.png');
					  echo $this->Html->link($img.__('Reservas'), array(
					  			'plugin' =>'aditions', 
					  			'controller'=>'aditions', 
					  			'action'=>'adicionar'
				  			), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Reservar habitaciones o para facturar.",
					  			'escape' => false,
					  			)); 
  			  			?></li><?php

					}
					?>
				</li>






				<?php if (Configure::read('Site.modulo_cajero')) { ?>
					<li id="bton-caja" class="">
						<?php 
						$img = $this->Html->image('/risto/css/ristorantino/home/caja.png');
						$mesasTitle = Inflector::pluralize( Configure::read('Mesa.tituloMesa') );
						  echo $this->Html->link($img.__('Cajero'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar','#'=>'listado-mesas-cerradas'), array(
						  			'escape' => false,
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Visualiza las $mesasTitle cerradas. Maneja los cobros e imprime el ticket.",
						  			)); 
						?>
					</li>
				<?php }?> 



				<?php if ( Configure::read('Site.type') == SITE_TYPE_RESTAURANTE ) {?>
				<li id="bton-comandero" class="">
				<?php
					$img = $this->Html->image('/risto/css/ristorantino/home/comandero.png');
					echo $this->Html->link($img.'Comandero', array('controller' => 'comandas', 'action' => 'comandero', 'plugin' => 'comanda'), array(
					  			'escape' => false,
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"El comandero sirve para ver, por pantalla, todas las comandas enviadas por el mozo.",
					  			)); 
					?>
				</li>    
				<?php } ?>




				<?php if (Configure::read('Site.modulo_contable')) { ?>
					<li id="bton-contabilidad" class="">
						<?php 
						$img = $this->Html->image('/risto/css/ristorantino/home/contabilidad.png');
						echo $this->Html->link($img.__('Contabilidad'), array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array(
						  			'escape' => false,
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Módulo contable. Desde aquí podrás manejar todo lo que genera un egreso: proveedores, facturas, impuestos, pagos, etc.",
						  			)); ?>
					</li>
				<?php }?> 
			
				
				
				<?php if (Configure::read('Site.modulo_arqueo_de_caja')) { ?>
					<li id="bton-arqueo" class="">  
						<?php 
						$img = $this->Html->image('/risto/css/ristorantino/home/arqueo.png');
						echo $this->Html->link($img.__('Arqueo'), array('plugin' => 'cash', 'controller' => 'arqueos'), array(
						  			'escape' => false,
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"El arqueo sirve para contabilizar los movimientos de caja generados durante la jornada.",
						  			)); ?>
					</li>  
				<?php } ?>

				<?php if (Configure::read('Site.modulo_compras')) { ?>
					<li id="bton-pedidos" class="">   
						<?php 
						$img = $this->Html->image('/risto/css/ristorantino/home/pedidos.png');
						echo $this->Html->link($img.__('Compras'), array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'pendientes'), array(
						  			'escape' => false,
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Ayuda a organizar y controlar todas las compras que se realizan en los distintos sectores del comercio.",
						  			)); ?>
					</li> 
				<?php } ?>



				<?php if (Configure::read('Site.modulo_impresoras')) { ?>
					<li id="bton-pedidos" class="">   
						<?php 
						$img = $this->Html->image('/risto/css/ristorantino/home/impresoras.png');
						echo $this->Html->link($img.__('Impresoras'), array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'index'), array(
						  			'escape' => false,
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Imprime tickets o comandas.",
						  			)); ?>
					</li> 
				<?php } ?>


				<?php if (Configure::read('Site.modulo_afip_factura_electronica')) { ?>
					<li id="bton-pedidos" class="">   
						<?php 
						$img = $this->Html->image('/risto/css/ristorantino/home/afip_factura_electronica.png');
						echo $this->Html->link($img.__('E-Factura'), array('plugin'=>'printers', 'controller'=>'afip_facturas', 'action'=>'index'), array(
						  			'escape' => false,
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Imprimir factura electrónica AFIP.",
						  			)); ?>
					</li> 

				<?php } ?>


				<?php if (Configure::read('Site.modulo_stats')) { ?>
					<li id="bton-stats" class="">  
						<?php 
						$img = $this->Html->image('/risto/css/ristorantino/home/stats.png');
						echo $this->Html->link($img.__('Estadísticas'), array(
									'plugin' => 'stats', 
									'controller' => 'stats', 'action'=>'mesas_total'
								), 
								array(
						  			'escape' => false,
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Visualiza las estadísticas de tu comercio.",
						  			)); ?>
					</li>  
				<?php } ?>
			
			</ul>
		</div><!-- EOF: dashboard -->
	</div>