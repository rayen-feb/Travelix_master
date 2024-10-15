<?php  
  
  include '../../controller/reservationC.php';
  include '../../model/reservation.php';

  require 'vendor/autoload.php'; // Include the Composer autoloader

   
      $error = "";
     $message ="";
    // create user
     
    // create an instance of the controller
      $reservationC = new reservationC();   
      $imageReal = "";
	
     
   if (isset($_POST["id_RES"]) && 
   isset($_POST["id_vol"]) && 
   isset($_POST["date_reservation_vol"]) &&
    isset($_POST["nb_place"])  

	  ) 
    {
        if (!empty($_POST["id_RES"]) &&
        !empty($_POST["id_vol"]) &&
		!empty($_POST["date_reservation_vol"])&&
         !empty($_POST["nb_place"]) 
         
		
 )    
             {
               
                $reservation = new reservation($_POST['id_RES'], $_POST['id_vol'], $_POST['date_reservation_vol'], $_POST['nb_place']);
              //  $volC->modifier_vol($vol);
				//header('Location: ../../back/material-dashboard-master/pages/flight.php');
                         
           }
        else
       $error = "Missing information";
    }
   

?>







<html lang="en">
<head>
<title>Contact</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travelix Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>

</head>

<body>

<div class="super_container">
	
	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="phone">+45 345 3324 56789</div>
						
						<div class="blog_box ml-auto">
							<div class="icon" ><img src="images/blog.png" alt=""></div>
						</div>
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

					</div>
				</div>
			</div>	
		</nav>

	</header>

	

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/contact_background.jpg"></div>
		<div class="home_content">
			<div class="home_title">reservation </div>
		</div>
	</div>
	<?php
      if (isset($_POST['id_vol'])){

        $reservation= $reservationC->RecupererReservation($_POST['id_vol']);
       
    ?>
<?php
if ($reservation['id_RES'] == 0) {
    echo "<script type='text/javascript'>
            alert('No valid reservation');
            var button1 = confirm('Do you want add a  new  one ?');
            if (button1) {
                window.location.href ='../../../../front/travelix-master/ajouterReservation.php' ;
            } else {
                window.location.href = 'flight.php';
            }
          </script>";
}
?>


	<!-- Contact -->

	<div class="contact_form_section">
		<div class="container">
			<div class="row">
				<div class="col">

					<!-- Contact Form -->
					<td>
                         <form method="POST" action="vol/AfficherVol.php">
							
                           <input  type="hidden" name="id"   value="<?PHP echo $vol['id']; ?>"   >
                         <input type="submit" name="afficher" value="show vol "    class="btn btn-primary"  >
                            </form>
                        </td>


					<div class="contact_form_container">
    <div class="contact_title text-center">reservation</div>

	<form method="POST" enctype="multipart/form-data" id="contact_form" action="confirm.php" class="contact_form text-center">
    <input readonly type="text" id="id_RES" name="id_RES" class="contact_form_subject input_field" value="ID Reservation: <?php echo $reservation['id_RES'];?>" placeholder="ID Reservation" required="required">
    <input  readonly type="text" id="id_vol" name="id_vol" class="contact_form_subject input_field" value="ID Vol: <?php echo $reservation['id_vol'];?>" placeholder="ID Vol" required="required">
    <input  readonly type="text" id="date_reservation_vol" name="date_reservation_vol" class="contact_form_subject input_field" value="Date Reservation Vol: <?php echo $reservation['date_reservation_vol'];?>" placeholder="Date Reservation Vol" required="required">
    <input  readonly type="text" id="nb_place" name="nb_place" class="contact_form_subject input_field" value="Nombre  Place: <?php echo $reservation['nb_place'];?>" placeholder="Nb Place" required="required">

    <button type="submit" name="confirm" id="submit" class="form_submit_button button trans_200">Confirm Reservation</button>
	<span></span><span></span><span></span></button>









								
				<button type="button" name="cancel_reservation" id="submit"
                class="form_submit_button button trans_200"
                onclick="cancel()">cancel  Reservation</button>

				echo "<a href='".$urlQRCode."' download='QRcode/monCodeQR.png'>Télécharger le QR Code</a>";






		
    </form>
	
	


	







	
    <script>
        function showConfirmationAndRedirect() {
            // Show a confirmation prompt
            const confirmationMessage = "Send a confirmation email to the client?";
            if (confirm(confirmationMessage)) {
                // If user confirms, redirect to confirm.php
                window.location.href = "confirm.php";
            } else {
                // If user cancels, do nothing
                alert("Reservation not confirmed.");
            }
        }
    </script>



<script>
        function cancel() {
            // Show a confirmation prompt
            const confirmationMessage = "Send a cancelation email to the client?";
            if (confirm(confirmationMessage)) {
                // If user confirms, redirect to confirm.php
                window.location.href = "cancel.php";
            } else {
                // If user cancels, do nothing
                alert("Reservation not confirmed.");
            }
        }
    </script>






</div>
						




<script>
function showCancellationMessage() {
    // Show a confirmation prompt
    const confirmationMessage = "Send an email to the client to cancel the reservation?";
    if (confirm(confirmationMessage)) {
		action="cancelReservation.php"
        // If user confirms, proceed with sending the cancellation email
        // You can add your email sending logic here
        alert("Cancellation email sent!");
    } else {
        // If user cancels, do nothing
        alert("Reservation not canceled.");
    }
}
</script>







							

						

						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php 
   } 
?>

	<!-- About -->
	
	<!-- Google Map -->
		
	
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
						
						<div class="footer_content footer_blog">

						<div id="qrcode"></div>

							
							
						</div>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="col-lg-3 footer_column">
					<div class="footer_col">
						
					</div>
				</div>

				<!-- Footer Column -->
				<div class="col-lg-3 footer_column">
					<div class="footer_col">
						
						
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
								<li class="footer_nav_item"><a href="flights.html">offers</a></li>
								<li class="footer_nav_item"><a href="blog.php">news</a></li>
								<li class="footer_nav_item"><a href="#">contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script src="https://unpkg.com/html5-qrcode"></script>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="js/contact_custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>


</body>

</html>