<?php
include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Config.php';    
include_once 'C:\xampp\htdocs\ali&yossra\ali&yossra\UserManagment\Dashboard\Model\User.php' ;

    class UserC {

        /////..............................Afficher............................../////
                function AfficherUser(){
                    $sql="SELECT * FROM user";
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
                function SupprimerUser($idUser){
                    $sql="DELETE FROM user WHERE idUser=:idUser";
                    $db = config::getConnexion();
                    $req=$db->prepare($sql);
                    $req->bindValue(':idUser', $idUser);   
                    try{
                        $req->execute();
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMessage());
                    }
                }
        
        
        /////..............................Ajouter............................../////
                function AjouterUser($user){
                    $sql="INSERT INTO user (username,email,password,dob,role,image) 
                    VALUES (:username,:email,:password,:dob,:role,:image)";
                    
                    $db = config::getConnexion();
                    try{
                        $query = $db->prepare($sql);
                        $query->execute([
                            'username' => $user->getUsername(),
                            'email' => $user->getEmail(),
                            'password' => $user->getPassword(),
                            'dob' => $user->getDate(),
                            'role' => $user->getRole(),
                            'image' => $user->getimage(),
                    ]);
                                
                    }
                    catch (Exception $e){
                        echo 'Erreur: '.$e->getMessage();
                    }			
                }
        /////..............................Affichage par la cle Primaire............................../////
                function RecupererUser($idUser){
                    $sql="SELECT * from user where idUser=$idUser";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $user=$query->fetch();
                        return $user;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }
        
        /////..............................Update............................../////
                function ModifierUser($user,$idUser){
                    try {
                        $db = config::getConnexion();
                $query = $db->prepare('UPDATE user SET  username = :username, email = :email, password = :password , dob = :dob, role = :role , image = :image WHERE idUser= :idUser');
                        $query->execute([
                            'username' => $user->getUsername(),
                            'email' => $user->getEmail(),
                            'password' => $user->getPassword(),
                            'dob' => $user->getDate(),
                            'role' => $user->getRole(),
                            'image' => $user->getimage(),
                            'idUser' => $idUser
                        ]);
                        echo $query->rowCount() . " UPDATED successfully <br>";
                    } catch (PDOException $e) {
                        $e->getMessage();
                    }
                }

                function RecupererUserByEmail($Email){
                    $sql="SELECT * from user where email='".$Email."'";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $user=$query->fetch();
                        return $user;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }


                public function getTotalUsers()
                    {
                        $sql = 'SELECT COUNT(*) AS nb_user FROM user';
                        $db = config::getConnexion();

                        try {
                            $query = $db->query($sql);
                            $result = $query->fetch();
                            return (int) $result['nb_user'];
                        } catch (Exception $e) {
                            die('Erreur: ' . $e->getMessage());
                        }
                    }



                        // Function to get users with pagination
                        public function getUserWithPagination($start, $itemsPerPage)
                        {
                            $sql = 'SELECT * FROM user LIMIT :start, :itemsPerPage';
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


                        		/////..............................tri............................../////
		function Recherche($email){
			$sql="SELECT * from user where email like '".$email."%' ";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}



		/////..............................tri............................../////
	function TriRole(){
		$sql="SELECT * FROM user order by role ASC";
		$db = config::getConnexion();
		try{
			$liste = $db->query($sql);
			return $liste;
		}
		catch(Exception $e){
			die('Erreur:'. $e->getMessage());
		}
	}

    function TriDob(){
		$sql="SELECT * FROM user order by dob DESC";
		$db = config::getConnexion();
		try{
			$liste = $db->query($sql);
			return $liste;
		}
		catch(Exception $e){
			die('Erreur:'. $e->getMessage());
		}
	}

    function TriUsername(){
		$sql="SELECT * FROM user order by username ASC";
		$db = config::getConnexion();
		try{
			$liste = $db->query($sql);
			return $liste;
		}
		catch(Exception $e){
			die('Erreur:'. $e->getMessage());
		}
	}

    function CountUsersByRole() {
        $sql = "SELECT role, COUNT(*) AS count FROM user GROUP BY role";
        $db = config::getConnexion();
    
        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    function ModifierPassword($idUser,$password){
        try {
            $db = config::getConnexion();
    $query = $db->prepare('UPDATE user SET  password = :password    WHERE idUser =:idUser');
            $query->execute([
                
                'password' => $password,
                'idUser' => $idUser,
        
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



            }

