<script type="text/javascript">
jQuery(function($){
	/***************************
	Form Votos
	*****************************/
	if($("#form_votos").length!=0){

        $("#form_votos").submit(function (e) {

            e.preventDefault();
			
			var enviarVotos = "false",
			v_Bot1 = "true",
			v_Bot2 = "true";

            var v_spam_textbox1 = $("#form_val_v_1").val(),
            v_spam_textbox2 = $("#form_val_v_2").val(),
			voto_cancion_id = $("#voto_cancion_id").val(),
            voto_cancion = $('input[name="voto_cancion"]:checked').val();

			if (v_spam_textbox1.length == 0 ){
				var v_Bot1 = "false";
			}
			if (v_spam_textbox2 == "https://" ){
				var v_Bot2 = "false";
			}
            if ($('input[name="voto_cancion"]').is(':checked')) {
				enviarVotos = "true";
            }
						
			
			if(enviarVotos == "true" && v_Bot1 == "false" && v_Bot2 == "false"){
				 var datos = {
						"voto_cancion_id" : voto_cancion_id,
						"voto_cancion" : voto_cancion
				 };
			 
				 $.ajax({
						 data: datos,
						url: 'assets/php/submit_votos.php',
						type: 'post',
						beforeSend: function () {
							$('#div_votar').html('Estamos registrando tu voto.').slideDown();
						 },
						 success: function (reponse) {
							 $('#div_votar').html(reponse).slideDown();
						 },
						error: function(){
							$('#div_votar').html('Gracias por tu voto.').slideDown();
						}
				 });
				 return false;
			}

        });

    }
	
});
</script> 