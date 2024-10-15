<?php
include_once 'C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Controller/UserC.php';
session_start(); 
$UserC=new UserC();
$erreur="";
$iserreur=false;


if(isset($_SESSION['idUser'])&& $_SESSION['idUser']!=-1){
    header("Location:front/travelix-master/index.php");  
    exit;                                     

}else{
    $_SESSION['idUser']=-1;
    $_SESSION['email']='';
    $_SESSION['role']='';

    if(isset($_POST['email'])&& isset($_POST['password'])){
        $userexist=$UserC->RecupererUserByEmail($_POST['email']);        
        if($userexist==false){
            $iserreur=true;
            $erreur="Email does not exist ";                                  

        }else{
            /*   
          echo "Hashed Password from Database: " . $userexist['password'] . "<br>";
          echo "Hashed Password Input: " . password_hash($_POST['password'], PASSWORD_DEFAULT) . "<br>";
          echo "Password Verify Result: " . (password_verify($_POST['password'], $userexist['password']) ? 'true' : 'false') . "<br>";  
            */
            if(password_verify($_POST['password'],$userexist['password'])==false){
              var_dump($userexist);
                $iserreur=true;
                $erreur="Mot de passe incorrect";                      
            }else{
                $_SESSION['idUser']=$userexist['idUser'];                /* Recuperation par Id */
                $_SESSION['email']=$userexist['email'];            /* Recuperation par Email */
                $_SESSION['role']=$userexist['role'];
                if($_SESSION['role']=="Client"){                 
                    header("Location:front/travelix-master/index.php"); /// header: hia win bch yhezna
                    exit;                    /* Si Client => Front */
                }else if($_SESSION['role']=="Admin"){
                    header("Location:\ali&yossra\ali&yossra\UserManagment\Dashboard\View\back\material-dashboard-master\pages\User\AfficherUtilisateurs.php");   
                    exit; 
                }
            }
        }
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

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
    
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card-body">
                <form method="POST" action="login.php">
                  <div class="input-group input-group-outline my-3">
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                  </div>


                  <div class="input-group input-group-outline mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="password">
                  </div>
                  <?php if($iserreur){ ?>
                    <div class="alert alert-danger" id="erreur">
                        <?php echo $erreur; ?>
                    </div>
                    <?php } ?>
                    
                    
                  
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Login</button>
                  </div>


                  <p class="mt-4 text-sm text">
                    <a href="forgotpassword.php" class="text-primary text-gradient font-weight-bold">Forgot Password ?</a>
                  </p>


                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="signup.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>



                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart" aria-hidden="true"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-white" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-white" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-white" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="Dashboard/View/back/material-dashboard-master/assets/js/core/popper.min.js"></script>
  <script src="Dashboard/View/back/material-dashboard-master/assets/js/core/bootstrap.min.js"></script>
  <script src="Dashboard/View/back/material-dashboard-master/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="Dashboard/View/back/material-dashboard-master/assets/js/plugins/smooth-scrollbar.min.js"></script>
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
</body>

</html>