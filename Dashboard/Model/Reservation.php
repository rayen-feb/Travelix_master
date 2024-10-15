 
<?php
class Reservation
{

    private $idReservation = null ;
    private $nombrePlaces=null ;
    private $source=null ;
    private $paiement=null ;
    private $dateCreation=null ;
    private $idOffre=null ;
    private $idUser=null ;
    
    function __construct($nombrePlaces,$source,$paiement,$idOffre, $idUser )
    {
        $this->nombrePlaces = $nombrePlaces;
        $this->source = $source;
        $this->paiement = $paiement;
        $this->idOffre = $idOffre;
        $this->idUser = $idUser;
    }

    function getIdReservation()
    {
        return $this->idReservation;
    }

    function getnombrePlaces()
    {
        return $this->nombrePlaces;
    }
    function setnombrePlaces(int $nombrePlaces)
    {
        $this->nombrePlaces = $nombrePlaces;
    }

    function getsource()
    {
        return $this->source;
    }
    function setsource(string $source)
    {
        $this->source = $source;
    }


    function getpaiement()
    {
        return $this->paiement;
    }
    function setpaiement(string $paiement)
    {
        $this->paiement = $paiement;
    }

    function getidOffre()
    {
        return $this->idOffre;
    }
    function setidOffre(string $idUser)
    {
        $this->idUser = $idUser;
    }

    function getidUser()
    {
        return $this->idUser;
    }

    function setidUser(string $idUser)
    {
        $this->idUser = $idUser;
    }

    function getnom_offre()
    {
        return $this->nom_offre;
    }
    function setnom_offre(string $nom_offre)
    {
        $this->nom_offre = $nom_offre;
    }


    function getdateCreation()
    {
        return $this->dateCreation;
    }
    function setdateCreation(int $dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }



}
?>