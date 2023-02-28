<?php
require_once("../model/DataBaseManager.php");


class ProjectRepository extends DBManager {

    const TABLE_NAME = "projects";

    public function getAllProject() {
        $requete = $this->getAll($this::TABLE_NAME);
        return $requete;
    }


    public function addProject($title,$content,$id_user,$img){
        $bdd = $this->connection();
        $requete = $bdd->prepare("INSERT INTO ".$this::TABLE_NAME."(title,content,id_user,img) VALUES (?,?,?,?)");
        $result = $requete->execute([$title,$content,$id_user,$img]);
        return $result;        
    }

    public function deleteProject ($id) {
        $bdd = $this->connection();        
        $requete = $bdd->prepare("DELETE FROM ".$this::TABLE_NAME." WHERE id = ? ");
        $requete->execute([$id]);
        return $requete->rowCount();
    }


    public function updateProject($id){
        $bdd = $this->connection();  
        $requete = $bdd->prepare("SELECT * FROM ".$this::TABLE_NAME." WHERE id= ?");
        $requete->execute([$id]);
        return $requete;
    }

    public function updateProjectBdd ($title,$content,$id,$img) {
        $bdd = $this->connection();         
        $requete = $bdd->prepare("UPDATE ".$this::TABLE_NAME." SET title = ?, content =?, img=? WHERE id = ? ");
        $requete->execute([$title,$content,$img,$id]);
        return $requete->rowCount();
    }

}