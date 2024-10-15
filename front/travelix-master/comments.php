<?php
include 'C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Controller/blogC.php';

include 'C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Controller/UserC.php';
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

$commentsForPage = [];
$totalPages = 3; 

$id = $_GET["blogid"] ?? null;
$token = $_GET['token'] ?? null;

// Define and initialize $currentPage
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Include the profanity filter function
function filterProfanity($text) {
    $apiKey = 'eRbd98L/mQV/7CpS4GMwaQ==28LR7fFavNEWX3Qn'; // Replace 'YOUR_API_KEY' with your actual API key
    $url = 'https://api.api-ninjas.com/v1/profanityfilter?text=' . urlencode($text);
    $headers = array(
        'X-Api-Key: ' . $apiKey
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);

    if ($result && isset($result['censored'])) {
        return $result['censored'];
    } else {
        return $text; // Return original text if filtering fails
    }
}

if ($id !== null) {
    $commentsC = new commentsC();
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : '';

    if (!empty($search) && !empty($search_type)) {
        // Filter search parameters for profanity
        $filteredSearch = filterProfanity($search);
        $filteredSearchType = filterProfanity($search_type);

        // Fetch filtered comments based on blog ID, filtered search criteria, and type
        $tab = $commentsC->searchCommentsByBlogID($id, $filteredSearch, $filteredSearchType);

        if (empty($tab)) {
            echo "No comments found matching your search criteria.";
        }
    } else {
        // Fetch all comments if no search parameters are set
        $tab = $commentsC->listComments($id);
    }

    // Calculate total pages for pagination
    $totalComments = count($tab);
    $itemsPerPage = 3; // Set your desired items per page here
    $totalPages = ceil($totalComments / $itemsPerPage);

    // Calculate offset for current page
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Fetch comments for current page
    $commentsForPage = array_slice($tab, $offset, $itemsPerPage);
} else {
    // Handle the case where the blog ID is not provided
    echo "Error: Blog ID is missing.";
}
?>



<!DOCTYPE html>
 <html lang="en">
 <head>
 <title>Comments</title>
 <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travelix Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="styles/blog_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/offers_styles.css">
<link rel="stylesheet" type="text/css" href="styles/offers_responsive.css">

<style>
  /* Updated Blog Post Styling */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
}

.blog_post {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-bottom: 40px;
}

