<?php

class Manager {

    protected function connection () {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        }catch(Exception $e) {
            throw new Exception ('Erreur : '.$e->getMessage());
        }
        return $bdd;
    }

    protected function getAll ($table) {  
        $bdd= $this->connection();
        $requete = $bdd->query('SELECT * FROM '.$table);
        return $requete;
        
    }





    
}