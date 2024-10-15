<?php
include '../../Dashboard/Controller/volC.php';
include '../../Dashboard/Controller/reservationC.php';
include '../../Dashboard/model/reservation.php';
session_start();
$error = "";
$valid=0;
// create user
$tri="" ; 
$token=$_GET['token'] ?? null;
$volC = new volC();
$reservationC = new reservationC()  ;
//$reservation = new reservation() ; 
$tab = $volC->listVols();






if (		
    isset($_POST["id_user"]) 
    
){
    if ( !empty($_POST["id_user"]) 
      
    )  {
		$reservation =$reservationC->getbyid($_POST["id_user"]);
		$reservationC->showResrvation($id_user) ;
		
    } else {
		$errorMessage = "<label id = 'form' style = 'color: red; font-weight: bold;'>&emsp;Une Information manquant !</label>   ";

    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title> VOLS </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travelix Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/offers_styles.css">
<link rel="stylesheet" type="text/css" href="styles/offers_responsive.css">
<link rel="stylesheet" href="css/plugins.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
   
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
    }

    .blog_post {
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        margin: 40px;
        padding: 20px;
		padding: 20px 40px; /* More padding for a larger button */
    width: 1000px; /* Longer button */

		
    }

    .blog_post_title {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .blog_post_meta {
        color: #666;
        margin-bottom: 10px;
    }

    .blog_post_text {
        line-height: 1.6;
    }

    .blog_post_link {
        margin-top: 15px;
    }

    .blog_post_link a {
        color: #007bff;
        text-decoration: none;
    }

    .blog_post_link a:hover {
        text-decoration: underline;
    }
	




    .blog_post_date {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #007bff;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .blog_post_day {
        font-size: 20px;
        font-weight: bold;
    }

    .blog_post_month {
        font-size: 16px;
    }
	.button {
		font-size: 20px; /* Larger font size */
		padding: 20px 40px; /* More padding for a larger button */
    width: 300px; /* Longer button */
    display: inline-block;
    height: 100px;


    background-color: #007bff;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
	padding: 20px 40px; /* More padding for a larger button */
    width: 800px; /* Longer button */

}
.button_1 {
		font-size: 10px; /* Larger font size */
		padding: 20px 40px; /* More padding for a larger button */
    width: 50px; /* Longer button */
    display: inline-block;
    height: 10px;


    background-color: #007bff;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
	padding: 20px 40px; /* More padding for a larger button */
    width: 235px; /* Longer button */

}
.center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 20vh;
    flex-direction: column;
}

.space {
    margin: 4em 0;
}
	
    

.button:hover {
    background-color: #0056b3;
}

/* Transparent button style */
.trans_button {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
}


.trans_button:hover {
    background-color: rgba(0, 123, 255, 0.1);
}
</style>

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
							<div class="icon" ><img src="images/user.png" alt=""></div>
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
						<div class="main_nav_container ml-auto">
							<ul class="main_nav_list">
								<li class="main_nav_item"><a href="index.html">home</a></li>
								<li class="main_nav_item"><a href="about.html">about us</a></li>
								<li class="main_nav_item"><a href="flights.html">flights</a></li>
								<li class="main_nav_item"><a href="reservations.php">reservations</a></li>

								<li class="main_nav_item"><a href="accomodations.html">accomodations</a></li>
								<li class="main_nav_item"><a href="pack.html">packs</a></li>
								<li class="main_nav_item"><a href="blog.html">blogs</a></li>
								<li class="main_nav_item"><a href="contact.html">contact</a></li>
								<li class="main_nav_item"><a href="claim.html">claim</a></li>
							</ul>
						</div>
						
						
						
						<li class="menu_item"><a href="">search for reservation </a></li>
						<div class="content_search ml-lg-0 ml-	auto"> 
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0px"
							width="50px" height="50px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
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

						



				
						
						
						<form id="search_form"  action="AfficherVol.php"    method="POST" name="form"  placeholder="id user "class="search_form bez_1">
							<input type="number"  name="id" value="<?PHP echo $vol['id']; ?>"  class="search_content_input  bez_1">
							<button type="submit"  name="modifier"  value="search" id="submit" class="form_submit_button button_1 trans_200"  >search<span></span><span></span><span></span></button>
                             
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
				<li class="menu_item"><a href="reservation.php">reservation</a></li>
				<li class="menu_item"><a href="contact.html">contact</a></li>
			</ul>
		</div>
	</div>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/about_background.jpg"></div>
		<div class="home_content">
			<div class="home_title"> the  flights </div>
		</div>
	</div>

	<div class="center">
    <div class="space"></div>





	
	<a  href="flights.php"><button class="button_1 ">return </button></a>
	<div class="space"></div>
</div>






<!--tri   -->






	

	<!-- flights -->

	<div class="blog">
		
		<?php
		if (isset($_GET['sort'])) {
			$sortOrder = $_GET['sort'];
			$tab = $volC->listVol($sortOrder);}
	
	
		
		
	
							foreach ($tab as $flight) {
								echo '<div class="container">
								<div class="row">
					
									<!-- flight content  -->
					
									<div class="col-lg-8">
										
										
										<div class="blog_post">
											<div class="blog_post_date d-flex flex-column align-items-center justify-content-center">
													</div><br><br><br><br>
											<div class="blog_post_title">company:'.$flight['company'].'</div>
											<div class="blog_post_meta">departure city :'.$flight['departure_city'].' </div>
											<div class="blog_post_meta">destination city :'.$flight['destination_city'].' </div>
											<div class="blog_post_meta">check in :'.$flight['check_in'].'  </div>
											<div class="blog_post_meta">check out :'.$flight['check_out'].'  </div>
											<div class="blog_post_meta">adults number :'.$flight['adults_1'].'  </div>
											<div class="blog_post_meta">children number :'.$flight['children_1'].'  </div>
											<div class="blog_post_meta">amount :'.$flight['amount'].' </div>
											<div class="blog_post_meta">id :'.$flight['id'].' </div>
	
	
											<div class="blog_post_link"><a href="modifierVol.php?id='.$flight['id'].'">update</a></div>
											<div class="blog_post_link"><a href="supprimerVol.php?id='.$flight['id'].'">delete</a></div>
										</div>
									<!-- Blog Sidebar -->
									</div>
									</div>
									</div>';
							}
						?>
				</div>
	
	
	
	
</div>
		</div>
	</div>

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
						<div class="footer_title">flight  post </div>
						<div class="footer_content footer_blog">
							
							<!-- Footer blog item -->
							<div class="footer_blog_item clearfix">
								<div class="footer_blog_image"><img src="images/footer_blog_1.jpg" alt="https://unsplash.com/@avidenov"></div>
								<div class="footer_blog_content">
									<div class="footer_blog_title"><a href="flights.html">Travel with us this year</a></div>
									<div class="footer_blog_date">Nov 29, 2017</div>
								</div>
							</div>
							
							<!-- Footer blog item -->
							<div class="footer_blog_item clearfix">
								<div class="footer_blog_image"><img src="images/footer_blog_2.jpg" alt="https://unsplash.com/@deannaritchie"></div>
								<div class="footer_blog_content">
									<div class="footer_blog_title"><a href="flights">New destinations for you</a></div>
									<div class="footer_blog_date">Nov 29, 2017</div>
								</div>
							</div>

							<!-- Footer blog item -->
							<div class="footer_blog_item clearfix">
								<div class="footer_blog_image"><img src="images/footer_blog_3.jpg" alt="https://unsplash.com/@bergeryap87"></div>
								<div class="footer_blog_content">
									<div class="footer_blog_title"><a href="flights.html">Travel with us this year</a></div>
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
								<li class="footer_nav_item"><a href="flights.php">flights</a></li>
								<li class="footer_nav_item"><a href="reservation.php">reservation</a></li>
								<li class="footer_nav_item"><a href="#">news</a></li>
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
<script src="plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/blog_custom.js"></script>
<!-- Load the client component. --> 
<script src="https://js.braintreegateway.com/web/3.101.3/js/client.min.js"></script> 
 <!-- Load the PayPal Checkout component. --> 
 <script src="https://js.braintreegateway.com/web/3.101.3/js/paypal-checkout.min.js"></script>

</body>

</html> 


