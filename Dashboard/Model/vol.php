<?php
class vol{

    private  $company , $departure_city, $destination_city, $check_in, $check_out, $adults_1  , $children_1 , $amount , $id ;

    function __construct( $company , $departure_city, $destination_city, $check_in, $check_out, $adults_1  , $children_1 , $amount ,  $id    )
    {
        $this->company = $company;
        $this->departure_city = $departure_city;
        $this->destination_city= $destination_city;
        $this->check_in = $check_in;
        $this->check_out = $check_out;
        $this->adults_1 = $adults_1; 
        $this->children_1 = $children_1;
        $this->amount = $amount;
         $this->id= $id;
    }



    //getters 
    function getCompany() {
        return  $this->company;
    }

    function getDeparture_city(){
        return  $this->departure_city;
    }
    function getDestination_city(){
        return $this->destination_city ;
    }
    function getCheck_in(){
        return $this->check_in;
    }
    function getCheck_out(){
        return $this->check_out;
    }
    function getAdult_1(){
        return $this->adults_1;
    }
    function getChildren_1(){
        return $this->children_1;}
    
    function getAmount(){
            return $this->amount;
    }
    function getId(){
        return $this->id;
    }


//setters 






    function setCompnay($company){
        $this->company = $company;
    }

    function setDeparture_city($departure_city){
        $this->departure_city = $departure_city;
    }
    function setDestination($destination){
        $this->destination = $destination;
    }
    function setCheck_in($check_in){
        $this->check_in = $check_in;
    }
    function setCheck_out($check_out){
        $this->check_out = $check_out;
    }
    function setAdults_1($adults_1){
        $this->adults_1 = $adults_1;
    }
    function setChildren_1($children_1){
        $this->children_1 = $children_1;
    }
    function setAmount($amount){
        $this->amount= $amount;
    }
    function setId($id){
        $this->id = $id;
    }
}

?>