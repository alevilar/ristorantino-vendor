<?php echo $this->element('Risto.paxapos_main_menu/dashboard_context_menu');?>


<?php //$this->append('script');?>
<?php // echo $this->element('Risto.smartsupp_chat_soporte_tecnico');?>
<?php //$this->end();?>



<?php
echo $this->Html->css('/risto/css/ristorantino/home/ristorantino.dashboard');
// $this->layout = 'Risto.administracion';
?>

<div class="row dashboard-container" style="display:none">

		   	<div class="alert alert-danger center">
		   		TRABAJANDO EN MODO OFFLINE
		   	</div>


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


			
			</ul>
		</div><!-- EOF: dashboard -->

	</div>



</div>


<?php $this->append('script');?>
<script>
	  $('[data-toggle="tooltip"]').tooltip();

	  setTimeout(function(){
		  $(".dashboard-container").show('fade');
	  }, 500);


	  $(".dashboard-buttons a").on('click', function( ev ){
	  	var $el = $(this).children("img");
	  	$el.effect( 'explode', {pieces:36}, 800, function(){
	  		$el.show();
	  	} );

	  });
</script>
<?php $this->end();?>