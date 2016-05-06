<?php
$isPremium = Configure::read('Site.is_premium');
if ( $isPremium ) {
	return '';
}

if ( empty($width) ) {
	$width = "100%"; 
}

if ( empty($height) ) {
	$height = "100px"; 
}

if ( empty($style) ) {
	$style = "display:inline-block;width:$width;height:$height";
}


?>

<!-- Menu Small 178x100 -->
<ins class="adsbygoogle"
     style="<?php echo $style?>"
     data-ad-client="ca-pub-5243804419064198"
     data-ad-slot="3047296917"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>