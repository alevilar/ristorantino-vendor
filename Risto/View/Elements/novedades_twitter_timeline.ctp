<?php
// si viene en false entonces no mostrar titulo
if ( !is_bool($title)) {
	if (empty($title)) {
		$title = "Novedades";
	}
}
?>


<?php if ( $title ) { ?>
	<h1 class="center"><?php echo $title;?></h1>
<?php } ?>

<a class="twitter-timeline" 
		href="https://twitter.com/PaxaPos" 
		data-widget-id="636390749106511872"
		data-chrome="noheader nofooter noborders transparent"
		width="100%" 
		height="220"
		 >Tweets @PaxaPos.</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

