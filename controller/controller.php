
<?php

    require("../model/ProjectManager.php");

     function home() {
        // Model
        $projetManagers = new ProjectManager;
        $requete = $projetManagers->getAllProject();
        // view
        require("../view/projectView.php");        
    }

    function createProject() {
        // Model

        //View
        require ("../view/createProjectView.php");
    }

    
    function addProject($title,$content,$id_user) {
        // Model
        $projet = new ProjectManager;
        $result = $projet->addProject($title,$content,$id_user);
        echo $result;
        if ($result){
            header("location:index.php?page=home&&succes=1&&message=L'article à bien été créér");
        } else {
            throw new Exception("L'article n'a pas pu etre créer");
        }


    }

