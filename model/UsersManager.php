
<?php

require_once ("Manager.php");


class UserManagers extends Manager {   

    public function getAllUser() {
        $requete = $this->getAll("users");
        return $requete;
    }

    public function addUserBdd($login,$password,$email,$rank="user"){

        $bdd = $this->connection();
        $requete = $bdd->prepare("INSERT INTO users (login, password, email,`rank`) VALUES (?,?,?,?)");      
        $requete->execute([$login,$password,$email,$rank]);
        return $requete;
    }

    public function avalaibleLogin($login){
        $bdd = $this->connection();
        $requete = $bdd->prepare("SELECT * FROM users WHERE login = ? ");
        $requete->execute([$login]);
        return $requete->rowCount();       
    }
 }
