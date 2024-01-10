<?php
    namespace App\Utils;
    class BddConnect{
        //fonction connexion BDD
        public function connexion(){
            //retour de l'objet PDO
            return new \PDO('mysql:host='.HOST.';dbname='.DATABASE.'', LOGIN, PASSWORD, 
            array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
    }

