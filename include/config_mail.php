<?php 
$mail->CharSet = 'UTF-8';  
	
$mail->IsSMTP();                                      // Set mailer to use SMTP

/*$mail->Host = 'evop28.areserver.net';                 // Specify main and backup server
$mail->Port = 465;                                    // Set the SMTP port*/

$mail->Host = 'mail.samlisten.com';                 // Specify main and backup server
$mail->Port = 25;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@samlisten.com';                // SMTP username
$mail->Password = 'aLEGRIASS013132';                  // SMTP password
$mail->SMTPSecure = 'tls';
?>