<?php
require("Manager.php");

class ProjectManager extends Manager {

    public function getAllProject() {
        $requete = $this->getAll("Project");
        return $requete;
    }


    public function addProject($title,$content,$id_user){
        $bdd = $this->connection();
        $requete = $bdd->prepare("INSERT INTO Project(title,content,id_user) VALUES (?,?,?)");
        $result = $requete->execute([$title,$content,$id_user]);
        return $result;        
    }
}