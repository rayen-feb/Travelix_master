<?php
class blog
{
    private ?int $id = null;
    private ?string $title = null;
    private ?string $user = null;
    private ?string $date = null;
    private ?string $contenu = null;
    private ?int $idUser = null; // Add idUser property

    public function __construct($title, $user, $date, $contenu, $idUser)
    {
        $this->id = null;
        $this->title = $title;
        $this->user = $user;
        $this->date = $date;
        $this->contenu = $contenu;
        $this->idUser = $idUser; // Set idUser in constructor
    }

    public function getIdblog()
    {
        return $this->id;
    }

    public function gettitle()
    {
        return $this->title;
    }

    public function settitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getuser()
    {
        return $this->user;
    }

    public function setuser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getdate()
    {
        return $this->date;
    }

    public function setdate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getcontenu()
    {
        return $this->contenu;
    }

    public function setcontenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }
}
