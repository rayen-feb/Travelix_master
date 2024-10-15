<?php
	include_once dirname(__FILE__).'/../Config.php';
	include_once dirname(__FILE__) . '/../Model/accomodation.php';

    class accomodationC {


        /////..............................Afficher............................../////
                function Afficheraccomodation(){
                    $sql="SELECT * FROM accomodation";
                    $db = config::getConnexion();
                    try{
                        $liste = $db->query($sql);
                        return $liste;
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMessage());
                    }
                }
        
        /////..............................Supprimer............................../////
                function Supprimeraccomodation($id_Acc){
                    $sql="DELETE FROM accomodation WHERE id_Acc=:id_Acc";
                    $db = config::getConnexion();
                    $req=$db->prepare($sql);
                    $req->bindValue(':id_Acc', $id_Acc);   
                    try{
                        $req->execute();
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMeesage());
                    }
                }
        
        
        /////..............................Ajouter............................../////
        function Ajouteraccomodation($accomodation){
            $sql = "INSERT INTO accomodation (Name, Location, address, type_acc, type_specific, price, amenities, description, images) VALUES (:name, :location, :address, :type_acc, :type_specific, :price, :amenities, :description, :images)";

            $db = config::getConnexion();
            try{
                // Convert image URLs to JSON format
                $imageUrls = $accomodation->getimageUrl();
                $jsonImages = json_encode($imageUrls);

                $query = $db->prepare($sql);
                $query->execute([
                    'name' => $accomodation->getname(),
                    'location' => $accomodation->getlocation(),
                    'address' => $accomodation->getaddress(),
                    'type_acc' => $accomodation->gettype_acc(),
                    'type_specific' => $accomodation->gettype_specific(),
                    'price' => $accomodation->getprice(),
                    'amenities' => $accomodation->getamenities(),
                    'description' => $accomodation->getdescription(),
                    'images' => $jsonImages // Insert JSON-formatted image URLs
                ]);

                echo $query->rowCount() . " records UPDATED successfully <br>";
            }
            catch (Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }
        }

        /////..............................Affichage par la cle Primaire............................../////
                function Recupereraccomodation($id_Acc){
                    $sql="SELECT * from accomodation where id_Acc=$id_Acc";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $accomodation=$query->fetch();
                        return $accomodation;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }
        
        /////..............................Update............................../////
                function Modifieraccomodation($accomodation,$id_Acc){
                    try {
                        $db = config::getConnexion();
                $query = $db->prepare('UPDATE accomodation SET  Name=:name,location=:location,address=:adress,type_acc=:type_acc,type_specific=:type_specific,price=:price,amenities=:amenities,description=:description WHERE id_Acc=:id_Acc');
                        $query->execute([
                            'name' => $accomodation->getname(),
                            'location' => $accomodation->getlocation(),
                            'adress' => $accomodation->getaddress(),
                            'type_acc' => $accomodation->gettype_acc(),
                            'type_specific' => $accomodation->gettype_specific(),
                            'price' => $accomodation->getprice(),
                            'amenities' => $accomodation->getamenities(),
                            'description' => $accomodation->getdescription(),
                            'id_Acc' => $id_Acc

                        ]);
                        echo $query->rowCount() . " records UPDATED successfully <br>";
                    } catch (PDOException $e) {
                        $e->getMessage();
                    }
                }

                function RecupereraccomodationBylocation($location){
                    $sql="SELECT * from accomodation where location='".$location."'";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $accomodation=$query->fetch();
                        return $accomodation;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }

            }

            //geturls
            function GetUrls($id_Acc){
                $sql="SELECT images from accomodation where id_Acc=$id_Acc";
                $db = config::getConnexion();
                try{
                    $query=$db->prepare($sql);
                    $query->execute();

                    $accomodation=$query->fetch();
                    return $accomodation;
                }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }
            }



?>