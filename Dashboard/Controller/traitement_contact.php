<?php
include_once 'C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Controller/gestion_contact.php';



$error = "";

// create reclamation
$contact = null;

$curentDate= date('Y-m-d H:i:s');


// create an instance of the controller
$contact_gestion = new contact_gestion();
if (  isset($_POST["idUser"]) && isset($_POST["sujet"]) && isset($_POST["message"])) 
{
    if (  (!empty($_POST['idUser']) &&  !empty($_POST["sujet"]) && !empty($_POST["message"])) )
     {
        $contact = new contact(null,$_POST['idUser'],new DateTime($curentDate) ,$_POST['sujet'] , $_POST['message'] ); 
        $contact_gestion->addcontact($contact);
        

        $client =  $contact_gestion->showClient($_POST["idUser"])  ; 

        

    } else
        {$error = "Missing information";
         echo $error ; }

}


?>





<!---------------------- YIB3AF MAIL IL USER -------------------------------------------->


<!-- YIB3AF MAILLLL -->

<?php

//Import PHPMailer classes into the global namespace
//hese must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php' ; 
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["idUser"]) && isset($_POST["sujet"]) && isset($_POST["message"])) 
{
    if (!empty($_POST['idUser']) &&  (!empty($_POST["sujet"]) && !empty($_POST["message"])) )
     {

$nom = $client['username'] ; 
$email1 = $client['email'] ; 

$suijet = $_POST['sujet'] ; 
$textarea = $_POST['message'] ;


  

$message1 = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            background-image: url("https://www.cap-voyage.com/wp-content/uploads/2019/05/Fotolia-79030524-Subscription-Monthly-M-1-e1481143505131.jpg");

        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
        }

        .content {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://www.cap-voyage.com/wp-content/uploads/2019/05/Fotolia-79030524-Subscription-Monthly-M-1-e1481143505131.jpg" alt="Logo">
        </div>
        <div class="content">
            <h2></h2>
            <p> ' . $suijet . '.</p>
            <p>Bienvenue,Je suis  ' . $nom . '.</p>
            <p>Bien que j apprécie vos services, je suis contraint(e) de soumettre une reclamation concernant  ' . $textarea . '.</p>
            <p>Jespère que vous pourrez resoudre cette situation rapidement et efficacement."</p>
        </div>
    </div>
</body>
</html>
';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ranimzavis5678@gmail.com';                     //SMTP username
    $mail->Password   = 'jlhnzxhogdzlhzjj';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



    $mail3 = 'ranimzavis5678@gmail.com' ; 
    //Recipients
    $mail->setFrom('rannimchaffar@esprit.tn', 'Reclamation');
    $mail->addAddress($mail3);     //Add a recipient
 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reclamation ';
    $mail->Body    = $message1 ;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    
    $mail->send();








    

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email Sent</title>
        <style>
            body {
                background: linear-gradient(to right, #FF6500, #AD88C6); /* Gradient between two colors */
            }
    
            body, html {
                height: 100%;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
    
            .container {
                text-align: center;
            }
    
            .animate {
                display: inline-block;
                animation: pulse 1s infinite;
            }
    
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }
    
            .success-message {
                font-size: 2em;
                color: green;
                display: none;
            }
    
            .success-message.show {
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <p class="animate">1 2 3</p>
            <p class="success-message">Email sent successfully</p>
        </div>
    
        <script>
            // JavaScript to show the success message after animation completes
            setTimeout(function() {
                document.querySelector(\'.success-message\').classList.add(\'show\');
                setTimeout(function() {
                    window.location.href = "http://localhost/ali&yossra/ali&yossra/UserManagment/front/travelix-master/contact.php"; // Redirect URL
                    
                    
                    
                }, 3000); // Adjust the delay (in milliseconds) as needed
            }, 3000); // Adjust the delay (in milliseconds) as needed
        </script>
    </body>
    </html>';
    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

     }
   }


?>





