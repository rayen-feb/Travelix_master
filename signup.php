<?php
include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\UserC.php';
include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\UserC.php';

$UserC = new UserC();
$erreur="";
$iserreur=false;
if(isset($_POST['username'])&& isset($_POST['email'])&& isset($_POST['password']) && isset($_POST['dob']) && isset($_FILES['image'])){
    $userexist=$UserC->RecupererUserByEmail($_POST['email']);
    if($userexist==false){
      
        $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
        $filenamee = $_FILES["image"]["name"];
        $tempnamee = $_FILES["image"]["tmp_name"];
        $folderr = "Dashboard/View/back/material-dashboard-master/pages/User/uploads/" . $filenamee;
        if (move_uploaded_file($tempnamee, $folderr)) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
        }
        $user = new User(
            $_POST['username'],
            $_POST['email'], 
            $password,
            $_POST['dob'],
            "Client",  /// bch n3adou role Client par <<<<<<defaut>>>
            $filenamee,   
        );
        $UserC->AjouterUser($user);
        header("Location:login.php");
    }else{
        $iserreur=true;
        $erreur="E-mail is already registered  ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Dashboard/View/back/material-dashboard-master/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="Dashboard/View/back/material-dashboard-master/assets/img/favicon.png">
  <title>
    Wild wander
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="Dashboard/View/back/material-dashboard-master/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="Dashboard/View/back/material-dashboard-master/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="Dashboard/View/back/material-dashboard-master/pages/User/assets/style.css">
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="Dashboard/View/back/material-dashboard-master/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('Dashboard/View/back/material-dashboard-master/assets/img/illustrations/illustration-lock.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Enter your email and password to register</p>
                </div>
                <div class="card-body">
                  <form method="POST" enctype="multipart/form-data" onsubmit ="return validateForm();">

                    <div class="input-group input-group-outline mb-3">
                         <label for="username">Username</label>
                      <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div id="usernameError" class="error-message"></div>


                    <div class="input-group input-group-outline mb-3">
                        <label for="email">Email</label>
                      <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div id="emailError" class="error-message"></div>

                    <div class="input-group input-group-outline mb-3">
                    <label for="password">Password</label>
                      <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                      <span class="toggle-password" onclick="togglePasswordVisibility()">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                      </span>
                    </div>
                    <div id="passwordError" class="error-message"></div>


                    <div class="input-group input-group-outline mb-3">
                      <label for="dob">Date of Birth</label>
                      <input type="date" class="form-control" id="dob" name="dob" style="border: 1px solid #dee2e6;">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label for="Image">Image</label>
                      <input type="file" class="form-control" id="image" name="image" style="border: 1px solid #dee2e6;">
                    </div>

                    <div class="alert alert-danger" style="display:none;" id="erreur">

                    </div>
                    <?php if($iserreur){ ?>
                    <div class="alert alert-danger" id="erreur">
                        <?php echo $erreur; ?>
                    </div>
                    <?php } ?>


                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="login.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="Dashboard/View/back/material-dashboard-master/assets/js/material-dashboard.min.js?v=3.1.0"></script>
  <script src="Dashboard/View/back/material-dashboard-master/pages/User/assets/javascript.js"></script>
</body>

</html>