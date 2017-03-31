<?php echo $this->element('Risto.paxapos_main_menu/dashboard_context_menu');?>






<?php
echo $this->Html->css('/risto/css/ristorantino/home/ristorantino.dashboard');
// $this->layout = 'Risto.administracion';
?>

<div class="row dashboard-container" style="display:none">

<div class="row">
<div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
	<?php echo $this->element('Risto.last_tweet'); ?>
</div>
<div class="hidden-xs col-sm-8 col-md-8 col-lg-8">
	<?php echo $this->element('Risto.modulo_list_element'); ?>
</div>
<div class="visible-xs col-xs-12">
	<?php echo $this->element('Risto.modulo_list_element'); ?>
</div>

</div>
</div>


<?php
	$this->append("footer");

	$this->end();
?>


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

