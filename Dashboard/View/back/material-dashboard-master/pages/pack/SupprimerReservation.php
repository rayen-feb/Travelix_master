<?php
include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\ReservationC.php';

	$message = "" ; 
	$ReservationC=new ReservationC();
	$ReservationC->SupprimerReservation($_GET["idReservation"]);
	header("Location:AfficherReservations.php?successMessage= Reservation Supprimé avec succés");

?>