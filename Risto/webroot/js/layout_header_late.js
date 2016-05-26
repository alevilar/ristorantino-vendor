(function(){

	var $loader = $("#loader-container");
	var $logo = $("#isologo");


	function mostrarLoader() {
		$logo.hide('fade');
	}

	function mostrarLogo() {
		$logo.show('fade');
	}

	//$( window ).on("load", mostrarLoader);
	$( window ).on("unload",mostrarLoader);

	mostrarLogo();

})();