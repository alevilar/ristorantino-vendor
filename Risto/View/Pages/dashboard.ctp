<?php $this->append('paxapos-main-menu');?>

 		<?php echo $this->element("Risto.paxapos_main_menu/home_btn");?>

		<br>
		<h3 class="center blue-8"><?php echo Configure::read("Site.name");?></h3>



      <?php echo $this->element("Risto.paxapos_main_menu/tenant_config");?>



<?php $this->end();?>





<?php
echo $this->Html->css('/risto/css/ristorantino/home/ristorantino.dashboard');
// $this->layout = 'Risto.administracion';
?>

<div class="row dashboard-container" style="display:none">



	<h1 class="blue center"><?php echo Configure::read('Site.name')?></h1>
	<div class="col-md-12">
		<div class="dashboard">
			<h4 class="white-8">APP's Instaladas</h4>
		   	<ul class="dashboard-buttons row">

					<?php 

					if ( Configure::read('Site.type') != SITE_TYPE_HOTEL ) {
						?>
						<li class="" id="bton-adicion">
							<?php
					  		echo $this->Html->link(__('Ventas'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array(
					  			
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"Comenzá a vender tus productos y generar comandas para la cocina.",
					  			)); 
			  			?></li><?php
					} else {
						?>
						<li class="" id="bton-reservations">
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





				<?php if (Configure::read('Site.modulo_cajero')) { ?>
					<li id="bton-caja" class="">
						<?php 
						$mesasTitle = Inflector::pluralize( Configure::read('Mesa.tituloMesa') );
						  echo $this->Html->link(__('Cajero'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar','#listado-mesas-cerradas'), array(
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
					echo $this->Html->link('Comandero', array('controller' => 'comandas', 'action' => 'comandero', 'plugin' => 'comanda'), array(
					  			'data-toggle' => "tooltip",
								'data-placement'=>"bottom",
					  			'title'=>"El comandero sirve para ver, por pantalla, todas las comandas enviadas por el mozo.",
					  			)); 
					?>
				</li>    
				<?php } ?>




				<?php if (Configure::read('Site.modulo_contable')) { ?>
					<li id="bton-contabilidad" class="">
						<?php echo $this->Html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array(
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Módulo contable. Desde aquí podrás manejar todo lo que genera un egreso: proveedores, facturas, impuestos, pagos, etc.",
						  			)); ?>
					</li>
				<?php }?> 
			
				
				
				<?php if (Configure::read('Site.modulo_arqueo_de_caja')) { ?>
					<li id="bton-arqueo" class="">  
						<?php echo $this->Html->link('Arqueo', array('plugin' => 'cash', 'controller' => 'arqueos'), array(
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"El arqueo sirve para contabilizar los movimientos de caja generados durante la jornada.",
						  			)); ?>
					</li>  
				<?php } ?>

				<?php if (Configure::read('Site.modulo_compras')) { ?>
					<li id="bton-pedidos" class="">   
						<?php echo $this->Html->link('Compras', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'pendientes'), array(
						  			'data-toggle' => "tooltip",
									'data-placement'=>"bottom",
						  			'title'=>"Ayuda a organizar y controlar todas las compras que se realizan en los distintos sectores del comercio.",
						  			)); ?>
					</li> 
				<?php } ?>
			
			</ul>
		</div><!-- EOF: dashboard -->

	</div>



</div>

<script>
	  $('[data-toggle="tooltip"]').tooltip();

	  setTimeout(function(){

		  $(".dashboard-container").show('fade');
	  }, 400);
</script>