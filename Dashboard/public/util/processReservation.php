<?php
session_start();
include '../../Model/reservation.php';
include '../../Controller/reservationC.php';

$reservationC = new reservationC();
$update = false;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

if(isset($_POST['ajouterReservation'])){
    $id_RES = $_POST['id_RES'];
    $id_vol = $_POST['id_vol'];
    $date_reservation_vol= $_POST['date_reservation_vol'];
    $nb_place = $_POST['nb_place'];
    

    $reservation = new reservation( $id_RES , $id_vol , $date_reservation_vol , $nb_place  );
    $reservationC= new reservationC();
    $reservationC->addReservation($reservation);
    header("location:../../view/front/travelix-master/flights.php");

}




if(isset($_GET['supprimerReservation']))
{   
    $id_user = $_GET['supprimerReservation'];
      
    $volC->deleteVol($id);
    $_SESSION['message'] = "reservation has been deleted !";
    $_SESSION['msg_type'] = "danger";
   // header("location:../../views/backend/BlogDash.php");
   header("location:../../view/front/travelix-master/flights.php");

}






if(isset($_POST['cancel']))
{   
    
   header("location:../../view/front/travelix-master/flights.php");

}


if(isset($_GET['modifierReservation'])){
   $id_user = test_input($_GET['modifierReservation']);
    $row = $reservationC->getbyid($id_user);
    $update = true;
    // var_dump($row);
    // die("je vx des infos");
    foreach($row as $Row){
        $id_RES = $row['id_RES'];
        $id_vol = $row['id_vol'];
        $date_reservation_vol = $row['date_reservation_vol'];
       
        $nb_place = $row['nb_place'];
       





        


    }

   header("location:../../view/front/travelix-master/flights.php");
}



if(isset($_POST['modifierReservation'])){

    $id_RES= test_input($_POST['id_RES']);
    $id_vol= test_input($_POST['id_vol']);
    $date_reservation_vol= test_input($_POST['date_reservation_vol']);
    $nb_place= test_input($_POST['nb_place']);
    






    $reservation= new reservation($id_RES , $id_vol  , $date_reservation_vol , $nb_place  ); 
    $reservationC->updateReservation($id_user);

    //header("location:../../views/backend/BlogDash.php");
}
/*
if(isset($_POST['search']))
{
  $listeU=$BlogCtrl->rechercherBlog($_POST['valueToSearch']);

  header("location:../../views/backend/rechercherBlog.php");
}

if(isset($_POST['DSCU']))
{ 
  $listeU=$BlogCtrl->tridscu();
  header("location:../../views/backend/rechercherBlog.php");
}
 
if(isset($_POST['ASCU']))
{ 
  $listeU=$BlogCtrl->triascu();
  header("location:../../views/backend/rechercherBlog.php");
}*/



?>