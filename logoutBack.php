<?php
session_start();


// remove all session variables
session_unset();

// destroy the session
session_destroy();
header("Location:/ali&yossra/ali&yossra/UserManagment/login.php");



?>