jQuery(function($){
	$(function(){

		/*====================================================================
		Barra fija top
		===================================================================*/
		function fnBarFixed(){
			var barraPlayer = $('#barra-player');
			var alturaBarraPlayer = barraPlayer.outerHeight();
			var posicionBarraPlayer = ($('#bg_principal').outerHeight(true))-alturaBarraPlayer;
	    $(window).on('scroll', function(){
	        if( $(window).scrollTop() > posicionBarraPlayer ) {
							barraPlayer.parent().addClass('is-sticky');
							barraPlayer.addClass('fixed');
	        } else {
							barraPlayer.parent().removeClass('is-sticky');
	            barraPlayer.removeClass('fixed');
	        }
	    });
	  }
		if ($('#barra-player').length) {
			fnBarFixed();
		}
	  $(window).resize(function(){
			if ($('#barra-player').length) {
				fnBarFixed();
			}
	  });
	});
});
