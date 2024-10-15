 
<?php
class Offre
{

    private $ID_offre = null ;
    private $nom_offre=null ;
    private $date_debut=null ;
    private $date_fin=null ;
    private $image=null ;
    private $prix=null ;
    
    function __construct($nom_offre,$date_debut,$date_fin,$image,$prix)
    {
        $this->nom_offre = $nom_offre;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->image = $image;
        $this->prix = $prix;
    }

    function getID_offre()
    {
        return $this->ID_offre;
    }

    function getnom_offre()
    {
        return $this->nom_offre;
    }
    function setnom_offre(string $nom_offre)
    {
        $this->nom_offre = $nom_offre;
    }

    function getimage()
    {
        return $this->image;
    }
    function setimage(string $image)
    {
        $this->image = $image;
    }


    function getprix()
    {
        return $this->prix;
    }
    function setprix(string $prix)
    {
        $this->prix = $prix;
    }

    function getdate_debut()
    {
        return $this->date_debut;
    }
    function setdate_debut(string $date_debut)
    {
        $this->date_debut = $date_debut;
    }



    function getdate_fin()
    {
        return $this->date_fin;
    }
    function setdate_fin(string $date_fin)
    {
        $this->date_fin = $date_fin;
    }




}
?>