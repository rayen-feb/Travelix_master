<?php
include_once(__DIR__ . '/../Config.php');






class volC {
    public function listVols()
    {
        $sql = "SELECT * FROM flight";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function getAllvols(){
        $conn = config::getConnexion();
        $sql = "SELECT * FROM flight";
    
        try {
            $result=$conn->query($sql);
            $row = $result->fetchAll(PDO::FETCH_ASSOC);
            return $row;
            if(!empty($row)){
                return $row[0];
            }
        } catch (PDOException $e) {
            die('Erreur: '.$e->getMessage());
        }
    }

    function showblog($id)
    {
        $sql = "SELECT * from blog where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $blog = $query->fetch();
            return $blog;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function showVol($id)
    {
        $sql = "SELECT * from flight where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $blog = $query->fetch();
            return $blog;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function listVol($sortOption = 'mostRecent') 
    {
        $sql = "SELECT * FROM flight";

        switch ($sortOption) {
            case 'mostRecent':
                $sql .= " ORDER BY check_in DESC";
                break;
            case 'leastRecent':
                $sql .= " ORDER BY check_in ASC";
                break;
            case 'alphabeticallyASC':
                $sql .= " ORDER BY company ASC";
                break;
                case 'alphabeticallyDESC':
                    $sql .= " ORDER BY company DESC";
                    break;
            case 'mostExpencive':
                    $sql .= " ORDER BY amount ASC";
                break;
            case 'leastExpencive':
                    $sql .= " ORDER BY amount DESC";
                break;
                
            default:
                $sql .= " ORDER BY check_in DESC";
                break;
        }

        $db = config::getConnexion();
        try 
        {
            $stmt = $db->prepare($sql); //stmt == statement
            $stmt->execute();

            // Fetch the results
            $flight = $stmt->fetchAll();
            return $flight;
        } 
        catch (Exception $e) 
        {
            die('Erreur : ' . $e->getMessage());
        }
    }


    public function fetchVolById($id)
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM flight WHERE id = :id";
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
            if ($req->rowCount() > 0) {
                return $req->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function afficher_vols()
    {
        $flight = $this->listVol();
        echo '<html>
                <body>
                    <table border="1" width="100%">
                        <tr>
                            <th>company</th>
                            <th>departure_city</th>
                            <th>destination_city</th>
                            <th>check_in</th>
                            <th>check out </th>
                            <th> adults  </th>
                            <th> children </th>
                            <th> amount  </th>
                            <th> id </th>
                        </tr>';
        foreach ($flight as $f) {
            echo '<tr>
                        <td>' . $f['company'] . '</td>
                        <td>' . $f['departure_city'] . '</td>
                        <td>' . $f['destination_city'] . '</td>
                        <td>' . $f['check_in'] . '</td>
                        <td>' . $f['check_out'] . '</td>
                        <td>' . $f['adults_1'] . '</td>
                        <td>' . $f['children_1'] . '</td>
                        <td>' . $f['amount'] . '</td>
                        <td>' . $f['id'] . '</td>
                  </tr>';
                        
                
        }
        echo '</table></body></html>';
    }


    function getbyId($id) {
        $sql = "SELECT * from flight where id = :id";
        $db = config::getConnexion();
        try {
          $query = $db->prepare($sql);
          $query->execute([
            ':id' => $id
          ]);
    
          $admin = $query->fetch();
          return $admin;
        } catch (Exception $e) {
          die('Error: '. $e->getMessage());
        }
      }
     




     
    function ajouter_Vol($vol)
    {

        $sql =  "INSERT INTO flight (company, departure_city, destination_city, check_in, check_out, adults_1 , children_1 , amount , id ) VALUES (:company, :departure_city, :destination_city, :check_in, :check_out, :adults_1 , :children_1 , :amount , :id )";
       

         $db = config::getConnexion();
         
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'company' => $vol->getCompany(),
            'departure_city' => $vol->getDeparture_city(),
            'destination_city' => $vol->getDestination_city(),
            'check_in' => $vol->getCheck_in(),
            'check_out' => $vol->getCheck_out(),
            'adults_1' => $vol->getAdult_1(),
            'children_1' => $vol->getChildren_1(),
            'amount' => $vol->getAmount(),
            'id'=> $vol->getId(),

        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    }


    function RecupererVol($id){
        $sql="SELECT * from flight where id=$id";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $flight=$query->fetch();
            return $flight;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }

    function modifier_vol($vol){
        $db = config::getConnexion();
        
        $sql = "UPDATE  flight SET company=:company  ,
                    departure_city=:departure_city,
                     destination_city=:destination_city ,
                     check_in=:check_in ,
                     check_out=:check_out  ,
                     adults_1=:adults_1 , 
                     children_1=:children_1 ,
                     amount=:amount
                      WHERE  id=:id" ; 
         try {
            $req = $db->prepare($sql);
            $req->bindValue(':company',$vol->getCompany());
            $req->bindValue(':departure_city',$vol->getDeparture_city());
            $req->bindValue(':destination_city',$vol->getDestination_city());
            $req->bindValue(':check_in',$vol->getCheck_in());
            $req->bindValue(':check_out',$vol->getCheck_out());
            $req->bindValue(':adults_1',$vol->getAdult_1());
            $req->bindValue(':Children_1',$vol->getChildren_1());
            $req->bindValue(':amount',$vol->getAmount());
            $req->bindValue(':id',$vol->getId());
            
        
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
    function deleteVol($id)
    {
        $sql = "DELETE FROM  flight WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

   public function supprimer_Vol_by_id($id){
        $conn = config::getConnexion();
        $sql = "DELETE FROM flight WHERE id=:id";

        try {
            $req = $conn->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
 


    function getAllCon(){
        $conn = config::getConnexion();
        $sql = "SELECT * FROM flight";

        try {
            $result=$conn->query($sql);
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
            if(!empty($rows)){
                return $rows[0];
            }
            
        } catch (PDOException $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
 

   

 function rechercher($input,$colonne) {
        if($colonne == "all") 
        {        $sql = "SELECT * from flight WHERE ( company LIKE \"%$input%\") OR ( destination LIKE \"%$input%\") OR ( Departure_city LIKE \"%$input%\") ";
       } else {
   $sql = "SELECT * from flight WHERE ( $colonne LIKE \"%$input%\")  "; }
   $db = config::getConnexion();
   try { $liste=$db->query($sql); 
    

       return $liste;
   }
   catch (PDOException $e) {
    die('Erreur: '.$e->getMessage());
   }
}
function tridsc(){
    $query = "SELECT * FROM flight ORDER BY check_in  DESC";
    $db= config::getConnexion();
    try { 
        $liste = $db->query($query);
    return $liste;
    }
    catch (Exception $e)
    {die ('Erreur:'.$e->getMessage());}
}

function triasc(){
    $query = "SELECT * FROM  flight ORDER BY check_in ASC";
    $db= config::getConnexion();
    try { 
        $liste = $db->query($query);
    return $liste;
    }
    catch (Exception $e)
    {die ('Erreur:'.$e->getMessage());}
}




}




