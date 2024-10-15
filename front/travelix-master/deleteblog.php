<?php
include 'C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Controller/blogC.php';

$blogC = new blogC();
$id = $_GET["id"];
$token=$_GET['token'] ?? null;
$blogC->deleteblog($id);

if($token==null)
    header('Location: blog.php');
else
    header('Location: http://localhost/ali&yossra/ali&yossra/UserManagment/Dashboard/View/back/material-dashboard-master/pages/blog.php');
exit;
?>