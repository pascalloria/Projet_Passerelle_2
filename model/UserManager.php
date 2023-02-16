<?php

require ("Manager.php");

 Class UserManager extends Manager {


    public function getAllUser() {

        $requete = $this->getAll("users");
        return $requete;

    }
    

 }