<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	//Server settings
	$mail->SMTPDebug = SMTP::DEBUG_OFF;                    //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'c1961260.ferozo.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'info@baireschef.com';                     //SMTP username
	$mail->Password   = 'Wumo9@Q3mJ';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom('info@baireschef.com', 'BairesChef');
	$mail->addAddress('melasudacompletamente@gmail.com', 'Joe User');     //Add a recipient

	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'Detalles de venta (PRUEBA)';
	$body = $_SESSION["sesion"]["nombre"].' ha comprado '.$_SESSION["sesion"]["productos"]. "<br> La dirección es: ";
	$mail->Body    = $body . $_SESSION["sesion"]["direccion"] . ".<br>Su teléfono es " . $_SESSION["sesion"]["telefono"];
	// $mail->Body    = $body . "<br>El código de venta es: " . $_GET["payment_id"];

	$mail->send();
	} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
?>