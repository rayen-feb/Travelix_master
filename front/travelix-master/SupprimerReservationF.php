<?php
	include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\ReservationC.php';

	$message = "" ; 
	$ReservationC=new ReservationC();
	$ReservationC->SupprimerReservation($_GET["idReservation"]);
	header("Location:ListReservations.php?successMessage= Reservation Supprimé avec succés");

	include 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Controller\UserC.php';
	session_start();
	$userC = new UserC();
	if(isset($_SESSION['idUser'])) {
		$user = $userC->RecupererUser($_SESSION['idUser']);
		if($user)
		{
			$username = $user['username'];
			$image = $user['image'];
		} else 
		{
			echo "No user found !!";
		}
	} else {
		echo "idUser not setted";
	}
	?>
	