<?php
session_start();
include '../../mocel/vol.php';
include '../../controller/volC.php';

$volC = new volC();
$update = false;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

if(isset($_POST['ajouterVol'])){
    $company = $_POST['company'];
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];
    $check_in = $_POST['check_in'];
    $check_out= $_POST['check_out'];
    $adults_1 = $_POST['adults_1'];
    $children_1 = $_POST['children_1'];
    $amount= $_POST['amount'];
    $id = $_POST['id'];

    $flight = new vol( $company , $departure_city , $destination_city , $check_in , $check_out , $adults_1, $children_1, $amount , $id );
    $volC= new volC();
    $volC->ajouter_Vol($flight);
    header("location:../flight.php");

    //header("location:../../views/backend/volDash.php");
}
if(isset($_GET['supprimerVol']))
{   
    $id = $_GET['supprimerVol'];
      
    $volC->deleteVol($id);
    $_SESSION['message'] = "vol has been deleted !";
    $_SESSION['msg_type'] = "danger";
   // header("location:../../views/backend/BlogDash.php");
   header("location:../flight.php");

}
if(isset($_POST['cancel']))
{   
    
   header("location:../flight.php");

}

/*
if(isset($_GET['modifierVol'])){
   $id = test_input($_GET['modifierVol']);
    $row = $volC->getbyId($id);
    $update = true;
    // var_dump($row);
    // die("je vx des infos");
    foreach($row as $Row){
        $company = $row['company'];
        $departure_city = $row['departure_city'];
        $destination_city = $row['destination_city'];
       
        $check_in = $row['check_in'];
        $check_out = $row['check_out'];
        $adults_1 = $²row['adults_1'];
        $children_1 = $row['children_1'];
        $amount = $row['amount'];
        $id = $row['id'];





        


    }
    header("location:../flight.php");


}*/



if(isset($_POST['modifierVol'])){

    $company = test_input($_POST['company']);
    $departure_city= test_input($_POST['departure_city']);
    $destination_city= test_input($_POST['destination_city']);
    $check_in= test_input($_POST['check_in']);
    $check_out= test_input($_POST['check_out']);
    $adults_1= test_input($_POST['adults_1']);
    $children_1= test_input($_POST['children_1']);
    $amount= test_input($_POST['amount']);
    $id = test_input($_POST['id']);
    






    $vol= new vol($company , $departure_city  , $destination_city , $check_in , $check_out  ,$adults_1  , $children_1 ,$amount , $id ); 
    $volC->modifier_vol($vol);
    header("location:../flight.php");


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