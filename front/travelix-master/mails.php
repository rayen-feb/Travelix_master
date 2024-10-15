<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'medsadek98@gmail.com';
    $mail->Password   = 'nyagzjyxkccmbduo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('medsadek98@gmail.com', 'Mailer');
    $mail->addAddress('savana.artsandcrafts@gmail.com', 'Joe User');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<!DOCTYPE html>
<html>
<head>
	<title>Your Email Title</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f6f6f6;
		}
		.email-container {
			width: 600px;
			margin: 0 auto;
			background-color: #ffffff;
			padding: 20px;
			box-sizing: border-box;
		}
		.header {
			background:linear-gradient(to right, #fa9e1b, #8d4fff, #fa9e1b);
			color: #ffffff;
			padding: 10px;
			text-align: center;
			font-size: 24px;
		}
		.content {
			margin-top: 50px;
			margin-bottom: 50px;
		}
		.footer {
			background:linear-gradient(to right, #fa9e1b, #8d4fff, #fa9e1b);
			color: #ffffff;
			text-align: center;
			padding: 10px;
			font-size: 14px;
		}
	</style>
</head>
<body>
<div class="email-container">
	<div class="header">
		payment status
	</div>
	<div class="content" style="text-align: center">
	payment recived successfully
	</div>
	<div class="footer">
		thank you for your payment
	</div>
</div>
</body>
</html>

';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header("Location:" . 'reservation.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
