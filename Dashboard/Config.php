<?php
      class Config {
        private static $pdo = NULL ; 
        public static function GetConnexion (){
            if (!isset(self :: $pdo)){
                try {
                    self :: $pdo = new PDO ('mysql:host=localhost;dbname=test','root','',
                    [
                       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 

                    ]);
                } catch (Exception $e){
                    die('Erreur:'.$e->GetMessage());
                }
            }
            return self ::$pdo ; 
        }
   }

