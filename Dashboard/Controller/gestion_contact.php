<?php
include_once("C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Config.php");
include_once("C:/xampp/htdocs/ali&yossra/ali&yossra/UserManagment/Dashboard/Model/contact.php");




class contact_gestion
{
   


    /**********************************************************************************************************/
    /*****************************bidayet il 5idma mil louwil ijdid*******/
    function showClient($id)
    {
        $sql = "SELECT * from user where idUser = $id";
        $Config = new Config();
        $db = $Config->GetConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $reclamation = $query->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function addcontact($contact)
{
    $sql = "INSERT INTO contact  VALUES (NULL,:idClient,:sujet_contact,:date_envoie,DEFAULT,:description)";

    $config = new Config();
    $db = $config->GetConnexion();   
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'idClient' => $contact->idUser(),
            'sujet_contact' => $contact->getSujet_contact(),
            'date_envoie' => $contact->getDateEnvoie()->format('Y-m-d H:i:s'),
            'description' => $contact->getdescription(),
        ]);
        // Gérer le succès de l'insertion ici si nécessaire
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données ici
        echo 'Error: ' . $e->getMessage();
    }
}
public function listContact()
{
    $sql = "SELECT * FROM contact";
    $config = new Config();
    $db = $config->GetConnexion();
    try {
        $liste = $db->query($sql);
        return $liste;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}
function deleteContact($id)
{
    $sql = "DELETE FROM contact WHERE id_contact = :id";

    $config = new Config();
    $db = $config->GetConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id);

    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}
function showContact($id)
{
    $sql = "SELECT * from contact where id_contact = $id";
    $config = new Config();
    $db = $config->GetConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();

        $contact = $query->fetch();
        return $contact;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function getResponses($contactId) {
    $config = new Config();
    $db = $config->GetConnexion();
    $stmt = $db->prepare("SELECT * FROM reponse WHERE idContact = ?");
    $stmt->execute([$contactId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




function updateContact($contact, $id)
{
    try {
        $config = new Config();
        $db = $config->GetConnexion();
        
        $query = $db->prepare('UPDATE contact SET iduser = :iduser, sujet_contact = :sujet, date_envoie = :date_envoie, etat_contact = :etat, description = :description WHERE id_contact = :id');
        $query->execute([
            'id' => $id,
            'iduser' => $contact->idUser(),
            'sujet' => $contact->getSujet_contact(),
            'date_envoie' => $contact->getDateEnvoie()->format('Y-m-d H:i:s'),
            'etat' => $contact->getEtat_contact(),
            'description' => $contact->getdescription()
        ]);
        // echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        $e->getMessage();
    }
}



 /********************ibdit ni5dim fil metier **************************/
 //fonction trie
 function show_etat_metier()
 {
     $sql = "SELECT * FROM contact ORDER BY 
             CASE 
                 WHEN etat_contact = 'non traite' THEN 0
                 WHEN etat_contact = 'traiter' THEN 1
                 ELSE 2
             END, etat_contact";
 
     $config = new Config();
     $db = $config->GetConnexion();
 
     try {
         $query = $db->prepare($sql);
         $query->execute();
 
         $notifications = $query->fetchAll(PDO::FETCH_ASSOC);
         return $notifications;
     } catch (Exception $e) {
         die('Error: ' . $e->getMessage());
     }
 }
 


   // fonction a3maltha bich itwarik les repenses imta3 il rajik ki ijaweb il client
   function show_Notification($rec_ ,$idUser)
   {
       $sql = "SELECT * FROM contact WHERE etat_contact = :etat_contact AND idUser = :idUser";
       $config = new Config();
       $db = $config->GetConnexion();
       try {
           $query = $db->prepare($sql);
           $query->bindParam(':etat_contact', $rec_);
           $query->bindParam(':idUser', $idUser);
           $query->execute();
   
           $notifications = $query->fetchAll(PDO::FETCH_ASSOC);
           return $notifications;
       } catch (Exception $e) {
           die('Error: ' . $e->getMessage());
       }
   }

}  




class reponse_gestion
{
   
    function addReponse($reponse)
    {  
     $sql = "INSERT INTO reponse  VALUES (NULL,:idContact,:Reponse,:date_envoie_r,DEFAULT)";

            $config = new Config();
            $db = $config->GetConnexion();   
         try {
            //print_r($reponse->getDateEnvoie_r()->format('Y-m-d H:i:s'));
            $query = $db->prepare($sql);
            $query->execute([
                'idContact' => $reponse->getididContact(),
                'Reponse' => $reponse->getReponse(),
                'date_envoie_r' => $reponse->getDateEnvoie_r()->format('Y-m-d H:i:s'),

            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

   /*************** */
    function listeReponse_idR($idContact)
    {
        $sql = "SELECT * from reponse where idContact =  idContact";
        $config = new Config();
        $db = $config->GetConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':idContact', $idContact);
            $query->execute();
    
            $notifications = $query->fetchAll(PDO::FETCH_ASSOC);
            return $notifications;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateReponseEtat($idContact, $etat)
    {
        try {
            $config = new Config();
            $db = $config->GetConnexion();
            
            $query = $db->prepare('UPDATE reponse SET etat_rep = :etat_rep WHERE idContact = :idContact');
            $query->execute([
                'etat_rep' => $etat,
                'idContact' => $idContact,
            ]);
            
            // echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
// kan ifasa5ha il user il reponse il i9dom im3ach yo8hrou
    function voir_repon($idContact ,$etat_rep)
    {
        $sql = "SELECT * FROM reponse WHERE idContact = :idContact AND etat_rep = :etat_rep";
        $config = new Config();
        $db = $config->GetConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':idContact', $idContact);
            $query->bindParam(':etat_rep', $etat_rep);
  
            $query->execute();
    
            $notifications = $query->fetchAll(PDO::FETCH_ASSOC);
            return $notifications;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
