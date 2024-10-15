<?php
class contact
{
    private ?int $id_contact = null;

    private ?string $iduser = null;
 
    private ?DateTime $date_envoie = null;
    private ?string $sujet_contact = null;
    private ?string $description = null;
    private ?string $etat_contact ;



    public function __construct($id = null,$user, $date, $s ,$m )
    {
        $this->id_contact = $id;
        $this->iduser = $user;
        $this->date_envoie = $date;
        $this->sujet_contact = $s;
        $this->description = $m;
    

    }


    public function idUser()
    {
        return $this->iduser;
    }

    public function getIdcontact()
    {
        return $this->id_contact;
    }

 
    public function getDateEnvoie()
    {
        return $this->date_envoie;
    }

    public function getSujet_contact()
    {
        return $this->sujet_contact;
    }

    public function getdescription()
    {
        return $this->description;
    }
    public function getEtat_contact()
    {
        return $this->etat_contact;
    }

    public function setEtat($etat) {
        $this->etat_contact = $etat;
        return $this;

    }

   
}







/**********************************/


class reponse
{
    private ?int $idReponse = null;
    private ?string $idContact = null;
    private ?string $Reponse = null;
    private ?DateTime $date_envoie_r = null;

    private ?string $etat_rep ;
   



    public function __construct($id = null, $idContact, $Reponse, $date )
    {
        $this->idReponse = $id;
        $this->idContact = $idContact;
        $this->Reponse = $Reponse;
        $this->date_envoie_r = $date;

       
    

    }


    public function getidReponse()
    {
        return $this->idReponse;
    }

    public function getididContact()
    {
        return $this->idContact;
    }

    public function getReponse()
    {
        return $this->Reponse;
    }


    public function getDateEnvoie_r()
    {
        return $this->date_envoie_r;
    }

  
    public function getEtat_rep()
    {
        return $this->etat_rep;
    }
   

    public function setEtat_rep($etat_rep) {
        $this->etat_rep = $etat_rep;
        return $this;

    }

   

}
?>



?>