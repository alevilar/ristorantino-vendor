<?php
$isPremium = Configure::read('Site.is_premium');
if ( $isPremium ) {
	return '';
}
if ( empty($style) ) {
	$style = 'display:inline-block;width:300px;height:100px';
}


?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Menu Small 178x100 -->
<ins class="adsbygoogle"
     style="<?php echo $style?>"
     data-ad-client="ca-pub-5243804419064198"
     data-ad-slot="3047296917"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>