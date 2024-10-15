<?php



require 'vendor/autoload.php'; // Include PHPMailer library



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;






error_reporting(E_ALL);
ini_set('display_errors', 1);
// Retrieve form data

$senderEmail = $_POST['sender_email'];
$receiverEmail = $_POST['receiver_email'];
$emailSubject = $_POST['email_subject'];
$emailMessage = $_POST['email_message'];

// Validate input (you can add more validation as needed)





$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Your SMTP server hostname
    $mail->SMTPAuth = true;
    $mail->Username = 'arayen138@gmail.com'; // Your SMTP username
    $mail->Password = 'MolkaBou25'; // Your SMTP password
    $mail->SMTPSecure = 'tls'; // Use 'tls' or 'ssl'
    $mail->Port = 587; // SMTP port (usually 587 for TLS)
    $mail->SMTPDebug = 2; // Set to 2 for maximum debugging output

    // Email content
    $mail->setFrom($senderEmail,'Admin');
    $mail->addAddress($receiverEmail, 'guest');
    $mail->Subject = $emailSubject; 
    $mail->Body = $emailMessage;
    // Send the email
    $mail->send();
    echo 'Email sent successfully!';

} catch (Exception $e) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
?>

