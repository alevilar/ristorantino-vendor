<?php
echo $this->Html->css('/risto/css/ristorantino/home/ristorantino.home');
?>


<div class="row">

	<div class="col-md-4 hidden-sm hidden-xs">
		<h3>Novedades PaxaPos</h3>
		<a class="twitter-timeline" href="https://twitter.com/PaxaPos" data-widget-id="636390749106511872">Tweets @PaxaPos.</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>

	<div class="col-md-8">
		<div class="jumbotron">
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
			   
				<li>
					<?php echo $this->Html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array('id' => 'bton-contabilidad')); ?>
				</li>       

				<li>  
					<?php echo $this->Html->link('Arqueo', array('plugin' => 'cash', 'controller' => 'arqueos'), array('id' => 'bton-caja')); ?>
				</li>  
				 

			  
		   </ul>
		  
			<ul class="dashboard-buttons">

				<li>   
					<?php echo $this->Html->link('Compras', array('plugin'=>'compras', 'controller'=>'pedidos', 'action'=>'pendientes'), array('id' => 'bton-pedidos')); ?>
				</li> 


				<li>  
					<?php echo $this->Html->link('Estadisticas', array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'), array('id' => 'bton-estadisticas')); ?>
				</li>     

				 <li>   
					<?php echo $this->Html->link('Admin', array('plugin'=>'risto', 'controller'=>'pages', 'action'=>'display', 'administracion'), array('id' => 'bton-admin')); ?>
				</li>
			</ul>
		</div>
	</div>
</div>