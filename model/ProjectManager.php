<?php
require("Manager.php");

class ProjectManager extends Manager {

    public function getAllProject() {
        $requete = $this->getAll("projects");
        return $requete;
    }


    public function addProject($title,$content,$id_user,$img){
        $bdd = $this->connection();
        $requete = $bdd->prepare("INSERT INTO projects(title,content,id_user,img) VALUES (?,?,?,?)");
        $result = $requete->execute([$title,$content,$id_user,$img]);
        return $result;        
    }

    public function deleteProject ($id) {
        $bdd = $this->connection();        
        $requete = $bdd->prepare("DELETE FROM projects WHERE id = ? ");
        $requete->execute([$id]);
        return $requete->rowCount();
    }


    public function updateProject($id){
        $bdd = $this->connection();  
        $requete = $bdd->prepare("SELECT * FROM projects WHERE id= ?");
        $requete->execute([$id]);
        return $requete;
    }

    public function updateProjectBdd ($title,$content,$id_user,$id,$img) {
        $bdd = $this->connection();         
        $requete = $bdd->prepare("UPDATE projects SET title = ?, content =?, id_user=?,img=? WHERE id = ? ");
        $requete->execute([$title,$content,$id_user,$img,$id]);
        return $requete->rowCount();
    }

}