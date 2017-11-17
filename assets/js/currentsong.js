jQuery(function($){
/*====================================================================
Recargar API "Currentsong"
===================================================================*/
	$(function(){
		var callmeback = $("input#callmeback").val();
		var interval = setInterval(function(){get_feedback();}, callmeback);
		
		function get_feedback(){
			var callmeback 			= $("input#callmeback").val();
			var centova 			= $("input#centova").val();
			var titulo 				= $("input#titulo").val();
			var artista 			= $("input#artista").val();
			var app_id_fb_canal		= $("input#app_id_fb_canal").val();
			var descripcion_canal	= $("input#descripcion_canal").val();
			
			var datos = {
				"centova" 				: centova,
				"titulo" 				: titulo,
				"artista" 				: artista,
				"app_id_fb_canal" 		: app_id_fb_canal,
				"descripcion_canal" 	: descripcion_canal
			 };
			$.ajax({
				data:  datos,
				type: "POST",
				url: "api_contenido.php",
				async: false, 
				success: function(response) {
					$('#qr').html( $(response).filter('#qr_reponse').html() );
					
					$('#callmeback_start').html( $(response).filter('#callmeback_start_reponse').html());
					
					var callmeback_start = $("#callmeback_start_input").val();
					
					if (callmeback_start == 1 || callmeback_start == "1") {
						$(".modal-backdrop.fade.in").remove();
						
						$('#js_bg_principal').fadeOut(400, function()	{
							$('#js_bg_principal').html( $(response).filter('#js_bg_principal_reponse').html() ).fadeIn(400);
						});
						
						$('#cover_h4').fadeOut(400, function()	{
							$('#cover_h4').html( $(response).filter('#cover_h4_reponse').html() ).fadeIn(400);
						});
						
						$('#cover_h5').fadeOut(400, function()	{
							$('#cover_h5').html( $(response).filter('#cover_h5_reponse').html() ).fadeIn(400);
						});
						
						
						$('#rouge_menu').fadeOut(400, function()	{
							$('#rouge_menu').html( $(response).filter('#rouge_menu_reponse').html() ).fadeIn(400);
						});
						
						$('#rouge_menu').fadeOut(400, function()	{
							$('#rouge_menu').html( $(response).filter('#rouge_menu_reponse').html() ).fadeIn(400);
						});
						
						$('#tit_letra').fadeOut(400, function()	{
							$('#tit_letra').html( $(response).filter('#tit_letra_reponse').html() ).fadeIn(400);
						});
						
						$('#art_letra').fadeOut(400, function()	{
							$('#art_letra').html( $(response).filter('#art_letra_reponse').html() ).fadeIn(400);
						});
						
						$('#letra').fadeOut(400, function()	{
							$('#letra').html( $(response).filter('#letra_reponse').html() ).fadeIn(400);
						});
						
						$('#img_letra').fadeOut(400, function()	{
							$('#img_letra').html( $(response).filter('#img_letra_reponse').html() ).fadeIn(400);
						});
						
						$('#recientes').fadeOut(400, function()	{
							$('#recientes').html( $(response).filter('#recientes_reponse').html() ).fadeIn(400);
						});
					}
				} ,
				error: function(){
					alert("Error al cargar la página. Refresca tu navegador para intentarlo de nuevo.");
				}
			}).complete(function(){
				if (interval != 0 || interval !== 0) {
					clearInterval(interval);
					interval = 0;
				}
				var callmeback2 = $("input#callmeback").val();
				setTimeout(function(){get_feedback();}, callmeback2);
			}).responseText;
		}
	});

});



