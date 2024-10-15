<?php
class accomodation
{
    private $id_Acc=null ;
    private $name=null ;
    private $location=null ;
    private $address=null ;
    private $type_acc=null ;
    private $type_specific=null ;
    private $price=null ;
    private $amenities=null ;
    private $description=null ;

    private $imageUrl = array();

    function __construct($name,$location,$address,$type_acc,$type_specific,$price,$amenities,$description,$imageUrl)
    {
        $this->name = $name;
        $this->location = $location;
        $this->address = $address;
        $this->type_acc = $type_acc;
        $this->type_specific = $type_specific;
        $this->price = $price;
        $this->amenities = $amenities;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
    }


    function getid_Acc()
    {
        return $this->id_Acc;
    }


    function getname()
    {
        return $this->name;
    }
    function setname(string $name)
    {
        $this->name = $name;
    }


    function getlocation()
    {
        return $this->location;
    }
    function setlocation(string $location)
    {
        $this->location = $location;
    }



    function getaddress()
    {
        return $this->address;
    }
    function setaddress(string $address)
    {
        $this->address = $address;
    }



    function gettype_acc()
    {
        return $this->type_acc;
    }
    function settype_acc(string $type_acc)
    {
        $this->type_acc = $type_acc;
    }

    function gettype_specific()
    {
        return $this->type_specific;
    }
    function settype_specific(string $type_specific)
    {
        $this->type_specific = $type_specific;
    }



    function getprice()
    {
        return $this->price;
    }
    function setprice(string $price)
    {
        $this->price = $price;
    }



    function getamenities()
    {
        return $this->amenities;
    }
    function setamenities(string $amenities)
    {
        $this->amenities = $amenities;
    }


    function getdescription()
    {
        return $this->description;
    }
    function setdescription(string $description)
    {
        $this->description = $description;
    }


    function getimageUrl()
    {
        return $this->imageUrl;
    }
    function setimageUrl(array $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }


    
    



}
?>