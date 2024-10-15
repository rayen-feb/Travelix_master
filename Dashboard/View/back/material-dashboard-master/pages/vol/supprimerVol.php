<?php
	include '../../controller/volC.php';
	session_start();


	$message = "" ; 
	$volC=new volC();
	$volC->deleteVol($_POST['id']);
header('Location: ../flight.php'  );
?>