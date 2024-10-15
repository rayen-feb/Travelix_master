<?php
class comments
{
    private ?int $id_comment = null;
    private ?string $content = null;
    private ?string $date = null;
    private ?string $user = null;
    private ?int $blog = null;
    private ?int $idUser = null;

    public function __construct($content, $date, $user, $blog, $idUser)
    {
        $this->id_comment = null;
        $this->content = $content;
        $this->date = $date;
        $this->user = $user;
        $this->blog = $blog;
        $this->idUser = $idUser;
    }

    public function getIdcomments()
    {
        return $this->id_comment;
    }

    public function getcontent()
    {
        return $this->content;
    }

    public function setcontent($content)
    {
        $this->content = $content;
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

    public function getblog()
    {
        return $this->blog;
    }

    public function setblog($blog)
    {
        $this->blog = $blog;
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
