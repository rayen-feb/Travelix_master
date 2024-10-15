<?php

include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Config.php';    
include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Model\offre.php';

class OffreC
{


    /////..............................Afficher............................../////
    function AfficherOffre()
    {
        $sql = "SELECT * FROM offre";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    /////..............................Supprimer............................../////
    function SupprimerOffre($ID_offre)
    {
        $sql = "DELETE FROM offre WHERE ID_offre=:ID_offre";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_offre', $ID_offre);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    /////..............................Ajouter............................../////
    function AjouterOffre($offre)
    {
        $sql = "INSERT INTO offre (nom_offre,date_debut,date_fin,image,prix) 
                    VALUES (:nom_offre,:date_debut,:date_fin,:image,:prix)";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom_offre' => $offre->getnom_offre(),
                'date_debut' => $offre->getdate_debut(),
                'date_fin' => $offre->getdate_fin(),
                'image' => $offre->getimage(),
                'prix' => $offre->getprix(),

            ]);

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    /////..............................Affichage par la cle Primaire............................../////
    function Recupereroffre($ID_offre)
    {
        $sql = "SELECT * from offre where ID_offre=$ID_offre";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $offre = $query->fetch();
            return $offre;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    /////..............................Update............................../////
    function modifierPack($offre, $ID_offre)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE offre SET nom_offre = :nom_offre, date_debut = :date_debut, date_fin = :date_fin , image = :image , prix = :prix WHERE ID_offre = :ID_offre');
            $query->execute([
                'nom_offre' => $offre->getnom_offre(),
                'date_debut' => $offre->getdate_debut(),
                'date_fin' => $offre->getdate_fin(),
                'image' => $offre->getimage(),
                'prix' => $offre->getprix(),
                'ID_offre' => $ID_offre,
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage(); // Afficher l'erreur PDO
        }
    }

    //$nom_offre,$date_debut,$date_fin



    /////..............................nb total d'offre ............................../////

    public function getTotaloffre()
    {
        $sql = 'SELECT COUNT(*) AS nbPack FROM offre';
        $db = config::getConnexion();

        try {
            $query = $db->query($sql);
            $result = $query->fetch();
            return (int) $result['nbPack'];
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }

    }


    // Function to get pack with pagination
    public function getPackWithPagination($start, $itemsPerPage)
    {
        $sql = 'SELECT * FROM offre LIMIT :start, :itemsPerPage';
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


    /////..............................recherche back ............................../////


    public function RechercheB($searchTerm)
    {
        $sql = "SELECT * FROM offre WHERE nom_offre LIKE '%$searchTerm%' OR prix = '$searchTerm'";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    



    /////..............................recherche par nom ............................../////
    function Recherche($nom_offre)
    {
        $sql = "SELECT * from offre where nom_offre like '" . $nom_offre . "%' ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }



    /////..............................tri par nom ............................../////
    function Trioffre()
    {
        $sql = "SELECT * FROM offre order by nom_offre ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    /////..............................tri par pric c ............................../////

    function Triprixdesc()
    {
        $sql = "SELECT * FROM offre order by prix DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    /////..............................tri par prix D ............................../////

    function Triprix()
    {
        $sql = "SELECT * FROM offre order by prix ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

}