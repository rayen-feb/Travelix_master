<?php
include 'C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Controller/blogC.php';

$commentsC = new commentsC();
$id = $_GET["id"];
$blogId = $_GET["blogid"]; // Retrieve the blogid parameter from the URL
$token = $_GET['token'] ?? null;

$commentsC->deletecomments($id);

// Check if the referer URL contains the blogid parameter
if($token==null)
    header('Location: comments.php');
else
    header('Location: http://localhost/ali&yossra/ali&yossra/UserManagment/Dashboard/View/back/material-dashboard-master/pages/blog.php');
exit;
?>
