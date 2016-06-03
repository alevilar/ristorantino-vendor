(function($){
	
	var $imgModals = $('a.img-modal');
console.info($imgModals);

	var $modal = $("#modal-for-images");



	$imgModals.on('click', function(e){

		e.preventDefault();
		
		// copiar la imagen para meterla en el modal
		var $body = $modal.find('.modal-body');
		

		var tmpImg = new Image();
		tmpImg.src=this.href; //or  document.images[i].src;

		var $imgs = $(tmpImg).one('load',function(){
		  var orgWidth = tmpImg.width;
		  var orgHeight = tmpImg.height;
		  var prop = orgWidth/orgHeight;
		  
		  if ( orgHeight > orgWidth ) {
		  		var calcHeight = $(window).height() - 100;
				$imgs.height( calcHeight )
					 .width('auto');
		   		$modal.find('.modal-dialog').css('width', (prop * calcHeight) + 40 );
		  } else {
		  		var calcWidth = $(window).width() - 300;
				$imgs.width( calcWidth  )
					 .height('auto');
				$modal.find('.modal-dialog').css('width', calcWidth + 40 );
		  }


		});
		


		function destroyAll() {
			if ( $imgs ) {
				$imgs.remove();
				$body.trigger('zoom.destroy');
			}
		}

		$body.append( $imgs );

		$imgs.on('click', function(){
			// akl clickear la imagen del modal, cerrar el modal
			$modal.modal('hide');
		});

		$modal.on('hide.bs.modal', function (e) {
		  destroyAll();
		});

	  	$modal.modal('show');

	  	$body.zoom({url: $imgs.attr('src')});

		return false;
	});
})(jQuery);
