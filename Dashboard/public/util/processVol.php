<?php
session_start();
include '../../Model/vol.php';
include '../../Model/reservation.php';

include '../../Controller/volC.php';
include '../../Controller/reservationC.php';
include '../../Controller/tokenC.php';



$volC = new volC();
$tokenC = new tokenC();

$reservationC= new reservationC() ;
$update = false;
$tab = $reservationC->listReservation();

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
    
    header("location:../../view/front/travelix-master/token.html");

    //header("location:../../views/backend/volDash.php");
}
if(isset($_GET['supprimerVol']))
{   
    $id = $_GET['supprimerVol'];
      
    $volC->deleteVol($id);
    $_SESSION['message'] = "vol has been deleted !";
    $_SESSION['msg_type'] = "danger";
   // header("location:../../views/backend/BlogDash.php");
   header("location:../../view/front/travelix-master/flights.php");

}
if(isset($_POST['cancel']))
{   
    
   header("location:../../view/front/travelix-master/flights.php");

}


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

   header("location:../../view/front/travelix-master/flights.php");
}



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
    $volC->modifier_vol($id);

    //header("location:../../views/backend/BlogDash.php");
}



/*if(isset($_GET['search'])){
  $id_user = test_input($_GET['search']);
   $row = $reservation->getbyId($id_user);
   $update = true;
   // var_dump($row);
   




       


   }

  //header("location:../../view/front/travelix-master/flights.php");
*/
?>
<?php
if(isset($_Get['search']))
{
 // $id_user = test_input($_GET['search']);
 //$id_user=88 ;

  $flight =$volC->showVol(0);
  //$tab = $reservationC->listReservation();}

  ?>
  

<?php

      if (isset($_POST['id'])){

        $vol = $volC->RecupererVol($_POST['id']);
        
    ?>
	<div class="contact_form_section">
		<div class="container">
			<div class="row">
				<div class="col">

					<!-- Contact Form -->
					<div class="contact_form_container">
						<div class="contact_title text-center">vol</div>
						<form method="POST"  enctype="multipart/form-data" id="contact_form" action="" class="contact_form text-center">
							<input type="text" id="company" name="company" class="contact_form_subject input_field" value="<?php echo $vol['company'];?>" placeholder="company" required="required" data-error="company is required.">
							<input type="text" id="departure_city" name="departure_city" class="contact_form_subject input_field" value="<?php echo $vol['departure_city'];?>" required="required"  placeholder="departure_city"  data-error="departure_cityis required.">
							<input type="text" id="destination_city" name="destination_city" class="contact_form_subject input_field" value="<?php echo $vol['destination_city'];?>" required="required"  placeholder="destination_city" data-error="destination city is required.">
							<input type="date" id="check_in" name="check_in" class="contact_form_subject input_field" value="<?php echo $vol['check_in'];?>" required="required"   placeholder="departure  date "  data-error="check_in is required.">
							<input type="date" id="check_out" name="check_out" class="contact_form_subject input_field" value="<?php echo $vol['check_out'];?>" required="required"   placeholder="arrival date "  data-error=" check out  is required.">
							<input type="number" id="adults_1" name="adults_1" class="contact_form_subject input_field" value="<?php echo $vol['adults_1'];?>" required="required"   placeholder="number of adults " data-error=" number of adults  is required.">
							<input type="number" id="children_1" name="children_1" class="contact_form_subject input_field" value="<?php echo $vol['children_1'];?>" required="required"   placeholder="number of children "  data-error="children  is required.">
							<input type="number" id="amount" name="amount" class="contact_form_subject input_field" value="<?php echo $vol['amount'];?>"  placeholder="amount"  required="required" data-error="amount is required.">

								<button type="submit"  class="form_submit_button button trans_200">Update<span></span><span></span><span></span></button>
								 
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php 
   } 
?>
<?php 
   } 
?>

