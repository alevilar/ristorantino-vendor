<?php

$isPremium = Configure::read('Site.is_premium');
if ( $isPremium ) {
	return '';
}
?>
<div class="center google-ads-horizontal">
	<!-- 728x90, creado 31/05/10 -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:90px;"
	     data-ad-client="ca-pub-5243804419064198"
	     data-ad-slot="8129076530"></ins>
</div>

<div class="clearfix"></div>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>