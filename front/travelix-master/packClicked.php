<?php
include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\UserC.php';
session_start();
$userC = new UserC();
if(isset($_SESSION['idUser'])) {
    $user = $userC->RecupererUser($_SESSION['idUser']);
	if($user)
	{
		$username = $user['username'];
		$image = $user['image'];
	} else 
	{
		echo "No user found !!";
	}
} else {
	echo "idUser not setted";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\ReservationC.php';
include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\front\travelix-master\PHPMailer\src\PHPMailer.php';
include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\front\travelix-master\PHPMailer\src\SMTP.php';


$reservation = null ;
$reservationC = new ReservationC();

$errorMessage = "";
$successMessage = "";

$ReservationC = new ReservationC();

// Check if 'Reserver' and 'idL' are set in GET parameters
if (isset($_GET["Reserver"]) && isset($_GET["ID_offre"])) {
    $idOffre = $_GET["ID_offre"];

    // Check if POST data is set
    if (isset($_POST["nombrePlaces"]) &&
        isset($_POST["source"]) &&
        isset($_POST["paiement"])) {

        // Check if POST data is not empty
        if (!empty($_POST["nombrePlaces"]) &&
            !empty($_POST["source"]) &&
            !empty($_POST["paiement"])) {

            // Create Reservation object and add reservation
            $Reservation = new Reservation(
                $_POST['nombrePlaces'], 
                $_POST['source'],
                $_POST['paiement'],
                $idOffre,
                $_SESSION['idUser']
            );
            $ReservationC->AjouterReservation($Reservation);
            
            // Envoi de l'e-mail avec les informations de réservation
 $mail = new PHPMailer(true);

try {
// Paramètres du serveur SMTP Gmail
            $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'najjaaali3@gmail.com'; // Votre adresse Gmail
    $mail->Password = 'cbvf iyvs zpjl ngle'; // Votre mot de passe Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Destinataire et expéditeur
    $mail->setFrom('najjaaali3@gmail.com', 'Wild Wander');
    $mail->addAddress($_POST["email"]);

     // Contenu du message
   $mail->isHTML(true);
$mail->Subject = 'Wild Wander - details of your reservation';

$mail->Body = "
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #555555;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #6a1b9a; /* Couleur violet */
            text-align: center;
            font-weight: bold; /* Texte en gras */
        }
        p {
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 16px; /* Taille de police plus grande */
        }
        .footer {
            text-align: center;
            color: #999999;
            margin-top: 30px;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .accent {
            background-color: #007bff;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
    <div class='container'>
       <center> <h1>HELLO ,</h1></center>
        <p style='text-align: center; color: #6a1b9a; font-weight: bold;'>Here are the details of your reservation:</p>
        <p><span class='highlight'><strong>Number of places :</strong></span> {$_POST['nombrePlaces']}</p>
        <p><span class='highlight'><strong>Reservation source :</strong></span> {$_POST['source']}</p>
        <p><span class='highlight'><strong>Payment method:</strong></span> {$_POST['paiement']}</p>
        <p style='color: #6a1b9a; font-weight: bold; font-size: 18px;'>Thank you for trusting us!!<br>Wild Wander, we offer the best tours.</p>
    </div>
    <p style='font-family: Arial, sans-serif; font-size: 16px; color: #333333; line-height: 1.6;'>
    We are honored to have you at our travel agency to complete the trip procedures.
</p>

    <div class='footer'>
        <p><span class='highlight'><strong>This is an automated email. Please do not reply.</span></strong></p>
    </div>
";

    // Envoi du message
    $mail->send();
    $successMessage = 'Votre e-mail a été envoyé avec succès.';
} 
catch (Exception $e) 
{
     $errorMessage = 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
}
 header("Location: ListReservations.php?successMessage=reservation ajouté avec succès");
 exit();
} 
else {
  $errorMessage = "<label id='form' style='color: red; font-weight: bold;'>&emsp;Une Information manquant !</label>";
     }
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Offers</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travelix Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/offers_styles.css">
<link rel="stylesheet" type="text/css" href="styles/offers_responsive.css">
</head>

<body>
<script>src="js/control.js"</script>

<div class="super_container">
    
    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->

        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="phone">+45 345 3324 56789</div>
                        <div class="social">
                            <ul class="social_list">
                                <li class="social_list_item"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li class="social_list_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="social_list_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="social_list_item"><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                                <li class="social_list_item"><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
                                <li class="social_list_item"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="user_box ml-auto">
						<a href="profile.php?id=<?php echo $_SESSION['idUser']; ?>" class="icon">
							<img src="../../Dashboard/View/back/material-dashboard-master/pages/User/uploads/<?php echo $image; ?>" height="30px" width="30px" style="border-radius: 50%; object-fit: cover;">
							<span class="text text-secondary" style="font-size:20px;">Welcome <?php echo $username; ?> !</span>
						</a>
						<div>
                    </div>
                </div>
            </div>      
        </div>

        <!-- Main Navigation -->

        <nav class="main_nav">
            <div class="container">
                <div class="row">
                    <div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
                        <div class="logo_container">
                            <div class="logo"><a href="#"><img src="images/logo.png" alt=""></a></div>
                        </div>
                        <div class="main_nav_container ml-auto">
                            <ul class="main_nav_list">
                                <li class="main_nav_item"><a href="index.php">home</a></li>
                                <li class="main_nav_item"><a href="about.html">about us</a></li>
                                <li class="main_nav_item"><a href="flights.html">flights</a></li>
                                <li class="main_nav_item"><a href="accomodations.php">accomodations</a></li>
                                <li class="main_nav_item"><a href="pack.php">packs</a></li>
                                <li class="main_nav_item"><a href="blog.php">blogs</a></li>
                                <li class="main_nav_item"><a href="contact.php">contact</a></li>
                                <li class="main_nav_item"><a href="claim.html">claim</a></li>
                            </ul>
                        </div>
                        <div class="content_search ml-lg-0 ml-auto">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            width="17px" height="17px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path class="mag_glass" fill="#FFFFFF" d="M78.438,216.78c0,57.906,22.55,112.343,63.493,153.287c40.945,40.944,95.383,63.494,153.287,63.494
                                            s112.344-22.55,153.287-63.494C489.451,329.123,512,274.686,512,216.78c0-57.904-22.549-112.342-63.494-153.286
                                            C407.563,22.549,353.124,0,295.219,0c-57.904,0-112.342,22.549-153.287,63.494C100.988,104.438,78.439,158.876,78.438,216.78z
                                            M119.804,216.78c0-96.725,78.69-175.416,175.415-175.416s175.418,78.691,175.418,175.416
                                            c0,96.725-78.691,175.416-175.416,175.416C198.495,392.195,119.804,313.505,119.804,216.78z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path class="mag_glass" fill="#FFFFFF" d="M6.057,505.942c4.038,4.039,9.332,6.058,14.625,6.058s10.587-2.019,14.625-6.058L171.268,369.98
                                            c8.076-8.076,8.076-21.172,0-29.248c-8.076-8.078-21.172-8.078-29.249,0L6.057,476.693
                                            C-2.019,484.77-2.019,497.865,6.057,505.942z"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>

                        <form id="search_form" class="search_form bez_1">
                            <input type="search" class="search_content_input bez_1">
                        </form>
                        
                        <div class="hamburger">
                            <i class="fa fa-bars trans_200"></i>
                        </div>
                    </div>
                </div>
            </div>  
        </nav>

    </header>

    <div class="menu trans_500">
        <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
            <div class="menu_close_container"><div class="menu_close"></div></div>
            <div class="logo menu_logo"><a href="#"><img src="images/logo.png" alt=""></a></div>
            <ul>
                <li class="menu_item"><a href="index.html">home</a></li>
                <li class="menu_item"><a href="about.html">about us</a></li>
                <li class="menu_item"><a href="#">offers</a></li>
                <li class="menu_item"><a href="blog.html">news</a></li>
                <li class="menu_item"><a href="contact.html">contact</a></li>
            </ul>
        </div>
    </div>

    <!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/about_background.jpg"></div>
        <div class="home_content">
            <div class="home_title">Our pack</div>
        </div>
    </div>

    <!-- Offers -->

    <div class="offers">

        <!-- Search -->

            <div class="search_inner">

                <!-- Search Contents -->
                
                <div class="container fill_height no-padding">
                    <div class="row fill_height no-margin">
                        <div class="col fill_height no-padding">
                            <center> <h1 class="card-title">New Reservation</h1></center>
                            <br><br><br>
                            <div class="search_panel active">
    <form method="POST" name="form" id="form" enctype="multipart/form-data " onsubmit="return validerres()">
    <div class="search_item">
        <input type="number" id="nombrePlaces" name="nombrePlaces" class="check_in search_input" placeholder="Nombre des Places">
        <div id="nbPlaceError" class="error-message"></div>

    </div>

    <div class="search_item">
        <select class="form-select" id="source" name="source" aria-label="Default select example">
        <option value="Select choice">Select choice</option>
            <option value="Online">Online</option>
            <option value="Mobile">Mobile</option>
            <option value="In-Person">In-Person</option>
        </select>
        <div id="sourceError" class="error-message"></div>

    </div>

    <div class="search_item">
        <select class="form-select" id="paiement" name="paiement" aria-label="Default select example">
        <option value="Select choice">Select choice</option>
            <option value="Espèce">Espèce</option>
            <option value="Carte">Carte</option>
            <option value="Cheque">Cheque</option>
        </select>
        <div id="paiementError" class="error-message"></div>

    </div>

    <div class="search_item">
        <input type="email" id="email" name="email" class="check_in search_input" placeholder="email@gmail.com">
        <div id="emailError" class="error-message"></div>

    </div>

    <button type="submit" id="submit" name="submit" class="button search_button">Réserver<span></span><span></span><span></span></button>
</form>
                            </div>

                            
                            <!-- Search Panel -->

                            
                            
                        </div>
                    </div>
                </div>  
            </div>  
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    
    <!-- Footer -->

    <footer class="footer">
        <div class="container">
            <div class="row">

                <!-- Footer Column -->
                <div class="col-lg-3 footer_column">
                    <div class="footer_col">
                        <div class="footer_content footer_about">
                            <div class="logo_container footer_logo">
                                <div class="logo"><a href="#"><img src="images/logo.png" alt=""></a></div>
                            </div>
                            <p class="footer_about_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis vu lputate eros, iaculis consequat nisl. Nunc et suscipit urna. Integer eleme ntum orci eu vehicula pretium.</p>
                            <ul class="footer_social_list">
                                <li class="footer_social_item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li class="footer_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="footer_social_item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="footer_social_item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li class="footer_social_item"><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Footer Column -->
                <div class="col-lg-3 footer_column">
                    <div class="footer_col">
                        <div class="footer_title">blog posts</div>
                        <div class="footer_content footer_blog">
                            
                            <!-- Footer blog item -->
                            <div class="footer_blog_item clearfix">
                                <div class="footer_blog_image"><img src="images/footer_blog_1.jpg" alt="https://unsplash.com/@avidenov"></div>
                                <div class="footer_blog_content">
                                    <div class="footer_blog_title"><a href="blog.html">Travel with us this year</a></div>
                                    <div class="footer_blog_date">Nov 29, 2017</div>
                                </div>
                            </div>
                            
                            <!-- Footer blog item -->
                            <div class="footer_blog_item clearfix">
                                <div class="footer_blog_image"><img src="images/footer_blog_2.jpg" alt="https://unsplash.com/@deannaritchie"></div>
                                <div class="footer_blog_content">
                                    <div class="footer_blog_title"><a href="blog.html">New destinations for you</a></div>
                                    <div class="footer_blog_date">Nov 29, 2017</div>
                                </div>
                            </div>

                            <!-- Footer blog item -->
                            <div class="footer_blog_item clearfix">
                                <div class="footer_blog_image"><img src="images/footer_blog_3.jpg" alt="https://unsplash.com/@bergeryap87"></div>
                                <div class="footer_blog_content">
                                    <div class="footer_blog_title"><a href="blog.html">Travel with us this year</a></div>
                                    <div class="footer_blog_date">Nov 29, 2017</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Footer Column -->
                <div class="col-lg-3 footer_column">
                    <div class="footer_col">
                        <div class="footer_title">tags</div>
                        <div class="footer_content footer_tags">
                            <ul class="tags_list clearfix">
                                <li class="tag_item"><a href="#">design</a></li>
                                <li class="tag_item"><a href="#">fashion</a></li>
                                <li class="tag_item"><a href="#">music</a></li>
                                <li class="tag_item"><a href="#">video</a></li>
                                <li class="tag_item"><a href="#">party</a></li>
                                <li class="tag_item"><a href="#">photography</a></li>
                                <li class="tag_item"><a href="#">adventure</a></li>
                                <li class="tag_item"><a href="#">travel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Footer Column -->
                <div class="col-lg-3 footer_column">
                    <div class="footer_col">
                        <div class="footer_title">contact info</div>
                        <div class="footer_content footer_contact">
                            <ul class="contact_info_list">
                                <li class="contact_info_item d-flex flex-row">
                                    <div><div class="contact_info_icon"><img src="images/placeholder.svg" alt=""></div></div>
                                    <div class="contact_info_text">4127 Raoul Wallenber 45b-c Gibraltar</div>
                                </li>
                                <li class="contact_info_item d-flex flex-row">
                                    <div><div class="contact_info_icon"><img src="images/phone-call.svg" alt=""></div></div>
                                    <div class="contact_info_text">2556-808-8613</div>
                                </li>
                                <li class="contact_info_item d-flex flex-row">
                                    <div><div class="contact_info_icon"><img src="images/message.svg" alt=""></div></div>
                                    <div class="contact_info_text"><a href="mailto:contactme@gmail.com?Subject=Hello" target="_top">contactme@gmail.com</a></div>
                                </li>
                                <li class="contact_info_item d-flex flex-row">
                                    <div><div class="contact_info_icon"><img src="images/planet-earth.svg" alt=""></div></div>
                                    <div class="contact_info_text"><a href="https://colorlib.com">www.colorlib.com</a></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- Copyright -->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2  ">
                    <div class="copyright_content d-flex flex-row align-items-center">
                        <div><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
                    </div>
                </div>
                <div class="col-lg-9 order-lg-2 order-1">
                    <div class="footer_nav_container d-flex flex-row align-items-center justify-content-lg-end">
                        <div class="footer_nav">
                            <ul class="footer_nav_list">
                                <li class="footer_nav_item"><a href="index.html">home</a></li>
                                <li class="footer_nav_item"><a href="about.html">about us</a></li>
                                <li class="footer_nav_item"><a href="#">offers</a></li>
                                <li class="footer_nav_item"><a href="blog.html">news</a></li>
                                <li class="footer_nav_item"><a href="contact.html">contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/offers_custom.js"></script>
</body>

</html>

<?php 

    $to = $_POST['email'] ;
    $subject = "Reservation information";
    $message = "Number of Places : ".$_POST['nombrePlaces']."\n";
    $message .= "Source : ".$_POST['source']."\n";
    $message .= "Payment Method : ".$_POST['paiement']."\n";
    $message .= "thank you for trusting us \n";
    $message .= "Wild Wander , We have the best tours \n ";
    $headers = "From: najjaaali3@gmail.com" . "\r\n" .
    "CC: najjaaali3@gmail.com" .$_POST['email'] ;

    mail($to, $subject, $message, $headers);
 
?>
