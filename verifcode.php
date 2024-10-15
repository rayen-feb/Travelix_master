<?php 
$succes=false;

session_start();
if(!isset($_SESSION['code'])){
    header("Location:forgetpassword.php");
}
if(isset($_POST['password'])){
    
    include_once 'Dashboard/Controller/UserC.php';
    $userC = new UserC();
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $userC->ModifierPassword($_SESSION['idUser'],$hashed_password);
    $succes=true;
    session_unset();
    session_destroy();
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

              <?php if($succes){?>
    <div class="alert alert-success">
password Updated , <a href="login.php">go to main page</a>     
</div>
    <?php }else{ ?>
                <?php if(!isset($_POST['code'])){ ?>

                <form method="POST" action="verifcode.php">
                <h4 class="text-center">Enter your code </h4><br>

                  <div class="input-group input-group-outline mb-3">
                    <input type="text" id="code" name="code" class="form-control" placeholder="Code">
                  </div>
                    
                  <div class="text-center">
                  <input class="btn btn-primary" type="submit" name="envoyer" value="Envoyer">
                </div>
                </form>
                <?php }else if($_POST['code']==$_SESSION['code']){ ?>
                  <form action="verifcode.php" method="POST">

                  <h4 class="text-center">Reset Your Password</h4><br>

                  <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder=" Your Password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                      </span>
                  </div>

                  <br><br>
                  <div class="text-center">
                  <input class="btn btn-primary" type="submit" name="envoyer" value="Envoyer">
                </div>
                </form>
                <?php }else{ ?>
                        <div class="alert alert-danger" id="erreur">
                        Code incorrect
                        </div>
                        <?php }} ?>

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
  <script src="C:/xamppp/htdocs/projetwissem/UserManagment/Dashboard/View/back/material-dashboard-master/pages/User/assets/javascript.js"></script>
</body>

</html>