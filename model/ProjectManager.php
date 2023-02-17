<?php
require("Manager.php");

class ProjectManager extends Manager {

    public function getAllProject() {
        $requete = $this->getAll("Project");
        return $requete;

    }
}