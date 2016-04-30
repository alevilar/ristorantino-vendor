<?php
echo $this->Html->css('/risto/css/ristorantino/home/ristorantino.home');
?>


<div class="row">

	<div class="col-md-4 hidden-sm hidden-xs">
		<?php echo $this->element('Risto.google_ads/columna_vertical'); ?>
		

		<h3>Novedades PaxaPos</h3>
		<a class="twitter-timeline" href="https://twitter.com/PaxaPos" data-widget-id="636390749106511872">Tweets @PaxaPos.</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>

	<div class="col-md-8">


		<div class="jumbotron">
			<?php 
			$isPremium = Configure::read('Site.is_premium');
			if ( !$isPremium) { ?>
				<p class="center">
					¿Quieres tu PaxaPos sin publicidad? <?php echo $this->Html->link('Hazte Premium', array('plugin'=>'paxapos', 'controller'=>'paxapos', 'action'=>'contact'));?>
				</p>
			<?php }?>
		   	<ul class="dashboard-buttons">
				<li>
					<?php 

					if ( Configure::read('Site.type') != SITE_TYPE_HOTEL ) {
					  echo $this->Html->link(__('Ventas'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array('id' => 'bton-adicion')); 
					} else {
					  echo $this->Html->link(__('Reservas'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array('id' => 'bton-reservations')); 
					}
					?>
				</li>

				
				<?php if ( Configure::read('Site.type') == SITE_TYPE_RESTAURANTE ) {?>
				<li>
				<?php
					echo $this->Html->link('Comandero', array('controller' => 'comandas', 'action' => 'comandero', 'plugin' => 'comanda'), array('id' => 'bton-comandero')); 
					?>
				</li>    
				<?php } ?>


				<li>   
					<?php echo $this->Html->link('Compras', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'pendientes'), array('id' => 'bton-pedidos')); ?>
				</li> 
			    

				
				 

			  
		   </ul>


		   <ul class="dashboard-buttons">

		   		<li>
					<?php 

					  echo $this->Html->link(__('Cajero'), array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar','#listado-mesas-cerradas'), array('id' => 'bton-adicion')); 
					?>
				</li>


				<li>   
					<?php echo $this->Html->link('Admin', array('plugin'=>'risto', 'controller'=>'pages', 'action'=>'display', 'administracion'), array('id' => 'bton-admin')); ?>
				</li>
			</ul>


		   		

		  
			<ul class="dashboard-buttons">

				<li>  
					<?php echo $this->Html->link('Estadisticas', array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'), array('id' => 'bton-estadisticas')); ?>
				</li>
				      


				<li>
					<?php echo $this->Html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array('id' => 'bton-contabilidad')); ?>
				</li>


				<li>  
					<?php echo $this->Html->link('Arqueo', array('plugin' => 'cash', 'controller' => 'arqueos'), array('id' => 'bton-caja')); ?>
				</li>  

				
			</ul>
		</div>
	</div>
</div>

