(function(){

	var $loader = $("#loader-container");
	var $logo = $("#isologo");


	function mostrarLoader() {
		$logo.hide('fade');
	}

	function mostrarLogo() {
		$logo.show('fade');
	}
	$( function() {
		mostrarLogo();
	} );

	//$( window ).on("load", mostrarLoader);
	$( window ).on("unload",mostrarLoader);
	$( window ).on("beforeunload",mostrarLoader);

	mostrarLogo();

})();