(function(){

	var $loader = $("#loader-container");
	var $logo = $("#isologo");
	var $descargarExcel = $("#descargarExcel");


	function mostrarLoader() {
		$logo.hide('fade');
		$logo.delay(10000);
		$logo.show('fade');
	}

	function mostrarLogo() {
		$logo.show('fade');
	}
	$( function() {
		mostrarLogo();
	} );

	//$( window ).on("load", mostrarLoader);
	$( window ).on("unload",mostrarLoader);
	$descargarExcel.on("click",mostrarLoader);

	mostrarLogo();

})();