.blog_post_title {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

.blog_post_meta {
    color: #666;
    margin-bottom: 15px;
}

.blog_post_text {
    color: #444;
    line-height: 1.8;
    margin-bottom: 20px;
}

.blog_post_link a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog_post_link a:hover {
    color: #0056b3;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #45a049;
}


.trans_button {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
}

.trans_button:hover {
    background-color: rgba(0, 123, 255, 0.1);
}

/* Pagination Styles */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    color: #fff;
    text-decoration: none;
    padding: 10px 15px;
    margin: 0 5px;
    border-radius: 25px;
    background-color: purple;
    border: 2px solid purple;
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

.pagination a:hover:not(.active) {
    background-color: cyan;
    border-color: cyan;
}

.pagination .active {
    background-color: orange;
    border-color: orange;
}

.pagination .prev,
.pagination .next {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: purple;
    border: 2px solid purple;
    color: #fff;
    font-size: 20px;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.pagination .prev:hover,
.pagination .next:hover {
    background-color: cyan;
    border-color: cyan;
    cursor: pointer;
}

.pagination .prev {
    margin-right: 10px;
}

/* Updated Search Panel Styles */
.search-panel {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    background-color: transparent;
    border: none; 
    padding: 0; 
    box-shadow: none;
}

.search-input-container {
    flex-grow: 1;
    margin-right: 10px;
}

.search-form {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    background-color: #f9f9f9;
}

.search-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

.search-button {
    padding: 8px 15px;
    margin-left: 10px;
    background-color: purple;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    outline: none;
}

.search-button:hover {
    background-color: cyan;
    color: white;
}

.search-options,
.search-input-container,
.search-button {
    display: inline-block;
    vertical-align: middle;
}
/* Purple Button Styles */
.purple_button {
	padding: 8px 15px;
    background-color: purple;
    color: white;
}

.purple_button:hover {
    background-color: cyan;
    color: white;
}

.text_to_speech_btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 16px;
        display: inline-block;
        position: relative;
    }

    .text_to_speech_btn::before {
        content: "\1F508"; /* Unicode for speaker icon */
        font-family: Arial, sans-serif;
        font-size: 24px;
        position: absolute;
        left: 0px; /* Adjust the position of the icon */
        top: 50%;
        transform: translateY(-50%);
    }

    #blog_audio {
        display: none;
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
								<li class="main_nav_item"><a href="index.html">home</a></li>
								<li class="main_nav_item"><a href="about.html">about us</a></li>
								<li class="main_nav_item"><a href="flights.html">flights</a></li>
								<li class="main_nav_item"><a href="accomodations.html">accomodations</a></li>
								<li class="main_nav_item"><a href="pack.html">packs</a></li>
								<li class="main_nav_item"><a href="blog.html">blogs</a></li>
								<li class="main_nav_item"><a href="contact.html">contact</a></li>
								<li class="main_nav_item"><a href="claim.html">claim</a></li>
                                <?php if(!(isset($_SESSION['idUser'])&& $_SESSION['idUser']!=-1)){
								?>
								<li class="main_nav_item"><a href="../../login.php">Login</a></li>
                        <?php }
                        ?>
                           <?php if(isset($_SESSION['idUser'])&& $_SESSION['idUser']!=-1){
						?>
                        		<li class="main_nav_item"><a href="../../logout.php">Log out</a></li>
                        <?php }
                        ?>
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
				<li class="menu_item"><a href="flights.html">offers</a></li>
				<li class="menu_item"><a href="#">news</a></li>
				<li class="menu_item"><a href="contact.html">contact</a></li>
			</ul>
		</div>
	</div>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/blog_background.jpg"></div>
		<div class="home_content">
			<div class="home_title">the blog</div>
		</div>
	</div>

	  <!-- Blog -->
	  <div class="button intro_button"><div class="button_bcg"></div><a href="addcomments.php?blogid=<?php echo $id;?>&token=<?php echo $token;?>">ADD</a></div>
        <!-- Display search form above the blog posts -->
        <!-- Search Form -->
<div class="search-panel">
  <form action="#" method="GET" id="search-form" class="search-form">
    <div class="search-container">
      <div class="search-options">
        <label for="search-type" class="search-label">Search by:</label>
        <select name="search_type" id="search-type" class="search-type">
          <option value="date">Date</option>
          <option value="user">User</option>
          <option value="content">Content</option>
        </select>
      </div>
      <div class="search-input-container">
        <input type="text" name="search"  class="search-input" placeholder="Search...">
		<input type="hidden" name="blogid" value="<?php echo $id; ?>">
      </div>
      <button type="submit" class="search-button">Search</button>
    </div>
  </form>
</div>


        <!-- Display Comments -->
        <!-- Display Comments -->
<?php foreach ($commentsForPage as $comment) {
    $date = new DateTime($comment['date']);
    $filteredContent = filterProfanity(strip_tags($comment['content'])); // Filter the content

    echo '<div class="container">
        <div class="row">

            <!-- Blog Content -->

            <div class="col-lg-8">


                <div class="blog_post">
                    <div class="blog_post_date d-flex flex-column align-items-center justify-content-center">
                        <div class="blog_post_day">' . $date->format('d') . '</div>
                        <div class="blog_post_month">' . $date->format('M, Y') . '</div>
                    </div><br><br><br><br>
                    <div class="blog_post_meta">' . $comment['user'] . ' </a></div>
                    <div class="blog_post_text">
                        <p>' . $filteredContent . '</p> <!-- Use filtered content -->
						<button class="text_to_speech_btn" data-content="' . $filteredContent . '"></button>
                        <audio id="blog_audio" controls ></audio>
                    </div>';

    // Check if the session user is the same as the user who posted the comment
    if ($_SESSION['idUser'] == $comment['idUser'] || ($token == 1)) {
        echo '<div class="button book_button purple_button" style="text-align: center;"><a href="updatecomment.php?id=' . $comment['id_comment'] . '&token=' . $token . '">update</a></div>
        <div class="button book_button purple_button" style="text-align: center;"><a href="deletecomment.php?id=' . $comment['id_comment'] . '&token=' . $token . '">delete</a></div>';
    }

    echo '</div>
                <!-- Blog Sidebar -->
            </div>
        </div>
    </div>';
} ?>

		<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ttsButtons = document.querySelectorAll('.text_to_speech_btn');
        const audioElement = document.getElementById('blog_audio');

        ttsButtons.forEach(button => {
            button.addEventListener('click', function () {
                const content = this.getAttribute('data-content');

                // Fetch API to trigger text-to-speech and get audio URL from VoiceRSS
                fetch('https://api.voicerss.org/', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'key=b8a7f781bfaa4425b00ceb553b1570b8&hl=en-us&src=' + encodeURIComponent(content),
                })
                    .then(response => {
                        if (!response.ok) {
                            console.error('Server response:', response);
                            throw new Error('Network response was not ok');
                        }
                        return response.blob(); // Convert response to blob
                    })
                    .then(blob => {
                        const audioUrl = URL.createObjectURL(blob); // Create object URL for the audio
                        console.log('Audio URL:', audioUrl); // Log the audio URL for debugging
                        audioElement.src = audioUrl; // Set audio source
                        audioElement.style.display = 'block'; // Show the audio element
                        audioElement.play(); // Play the audio
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error fetching audio');
                    });
            });
        });
    });
</script>
        <!-- Pagination Links -->
        <div class="pagination">
            <!-- Previous Page Link -->
            <?php if ($currentPage > 1) : ?>
                <a href="?blogid=<?php echo $id ?>&token=<?php echo $token ?>&page=<?php echo ($currentPage - 1) ?>" class="prev">&#8592; </a>
            <?php endif; ?>

            <!-- Numbered Page Links -->
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="?blogid=<?php echo $id ?>&token=<?php echo $token ?>&page=<?php echo $i ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <!-- Next Page Link -->
            <?php if ($currentPage < $totalPages) : ?>
                <a href="?blogid=<?php echo $id ?>&token=<?php echo $token ?>&page=<?php echo ($currentPage + 1) ?>" class="next">&#8594;</a>
            <?php endif; ?>
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
								<li class="footer_nav_item"><a href="flights.html">offers</a></li>
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
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/easing/easing.js"></script>

<script src="js/offers_custom.js"></script>

</body>

</html> 
