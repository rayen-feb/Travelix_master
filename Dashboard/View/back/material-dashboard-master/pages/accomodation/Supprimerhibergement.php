<?php
	include '../../../../../Controller/accomodationC.php';

	$message = "" ; 
	$accomodationC=new accomodationC();
	$accomodationC->Supprimeraccomodation($_GET["id_Acc"]);
	header('Location:Afficherhibergement.php?message= Utilisiateur Supprimé avec succés');
?>