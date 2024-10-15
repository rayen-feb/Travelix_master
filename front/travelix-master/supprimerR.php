<?php
	include '../../Dashboard/controller/volC.php';

	$message = "" ; 
	$volC=new volC();
	$volC->deleteVol($_GET["id"]);
	header('Location:AfficherVol.php? message=  vol Supprimé avec succés');
?>