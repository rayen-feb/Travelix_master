<?php

include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Config.php';    
include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Model\Reservation.php';

    class ReservationC {


        /////..............................Afficher............................../////
                function AfficherReservation(){
                    $sql="SELECT * FROM reservation";
                    $db = config::getConnexion();
                    try{
                        $liste = $db->query($sql);
                        return $liste;
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMessage());
                    }
                }
        
        /////..............................Supprimer............................../////
                function SupprimerReservation($idReservation){
                    $sql="DELETE FROM reservation WHERE idReservation=:idReservation";
                    $db = config::getConnexion();
                    $req=$db->prepare($sql);
                    $req->bindValue(':idReservation', $idReservation);   
                    try{
                        $req->execute();
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMessage());
                    }
                }
        
        /////..............................Ajouter............................../////
                function AjouterReservation($Reservation){
                    $sql="INSERT INTO reservation (nombrePlaces,source,paiement,idOffre,idUser) 
                    VALUES (:nombrePlaces,:source,:paiement,:idOffre,:idUser)";
                    
                    $db = config::getConnexion();
                    try{
                        $query = $db->prepare($sql);
                        $query->execute([
                            'nombrePlaces' => $Reservation->getnombrePlaces(),
                            'source' => $Reservation->getsource(),
                            'paiement' => $Reservation->getpaiement(),
                            'idOffre' => $Reservation->getidOffre(),
                            'idUser' => $Reservation->getidUser(),
                    ]);
                                
                    }
                    catch (Exception $e){
                        echo 'Erreur: '.$e->getMessage();
                    }			
                }
        /////..............................Affichage par la cle Primaire............................../////
                function RecupererReservation($idReservation){
                    $sql="SELECT * from reservation where idReservation=$idReservation";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $Reservation=$query->fetch();
                        return $Reservation;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }

                function Recupereroffre($ID_offre){
                    $sql="SELECT * from offre where ID_offre=$ID_offre";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $offre=$query->fetch();
                        return $offre;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }
        
        /////..............................Update............................../////
        function modifierReservation($Reservation, $idReservation){
            try {
                $db = config::getConnexion();
                $query = $db->prepare('UPDATE reservation SET nombrePlaces = :nombrePlaces, source = :source, paiement = :paiement , idOffre = :idOffre  WHERE idReservation = :idReservation');
                $query->execute([
                    'nombrePlaces' => $Reservation->getnombrePlaces(),
                    'source' => $Reservation->getsource(),
                    'paiement' => $Reservation->getpaiement(),
                    'idOffre' => $Reservation->getidOffre(),
                    'idReservation' => $idReservation, 
                ]);
                echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                echo $e->getMessage(); // Afficher l'erreur PDO
            }
        }
        
          /////..............................recherche back ............................../////

           
          public function RechercheB($searchTerm)
          {
              $sql = "SELECT * FROM reservation WHERE paiement LIKE '%$searchTerm%' OR source LIKE '%$searchTerm%'";
              $db = config::getConnexion();
          
              try {
                  $query = $db->prepare($sql);
                  $query->execute();
                  return $query->fetchAll(PDO::FETCH_ASSOC);
              } catch (Exception $e) {
                  die('Erreur: ' . $e->getMessage());
              }
          }
          



            
     public function getTotalres()
     {
        $sql = 'SELECT COUNT(*) AS nbrres FROM reservation';
         $db = config::getConnexion();

        try {
         $query = $db->query($sql);
         $result = $query->fetch();
         return (int) $result['nbrres'];
         } catch (Exception $e) {
          die('Erreur: ' . $e->getMessage());
         }
    
     }
        
        

  /////..............................recherche par id ............................../////
  function Recherche($idReservation){
    $sql="SELECT * from reservation where idReservation like '".$idReservation."%' ";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Erreur:'. $e->getMessage());
    }
}
 //...............Function to get pack with pagination.........................//
 public function getresWithPagination($start, $itemsPerPage)
         {
            $sql = 'SELECT * FROM reservation LIMIT :start, :itemsPerPage';
            $db = config::getConnexion();

            try {
                 $query = $db->prepare($sql);
                 $query->bindValue(':start', $start, PDO::PARAM_INT);
                 $query->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
                 $query->execute();
                 return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                     die('Erreur: ' . $e->getMessage());
                     }
          }

///...............trie par date de creation asc .........////////
function tridatecreation(){
    $sql="SELECT * FROM reservation  ORDER BY dateCreation ASC";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Erreur:'. $e->getMessage());
    }
}

 ///...............trie par date de creation dasc .........////////
function tridatecreationD(){
    $sql="SELECT * FROM reservation  ORDER BY dateCreation DESC";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Erreur:'. $e->getMessage());
    }
}


//////////////.............. fonction de la statistique ............//////////

function getOffresLesPlusReservees()
{
    $sql = "SELECT o.nom_offre, COUNT(r.idOffre) AS nombreReservations
            FROM reservation r
            INNER JOIN offre o ON r.idOffre = o.ID_offre
            GROUP BY r.idOffre
            ORDER BY nombreReservations ASC";

    $db = config::getConnexion();

    try {
        $query = $db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

}