<?php
	include '../../../../../Controller/reservation_A_C.php';


	$message = "" ; 
	$ReservationC=new ReservationAC();
	$ReservationC->SupprimerReservation($_GET["id_reservation"]);
	header('Location:Afficherreservation.php?message= reservation Supprimé avec succés');
?>