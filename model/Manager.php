<?php

class Manager {

    protected function connection () {
        try {
            $bdd = new PDO('mysql:host=localhost:3301;dbname=blog;charset=utf8', 'root', 'root');
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