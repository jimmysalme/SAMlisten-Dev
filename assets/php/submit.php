<?php
/*$your_email="info@samlisten.com";

if(!empty($_POST))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	$_subject=$_POST['subject'];
	
	$to      = $your_email;
	$subject = 'Contáctenos: '.$_subject;
	$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
	$message = $name.' sent you a message via the contact form :'."\r\n".$message;
	
	mail($to, $subject, $message, $headers);
}
*/
?>

<?php 
if (!empty($_POST)) {
	require_once $_SERVER['DOCUMENT_ROOT']."/include_class_db/config.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/include/class.phpmailer.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/include/class.smtp.php";

	$name=$_POST['name'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	$_subject=$_POST['subject'];
  
  	$text_courriel = "<p><em>Mensaje enviado desde el formulario de contacto SAMlisten.com</em></p>";
								
  	$mail = new PHPMailer;

	//Definimos las propiedades y llamamos a los métodos 
	//correspondientes del objeto mail
	
	//Con PluginDir le indicamos a la clase phpmailer donde se 
	//encuentra la clase smtp que como he comentado al principio de 
	//este ejemplo va a estar en el subdirectorio includes
	$mail->PluginDir = "include/";

	require_once $_SERVER['DOCUMENT_ROOT']."/include/config_mail.php";
	
	$mail->From = $_POST['email'];
	$mail->FromName = $_POST['name'];
	
	//$mail->AddAddress('mic@webtotal.ca', 'Michel Lapointe'); 
	$mail->AddAddress('info@samlisten.com', 'SAMlisten.com');
	//$mail->AddAddress($email, $prenom." ".$nom);
	
	
	$mail->IsHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = "SAMlisten.com: ".$_POST['subject'];
	
	
	$mail->Body = "<p>Mensaje enviado desde el formulario de contacto SAMlisten.com</p>
	<p>
	<strong>Nombre: </strong>".$_POST['name']."<br>
	<strong>Email: </strong>".$_POST['email']."<br>
	<strong>Asunto: </strong>".$_POST['subject']."
	</p>
	<p><strong>Mensaje: </strong><br>".$_POST['message']."</p>";
			
	$mail->AltBody = "Para leer el mensaje, por favor utilice un gestor de correo compatible con HTML.";
	
	if(!$mail->Send()) {
	   //echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	}
	else {
		/*echo "<p>Nous vous avons envoyé dans votre courriel les informations pertinentes afin de valider votre paiement. Merci d'avoir choisi Viva Plein Air.</p>";
		echo "<p><a href=\"".WEB_SITE."\">Cliquez ici</a> pour retourner à la page d'accueil.</p>";*/
		exit;
	}
}
else {
	echo "Acceso denegado";	
}
?>