<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	//get smtp infos from data.json
	$data = file_get_contents('../phpmailer/data.json');
	$json = json_decode($data, true);

	//Server settings
	$mail->SMTPDebug = 0; //0 = off (for production use, No debug messages) debugging: 1 = errors and messages, 2 = messages only
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                // Enable verbose debug output
	$mail->isSMTP();                                      // Send using SMTP
	$mail->Host       = $json['host'];                    // Set the SMTP server to send through
	$mail->SMTPAuth   = true;                             // Enable SMTP authentication
	$mail->Username   = $json['user'];                    // SMTP username
	$mail->Password   = $json['password'];                // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mail->Port       = $json['port'];                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	//Recipients
	$mail->setFrom($json['user'], explode('@', $json['user'])[0]);
	$toMail = str_replace(' ', '', $to);
	$toMail = explode(';', $toMail);
	foreach ($toMail as $a){
		$mail->addAddress($a);     		              // Add a recipient
	}
	//$mail->addAddress('ellen@example.com');             // Name is optional
	$mail->addReplyTo($json['user'], explode('@', $json['user'])[0]);
	if (strlen($cc)>5){
		$ccMail = str_replace(' ', '', $cc);
		$ccMail = explode(';', $ccMail);
		foreach ($ccMail as $c){
			$mail->addCC($c);                   //add cc
		}
	}
	if (strlen($cci)>5){
		$cciMail = str_replace(' ', '', $cci);
		$cciMail = explode(';', $cciMail);
		foreach ($cciMail as $i){
			$mail->addBCC($i);                   //add bcc
		}
	}

	// Attachments
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	
	// Content
	$body = htmlspecialchars_decode($mess);
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = $obj;
	$mail->Body    = $body;
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$infos = $mail->send();
	echo 'Votre mail a été envoyé avec succès !';
} catch (Exception $e) {
	echo "Impossible d'envoyer le mail. Mailer Error: {$mail->ErrorInfo}";
}